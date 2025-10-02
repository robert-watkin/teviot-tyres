<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

interface Vehicle {
    id: number;
    registration: string;
    make?: string;
    model?: string;
    year?: number;
    color?: string;
    fuel_type?: string;
    tyre_size?: string;
    notes?: string;
    created_at: string;
}

defineProps<{
    vehicles: Vehicle[];
}>();

const deleteVehicle = (id: number) => {
    if (confirm('Are you sure you want to delete this vehicle?')) {
        router.delete(route('vehicles.destroy', id));
    }
};
</script>

<template>
    <Head title="My Vehicles" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    My Vehicles
                </h2>
                <Link
                    :href="route('vehicles.create')"
                    class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-[#FFD700] to-yellow-500 px-4 py-2 text-sm font-semibold text-black shadow-lg hover:brightness-95 transition-all duration-300"
                >
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Add Vehicle</span>
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div v-if="vehicles.length === 0" class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-12 text-center">
                        <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
                    </svg>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">No vehicles yet</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">
                            Add your first vehicle to keep track of your service history and details.
                        </p>
                        <Link
                            :href="route('vehicles.create')"
                            class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-[#FFD700] to-yellow-500 px-6 py-3 text-base font-semibold text-black shadow-lg hover:brightness-95 transition-all duration-300"
                        >
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            <span>Add Your First Vehicle</span>
                        </Link>
                    </div>
                </div>

                <div v-else class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <div
                        v-for="vehicle in vehicles"
                        :key="vehicle.id"
                        class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition-all duration-300 hover:shadow-lg dark:border-gray-700 dark:bg-gray-800"
                    >
                        <div class="p-6">
                            <div class="mb-4 flex items-start justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="rounded-xl bg-gradient-to-br from-[#FFD700]/20 to-amber-500/10 p-3">
                                        <svg class="h-6 w-6 text-[#FFD700]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
                                    </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                            {{ vehicle.registration }}
                                        </h3>
                                        <p v-if="vehicle.make || vehicle.model" class="text-sm text-gray-600 dark:text-gray-400">
                                            {{ vehicle.make }} {{ vehicle.model }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-2 text-sm">
                                <div v-if="vehicle.year" class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Year:</span>
                                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ vehicle.year }}</span>
                                </div>
                                <div v-if="vehicle.color" class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Color:</span>
                                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ vehicle.color }}</span>
                                </div>
                                <div v-if="vehicle.fuel_type" class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Fuel:</span>
                                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ vehicle.fuel_type }}</span>
                                </div>
                                <div v-if="vehicle.tyre_size" class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Tyre Size:</span>
                                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ vehicle.tyre_size }}</span>
                                </div>
                            </div>

                            <div v-if="vehicle.notes" class="mt-4 rounded-lg bg-gray-50 p-3 dark:bg-gray-700/50">
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ vehicle.notes }}</p>
                            </div>

                            <div class="mt-6 flex gap-2">
                                <Link
                                    :href="route('vehicles.edit', vehicle.id)"
                                    class="flex-1 inline-flex items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600"
                                >
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    <span>Edit</span>
                                </Link>
                                <button
                                    @click="deleteVehicle(vehicle.id)"
                                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-red-300 bg-white px-4 py-2 text-sm font-medium text-red-700 hover:bg-red-50 dark:border-red-600 dark:bg-gray-700 dark:text-red-400 dark:hover:bg-red-900/20"
                                >
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    <span>Delete</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
