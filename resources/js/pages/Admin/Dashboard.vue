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

interface Props {
  stats: Stats;
}

const props = defineProps<Props>();

const breadcrumbs = [
  { title: 'Dashboard', href: '/dashboard' },
  { title: 'Admin', href: '/admin' },
  { title: 'Analytics', href: '/admin' },
];
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

      <!-- Datafast Analytics Placeholder -->
      <div class="rounded-xl border border-sidebar-border bg-card">
        <div class="border-b border-sidebar-border p-4">
          <h2 class="font-semibold">Analytics Dashboard</h2>
          <p class="text-sm text-muted-foreground">Datafast embedded analytics</p>
        </div>
        <div class="flex min-h-[500px] items-center justify-center p-8">
          <div class="text-center">
            <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-[#FFD700]/20">
              <Car class="h-8 w-8 text-[#FFD700]" />
            </div>
            <h3 class="text-lg font-semibold">Datafast Analytics</h3>
            <p class="mt-2 text-sm text-muted-foreground">Embedded dashboard will appear here</p>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
