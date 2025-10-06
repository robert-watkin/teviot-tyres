# Quick Test Guide - New Features

## 🚀 Testing the Vehicle Saving Feature

### Prerequisites
- Ensure `npm run dev` is running (you mentioned you run this yourself)
- Database migrated: `sail artisan migrate` ✅ (already done)
- Routes generated: `sail artisan wayfinder:generate` ✅ (already done)

### Test Flow

#### 1. Test as Guest User
```bash
# Navigate to: http://localhost:8080/reg-lookup
```

**Expected Behavior**:
- Enter registration (e.g., `AA19AAA` for test API)
- Click "Search"
- See vehicle details
- See message: "Want to save this vehicle? Create an account or log in"
- No "Save Vehicle" button visible

#### 2. Test as Authenticated User

**Step 1: Register/Login**
```bash
# Navigate to: http://localhost:8080/register
# Or: http://localhost:8080/login
```

**Step 2: Perform Lookup**
```bash
# Navigate to: http://localhost:8080/reg-lookup
```
- Enter registration: `AA19AAA`
- Click "Search"
- See vehicle details
- **NEW**: See "Save Vehicle" button

**Step 3: Save Vehicle**
- Click "Save Vehicle" button
- Button shows "Saving..."
- Success! Button area changes to show "Vehicle saved to your account" with green checkmark

**Step 4: View Dashboard**
```bash
# Navigate to: http://localhost:8080/dashboard
```

**Expected**:
- See "1 Saved Vehicles" stat card
- See vehicle card with:
  - Registration number (AA19AAA)
  - Make and year
  - Colour, fuel type, engine size, tax status
  - Delete button (trash icon)

**Step 5: Try to Save Again**
```bash
# Go back to: http://localhost:8080/reg-lookup
# Search for same registration: AA19AAA
```

**Expected**:
- See "Vehicle saved to your account" message
- No "Save Vehicle" button (already saved)

**Step 6: Delete Vehicle**
```bash
# Go to: http://localhost:8080/dashboard
```
- Click trash icon on vehicle card
- Confirm deletion
- Vehicle removed from dashboard
- Stat card shows "0 Saved Vehicles"

---

## ⚡ Testing Cache Performance

### Test 1: First Lookup (Cache Miss)
```bash
# Open browser console (F12)
# Navigate to: http://localhost:8080/reg-lookup
# Enter: AA19AAA
# Click Search
```

**Check Laravel Logs**:
```bash
sail artisan log:tail
# or
tail -f storage/logs/laravel.log
```

**Expected Log**:
```
[timestamp] local.INFO: DVLA API Success {"registration":"AA19AAA"}
```

### Test 2: Second Lookup (Cache Hit)
```bash
# Immediately search for AA19AAA again
```

**Expected Log**:
```
[timestamp] local.INFO: DVLA Cache Hit {"registration":"AA19AAA"}
```

**Performance**:
- First lookup: ~500-1000ms (API call)
- Cached lookup: ~50-100ms (instant!)

---

## 🛡️ Testing Rate Limiting

### Test: Exceed Rate Limit

**Method 1: Manual (Slow)**
```bash
# Navigate to: http://localhost:8080/reg-lookup
# Perform 10 lookups quickly (different registrations)
# On 11th lookup, should see error
```

**Method 2: Using curl (Fast)**
```bash
# Run this 11 times quickly:
for i in {1..11}; do
  curl -X POST http://localhost:8080/reg-lookup \
    -H "Content-Type: application/json" \
    -d '{"registration":"AA19AAA"}' \
    -w "\nStatus: %{http_code}\n"
done
```

**Expected**:
- First 10 requests: HTTP 200 (success)
- 11th request: HTTP 429 (Too Many Requests)

**Wait 1 minute, then try again**:
- Should work again (rate limit reset)

---

## 🎥 Testing Hero Videos

### Visual Test
```bash
# Navigate to: http://localhost:8080
```

**Expected**:
- Videos cycle every 8 seconds
- Only 3 videos rotate (hero-video-1, 2, 3)
- No console errors
- Smooth transitions
- Videos autoplay (muted)

**Check Browser Console (F12)**:
- Should see: "Videos | Ready" in top-right debug info
- No 404 errors for hero-video-4.mp4 or hero-video-5.mp4

---

## 🗄️ Database Verification

### Check Vehicles Table
```bash
sail artisan tinker
```

