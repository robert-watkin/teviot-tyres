<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Users, Car, TrendingUp, TrendingDown } from 'lucide-vue-next';

interface Stats {
  totalUsers: number;
  usersThisWeek: number;
  usersGrowth: number;
  totalVehicles: number;
  vehiclesThisWeek: number;
  vehiclesGrowth: number;
}

interface TopVehicle {
  registration: string;
  save_count: number;
}

interface RecentUser {
  id: number;
  name: string;
  email: string;
  created_at: string;
}

interface RecentVehicle {
  id: number;
  registration: string;
  created_at: string;
  user: {
    name: string;
  };
}

interface Props {
  stats: Stats;
  topVehicles: TopVehicle[];
  recentUsers: RecentUser[];
  recentVehicles: RecentVehicle[];
}

const props = defineProps<Props>();

const breadcrumbs = [
  { label: 'Dashboard', href: '/dashboard' },
  { label: 'Admin', href: '/admin' },
  { label: 'Analytics' },
];

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
    <Head title="Admin - Analytics" />
    
    <div class="flex h-full flex-1 flex-col gap-6 overflow-x-auto p-4">
      <!-- Header -->
      <div>
        <h1 class="text-2xl font-bold tracking-tight">Analytics Dashboard</h1>
        <p class="mt-1 text-sm text-muted-foreground">Overview of users, vehicles, and activity</p>
      </div>

      <!-- Stats Cards -->
      <div class="grid gap-4 md:grid-cols-2">
        <!-- Total Users -->
        <div class="rounded-xl border border-sidebar-border bg-card p-6">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm text-muted-foreground">Total Users</p>
              <p class="mt-2 text-3xl font-bold">{{ props.stats.totalUsers }}</p>
              <div class="mt-2 flex items-center gap-1 text-sm">
                <TrendingUp v-if="props.stats.usersGrowth > 0" class="h-4 w-4 text-green-500" />
                <TrendingDown v-else class="h-4 w-4 text-red-500" />
                <span :class="props.stats.usersGrowth > 0 ? 'text-green-500' : 'text-red-500'">
                  {{ props.stats.usersGrowth > 0 ? '+' : '' }}{{ props.stats.usersGrowth }}%
                </span>
                <span class="text-muted-foreground">from last week</span>
              </div>
            </div>
            <div class="rounded-lg bg-[#FFD700]/20 p-3">
              <Users class="h-6 w-6 text-[#FFD700]" />
            </div>
          </div>
        </div>

        <!-- Total Vehicles -->
        <div class="rounded-xl border border-sidebar-border bg-card p-6">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm text-muted-foreground">Total Vehicles</p>
              <p class="mt-2 text-3xl font-bold">{{ props.stats.totalVehicles }}</p>
              <div class="mt-2 flex items-center gap-1 text-sm">
                <TrendingUp v-if="props.stats.vehiclesGrowth > 0" class="h-4 w-4 text-green-500" />
                <TrendingDown v-else class="h-4 w-4 text-red-500" />
                <span :class="props.stats.vehiclesGrowth > 0 ? 'text-green-500' : 'text-red-500'">
                  {{ props.stats.vehiclesGrowth > 0 ? '+' : '' }}{{ props.stats.vehiclesGrowth }}%
                </span>
                <span class="text-muted-foreground">from last week</span>
              </div>
            </div>
            <div class="rounded-lg bg-[#FFD700]/20 p-3">
              <Car class="h-6 w-6 text-[#FFD700]" />
            </div>
          </div>
        </div>
      </div>

      <!-- Recent Activity & Top Vehicles -->
      <div class="grid gap-4 md:grid-cols-2">
        <!-- Recent Users -->
        <div class="rounded-xl border border-sidebar-border bg-card">
          <div class="border-b border-sidebar-border p-4">
            <h2 class="font-semibold">Recent Users</h2>
            <p class="text-sm text-muted-foreground">Latest user registrations</p>
          </div>
          <div class="p-4">
            <div v-if="props.recentUsers.length === 0" class="py-8 text-center text-sm text-muted-foreground">
              No users yet
            </div>
            <div v-else class="space-y-3">
              <div
                v-for="user in props.recentUsers"
                :key="user.id"
                class="flex items-center justify-between rounded-lg border border-sidebar-border p-3"
              >
                <div>
                  <p class="font-medium">{{ user.name }}</p>
                  <p class="text-sm text-muted-foreground">{{ user.email }}</p>
                </div>
                <p class="text-xs text-muted-foreground">{{ formatDate(user.created_at) }}</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Top Vehicles -->
        <div class="rounded-xl border border-sidebar-border bg-card">
          <div class="border-b border-sidebar-border p-4">
            <h2 class="font-semibold">Most Saved Vehicles</h2>
            <p class="text-sm text-muted-foreground">Top 10 saved registrations</p>
          </div>
          <div class="p-4">
            <div v-if="props.topVehicles.length === 0" class="py-8 text-center text-sm text-muted-foreground">
              No vehicles saved yet
            </div>
            <div v-else class="space-y-2">
              <div
                v-for="(vehicle, index) in props.topVehicles"
                :key="vehicle.registration"
                class="flex items-center justify-between rounded-lg border border-sidebar-border p-3"
              >
                <div class="flex items-center gap-3">
                  <div class="flex h-8 w-8 items-center justify-center rounded-full bg-[#FFD700]/20 text-sm font-bold text-[#FFD700]">
                    {{ index + 1 }}
                  </div>
                  <p class="font-mono font-semibold">{{ vehicle.registration }}</p>
                </div>
                <p class="text-sm text-muted-foreground">{{ vehicle.save_count }} saves</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Recent Vehicle Saves -->
      <div class="rounded-xl border border-sidebar-border bg-card">
        <div class="border-b border-sidebar-border p-4">
          <h2 class="font-semibold">Recent Vehicle Saves</h2>
          <p class="text-sm text-muted-foreground">Latest vehicles saved by users</p>
        </div>
        <div class="p-4">
          <div v-if="props.recentVehicles.length === 0" class="py-8 text-center text-sm text-muted-foreground">
            No vehicles saved yet
          </div>
          <div v-else class="space-y-3">
            <div
              v-for="vehicle in props.recentVehicles"
              :key="vehicle.id"
              class="flex items-center justify-between rounded-lg border border-sidebar-border p-3"
            >
              <div class="flex items-center gap-3">
                <div class="rounded-lg bg-[#FFD700]/20 p-2">
                  <Car class="h-4 w-4 text-[#FFD700]" />
                </div>
                <div>
                  <p class="font-mono font-semibold">{{ vehicle.registration }}</p>
                  <p class="text-sm text-muted-foreground">Saved by {{ vehicle.user.name }}</p>
                </div>
              </div>
              <p class="text-xs text-muted-foreground">{{ formatDate(vehicle.created_at) }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Quick Actions -->
      <div class="grid gap-4 md:grid-cols-3">
        <a
          href="/admin/users"
          class="rounded-xl border border-sidebar-border bg-card p-6 transition-colors hover:border-[#FFD700]/30 hover:bg-card/80"
        >
          <Users class="h-6 w-6 text-[#FFD700]" />
          <h3 class="mt-3 font-semibold">Manage Users</h3>
          <p class="mt-1 text-sm text-muted-foreground">View and manage all users</p>
        </a>

        <a
          href="/admin/vehicles"
          class="rounded-xl border border-sidebar-border bg-card p-6 transition-colors hover:border-[#FFD700]/30 hover:bg-card/80"
        >
          <Car class="h-6 w-6 text-[#FFD700]" />
          <h3 class="mt-3 font-semibold">Manage Vehicles</h3>
          <p class="mt-1 text-sm text-muted-foreground">View all saved vehicles</p>
        </a>

        <a
          href="/dashboard"
          class="rounded-xl border border-sidebar-border bg-card p-6 transition-colors hover:border-[#FFD700]/30 hover:bg-card/80"
        >
          <Users class="h-6 w-6 text-[#FFD700]" />
          <h3 class="mt-3 font-semibold">Back to Dashboard</h3>
          <p class="mt-1 text-sm text-muted-foreground">Return to your dashboard</p>
        </a>
      </div>
    </div>
  </AppLayout>
</template>
