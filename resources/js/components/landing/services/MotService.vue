<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import { CheckCircle, ArrowRight } from '@iconoir/vue'
import Reveal from '../../Reveal.vue'

interface Props {
  href?: string
  delay?: number
}

const props = withDefaults(defineProps<Props>(), {
  href: '/services#mot-prep',
  delay: 120
})
</script>

<template>
  <Reveal mode="up" :delay="delay">
    <Link :href="href"
      class="group relative rounded-3xl border border-neutral-800/50 bg-gradient-to-br from-neutral-900/80 to-neutral-950/80 p-8 backdrop-blur-sm hover:border-[#FFD700]/30 transition-all duration-500 hover:scale-105 overflow-hidden block">
      <!-- Background Image -->
      <div class="absolute inset-0 opacity-20">
        <img src="https://images.pexels.com/photos/3894030/pexels-photo-3894030.jpeg" alt="MOT Testing Bay" class="w-full h-full object-cover" />
        <div class="absolute inset-0 bg-gradient-to-br from-[#FFD700]/5 to-transparent"></div>
      </div>

      <div class="relative z-10 flex items-start gap-6">
        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-[#FFD700]/20 to-amber-500/10 flex items-center justify-center border border-[#FFD700]/20 group-hover:border-[#FFD700]/40 transition-all duration-300">
          <CheckCircle class="h-8 w-8 text-[#FFD700]" />
        </div>
        <div class="flex-1">
          <h3 class="text-xl font-bold text-white mb-3 group-hover:text-[#FFD700] transition-colors duration-300">MOT Preparation</h3>
          <p class="text-neutral-300 mb-4 text-sm">Preparation and advisory for MOT. Quick turnaround. Honest advice on any issues found.</p>
          <div class="flex items-center gap-2 text-[#FFD700]">
            <span class="text-sm font-medium">Learn more</span>
            <ArrowRight class="h-4 w-4" />
          </div>
        </div>
      </div>
    </Link>
  </Reveal>
</template>