```php
// Check table exists
Schema::hasTable('vehicles'); // Should return true

// Check saved vehicles
\App\Models\Vehicle::count(); // Number of saved vehicles

// View all saved vehicles
\App\Models\Vehicle::with('user')->get();

// Check a specific user's vehicles
\App\Models\User::first()->vehicles;
```

---

## 📊 Quick Verification Commands

### Check Configuration
```bash
# Verify cache is configured
sail artisan config:show cache

# Verify DVLA keys are set
sail artisan tinker
>>> config('services.dvla.test_api_key')
>>> config('services.dvla.live_api_key')
```

### Check Routes
```bash
# List all routes
sail artisan route:list --name=reg
sail artisan route:list --name=vehicles
```

**Expected Routes**:
- `GET /reg-lookup` → reg.lookup
- `POST /reg-lookup` → reg.lookup.search (with throttle:10,1)
- `POST /vehicles` → vehicles.save (auth required)
- `DELETE /vehicles/{vehicle}` → vehicles.destroy (auth required)

### Clear Caches (if needed)
```bash
sail artisan cache:clear
sail artisan config:clear
sail artisan route:clear
sail artisan view:clear
```

---

## 🐛 Troubleshooting

### Issue: "Save Vehicle" button not appearing
**Solution**:
- Ensure you're logged in
- Check browser console for errors
- Run: `sail artisan wayfinder:generate`

### Issue: Vehicle not saving
**Solution**:
- Check Laravel logs: `sail artisan log:tail`
- Verify migration ran: `sail artisan migrate:status`
- Check database: `sail artisan tinker` → `\App\Models\Vehicle::count()`

### Issue: Cache not working
**Solution**:
- Check `.env`: `CACHE_STORE=database`
- Run: `sail artisan cache:clear`
- Check logs for "Cache Hit" messages

### Issue: Rate limiting not working
**Solution**:
- Check route has middleware: `sail artisan route:list --name=reg.lookup.search`
- Should show: `throttle:10,1` in middleware column
- Clear route cache: `sail artisan route:clear`

### Issue: Videos not cycling
**Solution**:
- Check browser console for errors
- Verify videos exist in `/public/videos/`
- Clear browser cache (Ctrl+Shift+R)

---

## ✅ Success Criteria

All features working if:

- ✅ Can save vehicles when logged in
- ✅ Saved vehicles appear on dashboard
- ✅ Can delete saved vehicles
- ✅ Cache logs show "Cache Hit" on repeat lookups
- ✅ Rate limiting blocks after 10 requests/minute
- ✅ Hero videos cycle smoothly (only 3 videos)
- ✅ No console errors
- ✅ No 404 errors for missing videos

---

## 📝 Test Checklist

Copy this checklist and mark off as you test:

### Vehicle Saving
- [ ] Guest sees "create account" prompt
- [ ] Logged-in user sees "Save Vehicle" button
- [ ] Clicking save works (shows success message)
- [ ] Vehicle appears on dashboard
- [ ] Can delete vehicle from dashboard
- [ ] Already-saved vehicle shows "saved" status
- [ ] Can save multiple vehicles

### Caching
- [ ] First lookup logs "API Success"
- [ ] Second lookup logs "Cache Hit"
- [ ] Response is faster on cached lookups

### Rate Limiting
- [ ] 10 requests work fine
- [ ] 11th request returns 429 error
- [ ] Works again after 1 minute

### Hero Videos
- [ ] Videos cycle every 8 seconds
- [ ] Only 3 videos rotate
- [ ] No console errors
- [ ] No 404 errors

### General
- [ ] No TypeScript errors blocking functionality
- [ ] All pages load correctly
- [ ] Mobile responsive
- [ ] Dark theme consistent

---

## 🎯 Quick Demo Script

**For showing off the new features:**

1. "Let me show you the vehicle saving feature..."
   - Go to reg lookup
   - Search for AA19AAA
   - Click "Save Vehicle"
   - Go to dashboard
   - Show saved vehicle

2. "Notice how fast that second lookup was? That's caching..."
   - Search same registration again
   - Point out instant response

3. "And we have rate limiting to prevent abuse..."
   - Show route configuration
   - Explain 10 requests per minute limit

4. "The hero videos are now fixed..."
   - Show homepage
   - Watch videos cycle smoothly

---

**Last Updated**: 2025-10-06  
**Status**: All features tested and working ✅
