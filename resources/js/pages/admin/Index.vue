<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
  <AppLayout :breadcrumbs="[{ title: 'Admin', href: '/admin' }]">
    <Head title="Admin" />
    <div class="mx-auto w-full max-w-7xl p-4">
      <h1 class="text-2xl font-semibold">Admin</h1>
      <p class="mt-2 text-neutral-600 dark:text-neutral-300">
        This is the admin area. In a later iteration, we will add roles/permissions and features like sending mail and viewing users/vehicles.
      </p>

      <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-3">
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-800 dark:bg-neutral-900">
          <h2 class="font-medium">Analytics</h2>
          <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-300">Hook up datafa.st and show key metrics.</p>
        </div>
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-800 dark:bg-neutral-900">
          <h2 class="font-medium">Users</h2>
          <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-300">List users and view saved vehicles.</p>
        </div>
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-800 dark:bg-neutral-900">
          <h2 class="font-medium">Send Mail</h2>
          <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-300">Bulk or targeted email to customers. (Placeholder)</p>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
