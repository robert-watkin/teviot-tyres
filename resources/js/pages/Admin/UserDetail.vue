<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import RegistrationPlate from '@/components/RegistrationPlate.vue';
import { Head, router, useForm, usePage } from '@inertiajs/vue3';
import { User as UserIcon, Mail, Car, Calendar, Trash2, Shield, ArrowLeft } from 'lucide-vue-next';
import { computed, ref } from 'vue';

interface Vehicle {
  id: number;
  registration: string;
  vehicle_data: {
    make?: string;
    model?: string;
    colour?: string;
    year_of_manufacture?: number;
  };
  tyre_size?: string;
  notes?: string;
  created_at: string;
}

interface User {
  id: number;
  name: string;
  email: string;
  role: 'user' | 'admin' | 'owner';
  vehicles_count: number;
  created_at: string;
  vehicles: Vehicle[];
}

interface Props {
  user: User;
}

const props = defineProps<Props>();

const breadcrumbs = [
  { title: 'Dashboard', href: '/dashboard' },
  { title: 'Admin', href: '/admin' },
  { title: 'Users', href: '/admin/users' },
  { title: props.user.name, href: `/admin/users/${props.user.id}` },
];

const deleteVehicleForm = useForm({});
const promoteForm = useForm({});
const demoteForm = useForm({});
const vehicleToDelete = ref<Vehicle | null>(null);
const showDeleteDialog = ref(false);
const showPromoteDialog = ref(false);
const showDemoteDialog = ref(false);

const page = usePage();
const authUser = computed(() => page.props.auth?.user ?? null);

const canPromote = computed(() => authUser.value?.role === 'owner' && props.user.role === 'user');
const canDemote = computed(() => authUser.value?.role === 'owner' && props.user.role === 'admin');

const confirmDeleteVehicle = (vehicle: Vehicle) => {
  vehicleToDelete.value = vehicle;
  showDeleteDialog.value = true;
};

const deleteVehicle = () => {
  if (!vehicleToDelete.value) return;

  deleteVehicleForm.delete(`/admin/vehicles/${vehicleToDelete.value.id}`, {
    preserveScroll: true,
    onSuccess: () => {
      showDeleteDialog.value = false;
      vehicleToDelete.value = null;
    },
  });
};

const promoteUser = () => {
  if (!canPromote.value) return;

  promoteForm.post(`/admin/users/${props.user.id}/promote`, {
    preserveScroll: true,
    onSuccess: () => {
      showPromoteDialog.value = false;
    },
  });
};

