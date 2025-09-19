<script setup lang="ts">
import PublicLayout from '@/layouts/public/PublicLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import Reveal from '@/components/Reveal.vue';

const page = usePage();
const site = computed(() => (page.props as any).site || {});
const phone = computed(() => site.value.phone || '01450 374875');
const email = computed(() => site.value.email || 'teviottyres@outlook.com');
const address = computed(() => site.value.address || 'Unit 10, Lochpark Industrial Estate, Hawick TD9 9JA');
</script>

<template>
  <PublicLayout title="Contact">
    <Head title="Contact" />
    <section class="mx-auto w-full max-w-7xl px-4 py-16">
      <Reveal mode="up">
        <h1 class="text-3xl font-bold tracking-tight sm:text-4xl"><span class="text-[#FFD700]">Contact</span> Teviot Tyres</h1>
        <p class="mt-2 text-neutral-300">Call, email, or visit us — we’re here to help.</p>
      </Reveal>

      <div class="mt-8 grid grid-cols-1 gap-8 md:grid-cols-2">
        <!-- Details + Hours -->
        <div class="space-y-6">
          <Reveal mode="up">
            <div class="rounded-xl border border-neutral-800 bg-neutral-950 p-6">
            <p class="text-sm text-neutral-400">Phone</p>
            <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="mt-1 inline-block text-xl font-bold text-[#FFD700]">{{ phone }}</a>
            <p class="mt-4 text-sm text-neutral-400">Email</p>
            <a :href="`mailto:${email}`" class="mt-1 inline-block text-sm text-neutral-300 hover:underline">{{ email }}</a>
            <p class="mt-4 text-sm text-neutral-400">Address</p>
            <p class="mt-1 text-sm text-neutral-300">{{ address }}</p>
            </div>
          </Reveal>

          <Reveal mode="up" :delay="120">
            <div class="rounded-xl border border-neutral-800 bg-neutral-950 p-6">
            <h2 class="text-lg font-semibold text-white">Opening Hours</h2>
            <table class="mt-3 w-full text-left text-sm text-neutral-300">
              <tbody class="[&_td]:py-1">
                <tr><td>Mon–Fri</td><td class="text-right">9:00 – 17:00</td></tr>
                <tr><td>Saturday</td><td class="text-right">9:00 – 13:00</td></tr>
                <tr><td>Sunday</td><td class="text-right">Closed</td></tr>
              </tbody>
            </table>
            <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="mt-4 inline-block rounded-md bg-[#FFD700] px-4 py-2 text-sm font-semibold text-black hover:brightness-95">Call {{ phone }}</a>
            </div>
          </Reveal>
        </div>

        <!-- Map only -->
        <div class="space-y-6">
          <Reveal mode="up">
            <div class="rounded-xl border border-neutral-800 bg-black p-2">
              <iframe
                title="Teviot Tyres Map"
                src="https://www.google.com/maps?q=Unit%2010,%20Lochpark%20Industrial%20Estate,%20Hawick%20TD9%209JA&output=embed"
                class="h-64 w-full rounded-md"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
              ></iframe>
            </div>
          </Reveal>
        </div>
      </div>
    </section>
  </PublicLayout>
</template>
