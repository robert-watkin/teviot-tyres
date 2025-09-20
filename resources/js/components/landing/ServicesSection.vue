<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'
import Reveal from '../Reveal.vue'
import { Tools, CheckCircle, Settings, DashboardSpeed, Shield, Phone, ArrowRight } from '@iconoir/vue'

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

      <!-- Services Grid - Consistent Design -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Tyres Service -->
        <Reveal mode="up">
          <Link href="/services#tyres"
            class="group relative rounded-3xl border border-neutral-800/50 bg-gradient-to-br from-neutral-900/80 to-neutral-950/80 p-8 backdrop-blur-sm hover:border-[#FFD700]/30 transition-all duration-500 hover:scale-105 overflow-hidden block">
            <!-- Background Image -->
            <div class="absolute inset-0 opacity-20">
              <img src="https://images.pexels.com/photos/3806249/pexels-photo-3806249.jpeg" alt="Tyre fitting" class="w-full h-full object-cover" />
              <div class="absolute inset-0 bg-gradient-to-br from-[#FFD700]/5 to-transparent"></div>
            </div>

            <div class="relative z-10 flex items-start gap-6">
              <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-[#FFD700]/20 to-amber-500/10 flex items-center justify-center border border-[#FFD700]/20 group-hover:border-[#FFD700]/40 transition-all duration-300">
                <Tools class="h-8 w-8 text-[#FFD700]" />
              </div>
              <div class="flex-1">
                <h3 class="text-xl font-bold text-white mb-3 group-hover:text-[#FFD700] transition-colors duration-300">Tyres</h3>
                <p class="text-neutral-300 mb-4 text-sm">Budget to premium options. Professional fitting & balancing. FREE Tyre Check included.</p>
                <div class="flex items-center gap-2 text-[#FFD700]">
                  <span class="text-sm font-medium">Learn more</span>
                  <ArrowRight class="h-4 w-4" />
                </div>
              </div>
            </div>
          </Link>
        </Reveal>

        <!-- MOT Testing Service -->
        <Reveal mode="up" :delay="120">
          <Link href="/services#mot-class-4-7"
            class="group relative rounded-3xl border border-neutral-800/50 bg-gradient-to-br from-neutral-900/80 to-neutral-950/80 p-8 backdrop-blur-sm hover:border-green-500/30 transition-all duration-500 hover:scale-105 overflow-hidden block">
            <!-- Background Image -->
            <div class="absolute inset-0 opacity-20">
              <img src="https://images.pexels.com/photos/3894030/pexels-photo-3894030.jpeg" alt="MOT Testing Bay" class="w-full h-full object-cover" />
              <div class="absolute inset-0 bg-gradient-to-br from-green-500/5 to-transparent"></div>
            </div>

            <div class="relative z-10 flex items-start gap-6">
              <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-green-500/20 to-green-600/10 flex items-center justify-center border border-green-500/20 group-hover:border-green-500/40 transition-all duration-300">
                <CheckCircle class="h-8 w-8 text-green-400" />
              </div>
              <div class="flex-1">
                <h3 class="text-xl font-bold text-white mb-3 group-hover:text-green-400 transition-colors duration-300">MOT Testing</h3>
                <p class="text-neutral-300 mb-4 text-sm">Class 4 & 7 DVSA-approved testing. Quick turnaround. Honest advice on any issues found.</p>
                <div class="flex items-center gap-2 text-green-400">
                  <span class="text-sm font-medium">Learn more</span>
                  <ArrowRight class="h-4 w-4" />
                </div>
              </div>
            </div>
          </Link>
        </Reveal>

        <!-- Diagnostics Service -->
        <Reveal mode="up" :delay="240">
          <Link href="/services#diagnostics"
            class="group relative rounded-3xl border border-neutral-800/50 bg-gradient-to-br from-neutral-900/80 to-neutral-950/80 p-8 backdrop-blur-sm hover:border-purple-500/30 transition-all duration-500 hover:scale-105 overflow-hidden block">
            <!-- Background Image -->
            <div class="absolute inset-0 opacity-20">
              <img src="https://images.pexels.com/photos/8478265/pexels-photo-8478265.jpeg" alt="Vehicle Diagnostics Equipment" class="w-full h-full object-cover" />
              <div class="absolute inset-0 bg-gradient-to-br from-purple-500/5 to-transparent"></div>
            </div>

            <div class="relative z-10 flex items-start gap-6">
              <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-purple-500/20 to-purple-600/10 flex items-center justify-center border border-purple-500/20 group-hover:border-purple-500/40 transition-all duration-300">
                <DashboardSpeed class="h-8 w-8 text-purple-400" />
              </div>
              <div class="flex-1">
                <h3 class="text-xl font-bold text-white mb-3 group-hover:text-purple-400 transition-colors duration-300">Diagnostics</h3>
                <p class="text-neutral-300 mb-4 text-sm">Advanced computer diagnostics to identify issues quickly and accurately. Get to the root of the problem fast.</p>
                <div class="flex items-center gap-2 text-purple-400">
                  <span class="text-sm font-medium">Learn more</span>
                  <ArrowRight class="h-4 w-4" />
                </div>
              </div>
            </div>
          </Link>
        </Reveal>

        <!-- Servicing Service -->
        <Reveal mode="up" :delay="60">
          <Link href="/services#servicing"
            class="group relative rounded-3xl border border-neutral-800/50 bg-gradient-to-br from-neutral-900/80 to-neutral-950/80 p-8 backdrop-blur-sm hover:border-blue-500/30 transition-all duration-500 hover:scale-105 overflow-hidden block">
            <!-- Background Image -->
            <div class="absolute inset-0 opacity-20">
              <img src="https://images.pexels.com/photos/4489731/pexels-photo-4489731.jpeg" alt="Vehicle Servicing" class="w-full h-full object-cover" />
              <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-transparent"></div>
            </div>

            <div class="relative z-10 flex items-start gap-6">
              <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-500/20 to-blue-600/10 flex items-center justify-center border border-blue-500/20 group-hover:border-blue-500/40 transition-all duration-300">
                <Settings class="h-8 w-8 text-blue-400" />
              </div>
              <div class="flex-1">
                <h3 class="text-xl font-bold text-white mb-3 group-hover:text-blue-400 transition-colors duration-300">Servicing</h3>
                <p class="text-neutral-300 mb-4 text-sm">Full service and maintenance. Diagnostics. Repairs. Keep your car running smoothly and safely.</p>
                <div class="flex items-center gap-2 text-blue-400">
                  <span class="text-sm font-medium">Learn more</span>
                  <ArrowRight class="h-4 w-4" />
                </div>
              </div>
            </div>
          </Link>
        </Reveal>

        <!-- Batteries Service -->
        <Reveal mode="up" :delay="180">
          <Link href="/services#batteries"
            class="group relative rounded-3xl border border-neutral-800/50 bg-gradient-to-br from-neutral-900/80 to-neutral-950/80 p-8 backdrop-blur-sm hover:border-amber-500/30 transition-all duration-500 hover:scale-105 overflow-hidden block">
            <!-- Background Image -->
            <div class="absolute inset-0 opacity-20">
              <img src="https://images.pexels.com/photos/5572270/pexels-photo-5572270.jpeg" alt="Jumper cables on car battery" class="w-full h-full object-cover" />
              <div class="absolute inset-0 bg-gradient-to-br from-amber-500/5 to-transparent"></div>
            </div>

            <div class="relative z-10 flex items-start gap-6">
              <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-amber-500/20 to-amber-600/10 flex items-center justify-center border border-amber-500/20 group-hover:border-amber-500/40 transition-all duration-300">
                <Shield class="h-8 w-8 text-amber-400" />
              </div>
              <div class="flex-1">
                <h3 class="text-xl font-bold text-white mb-3 group-hover:text-amber-400 transition-colors duration-300">Batteries</h3>
                <p class="text-neutral-300 mb-4 text-sm">Battery testing, replacement, and charging systems. Don't get caught with a dead battery in the cold.</p>
                <div class="flex items-center gap-2 text-amber-400">
                  <span class="text-sm font-medium">Learn more</span>
                  <ArrowRight class="h-4 w-4" />
                </div>
              </div>
            </div>
          </Link>
        </Reveal>

        <!-- Emergency Service -->
        <Reveal mode="up" :delay="300">
          <Link href="/services#emergency"
            class="group relative rounded-3xl border border-neutral-800/50 bg-gradient-to-br from-neutral-900/80 to-neutral-950/80 p-8 backdrop-blur-sm hover:border-red-500/30 transition-all duration-500 hover:scale-105 overflow-hidden block">
            <!-- Background Image -->
            <div class="absolute inset-0 opacity-20">
              <img src="https://images.pexels.com/photos/1409999/pexels-photo-1409999.jpeg" alt="Roadside Emergency Assistance" class="w-full h-full object-cover" />
              <div class="absolute inset-0 bg-gradient-to-br from-red-500/5 to-transparent"></div>
            </div>

            <div class="relative z-10 flex items-start gap-6">
              <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-red-500/20 to-red-600/10 flex items-center justify-center border border-red-500/20 group-hover:border-red-500/40 transition-all duration-300">
                <Phone class="h-8 w-8 text-red-400" />
              </div>
              <div class="flex-1">
                <h3 class="text-xl font-bold text-white mb-3 group-hover:text-red-400 transition-colors duration-300">Emergency Callout</h3>
                <p class="text-neutral-300 mb-4 text-sm">24/7 emergency repairs and roadside assistance. We're here when you need us most.</p>
                <div class="flex items-center gap-2 text-red-400">
                  <span class="text-sm font-medium">Learn more</span>
                  <ArrowRight class="h-4 w-4" />
                </div>
              </div>
            </div>
          </Link>
        </Reveal>
      </div>
    </div>
  </section>
</template>
