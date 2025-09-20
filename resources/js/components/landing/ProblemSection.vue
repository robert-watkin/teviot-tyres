<script setup lang="ts">
import { h } from 'vue'
import Reveal from '../Reveal.vue'

// Custom icons using SVG (inspired by Phosphor style)
const AlertTriangleIcon = () => h('svg', {
  class: 'h-8 w-8 text-red-400',
  fill: 'none',
  stroke: 'currentColor',
  viewBox: '0 0 24 24'
}, [
  h('path', {
    'stroke-linecap': 'round',
    'stroke-linejoin': 'round',
    'stroke-width': '2',
    d: 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z'
  })
])

const WrenchIcon = () => h('svg', {
  class: 'h-8 w-8 text-red-400',
  fill: 'none',
  stroke: 'currentColor',
  viewBox: '0 0 24 24'
}, [
  h('path', {
    'stroke-linecap': 'round',
    'stroke-linejoin': 'round',
    'stroke-width': '2',
    d: 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z'
  }),
  h('path', {
    'stroke-linecap': 'round',
    'stroke-linejoin': 'round',
    'stroke-width': '2',
    d: 'M15 12a3 3 0 11-6 0 3 3 0 016 0z'
  })
])

const ClockIcon = () => h('svg', {
  class: 'h-8 w-8 text-red-400',
  fill: 'none',
  stroke: 'currentColor',
  viewBox: '0 0 24 24'
}, [
  h('circle', {
    cx: '12',
    cy: '12',
    r: '10',
    'stroke-linecap': 'round',
    'stroke-linejoin': 'round',
    'stroke-width': '2'
  }),
  h('polyline', {
    points: '12,6 12,12 16,14',
    'stroke-linecap': 'round',
    'stroke-linejoin': 'round',
    'stroke-width': '2'
  })
])
</script>

<template>
  <!-- Problem Section -->
  <section class="relative bg-gradient-to-br from-red-950/20 via-neutral-950 to-neutral-900 overflow-hidden">
    <!-- Subtle Background Animation -->
    <div class="absolute inset-0">
      <!-- Gentle pulsing orbs -->
      <div class="absolute top-20 left-10 w-32 h-32 bg-red-500/8 rounded-full blur-3xl animate-pulse-gentle"></div>
      <div class="absolute bottom-20 right-20 w-24 h-24 bg-rose-400/6 rounded-full blur-2xl animate-pulse-gentle" style="animation-delay: 2s;"></div>
      <div class="absolute top-1/2 left-1/3 w-16 h-16 bg-red-600/4 rounded-full blur-xl animate-pulse-gentle" style="animation-delay: 4s;"></div>

      <!-- Subtle floating particles -->
      <div class="absolute top-1/4 right-1/4 w-2 h-2 bg-red-400/30 rounded-full animate-float-particle"></div>
      <div class="absolute bottom-1/3 left-1/4 w-1 h-1 bg-rose-300/40 rounded-full animate-float-particle" style="animation-delay: 3s;"></div>
      <div class="absolute top-3/4 right-1/3 w-1.5 h-1.5 bg-red-500/25 rounded-full animate-float-particle" style="animation-delay: 6s;"></div>
    </div>

    <!-- Very subtle grid overlay -->
    <div class="absolute inset-0 opacity-3">
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_50%,rgba(239,68,68,0.02),transparent_70%)]"></div>
    </div>

    <div class="relative mx-auto w-full max-w-7xl px-4 py-24">
      <Reveal mode="up">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold mb-4">
            <span class="text-red-400">Common Car Problems</span> That Cost You Time & Money
          </h2>
          <p class="text-xl text-neutral-300 max-w-3xl mx-auto">
            Don't let these issues catch you off guard — know the warning signs and get them fixed fast
          </p>
        </div>
      </Reveal>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <Reveal mode="up">
          <div class="group relative rounded-2xl border border-red-800/30 bg-gradient-to-br from-red-900/20 to-neutral-900/80 p-8 backdrop-blur-sm hover:border-red-600/50 transition-all duration-300 hover:scale-105">
            <div class="w-16 h-16 rounded-xl bg-red-600/20 flex items-center justify-center mb-6">
            <component :is="AlertTriangleIcon" />
            </div>
            <h3 class="text-xl font-semibold text-white mb-4">Tyre Emergencies</h3>
            <ul class="space-y-2 text-neutral-300">
              <li>• Sudden punctures or blowouts</li>
              <li>• Uneven or excessive wear</li>
              <li>• Poor handling in wet conditions</li>
              <li>• Increased stopping distances</li>
            </ul>
          </div>
        </Reveal>

        <Reveal mode="up" :delay="120">
          <div class="group relative rounded-2xl border border-red-800/30 bg-gradient-to-br from-red-900/20 to-neutral-900/80 p-8 backdrop-blur-sm hover:border-red-600/50 transition-all duration-300 hover:scale-105">
            <div class="w-16 h-16 rounded-xl bg-red-600/20 flex items-center justify-center mb-6">
            <component :is="WrenchIcon" />
            </div>
            <h3 class="text-xl font-semibold text-white mb-4">MOT Failures</h3>
            <ul class="space-y-2 text-neutral-300">
              <li>• Brake system faults</li>
              <li>• Suspension issues</li>
              <li>• Exhaust system problems</li>
              <li>• Lighting and electrical faults</li>
            </ul>
          </div>
        </Reveal>

        <Reveal mode="up" :delay="240">
          <div class="group relative rounded-2xl border border-red-800/30 bg-gradient-to-br from-red-900/20 to-neutral-900/80 p-8 backdrop-blur-sm hover:border-red-600/50 transition-all duration-300 hover:scale-105">
            <div class="w-16 h-16 rounded-xl bg-red-600/20 flex items-center justify-center mb-6">
            <component :is="ClockIcon" />
            </div>
            <h3 class="text-xl font-semibold text-white mb-4">Service Delays</h3>
            <ul class="space-y-2 text-neutral-300">
              <li>• Long waits at busy garages</li>
              <li>• Unclear pricing and hidden costs</li>
              <li>• Poor communication about repairs</li>
              <li>• Inconvenient opening hours</li>
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
