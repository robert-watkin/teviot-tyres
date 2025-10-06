# Admin System Design - Role-Based Access Control

**Last Updated**: 2025-10-06  
**Status**: Planning Phase  

---

## 🎯 User Role Hierarchy

### 1. Standard User (Default)
**Permissions**:
- ✅ View own dashboard
- ✅ Save vehicles (max 10)
- ✅ View own saved vehicles
- ✅ Delete own vehicles
- ✅ Manage own profile
- ❌ No admin access

**Database**: `role = 'user'` (default)

---

### 2. Admin
**Permissions**:
- ✅ All standard user permissions
- ✅ View all users
- ✅ Search/filter users
- ✅ View user details
- ✅ View user's saved vehicles
- ✅ Delete users (with confirmation)
- ✅ View all vehicles
- ✅ Search/filter vehicles
- ✅ Delete vehicles (with confirmation)
- ✅ View analytics dashboard
- ❌ Cannot manage other admins
- ❌ Cannot change user roles

**Database**: `role = 'admin'`

---

### 3. Owner (Super Admin)
**Permissions**:
- ✅ All admin permissions
- ✅ **Promote users to admin**
- ✅ **Demote admins to user**
- ✅ View all admins
- ✅ Manage admin access
- ✅ Cannot be deleted
- ✅ Full system access

**Database**: `role = 'owner'`

**Note**: Only ONE owner account (the client)

---

## 🗄️ Database Schema

### Migration: Add Role Column
```php
// database/migrations/xxxx_add_role_to_users_table.php
Schema::table('users', function (Blueprint $table) {
    $table->enum('role', ['user', 'admin', 'owner'])
          ->default('user')
          ->after('email');
    $table->index('role');
});
```

### User Model
```php
// app/Models/User.php
class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password', 'role'];
    
    // Role checks
    public function isUser(): bool
    {
        return $this->role === 'user';
    }
    
    public function isAdmin(): bool
    {
        return in_array($this->role, ['admin', 'owner']);
    }
    
    public function isOwner(): bool
    {
        return $this->role === 'owner';
    }
    
    // Can manage roles
    public function canManageRoles(): bool
    {
        return $this->isOwner();
    }
}
```

---

## 🎨 UI Design - Sidebar Navigation

### Standard User Sidebar
```
Platform
├─ Dashboard
│
Settings
├─ Profile
├─ Password
├─ Two-Factor Auth
├─ Appearance
```

### Admin Sidebar
```
Platform
├─ Dashboard
│
Admin ▼ (Dropdown)
├─ Analytics
├─ Users
├─ Vehicles
│
Settings
├─ Profile
├─ Password
├─ Two-Factor Auth
├─ Appearance
```

### Owner Sidebar
```
Platform
├─ Dashboard
│
Admin ▼ (Dropdown)
├─ Analytics
├─ Users
├─ Vehicles
├─ Manage Admins ⭐ (Owner only)
│
Settings
├─ Profile
├─ Password
├─ Two-Factor Auth
├─ Appearance
```

---

## 📄 Admin Pages

### 1. Analytics Dashboard (`/admin`)
**Access**: Admin, Owner  
**Features**:
- Total users (with growth %)
- Total vehicles saved (with growth %)
- Recent registrations (last 7 days)
- Recent vehicle saves (last 7 days)
- Most saved vehicles (top 10)
- DVLA API usage stats
- Quick actions (view users, view vehicles)

**UI Components**:
- Stat cards (4-6 cards)
- Recent activity feed
- Top vehicles table
- Quick action buttons

---

### 2. Users Management (`/admin/users`)
**Access**: Admin, Owner  
**Features**:
- List all users with pagination (20 per page)
- Search by name/email
- Filter by role (user/admin/owner)
- Sort by: name, email, created date, vehicle count
- View user details (modal or page)
- Delete user (with confirmation)
- Show user's saved vehicles
- **Email all users** (mailto: link with all emails in BCC)
- **Email individual user** (mailto: link)

**UI Components**:
- Search bar
- Filter dropdown (role)
- **"Email All Users" button** (top right) - Opens mailto: with all user emails in BCC
- Users table with columns:
  - Name
  - Email
  - Role (badge)
  - Vehicles Count
  - Registered Date
  - Actions (View, Email, Delete)
- User detail modal
- Delete confirmation dialog

**User Detail Modal**:
- User info (name, email, role, registration date)
- Statistics (vehicles saved, last login)
- Saved vehicles list
- Actions (Email user, Delete user)

**Email Functionality**:
- **Email All**: `mailto:?bcc=user1@email.com,user2@email.com,...`
- **Email Individual**: `mailto:user@email.com`
- Opens in admin's default email client (Outlook, Gmail, etc.)
- Admin can compose message in their preferred email app

