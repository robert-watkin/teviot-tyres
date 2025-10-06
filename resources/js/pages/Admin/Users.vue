<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import { Users as UsersIcon, Mail, Trash2, Search, Filter } from 'lucide-vue-next';
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
  { label: 'Dashboard', href: '/dashboard' },
  { label: 'Admin', href: '/admin' },
  { label: 'Users' },
];

const searchForm = useForm({
  search: props.filters.search || '',
  role: props.filters.role || '',
});

const deleteForm = useForm({});
const userToDelete = ref<User | null>(null);
const showDeleteDialog = ref(false);

const search = () => {
  router.get('/admin/users', {
    search: searchForm.search,
    role: searchForm.role,
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
};

const deleteUser = () => {
  if (!userToDelete.value) return;
  
  deleteForm.delete(`/admin/users/${userToDelete.value.id}`, {
    preserveScroll: true,
    onSuccess: () => {
      showDeleteDialog.value = false;
      userToDelete.value = null;
    },
  });
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
</script>

<template>
  <AppLayout :breadcrumbs="breadcrumbs">
    <Head title="Admin - Users" />
    
    <div class="flex h-full flex-1 flex-col gap-6 overflow-x-auto p-4">
      <!-- Header -->
      <div class="flex items-center justify-between">
        <div>
          <h1 class="text-2xl font-bold tracking-tight">Users Management</h1>
          <p class="mt-1 text-sm text-muted-foreground">
            Manage all users ({{ props.users.total }} total)
          </p>
        </div>
        
        <!-- Email All Users Button -->
        <a 
          :href="`mailto:?bcc=${props.allEmails}`"
          class="inline-flex items-center gap-2 rounded-lg bg-[#FFD700] px-4 py-2 text-sm font-semibold text-black hover:brightness-95 transition-all"
        >
          <Mail class="h-4 w-4" />
          Email All Users
        </a>
      </div>

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

      <!-- Users Table -->
      <div class="rounded-xl border border-sidebar-border bg-card overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full">
            <thead class="border-b border-sidebar-border bg-muted/50">
              <tr>
                <th class="px-4 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                  Name
                </th>
                <th class="px-4 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                  Email
                </th>
                <th class="px-4 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                  Role
                </th>
                <th class="px-4 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                  Vehicles
                </th>
                <th class="px-4 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                  Registered
                </th>
                <th class="px-4 py-3 text-right text-xs font-medium text-muted-foreground uppercase tracking-wider">
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
                class="hover:bg-muted/50 transition-colors"
              >
                <td class="px-4 py-3">
                  <p class="font-medium">{{ user.name }}</p>
                </td>
                <td class="px-4 py-3">
                  <p class="text-sm text-muted-foreground">{{ user.email }}</p>
                </td>
                <td class="px-4 py-3">
                  <span
                    :class="getRoleBadgeClass(user.role)"
                    class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold uppercase"
                  >
                    {{ user.role }}
                  </span>
                </td>
                <td class="px-4 py-3">
                  <p class="text-sm">{{ user.vehicles_count }}</p>
                </td>
                <td class="px-4 py-3">
                  <p class="text-sm text-muted-foreground">{{ formatDate(user.created_at) }}</p>
                </td>
                <td class="px-4 py-3">
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

        <!-- Pagination -->
        <div v-if="props.users.last_page > 1" class="border-t border-sidebar-border px-4 py-3">
          <div class="flex items-center justify-between">
            <p class="text-sm text-muted-foreground">
              Showing {{ ((props.users.current_page - 1) * props.users.per_page) + 1 }} to 
              {{ Math.min(props.users.current_page * props.users.per_page, props.users.total) }} of 
              {{ props.users.total }} users
            </p>
            <div class="flex items-center gap-2">
              <a
                v-for="page in props.users.last_page"
                :key="page"
                :href="`/admin/users?page=${page}${searchForm.search ? '&search=' + searchForm.search : ''}${searchForm.role ? '&role=' + searchForm.role : ''}`"
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
      </div>

      <!-- Delete Confirmation Dialog -->
      <div
        v-if="showDeleteDialog"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm"
        @click.self="showDeleteDialog = false"
      >
        <div class="w-full max-w-md rounded-xl border border-sidebar-border bg-card p-6 shadow-lg">
          <h2 class="text-xl font-bold">Delete User</h2>
          <p class="mt-2 text-sm text-muted-foreground">
            Are you sure you want to delete <strong>{{ userToDelete?.name }}</strong>? 
            This action cannot be undone. All their saved vehicles will also be deleted.
          </p>
          <div class="mt-6 flex items-center justify-end gap-3">
            <button
              @click="showDeleteDialog = false"
              class="rounded-lg border border-sidebar-border px-4 py-2 text-sm font-medium hover:bg-muted transition-colors"
            >
              Cancel
            </button>
            <button
              @click="deleteUser"
              :disabled="deleteForm.processing"
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