const demoteUser = () => {
  if (!canDemote.value) return;

  demoteForm.post(`/admin/users/${props.user.id}/demote`, {
    preserveScroll: true,
    onSuccess: () => {
      showDemoteDialog.value = false;
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

const getRoleBadgeClass = (role: string) => {
  switch (role) {
    case 'owner':
      return 'bg-purple-500/20 text-purple-400 border-purple-500/30';
    case 'admin':
      return 'bg-blue-500/20 text-blue-400 border-blue-500/30';
    default:
      return 'bg-gray-500/20 text-gray-400 border-gray-500/30';
  }
};

const goBack = () => {
  router.visit('/admin/users');
};
</script>

<template>
  <AppLayout :breadcrumbs="breadcrumbs">
    <Head :title="`Admin - ${props.user.name}`" />
    
    <div class="flex h-full flex-1 flex-col gap-6 overflow-x-auto p-4">
      <!-- Back Button -->
      <div>
        <button
          @click="goBack"
          class="inline-flex items-center gap-2 text-sm text-muted-foreground hover:text-foreground transition-colors"
        >
          <ArrowLeft class="h-4 w-4" />
          Back
        </button>
      </div>

      <!-- User Info Card -->
      <div class="rounded-xl border border-sidebar-border bg-card">
        <div class="border-b border-sidebar-border p-6">
          <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
              <div class="mx-auto rounded-full bg-[#FFD700]/20 p-4 sm:mx-0">
                <UserIcon class="h-8 w-8 text-[#FFD700]" />
              </div>
              <div class="text-center sm:text-left">
                <h1 class="text-2xl font-bold">{{ props.user.name }}</h1>
                <div class="mt-2 flex flex-wrap items-center justify-center gap-3 sm:justify-start">
                  <div class="flex items-center gap-1.5 text-sm text-muted-foreground">
                    <Mail class="h-4 w-4" />
                    <a :href="`mailto:${props.user.email}`" class="hover:text-foreground transition-colors">
                      {{ props.user.email }}
                    </a>
                  </div>
                  <span
                    :class="[
                      'rounded-full border px-2.5 py-0.5 text-xs font-semibold uppercase',
                      getRoleBadgeClass(props.user.role)
                    ]"
                  >
                    {{ props.user.role }}
                  </span>
                </div>
              </div>
            </div>

            <div class="flex flex-col gap-3 md:flex-row md:items-center md:gap-6">
              <div class="flex items-center justify-center gap-2 text-sm text-muted-foreground md:justify-start">
                <Calendar class="h-4 w-4 text-[#FFD700]" />
                <span class="font-semibold text-foreground">{{ formatDate(props.user.created_at) }}</span>
              </div>

              <div v-if="canPromote || canDemote" class="flex flex-col gap-2 sm:flex-row">
                <button
                  v-if="canPromote"
                  @click="showPromoteDialog = true"
                  class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#FFD700] px-4 py-2 text-sm font-semibold text-black hover:brightness-95 transition-all"
                >
                  <Shield class="h-4 w-4" />
                  Promote to Admin
                </button>
                <button
                  v-if="canDemote"
                  @click="showDemoteDialog = true"
                  class="inline-flex items-center justify-center gap-2 rounded-lg border border-red-500/30 px-4 py-2 text-sm font-semibold text-red-400 hover:bg-red-500/10 transition-colors"
                >
                  <Shield class="h-4 w-4" />
                  Demote to User
                </button>
              </div>
            </div>
          </div>
          <div class="mt-6 grid gap-6 md:grid-cols-3">
            <div class="text-center md:text-left">
              <p class="text-sm text-muted-foreground">Member Since</p>
              <div class="mt-2 flex items-center justify-center gap-2 md:justify-start">
                <Calendar class="h-4 w-4 text-[#FFD700]" />
                <p class="font-semibold">{{ formatDate(props.user.created_at) }}</p>
              </div>
            </div>
            <div class="text-center md:text-left">
              <p class="text-sm text-muted-foreground">Total Vehicles</p>
              <div class="mt-2 flex items-center justify-center gap-2 md:justify-start">
                <Car class="h-4 w-4 text-[#FFD700]" />
                <p class="font-semibold">{{ props.user.vehicles_count }}</p>
              </div>
            </div>
            <div class="text-center md:text-left">
              <p class="text-sm text-muted-foreground">User ID</p>
              <p class="mt-2 font-mono font-semibold">#{{ props.user.id }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Saved Vehicles -->
      <div class="rounded-xl border border-sidebar-border bg-card">
        <div class="border-b border-sidebar-border p-4">
          <h2 class="font-semibold">Saved Vehicles</h2>
          <p class="text-sm text-muted-foreground">{{ props.user.vehicles_count }} vehicle(s)</p>
        </div>
        <div class="p-4">
          <div v-if="props.user.vehicles.length === 0" class="py-12 text-center">
            <Car class="mx-auto h-12 w-12 text-muted-foreground/50" />
            <p class="mt-3 text-sm text-muted-foreground">No vehicles saved yet</p>
          </div>
          <div v-else class="space-y-3">
            <div
              v-for="vehicle in props.user.vehicles"
              :key="vehicle.id"
              class="flex flex-col gap-4 rounded-lg border border-sidebar-border p-4 transition-colors hover:border-[#FFD700]/30 md:flex-row md:items-center md:justify-between"
            >
              <div class="flex flex-col gap-4 md:flex-row md:items-center md:gap-4">
                <div class="inline-flex w-fit rounded-lg bg-[#FFD700]/20 p-3">
                  <Car class="h-5 w-5 text-[#FFD700]" />
                </div>
                <div class="text-center md:text-left">
                  <RegistrationPlate :registration="vehicle.registration" size="lg" />
                  <div class="mt-2 flex flex-wrap items-center justify-center gap-2 text-sm text-muted-foreground md:justify-start">
                    <span v-if="vehicle.vehicle_data?.make && vehicle.vehicle_data?.model">
                      {{ vehicle.vehicle_data.make }} {{ vehicle.vehicle_data.model }}
                    </span>
                    <span v-if="vehicle.vehicle_data?.year_of_manufacture">
                      • {{ vehicle.vehicle_data.year_of_manufacture }}
                    </span>
                    <span v-if="vehicle.vehicle_data?.colour">
                      • {{ vehicle.vehicle_data.colour }}
                    </span>
                  </div>
                  <p class="mt-1 text-xs text-muted-foreground">
                    Saved {{ formatDate(vehicle.created_at) }}
                  </p>
                </div>
              </div>
              <button
                @click="confirmDeleteVehicle(vehicle)"
                class="inline-flex items-center justify-center gap-2 rounded-lg border border-red-500/30 px-3 py-2 text-sm font-medium text-red-400 hover:bg-red-500/10 transition-colors"
              >
                <Trash2 class="h-4 w-4" />
                Delete
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Delete Vehicle Confirmation Dialog -->
      <div
        v-if="showDeleteDialog"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm"
        @click.self="showDeleteDialog = false"
      >
        <div class="w-full max-w-md rounded-xl border border-sidebar-border bg-card p-6 shadow-lg">
          <h2 class="text-xl font-bold">Delete Vehicle</h2>
          <p class="mt-2 text-sm text-muted-foreground">
            Are you sure you want to delete this vehicle? This action cannot be undone.
          </p>
          <div class="mt-4 flex justify-center">
            <RegistrationPlate v-if="vehicleToDelete" :registration="vehicleToDelete.registration" size="lg" />
          </div>
          <div class="mt-6 flex items-center justify-end gap-3">
            <button
              @click="showDeleteDialog = false"
              class="rounded-lg border border-sidebar-border px-4 py-2 text-sm font-medium hover:bg-muted transition-colors"
            >
              Cancel
            </button>
            <button
              @click="deleteVehicle"
              :disabled="deleteVehicleForm.processing"
              class="rounded-lg bg-red-500 px-4 py-2 text-sm font-medium text-white hover:bg-red-600 disabled:opacity-50 transition-colors"
            >
              {{ deleteVehicleForm.processing ? 'Deleting...' : 'Delete Vehicle' }}
            </button>
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
            Are you sure you want to promote <strong>{{ props.user.name }}</strong> to admin?
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
              class="rounded-lg bg-[#FFD700] px-4 py-2 text-sm font-semibold text-black hover:brightness-95 disabled:opacity-50 transition-all"
            >
              {{ promoteForm.processing ? 'Promoting...' : 'Promote' }}
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
          <p class="mt-2 text-muted-foreground">
            Are you sure you want to demote <strong>{{ props.user.name }}</strong> to user?
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
              class="rounded-lg bg-red-500 px-4 py-2 text-sm font-semibold text-white hover:bg-red-600 disabled:opacity-50 transition-all"
            >
              {{ demoteForm.processing ? 'Demoting...' : 'Demote' }}
            </button>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