---

### 3. Vehicles Management (`/admin/vehicles`)
**Access**: Admin, Owner  
**Features**:
- List all vehicles with pagination (20 per page)
- Search by registration
- Filter by: date saved, user
- Sort by: registration, user, date saved
- View vehicle details
- Delete vehicle (with confirmation)
- Show which users saved this vehicle

**UI Components**:
- Search bar
- Filter dropdowns
- Vehicles table with columns:
  - Registration
  - Make/Model
  - Saved By (user name)
  - Date Saved
  - Actions (View, Delete)
- Vehicle detail modal
- Delete confirmation dialog

**Vehicle Detail Modal**:
- Vehicle info (registration, make, model, year, etc.)
- Saved by user (name, email)
- Date saved
- Actions (Delete vehicle)

---

### 4. Manage Admins (`/admin/manage-admins`) ⭐
**Access**: Owner ONLY  
**Features**:
- List all admins
- Search admins
- Promote user to admin
- Demote admin to user
- View admin activity

**UI Components**:
- Current admins table
- Search users to promote
- Promote/Demote buttons with confirmation
- Admin activity log

**Promote User Flow**:
1. Search for user by name/email
2. Select user from results
3. Confirm promotion
4. User becomes admin

**Demote Admin Flow**:
1. Click "Demote" on admin
2. Confirm demotion
3. Admin becomes user

---

## 🔒 Middleware & Authorization

### Middleware
```php
// app/Http/Middleware/EnsureUserIsAdmin.php
public function handle(Request $request, Closure $next)
{
    if (!$request->user() || !$request->user()->isAdmin()) {
        abort(403, 'Unauthorized access.');
    }
    return $next($request);
}

// app/Http/Middleware/EnsureUserIsOwner.php
public function handle(Request $request, Closure $next)
{
    if (!$request->user() || !$request->user()->isOwner()) {
        abort(403, 'Unauthorized access.');
    }
    return $next($request);
}
```

### Route Protection
```php
// routes/web.php
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/vehicles', [AdminController::class, 'vehicles'])->name('admin.vehicles');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::delete('/vehicles/{vehicle}', [AdminController::class, 'deleteVehicle'])->name('admin.vehicles.delete');
    
    // Owner only routes
    Route::middleware('owner')->group(function () {
        Route::get('/manage-admins', [AdminController::class, 'manageAdmins'])->name('admin.manage-admins');
        Route::post('/users/{user}/promote', [AdminController::class, 'promoteToAdmin'])->name('admin.users.promote');
        Route::post('/users/{user}/demote', [AdminController::class, 'demoteToUser'])->name('admin.users.demote');
    });
});
```

---

## 🎨 UI Components Needed

### 1. Sidebar Admin Dropdown
```vue
<SidebarGroup v-if="isAdmin">
  <SidebarGroupLabel>Admin</SidebarGroupLabel>
  <SidebarGroupContent>
    <SidebarMenu>
      <SidebarMenuItem>
        <SidebarMenuButton as-child>
          <Link href="/admin">Analytics</Link>
        </SidebarMenuButton>
      </SidebarMenuItem>
      <SidebarMenuItem>
        <SidebarMenuButton as-child>
          <Link href="/admin/users">Users</Link>
        </SidebarMenuButton>
      </SidebarMenuItem>
      <SidebarMenuItem>
        <SidebarMenuButton as-child>
          <Link href="/admin/vehicles">Vehicles</Link>
        </SidebarMenuButton>
      </SidebarMenuItem>
      <SidebarMenuItem v-if="isOwner">
        <SidebarMenuButton as-child>
          <Link href="/admin/manage-admins">Manage Admins</Link>
        </SidebarMenuButton>
      </SidebarMenuItem>
    </SidebarMenu>
  </SidebarGroupContent>
</SidebarGroup>
```

### 2. Role Badge Component
```vue
<Badge :variant="roleVariant(user.role)">
  {{ user.role.toUpperCase() }}
</Badge>
```

### 3. Stat Card Component
```vue
<Card>
  <CardHeader>
    <CardTitle>{{ title }}</CardTitle>
  </CardHeader>
  <CardContent>
    <div class="text-3xl font-bold">{{ value }}</div>
    <p class="text-sm text-muted-foreground">
      {{ change > 0 ? '+' : '' }}{{ change }}% from last week
    </p>
  </CardContent>
</Card>
```

