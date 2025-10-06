<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router } from '@inertiajs/vue3';
import { Car as CarIcon, Trash as TrashIcon } from 'lucide-vue-next';

interface Vehicle {
    id: number;
    registration: string;
    vehicle_data: {
        make: string;
        colour: string;
        fuel_type: string;
        year_of_manufacture: number;
        engine_capacity?: number;
        tax_status: string;
        mot_status: string;
    };
    tyre_size?: string;
    notes?: string;
    created_at: string;
}

interface Props {
    vehicles: Vehicle[];
}

const props = defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];

const deleteVehicle = (vehicleId: number) => {
    if (confirm('Are you sure you want to remove this vehicle?')) {
        router.delete(`/vehicles/${vehicleId}`, {
            preserveScroll: true,
        });
    }
};

const formatEngineSize = (cc?: number) => {
    if (!cc) return 'N/A';
    return `${cc}cc (${(cc / 1000).toFixed(1)}L)`;
};
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-6 overflow-x-auto p-4">
            <!-- Header -->
            <div>
                <h1 class="text-2xl font-bold tracking-tight">Dashboard</h1>
                <p class="mt-1 text-sm text-muted-foreground">Manage your saved vehicles and account</p>
            </div>

            <!-- Quick Stats -->
            <div class="grid gap-4 md:grid-cols-3">
                <div class="rounded-xl border border-sidebar-border bg-card p-6">
                    <div class="flex items-center gap-3">
                        <div class="rounded-lg bg-[#FFD700]/20 p-2">
                            <CarIcon class="h-5 w-5 text-[#FFD700]" />
                        </div>
                        <div>
                            <p class="text-2xl font-bold">{{ props.vehicles.length }}</p>
                            <p class="text-sm text-muted-foreground">Saved Vehicles</p>
                        </div>
                    </div>
                </div>
                <div class="rounded-xl border border-sidebar-border bg-card p-6">
                    <div>
                        <p class="text-sm text-muted-foreground">Quick Actions</p>
                        <Link href="/reg-lookup" class="mt-2 inline-flex items-center text-sm font-medium text-[#FFD700] hover:underline">
                            Lookup New Vehicle →
                        </Link>
                    </div>
                </div>
                <div class="rounded-xl border border-sidebar-border bg-card p-6">
                    <div>
                        <p class="text-sm text-muted-foreground">Need Help?</p>
                        <a href="tel:01450374875" class="mt-2 inline-flex items-center text-sm font-medium text-[#FFD700] hover:underline">
                            Call 01450 374875 →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Saved Vehicles -->
            <div class="rounded-xl border border-sidebar-border bg-card">
                <div class="border-b border-sidebar-border p-6">
                    <h2 class="text-lg font-semibold">Saved Vehicles</h2>
                    <p class="mt-1 text-sm text-muted-foreground">View and manage your saved vehicles</p>
                </div>

                <div v-if="props.vehicles.length === 0" class="p-12 text-center">
                    <CarIcon class="mx-auto h-12 w-12 text-muted-foreground/50" />
                    <h3 class="mt-4 text-lg font-semibold">No saved vehicles</h3>
                    <p class="mt-2 text-sm text-muted-foreground">Use the reg lookup to find and save vehicles</p>
                    <Link href="/reg-lookup" class="mt-4 inline-flex items-center gap-2 rounded-lg bg-[#FFD700] px-4 py-2 text-sm font-semibold text-black hover:brightness-95">
                        <CarIcon class="h-4 w-4" />
                        <span>Lookup Vehicle</span>
                    </Link>
                </div>

                <div v-else class="divide-y divide-sidebar-border">
                    <div v-for="vehicle in props.vehicles" :key="vehicle.id" class="p-6 transition-colors hover:bg-muted/50">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-3">
                                    <div class="rounded-lg bg-[#FFD700]/20 p-2">
                                        <CarIcon class="h-5 w-5 text-[#FFD700]" />
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-bold">{{ vehicle.registration }}</h3>
                                        <p class="text-sm text-muted-foreground">
                                            {{ vehicle.vehicle_data.make }} • {{ vehicle.vehicle_data.year_of_manufacture }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Vehicle Details Grid -->
                                <div class="mt-4 grid grid-cols-2 gap-3 md:grid-cols-4">
                                    <div>
                                        <p class="text-xs text-muted-foreground">Colour</p>
                                        <p class="text-sm font-medium">{{ vehicle.vehicle_data.colour }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-muted-foreground">Fuel Type</p>
                                        <p class="text-sm font-medium">{{ vehicle.vehicle_data.fuel_type }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-muted-foreground">Engine Size</p>
                                        <p class="text-sm font-medium">{{ formatEngineSize(vehicle.vehicle_data.engine_capacity) }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-muted-foreground">Tax Status</p>
                                        <p class="text-sm font-medium" :class="vehicle.vehicle_data.tax_status === 'Taxed' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400'">
                                            {{ vehicle.vehicle_data.tax_status }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Tyre Size & Notes -->
                                <div v-if="vehicle.tyre_size || vehicle.notes" class="mt-3 space-y-2">
                                    <div v-if="vehicle.tyre_size" class="text-sm">
                                        <span class="text-muted-foreground">Tyre Size:</span>
                                        <span class="ml-2 font-medium">{{ vehicle.tyre_size }}</span>
                                    </div>
                                    <div v-if="vehicle.notes" class="text-sm">
                                        <span class="text-muted-foreground">Notes:</span>
                                        <span class="ml-2">{{ vehicle.notes }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <button
                                @click="deleteVehicle(vehicle.id)"
                                class="rounded-lg border border-red-200 bg-red-50 p-2 text-red-600 transition-colors hover:bg-red-100 dark:border-red-900 dark:bg-red-950 dark:text-red-400 dark:hover:bg-red-900"
                                title="Remove vehicle"
                            >
                                <TrashIcon class="h-4 w-4" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
