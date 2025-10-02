<script setup lang="ts">
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { Car, Plus, Edit, Trash2 } from '@iconoir/vue';

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
                    <Plus class="h-4 w-4" />
                    <span>Add Vehicle</span>
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div v-if="vehicles.length === 0" class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-12 text-center">
                        <Car class="mx-auto h-16 w-16 text-gray-400 mb-4" />
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">No vehicles yet</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">
                            Add your first vehicle to keep track of your service history and details.
                        </p>
                        <Link
                            :href="route('vehicles.create')"
                            class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-[#FFD700] to-yellow-500 px-6 py-3 text-base font-semibold text-black shadow-lg hover:brightness-95 transition-all duration-300"
                        >
                            <Plus class="h-5 w-5" />
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
                                        <Car class="h-6 w-6 text-[#FFD700]" />
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
                                    <Edit class="h-4 w-4" />
                                    <span>Edit</span>
                                </Link>
                                <button
                                    @click="deleteVehicle(vehicle.id)"
                                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-red-300 bg-white px-4 py-2 text-sm font-medium text-red-700 hover:bg-red-50 dark:border-red-600 dark:bg-gray-700 dark:text-red-400 dark:hover:bg-red-900/20"
                                >
                                    <Trash2 class="h-4 w-4" />
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