### 4. Delete Confirmation Dialog
```vue
<AlertDialog>
  <AlertDialogTrigger>Delete</AlertDialogTrigger>
  <AlertDialogContent>
    <AlertDialogHeader>
      <AlertDialogTitle>Are you sure?</AlertDialogTitle>
      <AlertDialogDescription>
        This action cannot be undone. This will permanently delete the {{ type }}.
      </AlertDialogDescription>
    </AlertDialogHeader>
    <AlertDialogFooter>
      <AlertDialogCancel>Cancel</AlertDialogCancel>
      <AlertDialogAction @click="confirmDelete">Delete</AlertDialogAction>
    </AlertDialogFooter>
  </AlertDialogContent>
</AlertDialog>
```

---

## 📧 Email Functionality Implementation

### Backend - Generate Email Links
```php
// AdminController.php

// Get all user emails for "Email All" button
public function getUserEmails()
{
    $emails = User::where('role', 'user') // Only regular users, not admins
        ->pluck('email')
        ->implode(',');
    
    return response()->json(['emails' => $emails]);
}

// Or pass directly to view
public function users()
{
    $users = User::withCount('vehicles')->paginate(20);
    $allEmails = User::where('role', 'user')->pluck('email')->implode(',');
    
    return Inertia::render('Admin/Users', [
        'users' => $users,
        'allEmails' => $allEmails,
    ]);
}
```

### Frontend - Email Buttons
```vue
<!-- Email All Users Button -->
<a 
  :href="`mailto:?bcc=${allEmails}`"
  class="inline-flex items-center gap-2 rounded-lg bg-[#FFD700] px-4 py-2 text-sm font-semibold text-black hover:brightness-95"
>
  <Mail class="h-4 w-4" />
  Email All Users
</a>

<!-- Email Individual User Button (in table row) -->
<a 
  :href="`mailto:${user.email}`"
  class="inline-flex items-center gap-1 text-sm text-[#FFD700] hover:underline"
>
  <Mail class="h-4 w-4" />
  Email
</a>

<!-- Email User Button (in detail modal) -->
<a 
  :href="`mailto:${user.email}`"
  class="inline-flex items-center gap-2 rounded-lg border border-[#FFD700] px-4 py-2 text-sm font-semibold text-[#FFD700] hover:bg-[#FFD700]/10"
>
  <Mail class="h-4 w-4" />
  Email User
</a>
```

### How It Works
1. **Email All Users**: 
   - Click button → Opens email client
   - All user emails in BCC field
   - Admin composes message
   - Sends from their email account

2. **Email Individual User**:
   - Click "Email" next to user → Opens email client
   - User's email in "To" field
   - Admin composes message
   - Sends from their email account

**Benefits**:
- ✅ No email configuration needed in app
- ✅ Admin uses their preferred email client
- ✅ No email sending limits
- ✅ Admin's email signature/branding
- ✅ Simple and reliable
- ✅ No SMTP setup required

---

## 📊 Database Queries

### Analytics Stats
```php
// Total users
$totalUsers = User::count();

// Users this week
$usersThisWeek = User::where('created_at', '>=', now()->subWeek())->count();

// Total vehicles
$totalVehicles = Vehicle::count();

// Vehicles this week
$vehiclesThisWeek = Vehicle::where('created_at', '>=', now()->subWeek())->count();

// Most saved vehicles
$topVehicles = Vehicle::select('registration', DB::raw('COUNT(*) as count'))
    ->groupBy('registration')
    ->orderByDesc('count')
    ->limit(10)
    ->get();

// Recent users
$recentUsers = User::latest()->limit(5)->get();

// Recent vehicles
$recentVehicles = Vehicle::with('user')->latest()->limit(5)->get();
```

### User Management
```php
// All users with vehicle count
$users = User::withCount('vehicles')
    ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%")
        ->orWhere('email', 'like', "%{$search}%"))
    ->when($roleFilter, fn($q) => $q->where('role', $roleFilter))
    ->orderBy($sortBy, $sortDirection)
    ->paginate(20);
```

### Vehicle Management
```php
// All vehicles with user info
$vehicles = Vehicle::with('user')
    ->when($search, fn($q) => $q->where('registration', 'like', "%{$search}%"))
    ->orderBy($sortBy, $sortDirection)
    ->paginate(20);
```

---

## 🔐 Security Considerations

### 1. Role Validation
- Always check role in middleware
- Never trust client-side role checks
- Validate role on every admin action

### 2. Owner Protection
- Owner account cannot be deleted
- Owner role cannot be changed
- Only one owner account allowed

### 3. Admin Actions
- Log all admin actions (user deletions, role changes)
- Require confirmation for destructive actions
- Show who performed the action

