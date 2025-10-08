<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import { Users as UsersIcon, Mail, Trash2, Search, Filter, ArrowUpDown, ArrowUp, ArrowDown, Clipboard } from 'lucide-vue-next';
import { ref, computed } from 'vue';

interface User {
  id: number;
  name: string;
  email: string;
  role: 'user' | 'admin' | 'owner';
  vehicles_count: number;
  created_at: string;
}

interface PaginatedUsers {
  data: User[];
  current_page: number;
  last_page: number;
  per_page: number;
  total: number;
}

interface Props {
  users: PaginatedUsers;
  allEmails: string;
  filters: {
    search?: string;
    role?: string;
    sort?: string;
    direction?: string;
  };
}

const props = defineProps<Props>();

const breadcrumbs = [
  { title: 'Dashboard', href: '/dashboard' },
  { title: 'Admin', href: '/admin' },
  { title: 'Users', href: '/admin/users' },
];

const searchForm = useForm({
  search: props.filters.search || '',
  role: props.filters.role || '',
});

const deleteForm = useForm({});
const userToDelete = ref<User | null>(null);
const showDeleteDialog = ref(false);
const confirmDeleteEmail = ref('');
const copyStatus = ref<'idle' | 'copied' | 'error'>('idle');
let copyStatusTimeout: ReturnType<typeof setTimeout> | null = null;

const currentSort = computed(() => props.filters.sort || 'created_at');
const currentDirection = computed(() => props.filters.direction || 'desc');

const search = () => {
  router.get('/admin/users', {
    search: searchForm.search,
    role: searchForm.role,
    sort: currentSort.value,
    direction: currentDirection.value,
  }, {
    preserveState: true,
    preserveScroll: true,
  });
};

const clearFilters = () => {
  searchForm.search = '';
  searchForm.role = '';
  search();
};

const confirmDelete = (user: User) => {
  userToDelete.value = user;
  showDeleteDialog.value = true;
  confirmDeleteEmail.value = '';
};

const deleteUser = () => {
  if (!userToDelete.value) return;
  
  deleteForm.delete(`/admin/users/${userToDelete.value.id}`, {
    preserveScroll: true,
    onSuccess: () => {
      cancelDelete();
    },
  });
};

const cancelDelete = () => {
  showDeleteDialog.value = false;
  confirmDeleteEmail.value = '';
  userToDelete.value = null;
};

const copyEmailsToClipboard = async () => {
  if (!props.allEmails) return;
  const resetStatus = () => {
    if (copyStatusTimeout) {
      clearTimeout(copyStatusTimeout);
    }
    copyStatusTimeout = setTimeout(() => {
      copyStatus.value = 'idle';
      copyStatusTimeout = null;
    }, 2500);
  };

  try {
    if (navigator?.clipboard?.writeText) {
      await navigator.clipboard.writeText(props.allEmails);
    } else {
      const textarea = document.createElement('textarea');
      textarea.value = props.allEmails;
      textarea.setAttribute('readonly', '');
      textarea.style.position = 'absolute';
      textarea.style.left = '-9999px';
      document.body.appendChild(textarea);
      textarea.select();
      document.execCommand('copy');
      document.body.removeChild(textarea);
    }
    copyStatus.value = 'copied';
  } catch (error) {
    console.error('Failed to copy emails', error);
    copyStatus.value = 'error';
  } finally {
    resetStatus();
  }
};

const getRoleBadgeClass = (role: string) => {
  switch (role) {
    case 'owner':
      return 'bg-[#FFD700]/20 text-[#FFD700] border-[#FFD700]/30';
    case 'admin':
      return 'bg-blue-500/20 text-blue-400 border-blue-500/30';
    default:
      return 'bg-gray-500/20 text-gray-400 border-gray-500/30';
  }
};

const formatDate = (date: string) => {
  return new Date(date).toLocaleDateString('en-GB', {
    day: 'numeric',
    month: 'short',
    year: 'numeric',
  });
};

const sort = (column: string) => {
  let direction = 'asc';
  
  // If clicking the same column, toggle direction
  if (props.filters.sort === column) {
    direction = props.filters.direction === 'asc' ? 'desc' : 'asc';
  }
  
  router.get('/admin/users', {
    search: searchForm.search,
    role: searchForm.role,
    sort: column,
    direction: direction,
  }, {
    preserveState: true,
    preserveScroll: true,
  });
};

