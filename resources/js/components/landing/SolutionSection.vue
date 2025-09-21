<script setup lang="ts">
import { Tools, Shield, CheckCircle } from '@iconoir/vue'
import Reveal from '../Reveal.vue'
</script>

<template>
  <!-- Solution Section -->
  <section class="relative overflow-hidden bg-gradient-to-b from-neutral-950 via-neutral-900 to-neutral-950">
    <!-- Background Elements -->
    <div class="absolute inset-0 opacity-10">
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_10%_20%,rgba(255,215,0,0.3),transparent_30%)]"></div>
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_90%_80%,rgba(255,215,0,0.2),transparent_40%)]"></div>
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_50%,rgba(255,215,0,0.1),transparent_60%)]"></div>
    </div>

    <!-- Subtle background shapes -->
    <div class="absolute inset-0 overflow-hidden">
      <div class="absolute top-20 left-10 w-32 h-32 bg-[#FFD700]/6 rounded-full blur-2xl"></div>
      <div class="absolute top-40 right-20 w-24 h-24 bg-[#FFD700]/10 rounded-full blur-xl"></div>
      <div class="absolute bottom-20 left-1/4 w-20 h-20 bg-[#FFD700]/8 rounded-full blur-lg"></div>
    </div>

    <div class="relative mx-auto w-full max-w-7xl px-4 py-24">
      <Reveal mode="up">
        <div class="text-center mb-20">
          <h2 class="text-5xl font-bold mb-6">
            <span class="text-[#FFD700]">How We Solve</span> Your Problems
          </h2>
          <p class="text-xl text-neutral-300 max-w-3xl mx-auto leading-relaxed">
            Fast, reliable solutions that get you back on the road quickly and safely
          </p>
        </div>
      </Reveal>

      <!-- Solution Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Same-Day Service -->
        <Reveal mode="up">
          <div class="group relative rounded-3xl border border-neutral-800/50 bg-gradient-to-br from-neutral-900/80 to-neutral-950/80 p-8 backdrop-blur-sm hover:border-[#FFD700]/30 transition-all duration-500 hover:scale-105">
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-[#FFD700]/20 to-amber-500/10 flex items-center justify-center border border-[#FFD700]/20 group-hover:border-[#FFD700]/40 transition-all duration-300 mb-6">
              <Tools class="h-8 w-8 text-[#FFD700]" />
            </div>
            <h3 class="text-xl font-bold text-white mb-3 group-hover:text-[#FFD700] transition-colors duration-300">Same-Day Service</h3>
            <p class="text-neutral-300 mb-4 text-sm">Emergency repairs and replacements completed quickly without waiting weeks.</p>
          </div>
        </Reveal>

        <!-- Expert Technicians -->
        <Reveal mode="up" :delay="120">
          <div class="group relative rounded-3xl border border-neutral-800/50 bg-gradient-to-br from-neutral-900/80 to-neutral-950/80 p-8 backdrop-blur-sm hover:border-[#FFD700]/30 transition-all duration-500 hover:scale-105">
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-[#FFD700]/20 to-amber-500/10 flex items-center justify-center border border-[#FFD700]/20 group-hover:border-[#FFD700]/40 transition-all duration-300 mb-6">
              <Shield class="h-8 w-8 text-[#FFD700]" />
            </div>
            <h3 class="text-xl font-bold text-white mb-3 group-hover:text-[#FFD700] transition-colors duration-300">Expert Technicians</h3>
            <p class="text-neutral-300 mb-4 text-sm">Qualified mechanics with honest advice, transparent pricing, and guaranteed work.</p>
          </div>
        </Reveal>

        <!-- Local Convenience -->
        <Reveal mode="up" :delay="240">
          <div class="group relative rounded-3xl border border-neutral-800/50 bg-gradient-to-br from-neutral-900/80 to-neutral-950/80 p-8 backdrop-blur-sm hover:border-[#FFD700]/30 transition-all duration-500 hover:scale-105">
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-[#FFD700]/20 to-amber-500/10 flex items-center justify-center border border-[#FFD700]/20 group-hover:border-[#FFD700]/40 transition-all duration-300 mb-6">
              <CheckCircle class="h-8 w-8 text-[#FFD700]" />
            </div>
            <h3 class="text-xl font-bold text-white mb-3 group-hover:text-[#FFD700] transition-colors duration-300">Local Convenience</h3>
            <p class="text-neutral-300 mb-4 text-sm">Easy-to-find location, competitive pricing, friendly service, and local business support.</p>
          </div>
        </Reveal>
      </div>
    </div>
  </section>
</template>

<style scoped>
/* Gentle pulse animation (reduced intensity) */
@keyframes pulse-gentle {
  0%, 100% { opacity: 0.55; transform: scale(1); }
  50% { opacity: 0.85; transform: scale(1.02); }
}

/* Subtle floating particle animation (no rotation, reduced distance) */
@keyframes float-particle {
  0%, 100% { transform: translateY(0) translateX(0); opacity: 0.3; }
  50% { transform: translateY(-8px) translateX(6px); opacity: 0.5; }
}

/* Breathing effect for background (subtle) */
@keyframes breathe {
  0%, 100% { opacity: 0.02; transform: scale(1); }
  50% { opacity: 0.045; transform: scale(1.01); }
}

.animate-pulse-gentle { animation: pulse-gentle 10s ease-in-out infinite; }
.animate-float-particle { animation: float-particle 14s ease-in-out infinite; }
.animate-breathe { animation: breathe 20s ease-in-out infinite; }

@media (prefers-reduced-motion: reduce) {
  * { animation: none !important; transition: none !important; }
}
</style>