### 4. Authorization
```php
// Prevent self-demotion
if ($user->id === auth()->id() && $user->isOwner()) {
    throw new Exception('Cannot demote yourself');
}

// Prevent owner deletion
if ($user->isOwner()) {
    throw new Exception('Cannot delete owner account');
}

// Only owner can manage roles
if (!auth()->user()->isOwner()) {
    abort(403);
}
```

---

## 📋 Implementation Checklist

### Phase 1: Database & Auth (1 hour)
- [ ] Create migration for role column
- [ ] Update User model with role methods
- [ ] Create admin middleware
- [ ] Create owner middleware
- [ ] Protect routes
- [ ] Create seeder for owner account
- [ ] Test role checks

### Phase 2: Sidebar Navigation (30 min)
- [ ] Update AppSidebar.vue
- [ ] Add admin dropdown
- [ ] Show/hide based on role
- [ ] Test visibility for each role

### Phase 3: Analytics Dashboard (2 hours)
- [ ] Create AdminController
- [ ] Build analytics queries
- [ ] Create Admin/Dashboard.vue page
- [ ] Add stat cards
- [ ] Add recent activity
- [ ] Add top vehicles table
- [ ] Test with real data

### Phase 4: User Management (3 hours)
- [ ] Create Admin/Users.vue page
- [ ] Add users table with pagination
- [ ] Add search functionality
- [ ] Add role filter
- [ ] Add sorting
- [ ] **Add "Email All Users" button (mailto: with BCC)**
- [ ] **Add "Email" button for each user (mailto:)**
- [ ] Create user detail modal
- [ ] Add delete functionality
- [ ] Test all features

### Phase 5: Vehicle Management (2 hours)
- [ ] Create Admin/Vehicles.vue page
- [ ] Add vehicles table with pagination
- [ ] Add search functionality
- [ ] Add sorting
- [ ] Create vehicle detail modal
- [ ] Add delete functionality
- [ ] Test all features

### Phase 6: Manage Admins (1.5 hours)
- [ ] Create Admin/ManageAdmins.vue page
- [ ] List current admins
- [ ] Add user search for promotion
- [ ] Add promote functionality
- [ ] Add demote functionality
- [ ] Add confirmations
- [ ] Test role changes

### Phase 7: Testing & Polish (1 hour)
- [ ] Test all admin features
- [ ] Test role-based access
- [ ] Test owner-only features
- [ ] Add loading states
- [ ] Add error handling
- [ ] Write tests for admin features
- [ ] Update documentation

---

## 🧪 Testing Plan

### Unit Tests
```php
test('user has correct default role', function () {
    $user = User::factory()->create();
    expect($user->role)->toBe('user');
    expect($user->isUser())->toBeTrue();
    expect($user->isAdmin())->toBeFalse();
});

test('admin can access admin routes', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $response = $this->actingAs($admin)->get('/admin');
    $response->assertStatus(200);
});

test('user cannot access admin routes', function () {
    $user = User::factory()->create(['role' => 'user']);
    $response = $this->actingAs($user)->get('/admin');
    $response->assertStatus(403);
});

test('only owner can promote users', function () {
    $owner = User::factory()->create(['role' => 'owner']);
    $user = User::factory()->create(['role' => 'user']);
    
    $response = $this->actingAs($owner)
        ->post("/admin/users/{$user->id}/promote");
    
    $response->assertStatus(200);
    expect($user->fresh()->role)->toBe('admin');
});
```

---

## 💰 Time Estimate

| Task | Time |
|------|------|
| Database & Auth | 1h |
| Sidebar Navigation | 30min |
| Analytics Dashboard | 2h |
| User Management (with mailto: email) | 3h |
| Vehicle Management | 2h |
| Manage Admins | 1.5h |
| Testing & Polish | 1h |
| **TOTAL** | **11 hours** |

**Budget Impact**: £165 (11h × £15/hour)  
**Overage**: £105 over original budget  
**Justification**: Critical for non-technical client to manage site

**Note**: Email functionality is simple mailto: links (30 min), included in User Management time

---

## 🎯 Success Criteria

### Must Have
- ✅ Three distinct roles (user, admin, owner)
- ✅ Admin dropdown in sidebar (only for admins)
- ✅ Analytics dashboard with key metrics
- ✅ User management (view, search, delete)
- ✅ Vehicle management (view, search, delete)
- ✅ Owner can promote/demote admins
- ✅ All routes properly protected
- ✅ Owner account cannot be deleted
- ✅ Confirmations for destructive actions

### Nice to Have (Post-Launch)
- Export data to CSV
- Bulk actions
- Advanced filtering
- Activity logs
- Email notifications for admin actions

---

**Status**: Ready to implement 🚀  
**Next Step**: Start with database migration and role system
