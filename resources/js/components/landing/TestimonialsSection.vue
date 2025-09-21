<script setup lang="ts">
import { h } from 'vue'
import Reveal from '../Reveal.vue'

// Custom star icon using SVG
const StarIcon = () => h('svg', {
  class: 'h-4 w-4',
  fill: 'none',
  stroke: 'currentColor',
  viewBox: '0 0 24 24'
}, [
  h('path', {
    'stroke-linecap': 'round',
    'stroke-linejoin': 'round',
    'stroke-width': '2',
    d: 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z'
  })
])

// Testimonial data with varied ratings
const testimonials = [
  {
    id: 1,
    rating: 5,
    text: "Needed a new tyre quickly and Teviot Tyres sorted me out same day at a very reasonable price. Thanks lads!",
    name: "James D.",
    initials: "JD"
  },
  {
    id: 2,
    rating: 4.5,
    text: "Tyres replaced and source of 'squeaking' located. Brilliant service, and honest, sound advice. Thank you. I also revisited for MOT. Highly recommend.",
    name: "Sarah M.",
    initials: "SM"
  },
  {
    id: 3,
    rating: 5,
    text: "Absolutely brilliant service. Can't thank them enough. Will definitely be using them from now on for my car. Brilliant service and very quick and very affordable.",
    name: "Robert T.",
    initials: "RT"
  }
]
</script>

