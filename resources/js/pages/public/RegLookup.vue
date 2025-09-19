<script setup lang="ts">
import PublicLayout from '@/layouts/public/PublicLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import Reveal from '@/components/Reveal.vue';

interface Props {
  reg?: string | null;
  vehicle?: Record<string, any> | null; // TODO: type when API chosen
  error?: string | null;
}

const props = withDefaults(defineProps<Props>(), {
  reg: null,
  vehicle: null,
  error: null,
});

const page = usePage();
const isAuthed = computed(() => !!page.props.auth?.user);
const site = computed(() => (page.props as any).site || {});
const phone = computed(() => site.value.phone || '01450 374875');
</script>

<template>
  <PublicLayout title="Reg Lookup">
    <Head title="Reg Lookup" />
    <section class="mx-auto w-full max-w-3xl px-4 py-16">
      <Reveal mode="up">
        <h1 class="text-3xl font-bold tracking-tight sm:text-4xl"><span class="text-[#FFD700]">Registration</span> Lookup</h1>
        <p class="mt-2 text-neutral-300">Enter your vehicle registration for instant details. We’ll soon include MOT history and more. Create an account to save details for next time.</p>

        <form action="/reg-lookup" method="get" class="mt-8 flex gap-3">
          <input type="text" name="reg" :value="props.reg ?? ''" placeholder="e.g. AB12 CDE" class="flex-1 rounded-md border border-neutral-800 bg-black px-3 py-2 text-sm outline-none ring-2 ring-transparent placeholder:text-neutral-500 focus:ring-neutral-800" />
          <button type="submit" class="rounded-md bg-[#FFD700] px-4 py-2 text-sm font-semibold text-black hover:brightness-95">Search</button>
        </form>
      </Reveal>

      <Reveal v-if="props.error" mode="up" :delay="60">
        <div class="mt-6 rounded-md border border-yellow-600/40 bg-yellow-500/10 p-4 text-sm text-yellow-300">
          {{ props.error }}
        </div>
      </Reveal>

      <Reveal v-if="props.reg" mode="up" :delay="120">
        <div class="mt-8 rounded-xl border border-neutral-800 bg-neutral-950 p-6">
          <h2 class="text-xl font-semibold text-white">Results for {{ props.reg }}</h2>
          <div v-if="props.vehicle" class="mt-3 space-y-1 text-sm text-neutral-300">
            <p><span class="font-medium text-white">Make:</span> {{ props.vehicle.make }}</p>
            <p><span class="font-medium text-white">Model:</span> {{ props.vehicle.model }}</p>
            <p><span class="font-medium text-white">Year:</span> {{ props.vehicle.year }}</p>
            <p><span class="font-medium text-white">Tyre Size:</span> {{ props.vehicle.tyreSize ?? '—' }}</p>
          </div>
          <p v-else class="mt-3 text-sm text-neutral-400">Lookup provider not configured yet. This is a placeholder.</p>

          <div class="mt-6 grid gap-4 md:grid-cols-2">
            <div class="rounded-md border border-neutral-800 bg-black p-4 text-sm text-neutral-300">
              <p class="font-semibold text-white">What you'll get</p>
              <ul class="mt-2 list-disc space-y-1 pl-5">
                <li>Basic vehicle info (make, model, year)</li>
                <li>MOT status/history (coming soon)</li>
                <li>Option to save to your profile</li>
              </ul>
            </div>
            <div class="rounded-md border border-neutral-800 bg-black p-4 text-sm text-neutral-300">
              <p class="font-semibold text-white">Next steps</p>
              <p class="mt-2">Want to book? Call us now.</p>
              <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="mt-3 inline-block rounded-md bg-[#FFD700] px-4 py-2 font-semibold text-black hover:brightness-95">Call {{ phone }}</a>
            </div>
          </div>

          <div class="mt-6 rounded-md border border-neutral-800 bg-neutral-950 p-4 text-sm">
            <p v-if="isAuthed">You are logged in. In the next iteration, you'll be able to save this vehicle to your profile.</p>
            <p v-else>Want to save this vehicle to your account? <a href="/register" class="font-semibold text-[#FFD700] hover:underline">Create an account</a> or <a href="/login" class="font-semibold text-[#FFD700] hover:underline">log in</a>.</p>
          </div>
        </div>
      </Reveal>
    </section>
  </PublicLayout>
</template>
