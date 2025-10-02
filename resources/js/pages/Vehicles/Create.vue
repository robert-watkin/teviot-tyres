<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    registration: '',
    make: '',
    model: '',
    year: '',
    color: '',
    fuel_type: '',
    tyre_size: '',
    notes: '',
});

const submit = () => {
    form.post(route('vehicles.store'));
};
</script>

<template>
    <Head title="Add Vehicle" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Add Vehicle
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-2xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <form @submit.prevent="submit" class="p-6 space-y-6">
                        <div>
                            <InputLabel for="registration" value="Registration *" />
                            <TextInput
                                id="registration"
                                v-model="form.registration"
                                type="text"
                                class="mt-1 block w-full uppercase"
                                required
                                autofocus
                                placeholder="e.g. AB12 CDE"
                            />
                            <InputError class="mt-2" :message="form.errors.registration" />
                        </div>

                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <InputLabel for="make" value="Make" />
                                <TextInput
                                    id="make"
                                    v-model="form.make"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="e.g. Ford"
                                />
                                <InputError class="mt-2" :message="form.errors.make" />
                            </div>

                            <div>
                                <InputLabel for="model" value="Model" />
                                <TextInput
                                    id="model"
                                    v-model="form.model"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="e.g. Focus"
                                />
                                <InputError class="mt-2" :message="form.errors.model" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                            <div>
                                <InputLabel for="year" value="Year" />
                                <TextInput
                                    id="year"
                                    v-model="form.year"
                                    type="number"
                                    class="mt-1 block w-full"
                                    placeholder="2020"
                                />
                                <InputError class="mt-2" :message="form.errors.year" />
                            </div>

                            <div>
                                <InputLabel for="color" value="Color" />
                                <TextInput
                                    id="color"
                                    v-model="form.color"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="Blue"
                                />
                                <InputError class="mt-2" :message="form.errors.color" />
                            </div>

                            <div>
                                <InputLabel for="fuel_type" value="Fuel Type" />
                                <TextInput
                                    id="fuel_type"
                                    v-model="form.fuel_type"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="Petrol"
                                />
                                <InputError class="mt-2" :message="form.errors.fuel_type" />
                            </div>
                        </div>

                        <div>
                            <InputLabel for="tyre_size" value="Tyre Size" />
                            <TextInput
                                id="tyre_size"
                                v-model="form.tyre_size"
                                type="text"
                                class="mt-1 block w-full"
                                placeholder="e.g. 205/55 R16"
                            />
                            <InputError class="mt-2" :message="form.errors.tyre_size" />
                        </div>

                        <div>
                            <InputLabel for="notes" value="Notes" />
                            <textarea
                                id="notes"
                                v-model="form.notes"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                                rows="3"
                                placeholder="Any additional notes about this vehicle..."
                            ></textarea>
                            <InputError class="mt-2" :message="form.errors.notes" />
                        </div>

                        <div class="flex items-center gap-4">
                            <PrimaryButton :disabled="form.processing">Add Vehicle</PrimaryButton>
                            <a
                                :href="route('vehicles.index')"
                                class="text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100"
                            >
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