<template>
  <!-- Testimonials Section -->
  <section class="relative overflow-hidden bg-gradient-to-b from-neutral-950 via-neutral-900 to-neutral-950">
    <!-- Dynamic Background Elements -->
    <div class="absolute inset-0">
      <!-- Animated radial gradients with gold theme -->
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(255,215,0,0.15),transparent_60%)] animate-gradient-shift-1"></div>
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_70%_80%,rgba(255,215,0,0.08),transparent_60%)] animate-gradient-shift-2"></div>
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_50%,rgba(255,193,7,0.05),transparent_70%)] animate-gradient-shift-3"></div>
    </div>

    <!-- Floating geometric shapes -->
    <div class="absolute inset-0 overflow-hidden">
      <!-- Large floating circles -->
      <div class="absolute top-20 left-10 w-32 h-32 bg-[#FFD700]/5 rounded-full blur-2xl animate-float-slow"></div>
      <div class="absolute top-40 right-20 w-24 h-24 bg-amber-400/8 rounded-full blur-xl animate-float-medium" style="animation-delay: 2s;"></div>
      <div class="absolute bottom-20 left-1/4 w-20 h-20 bg-yellow-500/6 rounded-full blur-lg animate-float-fast" style="animation-delay: 4s;"></div>

      <!-- Small floating elements -->
      <div class="absolute top-1/3 right-1/3 w-4 h-4 bg-[#FFD700]/20 rounded-full animate-pulse" style="animation-delay: 1s;"></div>
      <div class="absolute bottom-1/3 left-1/3 w-3 h-3 bg-amber-300/15 rounded-full animate-pulse" style="animation-delay: 3s;"></div>
      <div class="absolute top-2/3 right-1/4 w-2 h-2 bg-yellow-400/25 rounded-full animate-pulse" style="animation-delay: 5s;"></div>

      <!-- Subtle grid pattern -->
      <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0 bg-[linear-gradient(rgba(255,215,0,0.1)_1px,transparent_1px),linear-gradient(90deg,rgba(255,215,0,0.1)_1px,transparent_1px)] bg-[size:50px_50px]"></div>
      </div>
    </div>

    <!-- Color transition overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-transparent via-amber-900/5 to-transparent animate-color-shift"></div>

    <div class="relative mx-auto w-full max-w-7xl px-4 py-24">
      <Reveal mode="up">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold mb-4">
            <span class="text-[#FFD700]">What Our Customers</span> Say
          </h2>
          <p class="text-xl text-neutral-300 max-w-3xl mx-auto">
            Don't just take our word for it — see what local drivers are saying about our service
          </p>
        </div>
      </Reveal>

      <!-- Scrolling Testimonials Carousel -->
      <div class="relative mb-16">
        <div class="flex overflow-hidden">
          <div class="flex animate-scroll-left gap-8 w-max">
            <!-- First set of testimonials -->
            <div v-for="testimonial in testimonials" :key="testimonial.id" class="group relative rounded-2xl border border-neutral-800/50 bg-gradient-to-br from-neutral-900/80 to-neutral-950/80 p-8 backdrop-blur-sm hover:border-[#FFD700]/30 transition-all duration-300 hover:scale-105 min-w-[400px]">
              <!-- Stars positioned above customer info -->
              <div class="flex gap-1 mb-4">
                <component :is="StarIcon" v-for="i in 5" :key="i" :class="i <= testimonial.rating ? 'text-[#FFD700] fill-current' : 'text-neutral-600 fill-none'" />
              </div>

              <blockquote class="text-neutral-200 mb-6 leading-relaxed">
                "{{ testimonial.text }}"
              </blockquote>

              <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-[#FFD700]/20 flex items-center justify-center">
                  <span class="text-[#FFD700] font-semibold">{{ testimonial.initials }}</span>
                </div>
                <div>
                  <div class="font-semibold text-white">{{ testimonial.name }}</div>
                  <div class="text-sm text-neutral-400">Customer</div>
                </div>
              </div>
            </div>

            <!-- Duplicate set for seamless loop -->
            <div v-for="testimonial in testimonials" :key="`duplicate-${testimonial.id}`" class="group relative rounded-2xl border border-neutral-800/50 bg-gradient-to-br from-neutral-900/80 to-neutral-950/80 p-8 backdrop-blur-sm hover:border-[#FFD700]/30 transition-all duration-300 hover:scale-105 min-w-[400px]">
              <!-- Stars positioned above customer info -->
              <div class="flex gap-1 mb-4">
                <component :is="StarIcon" v-for="i in 5" :key="i" :class="i <= testimonial.rating ? 'text-[#FFD700] fill-current' : 'text-neutral-600 fill-none'" />
              </div>

              <blockquote class="text-neutral-200 mb-6 leading-relaxed">
                "{{ testimonial.text }}"
              </blockquote>

              <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-[#FFD700]/20 flex items-center justify-center">
                  <span class="text-[#FFD700] font-semibold">{{ testimonial.initials }}</span>
                </div>
                <div>
                  <div class="font-semibold text-white">{{ testimonial.name }}</div>
                  <div class="text-sm text-neutral-400">Customer</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Stats section -->
      <Reveal mode="up" :delay="300">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
          <div class="space-y-2">
            <div class="text-3xl font-bold text-[#FFD700]">Highly Rated</div>
            <div class="text-neutral-300">By local customers</div>
          </div>
          <div class="space-y-2">
            <div class="text-3xl font-bold text-[#FFD700]">Trusted</div>
            <div class="text-neutral-300">For tyres & repairs</div>
          </div>
          <div class="space-y-2">
            <div class="text-3xl font-bold text-[#FFD700]">Same Day</div>
            <div class="text-neutral-300">Service available</div>
          </div>
          <div class="space-y-2">
            <div class="text-3xl font-bold text-[#FFD700]">Under new management</div>
            <div class="text-neutral-300">Since April 2024</div>
          </div>
        </div>
      </Reveal>
    </div>
  </section>
</template>

<style scoped>
/* Animated gradient shifts - refined (no rotation) */
@keyframes gradient-shift-1 {
  0%, 100% {
    transform: translate(0, 0) scale(1);
    opacity: 0.12;
  }
  50% {
    transform: translate(16px, -10px) scale(1.02);
    opacity: 0.16;
  }
}

@keyframes gradient-shift-2 {
  0%, 100% {
    transform: translate(0, 0) scale(1);
    opacity: 0.06;
  }
  50% {
    transform: translate(-20px, 12px) scale(1.015);
    opacity: 0.08;
  }
}

@keyframes gradient-shift-3 {
  0%, 100% {
    transform: translate(0, 0) scale(1);
    opacity: 0.04;
  }
  50% {
    transform: translate(10px, -12px) scale(1.02);
    opacity: 0.06;
  }
}

/* Floating animations - refined (no rotation) */
@keyframes float-slow {
  0%, 100% { transform: translateY(0) translateX(0); }
  50% { transform: translateY(-14px) translateX(10px); }
}

@keyframes float-medium {
  0%, 100% { transform: translateY(0) translateX(0); }
  50% { transform: translateY(-10px) translateX(16px); }
}

@keyframes float-fast {
  0%, 100% { transform: translateY(0) translateX(0); }
  50% { transform: translateY(-8px) translateX(-12px); }
}

/* Color transition animation - Gold theme */
@keyframes color-shift {
  0%, 100% {
    background: linear-gradient(135deg, transparent 0%, rgba(255, 215, 0, 0.05) 50%, transparent 100%);
  }
  25% {
    background: linear-gradient(135deg, rgba(255, 215, 0, 0.02) 0%, rgba(255, 193, 7, 0.08) 50%, rgba(255, 215, 0, 0.03) 100%);
  }
  50% {
    background: linear-gradient(135deg, rgba(255, 193, 7, 0.03) 0%, rgba(255, 215, 0, 0.06) 50%, rgba(255, 193, 7, 0.02) 100%);
  }
  75% {
    background: linear-gradient(135deg, rgba(255, 215, 0, 0.04) 0%, rgba(255, 193, 7, 0.04) 50%, rgba(255, 215, 0, 0.05) 100%);
  }
}

.animate-gradient-shift-1 { animation: gradient-shift-1 28s ease-in-out infinite; }
.animate-gradient-shift-2 { animation: gradient-shift-2 32s ease-in-out infinite; }
.animate-gradient-shift-3 { animation: gradient-shift-3 36s ease-in-out infinite; }

.animate-float-slow { animation: float-slow 18s ease-in-out infinite; }
.animate-float-medium { animation: float-medium 16s ease-in-out infinite; }
.animate-float-fast { animation: float-fast 14s ease-in-out infinite; }

.animate-color-shift { animation: color-shift 22s ease-in-out infinite; }

/* Respect user preference to reduce motion */
@media (prefers-reduced-motion: reduce) {
  * { animation: none !important; transition: none !important; }
}

/* Enhanced scroll animation */
@keyframes scroll-left {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(-50%);
  }
}

.animate-scroll-left {
  animation: scroll-left 30s linear infinite;
}

.animate-scroll-left:hover {
  animation-play-state: paused;
}
</style>
