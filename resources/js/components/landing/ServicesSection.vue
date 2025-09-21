<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'
import Reveal from '../Reveal.vue'
import TyresService from './services/TyresService.vue'
import MotService from './services/MotService.vue'
import DiagnosticsService from './services/DiagnosticsService.vue'
import ServicingService from './services/ServicingService.vue'
import BatteryService from './services/BatteryService.vue'
import EmergencyService from './services/EmergencyService.vue'

// Get page props for phone number
const page = usePage()
const site = computed(() => (page.props as any).site || {})
const phone = computed(() => site.value.phone || '01450 374875')
</script>

<template>
  <!-- Services Section -->
  <section class="relative overflow-hidden bg-gradient-to-b from-neutral-950 via-neutral-900 to-neutral-950">
    <!-- Background Elements -->
    <div class="absolute inset-0 opacity-10">
      <!-- Tyre pattern background -->
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_10%_20%,rgba(255,215,0,0.3),transparent_30%)]"></div>
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_90%_80%,rgba(255,215,0,0.2),transparent_40%)]"></div>
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_50%,rgba(255,215,0,0.1),transparent_60%)]"></div>
    </div>

    <!-- Subtle background shapes (no animation) -->
    <div class="absolute inset-0 overflow-hidden">
      <div class="absolute top-20 left-10 w-32 h-32 bg-[#FFD700]/6 rounded-full blur-2xl"></div>
      <div class="absolute top-40 right-20 w-24 h-24 bg-[#FFD700]/10 rounded-full blur-xl"></div>
      <div class="absolute bottom-20 left-1/4 w-20 h-20 bg-[#FFD700]/8 rounded-full blur-lg"></div>
    </div>

    <div class="relative mx-auto w-full max-w-7xl px-4 py-24">
      <Reveal mode="up">
        <div class="text-center mb-20">
          <h2 class="text-5xl font-bold mb-6">
            <span class="text-[#FFD700]">Our Services</span>
          </h2>
          <p class="text-xl text-neutral-300 max-w-3xl mx-auto leading-relaxed">
            From emergency repairs to routine maintenance, we've got you covered with fast, reliable service and expert technicians
          </p>
        </div>
      </Reveal>

      <!-- Services Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <TyresService />
        <MotService />
        <DiagnosticsService />
        <ServicingService />
        <BatteryService />
        <EmergencyService />
      </div>
    </div>
  </section>
</template>