const getSortIcon = (column: string) => {
  if (props.filters.sort !== column) {
    return ArrowUpDown;
  }
  return props.filters.direction === 'asc' ? ArrowUp : ArrowDown;
};
</script>

<template>
  <AppLayout :breadcrumbs="breadcrumbs">
    <Head title="Admin - Users" />
    
    <div class="flex h-full flex-1 flex-col gap-6 overflow-x-auto p-4">
      <!-- Header -->
      <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
        <div>
          <h1 class="text-2xl font-bold tracking-tight">Users Management</h1>
          <p class="mt-1 text-sm text-muted-foreground">
            Manage all users ({{ props.users.total }} total)
          </p>
        </div>

        <div class="flex flex-col gap-2 sm:flex-row sm:items-center">
          <a 
            :href="`mailto:?bcc=${props.allEmails}`"
            class="inline-flex items-center gap-2 rounded-lg bg-[#FFD700] px-4 py-2 text-sm font-semibold text-black transition-all hover:brightness-95"
          >
            <Mail class="h-4 w-4" />
            Email All Users
          </a>
          <button
            type="button"
            @click="copyEmailsToClipboard"
            class="inline-flex items-center gap-2 rounded-lg border border-sidebar-border px-4 py-2 text-sm font-semibold text-foreground transition-colors hover:bg-muted"
          >
            <Clipboard class="h-4 w-4" />
            Copy Emails
          </button>
        </div>
      </div>

      <p
        v-if="copyStatus === 'copied' || copyStatus === 'error'"
        :class="[
          'text-xs font-medium',
          copyStatus === 'copied' ? 'text-emerald-400' : 'text-red-400'
        ]"
      >
        {{ copyStatus === 'copied' ? 'All email addresses copied to clipboard.' : 'Unable to copy. Please try again.' }}
      </p>

      <!-- Filters -->
      <div class="flex flex-wrap items-center gap-3">
        <!-- Search -->
        <div class="flex-1 min-w-[200px]">
          <div class="relative">
            <Search class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-muted-foreground" />
            <input
              v-model="searchForm.search"
              @keyup.enter="search"
              type="text"
              placeholder="Search by name or email..."
              class="w-full rounded-lg border border-sidebar-border bg-background pl-10 pr-4 py-2 text-sm focus:border-[#FFD700] focus:outline-none focus:ring-1 focus:ring-[#FFD700]"
            />
          </div>
        </div>

        <!-- Role Filter -->
        <select
          v-model="searchForm.role"
          @change="search"
          class="rounded-lg border border-sidebar-border bg-background px-4 py-2 text-sm focus:border-[#FFD700] focus:outline-none focus:ring-1 focus:ring-[#FFD700]"
        >
          <option value="">All Roles</option>
          <option value="user">User</option>
          <option value="admin">Admin</option>
          <option value="owner">Owner</option>
        </select>

        <!-- Search Button -->
        <button
          @click="search"
          class="inline-flex items-center gap-2 rounded-lg bg-[#FFD700] px-4 py-2 text-sm font-semibold text-black hover:brightness-95 transition-all"
        >
          <Search class="h-4 w-4" />
          Search
        </button>

        <!-- Clear Filters -->
        <button
          v-if="searchForm.search || searchForm.role"
          @click="clearFilters"
          class="text-sm text-muted-foreground hover:text-foreground transition-colors"
        >
          Clear filters
        </button>
      </div>

      <!-- Users Table (Desktop) -->
      <div class="hidden rounded-xl border border-sidebar-border bg-card md:block">
        <div class="overflow-x-auto">
          <table class="w-full">
            <thead class="border-b border-sidebar-border bg-muted/50">
              <tr>
                <th class="w-[14rem] min-w-[14rem] px-4 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                  <button
                    @click="sort('name')"
                    class="inline-flex items-center gap-1 hover:text-foreground transition-colors"
                  >
                    Name
                    <component :is="getSortIcon('name')" class="h-3 w-3" />
                  </button>
                </th>
                <th class="w-[18rem] min-w-[18rem] px-4 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                  <button
                    @click="sort('email')"
                    class="inline-flex items-center gap-1 hover:text-foreground transition-colors"
                  >
                    Email
                    <component :is="getSortIcon('email')" class="h-3 w-3" />
                  </button>
                </th>
                <th class="w-[8rem] min-w-[8rem] px-4 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                  <button
                    @click="sort('role')"
                    class="inline-flex items-center gap-1 hover:text-foreground transition-colors"
                  >
                    Role
                    <component :is="getSortIcon('role')" class="h-3 w-3" />
                  </button>
                </th>
                <th class="w-[7rem] min-w-[7rem] px-4 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                  <button
                    @click="sort('vehicles_count')"
                    class="inline-flex items-center gap-1 hover:text-foreground transition-colors"
                  >
                    Vehicles
                    <component :is="getSortIcon('vehicles_count')" class="h-3 w-3" />
                  </button>
                </th>
                <th class="w-[10rem] min-w-[10rem] px-4 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                  <button
                    @click="sort('created_at')"
                    class="inline-flex items-center gap-1 hover:text-foreground transition-colors"
                  >
                    Registered
                    <component :is="getSortIcon('created_at')" class="h-3 w-3" />
                  </button>
                </th>
                <th class="w-[10rem] min-w-[10rem] px-4 py-3 text-right text-xs font-medium text-muted-foreground uppercase tracking-wider">
                  Actions
                </th>
              </tr>
            </thead>
            <tbody class="divide-y divide-sidebar-border">
              <tr v-if="props.users.data.length === 0">
                <td colspan="6" class="px-4 py-8 text-center text-sm text-muted-foreground">
                  No users found
                </td>
              </tr>
              <tr
                v-for="user in props.users.data"
                :key="user.id"
                class="hover:bg-muted/50 transition-colors cursor-pointer"
                @click="router.visit(`/admin/users/${user.id}`)"
              >
                <td class="w-[14rem] min-w-[14rem] px-4 py-3">
                  <p class="font-medium">{{ user.name }}</p>
                </td>
                <td class="w-[18rem] min-w-[18rem] px-4 py-3">
                  <p class="text-sm text-muted-foreground">{{ user.email }}</p>
                </td>
                <td class="w-[8rem] min-w-[8rem] px-4 py-3">
                  <span
                    :class="getRoleBadgeClass(user.role)"
                    class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold uppercase"
                  >
                    {{ user.role }}
                  </span>
                </td>
                <td class="w-[7rem] min-w-[7rem] px-4 py-3">
                  <p class="text-sm">{{ user.vehicles_count }}</p>
                </td>
                <td class="w-[10rem] min-w-[10rem] px-4 py-3">
                  <p class="text-sm text-muted-foreground">{{ formatDate(user.created_at) }}</p>
                </td>
                <td class="w-[10rem] min-w-[10rem] px-4 py-3" @click.stop>
                  <div class="flex items-center justify-end gap-2">
                    <!-- Email User -->
                    <a
                      :href="`mailto:${user.email}`"
                      class="inline-flex items-center gap-1 rounded-lg px-3 py-1.5 text-xs font-medium text-[#FFD700] hover:bg-[#FFD700]/10 transition-colors"
                      title="Email user"
                    >
                      <Mail class="h-3 w-3" />
                      Email
                    </a>

                    <!-- Delete User -->
                    <button
                      v-if="user.role !== 'owner'"
                      @click="confirmDelete(user)"
                      class="inline-flex items-center gap-1 rounded-lg px-3 py-1.5 text-xs font-medium text-red-400 hover:bg-red-500/10 transition-colors"
                      title="Delete user"
                    >
                      <Trash2 class="h-3 w-3" />
                      Delete
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Users Cards (Mobile) -->
      <div class="space-y-3 md:hidden">
        <div v-if="props.users.data.length === 0" class="rounded-xl border border-sidebar-border bg-card p-4 text-sm text-muted-foreground">
          No users found
        </div>
        <div v-else class="space-y-3">
          <div
            v-for="user in props.users.data"
            :key="user.id"
            class="rounded-xl border border-sidebar-border bg-card p-4 transition-colors hover:border-[#FFD700]/30"
            @click="router.visit(`/admin/users/${user.id}`)"
          >
            <div class="flex flex-col gap-3">
              <div class="flex items-start justify-between gap-3">
                <div>
                  <p class="text-base font-semibold">{{ user.name }}</p>
                  <p class="text-sm text-muted-foreground">{{ user.email }}</p>
                </div>
                <span
                  :class="getRoleBadgeClass(user.role)"
                  class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold uppercase"
                >
                  {{ user.role }}
                </span>
              </div>
              <div class="flex flex-wrap items-center gap-4 text-sm text-muted-foreground">
                <div class="flex items-center gap-1">
                  <span class="font-semibold text-foreground">Vehicles:</span>
                  {{ user.vehicles_count }}
                </div>
                <div class="flex items-center gap-1">
                  <span class="font-semibold text-foreground">Registered:</span>
                  {{ formatDate(user.created_at) }}
                </div>
              </div>
              <div class="flex flex-col gap-2 sm:flex-row sm:justify-end">
                <a
                  :href="`mailto:${user.email}`"
                  class="inline-flex items-center justify-center gap-2 rounded-lg border border-[#FFD700]/40 px-3 py-2 text-sm font-medium text-[#FFD700] hover:bg-[#FFD700]/10 transition-colors"
                  @click.stop
                >
                  <Mail class="h-4 w-4" />
                  Email
                </a>
                <button
                  v-if="user.role !== 'owner'"
                  @click.stop="confirmDelete(user)"
                  class="inline-flex items-center justify-center gap-2 rounded-lg border border-red-500/40 px-3 py-2 text-sm font-medium text-red-400 hover:bg-red-500/10 transition-colors"
                >
                  <Trash2 class="h-4 w-4" />
                  Delete
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Pagination -->
      <div v-if="props.users.last_page > 1" class="rounded-xl border border-sidebar-border bg-card px-4 py-3">
        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
          <p class="text-sm text-muted-foreground">
            Showing {{ ((props.users.current_page - 1) * props.users.per_page) + 1 }} to 
            {{ Math.min(props.users.current_page * props.users.per_page, props.users.total) }} of 
            {{ props.users.total }} users
          </p>
          <div class="flex flex-wrap items-center gap-2">
            <a
              v-for="page in props.users.last_page"
              :key="page"
              :href="`/admin/users?page=${page}${searchForm.search ? '&search=' + searchForm.search : ''}${searchForm.role ? '&role=' + searchForm.role : ''}${props.filters.sort ? '&sort=' + props.filters.sort : ''}${props.filters.direction ? '&direction=' + props.filters.direction : ''}`"
              :class="[
                'px-3 py-1 rounded-lg text-sm font-medium transition-colors',
                page === props.users.current_page
                  ? 'bg-[#FFD700] text-black'
                  : 'text-muted-foreground hover:bg-muted'
              ]"
            >
              {{ page }}
            </a>
          </div>
        </div>
      </div>

      <!-- Delete Confirmation Dialog -->
      <div
        v-if="showDeleteDialog"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm"
        @click.self="cancelDelete()"
      >
        <div class="w-full max-w-md rounded-xl border border-sidebar-border bg-card p-6 shadow-lg">
          <h2 class="text-xl font-bold">Delete User</h2>
          <p class="mt-2 text-sm text-muted-foreground">
            Are you sure you want to delete <strong>{{ userToDelete?.name }}</strong>? 
            This action cannot be undone. All their saved vehicles will also be deleted.
          </p>
          <div class="mt-6">
            <p class="text-sm font-medium text-muted-foreground">Type the user's email to confirm:</p>
            <div class="mt-2 rounded-lg border border-sidebar-border bg-muted/30 px-3 py-2">
              <p class="text-sm font-mono text-foreground">{{ userToDelete?.email }}</p>
            </div>
            <input
              v-model="confirmDeleteEmail"
              type="email"
              placeholder="Enter email address"
              class="mt-3 w-full rounded-lg border border-sidebar-border bg-background px-3 py-2 text-sm focus:border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500"
            />
            <p v-if="confirmDeleteEmail && confirmDeleteEmail !== userToDelete?.email" class="mt-2 text-xs text-red-500">
              Email does not match.
            </p>
          </div>
          <div class="mt-6 flex items-center justify-end gap-3">
            <button
              @click="cancelDelete"
              class="rounded-lg border border-sidebar-border px-4 py-2 text-sm font-medium hover:bg-muted transition-colors"
            >
              Cancel
            </button>
            <button
              @click="deleteUser"
              :disabled="deleteForm.processing || confirmDeleteEmail !== userToDelete?.email"
              class="rounded-lg bg-red-500 px-4 py-2 text-sm font-medium text-white hover:bg-red-600 disabled:opacity-50 transition-colors"
            >
              {{ deleteForm.processing ? 'Deleting...' : 'Delete User' }}
            </button>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
