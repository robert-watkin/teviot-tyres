<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import { Shield, UserPlus, UserMinus, Search, ChevronLeft, ChevronRight } from 'lucide-vue-next';
import { ref } from 'vue';

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
  links: Array<{
    url: string | null;
    label: string;
    active: boolean;
  }>;
}

interface Props {
  admins: User[];
  users: PaginatedUsers;
  search?: string;
}

const props = defineProps<Props>();

const breadcrumbs = [
  { title: 'Dashboard', href: '/dashboard' },
  { title: 'Admin', href: '/admin' },
  { title: 'Manage Admins', href: '/admin/manage-admins' },
];

const searchForm = useForm({
  search: props.search || '',
});

const promoteForm = useForm({});
const demoteForm = useForm({});

const userToPromote = ref<User | null>(null);
const userToDemote = ref<User | null>(null);
const showPromoteDialog = ref(false);
const showDemoteDialog = ref(false);

const searchUsers = () => {
  router.get('/admin/manage-admins', {
    search: searchForm.search,
  }, {
    preserveState: true,
    preserveScroll: true,
  });
};

const clearSearch = () => {
  searchForm.search = '';
  searchUsers();
};

const confirmPromote = (user: User) => {
  userToPromote.value = user;
  showPromoteDialog.value = true;
};

const promoteUser = () => {
  if (!userToPromote.value) return;
  
  promoteForm.post(`/admin/users/${userToPromote.value.id}/promote`, {
    preserveScroll: true,
    onSuccess: () => {
      showPromoteDialog.value = false;
      userToPromote.value = null;
      searchForm.search = '';
    },
  });
};

const confirmDemote = (user: User) => {
  userToDemote.value = user;
  showDemoteDialog.value = true;
};

