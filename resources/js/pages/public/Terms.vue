<script setup lang="ts">
import PublicLayout from '@/layouts/public/PublicLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
  <PublicLayout title="Terms & Conditions">
    <Head title="Terms & Conditions" />
    <section class="mx-auto w-full max-w-3xl px-4 py-16">
      <h1 class="text-3xl font-bold tracking-tight sm:text-4xl"><span class="text-[#FFD700]">Terms</span> & Conditions</h1>
      <div class="mt-6 rounded-xl border border-neutral-800 bg-neutral-950 p-6">
        <div class="prose prose-invert max-w-none">
          <p>These terms and conditions are placeholders and will be updated with the final policy text.</p>
          <ul>
            <li>Service provided as‑is; booking is via phone call.</li>
            <li>Prices confirmed in‑store or over the phone.</li>
            <li>Warranty details available upon request.</li>
          </ul>
        </div>
      </div>
    </section>
  </PublicLayout>
</template>
