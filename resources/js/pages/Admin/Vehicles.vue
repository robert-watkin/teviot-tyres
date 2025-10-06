<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import { Car, Trash2, Search, User } from 'lucide-vue-next';
import { ref } from 'vue';

interface Vehicle {
  id: number;
  registration: string;
  vehicle_data: {
    make?: string;
    model?: string;
    colour?: string;
    year_of_manufacture?: number;
  };
  created_at: string;
  user: {
    id: number;
    name: string;
    email: string;
  };
}

interface PaginatedVehicles {
  data: Vehicle[];
  current_page: number;
  last_page: number;
  per_page: number;
  total: number;
}

interface Props {
  vehicles: PaginatedVehicles;
  filters: {
    search?: string;
    sort?: string;
    direction?: string;
  };
}

const props = defineProps<Props>();

const breadcrumbs = [
  { label: 'Dashboard', href: '/dashboard' },
  { label: 'Admin', href: '/admin' },
  { label: 'Vehicles' },
];

const searchForm = useForm({
  search: props.filters.search || '',
});

const deleteForm = useForm({});
const vehicleToDelete = ref<Vehicle | null>(null);
const showDeleteDialog = ref(false);

const search = () => {
  router.get('/admin/vehicles', {
    search: searchForm.search,
  }, {
    preserveState: true,
    preserveScroll: true,
  });
};

const clearFilters = () => {
  searchForm.search = '';
  search();
};

const confirmDelete = (vehicle: Vehicle) => {
  vehicleToDelete.value = vehicle;
  showDeleteDialog.value = true;
};

const deleteVehicle = () => {
  if (!vehicleToDelete.value) return;
  
  deleteForm.delete(`/admin/vehicles/${vehicleToDelete.value.id}`, {
    preserveScroll: true,
    onSuccess: () => {
      showDeleteDialog.value = false;
      vehicleToDelete.value = null;
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
    <Head title="Admin - Vehicles" />
    
    <div class="flex h-full flex-1 flex-col gap-6 overflow-x-auto p-4">
      <!-- Header -->
      <div>
        <h1 class="text-2xl font-bold tracking-tight">Vehicles Management</h1>
        <p class="mt-1 text-sm text-muted-foreground">
          Manage all saved vehicles ({{ props.vehicles.total }} total)
        </p>
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
              placeholder="Search by registration..."
              class="w-full rounded-lg border border-sidebar-border bg-background pl-10 pr-4 py-2 text-sm focus:border-[#FFD700] focus:outline-none focus:ring-1 focus:ring-[#FFD700]"
            />
          </div>
        </div>

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
          v-if="searchForm.search"
          @click="clearFilters"
          class="text-sm text-muted-foreground hover:text-foreground transition-colors"
        >
          Clear filters
        </button>
      </div>

      <!-- Vehicles Table -->
      <div class="rounded-xl border border-sidebar-border bg-card overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full">
            <thead class="border-b border-sidebar-border bg-muted/50">
              <tr>
                <th class="px-4 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                  Registration
                </th>
                <th class="px-4 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                  Make / Model
                </th>
                <th class="px-4 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                  Colour
                </th>
                <th class="px-4 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                  Year
                </th>
                <th class="px-4 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                  Saved By
                </th>
                <th class="px-4 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                  Date Saved
                </th>
                <th class="px-4 py-3 text-right text-xs font-medium text-muted-foreground uppercase tracking-wider">
                  Actions
                </th>
              </tr>
            </thead>
            <tbody class="divide-y divide-sidebar-border">
              <tr v-if="props.vehicles.data.length === 0">
                <td colspan="7" class="px-4 py-8 text-center text-sm text-muted-foreground">
                  No vehicles found
                </td>
              </tr>
              <tr
                v-for="vehicle in props.vehicles.data"
                :key="vehicle.id"
                class="hover:bg-muted/50 transition-colors"
              >
                <td class="px-4 py-3">
                  <p class="font-mono font-semibold">{{ vehicle.registration }}</p>
                </td>
                <td class="px-4 py-3">
                  <p class="text-sm">
                    {{ vehicle.vehicle_data.make || 'N/A' }}
                    {{ vehicle.vehicle_data.model ? `- ${vehicle.vehicle_data.model}` : '' }}
                  </p>
                </td>
                <td class="px-4 py-3">
                  <p class="text-sm">{{ vehicle.vehicle_data.colour || 'N/A' }}</p>
                </td>
                <td class="px-4 py-3">
                  <p class="text-sm">{{ vehicle.vehicle_data.year_of_manufacture || 'N/A' }}</p>
                </td>
                <td class="px-4 py-3">
                  <div class="flex items-center gap-2">
                    <User class="h-4 w-4 text-muted-foreground" />
                    <div>
                      <p class="text-sm font-medium">{{ vehicle.user.name }}</p>
                      <p class="text-xs text-muted-foreground">{{ vehicle.user.email }}</p>
                    </div>
                  </div>
                </td>
                <td class="px-4 py-3">
                  <p class="text-sm text-muted-foreground">{{ formatDate(vehicle.created_at) }}</p>
                </td>
                <td class="px-4 py-3">
                  <div class="flex items-center justify-end gap-2">
                    <!-- Delete Vehicle -->
                    <button
                      @click="confirmDelete(vehicle)"
                      class="inline-flex items-center gap-1 rounded-lg px-3 py-1.5 text-xs font-medium text-red-400 hover:bg-red-500/10 transition-colors"
                      title="Delete vehicle"
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
        <div v-if="props.vehicles.last_page > 1" class="border-t border-sidebar-border px-4 py-3">
          <div class="flex items-center justify-between">
            <p class="text-sm text-muted-foreground">
              Showing {{ ((props.vehicles.current_page - 1) * props.vehicles.per_page) + 1 }} to 
              {{ Math.min(props.vehicles.current_page * props.vehicles.per_page, props.vehicles.total) }} of 
              {{ props.vehicles.total }} vehicles
            </p>
            <div class="flex items-center gap-2">
              <a
                v-for="page in props.vehicles.last_page"
                :key="page"
                :href="`/admin/vehicles?page=${page}${searchForm.search ? '&search=' + searchForm.search : ''}`"
                :class="[
                  'px-3 py-1 rounded-lg text-sm font-medium transition-colors',
                  page === props.vehicles.current_page
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
          <h2 class="text-xl font-bold">Delete Vehicle</h2>
          <p class="mt-2 text-sm text-muted-foreground">
            Are you sure you want to delete vehicle <strong class="font-mono">{{ vehicleToDelete?.registration }}</strong>? 
            This action cannot be undone.
          </p>
          <div class="mt-6 flex items-center justify-end gap-3">
            <button
              @click="showDeleteDialog = false"
              class="rounded-lg border border-sidebar-border px-4 py-2 text-sm font-medium hover:bg-muted transition-colors"
            >
              Cancel
            </button>
            <button
              @click="deleteVehicle"
              :disabled="deleteForm.processing"
              class="rounded-lg bg-red-500 px-4 py-2 text-sm font-medium text-white hover:bg-red-600 disabled:opacity-50 transition-colors"
            >
              {{ deleteForm.processing ? 'Deleting...' : 'Delete Vehicle' }}
            </button>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