const demoteUser = () => {
  if (!userToDemote.value) return;
  
  demoteForm.post(`/admin/users/${userToDemote.value.id}/demote`, {
    preserveScroll: true,
    onSuccess: () => {
      showDemoteDialog.value = false;
      userToDemote.value = null;
    },
  });
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
    <Head title="Admin - Manage Admins" />
    
    <div class="flex h-full flex-1 flex-col gap-6 overflow-x-auto p-4">
      <!-- Header -->
      <div>
        <h1 class="text-2xl font-bold tracking-tight">Manage Admins</h1>
        <p class="mt-1 text-sm text-muted-foreground">
          Promote users to admin or demote admins to user
        </p>
      </div>

      <!-- Current Admins -->
      <div class="rounded-xl border border-sidebar-border bg-card">
        <div class="border-b border-sidebar-border p-4">
          <h2 class="font-semibold">Current Admins</h2>
          <p class="text-sm text-muted-foreground">{{ props.admins.length }} admin(s)</p>
        </div>
        <div class="p-4">
          <div v-if="props.admins.length === 0" class="py-8 text-center text-sm text-muted-foreground">
            No admins yet
          </div>
          <div v-else class="space-y-3">
            <div
              v-for="admin in props.admins"
              :key="admin.id"
              class="flex items-center justify-between rounded-lg border border-sidebar-border p-4"
            >
              <div class="flex items-center gap-3">
                <div class="rounded-lg bg-blue-500/20 p-2">
                  <Shield class="h-5 w-5 text-blue-400" />
                </div>
                <div>
                  <p class="font-medium">{{ admin.name }}</p>
                  <p class="text-sm text-muted-foreground">{{ admin.email }}</p>
                  <p class="text-xs text-muted-foreground mt-1">
                    Admin since {{ formatDate(admin.created_at) }} • {{ admin.vehicles_count }} vehicles
                  </p>
                </div>
              </div>
              <button
                @click="confirmDemote(admin)"
                class="inline-flex items-center gap-2 rounded-lg border border-red-500/30 px-4 py-2 text-sm font-medium text-red-400 hover:bg-red-500/10 transition-colors"
              >
                <UserMinus class="h-4 w-4" />
                Demote to User
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Promote Users to Admin -->
      <div class="rounded-xl border border-sidebar-border bg-card">
        <div class="border-b border-sidebar-border p-4">
          <h2 class="font-semibold">Promote User to Admin</h2>
          <p class="text-sm text-muted-foreground">{{ props.users.total }} user(s) available</p>
        </div>
        <div class="p-4">
          <!-- Search -->
          <div class="flex items-center gap-3 mb-4">
            <div class="flex-1">
              <div class="relative">
                <Search class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-muted-foreground" />
                <input
                  v-model="searchForm.search"
                  @keyup.enter="searchUsers"
                  type="text"
                  placeholder="Search by name or email..."
                  class="w-full rounded-lg border border-sidebar-border bg-background pl-10 pr-4 py-2 text-sm focus:border-[#FFD700] focus:outline-none focus:ring-1 focus:ring-[#FFD700]"
                />
              </div>
            </div>
            <button
              @click="searchUsers"
              class="inline-flex items-center gap-2 rounded-lg bg-[#FFD700] px-4 py-2 text-sm font-semibold text-black hover:brightness-95 transition-all"
            >
              <Search class="h-4 w-4" />
              Search
            </button>
            <button
              v-if="searchForm.search"
              @click="clearSearch"
              class="text-sm text-muted-foreground hover:text-foreground transition-colors"
            >
              Clear
            </button>
          </div>

          <!-- Users List -->
          <div v-if="props.users.data.length === 0" class="py-8 text-center text-sm text-muted-foreground">
            No users found
          </div>
          <div v-else>
            <div class="space-y-2">
              <div
                v-for="user in props.users.data"
                :key="user.id"
                class="flex items-center justify-between rounded-lg border border-sidebar-border p-3"
              >
                <div>
                  <p class="font-medium">{{ user.name }}</p>
                  <p class="text-sm text-muted-foreground">{{ user.email }}</p>
                  <p class="text-xs text-muted-foreground mt-1">
                    Joined {{ formatDate(user.created_at) }} • {{ user.vehicles_count }} vehicles
                  </p>
                </div>
                <button
                  @click="confirmPromote(user)"
                  class="inline-flex items-center gap-2 rounded-lg bg-[#FFD700] px-3 py-1.5 text-sm font-semibold text-black hover:brightness-95 transition-all"
                >
                  <UserPlus class="h-4 w-4" />
                  Promote to Admin
                </button>
              </div>
            </div>

            <!-- Pagination -->
            <div v-if="props.users.last_page > 1" class="mt-4 flex items-center justify-between border-t border-sidebar-border pt-4">
              <p class="text-sm text-muted-foreground">
                Showing {{ ((props.users.current_page - 1) * props.users.per_page) + 1 }} to 
                {{ Math.min(props.users.current_page * props.users.per_page, props.users.total) }} of 
                {{ props.users.total }} users
              </p>
              <div class="flex items-center gap-2">
                <Link
                  v-for="link in props.users.links"
                  :key="link.label"
                  :href="link.url || '#'"
                  :class="[
                    'inline-flex items-center justify-center rounded-lg px-3 py-1.5 text-sm transition-colors',
                    link.active
                      ? 'bg-[#FFD700] text-black font-semibold'
                      : link.url
                        ? 'border border-sidebar-border hover:bg-muted'
                        : 'opacity-50 cursor-not-allowed',
                  ]"
                  :preserve-scroll="true"
                  :preserve-state="true"
                >
                  <ChevronLeft v-if="link.label === '&laquo; Previous'" class="h-4 w-4" />
                  <ChevronRight v-else-if="link.label === 'Next &raquo;'" class="h-4 w-4" />
                  <span v-else v-html="link.label"></span>
                </Link>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Promote Confirmation Dialog -->
      <div
        v-if="showPromoteDialog"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm"
        @click.self="showPromoteDialog = false"
      >
        <div class="w-full max-w-md rounded-xl border border-sidebar-border bg-card p-6 shadow-lg">
          <h2 class="text-xl font-bold">Promote to Admin</h2>
          <p class="mt-2 text-sm text-muted-foreground">
            Are you sure you want to promote <strong>{{ userToPromote?.name }}</strong> to admin? 
            They will have access to the admin panel and be able to manage users and vehicles.
          </p>
          <div class="mt-6 flex items-center justify-end gap-3">
            <button
              @click="showPromoteDialog = false"
              class="rounded-lg border border-sidebar-border px-4 py-2 text-sm font-medium hover:bg-muted transition-colors"
            >
              Cancel
            </button>
            <button
              @click="promoteUser"
              :disabled="promoteForm.processing"
              class="rounded-lg bg-[#FFD700] px-4 py-2 text-sm font-medium text-black hover:brightness-95 disabled:opacity-50 transition-colors"
            >
              {{ promoteForm.processing ? 'Promoting...' : 'Promote to Admin' }}
            </button>
          </div>
        </div>
      </div>

      <!-- Demote Confirmation Dialog -->
      <div
        v-if="showDemoteDialog"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm"
        @click.self="showDemoteDialog = false"
      >
        <div class="w-full max-w-md rounded-xl border border-sidebar-border bg-card p-6 shadow-lg">
          <h2 class="text-xl font-bold">Demote to User</h2>
          <p class="mt-2 text-sm text-muted-foreground">
            Are you sure you want to demote <strong>{{ userToDemote?.name }}</strong> to user? 
            They will lose access to the admin panel.
          </p>
          <div class="mt-6 flex items-center justify-end gap-3">
            <button
              @click="showDemoteDialog = false"
              class="rounded-lg border border-sidebar-border px-4 py-2 text-sm font-medium hover:bg-muted transition-colors"
            >
              Cancel
            </button>
            <button
              @click="demoteUser"
              :disabled="demoteForm.processing"
              class="rounded-lg bg-red-500 px-4 py-2 text-sm font-medium text-white hover:bg-red-600 disabled:opacity-50 transition-colors"
            >
              {{ demoteForm.processing ? 'Demoting...' : 'Demote to User' }}
            </button>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
