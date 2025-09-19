<script setup lang="ts">
import PublicLayout from '@/layouts/public/PublicLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
  <PublicLayout title="Privacy Policy">
    <Head title="Privacy Policy" />
    <section class="mx-auto w-full max-w-3xl px-4 py-16">
      <h1 class="text-3xl font-bold tracking-tight sm:text-4xl"><span class="text-[#FFD700]">Privacy</span> Policy</h1>
      <div class="mt-6 rounded-xl border border-neutral-800 bg-neutral-950 p-6">
        <div class="prose prose-invert max-w-none">
          <p>This is a placeholder privacy policy. We will update this section with the final policy text.</p>
          <p>We respect your privacy and only collect necessary information to provide our services.</p>
        </div>
      </div>
    </section>
  </PublicLayout>
</template>
