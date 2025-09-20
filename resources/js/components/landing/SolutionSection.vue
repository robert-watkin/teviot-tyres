<script setup lang="ts">
import { h } from 'vue'
import Reveal from '../Reveal.vue'

// Custom icons using SVG (inspired by Phosphor style)
const ZapIcon = () => h('svg', {
  class: 'h-8 w-8 text-green-400',
  fill: 'none',
  stroke: 'currentColor',
  viewBox: '0 0 24 24'
}, [
  h('polygon', {
    points: '13,2 3,14 12,14 11,22 21,10 12,10 13,2',
    'stroke-linecap': 'round',
    'stroke-linejoin': 'round',
    'stroke-width': '2'
  })
])

const ShieldIcon = () => h('svg', {
  class: 'h-8 w-8 text-green-400',
  fill: 'none',
  stroke: 'currentColor',
  viewBox: '0 0 24 24'
}, [
  h('path', {
    'stroke-linecap': 'round',
    'stroke-linejoin': 'round',
    'stroke-width': '2',
    d: 'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z'
  })
])

const CheckCircleIcon = () => h('svg', {
  class: 'h-8 w-8 text-green-400',
  fill: 'none',
  stroke: 'currentColor',
  viewBox: '0 0 24 24'
}, [
  h('path', {
    'stroke-linecap': 'round',
    'stroke-linejoin': 'round',
    'stroke-width': '2',
    d: 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'
  })
])
</script>

<template>
  <!-- Solution Section -->
  <section class="relative bg-gradient-to-br from-green-950/20 via-neutral-950 to-neutral-900 overflow-hidden">
    <!-- Subtle Background Animation -->
    <div class="absolute inset-0">
      <!-- Gentle pulsing orbs -->
      <div class="absolute top-20 left-10 w-32 h-32 bg-green-500/8 rounded-full blur-3xl animate-pulse-gentle"></div>
      <div class="absolute bottom-20 right-20 w-24 h-24 bg-emerald-400/6 rounded-full blur-2xl animate-pulse-gentle" style="animation-delay: 2s;"></div>
      <div class="absolute top-1/2 left-1/3 w-16 h-16 bg-green-600/4 rounded-full blur-xl animate-pulse-gentle" style="animation-delay: 4s;"></div>

      <!-- Subtle floating particles -->
      <div class="absolute top-1/4 right-1/4 w-2 h-2 bg-green-400/30 rounded-full animate-float-particle"></div>
      <div class="absolute bottom-1/3 left-1/4 w-1 h-1 bg-emerald-300/40 rounded-full animate-float-particle" style="animation-delay: 3s;"></div>
      <div class="absolute top-3/4 right-1/3 w-1.5 h-1.5 bg-green-500/25 rounded-full animate-float-particle" style="animation-delay: 6s;"></div>
    </div>

    <!-- Very subtle grid overlay -->
    <div class="absolute inset-0 opacity-3">
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_50%,rgba(34,197,94,0.02),transparent_70%)]"></div>
    </div>

    <div class="relative mx-auto w-full max-w-7xl px-4 py-24">
      <Reveal mode="up">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold mb-4">
            <span class="text-green-400">How We Solve</span> Your Problems
          </h2>
          <p class="text-xl text-neutral-300 max-w-3xl mx-auto">
            Fast, reliable solutions that get you back on the road quickly and safely
          </p>
        </div>
      </Reveal>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <Reveal mode="up">
          <div class="group relative rounded-2xl border border-green-800/30 bg-gradient-to-br from-green-900/20 to-neutral-900/80 p-8 backdrop-blur-sm hover:border-green-600/50 transition-all duration-300 hover:scale-105">
            <div class="w-16 h-16 rounded-xl bg-green-600/20 flex items-center justify-center mb-6">
            <component :is="ZapIcon" />
            </div>
            <h3 class="text-xl font-semibold text-white mb-4">Same-Day Service</h3>
            <ul class="space-y-2 text-neutral-300">
              <li>• Emergency tyre repairs & replacements</li>
              <li>• Most services completed same day</li>
              <li>• No need to wait weeks for appointments</li>
              <li>• Get back on the road fast</li>
            </ul>
          </div>
        </Reveal>

        <Reveal mode="up" :delay="120">
          <div class="group relative rounded-2xl border border-green-800/30 bg-gradient-to-br from-green-900/20 to-neutral-900/80 p-8 backdrop-blur-sm hover:border-green-600/50 transition-all duration-300 hover:scale-105">
            <div class="w-16 h-16 rounded-xl bg-green-600/20 flex items-center justify-center mb-6">
            <component :is="ShieldIcon" />
            </div>
            <h3 class="text-xl font-semibold text-white mb-4">Expert Technicians</h3>
            <ul class="space-y-2 text-neutral-300">
              <li>• DVSA-approved MOT testing</li>
              <li>• Qualified and experienced mechanics</li>
              <li>• Honest advice and transparent pricing</li>
              <li>• All work fully guaranteed</li>
            </ul>
          </div>
        </Reveal>

        <Reveal mode="up" :delay="240">
          <div class="group relative rounded-2xl border border-green-800/30 bg-gradient-to-br from-green-900/20 to-neutral-900/80 p-8 backdrop-blur-sm hover:border-green-600/50 transition-all duration-300 hover:scale-105">
            <div class="w-16 h-16 rounded-xl bg-green-600/20 flex items-center justify-center mb-6">
            <component :is="CheckCircleIcon" />
            </div>
            <h3 class="text-xl font-semibold text-white mb-4">Local Convenience</h3>
            <ul class="space-y-2 text-neutral-300">
              <li>• Hawick location - easy to find</li>
              <li>• Competitive pricing, no hidden costs</li>
              <li>• Friendly, personal service</li>
              <li>• Support your local business</li>
            </ul>
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
