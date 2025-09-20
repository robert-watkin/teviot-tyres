<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'
import { Phone, MapPin, Tools, Shield, CheckCircle } from '@iconoir/vue'
import Reveal from '../Reveal.vue'

const page = usePage()
const site = computed(() => (page.props as any).site || {})
const phone = computed(() => site.value.phone || '01450 374875')
</script>

<template>
  <!-- CTA Section -->
  <section class="relative bg-gradient-to-br from-[#FFD700]/10 via-neutral-950 to-neutral-900 overflow-hidden">
    <!-- Dynamic Background Elements -->
    <div class="absolute inset-0">
      <!-- Static radial gradients with gold theme -->
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_50%,rgba(255,215,0,0.15),transparent_70%)]"></div>
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(255,193,7,0.08),transparent_60%)]"></div>
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_70%_80%,rgba(255,215,0,0.05),transparent_80%)]"></div>
    </div>

    <!-- Static geometric shapes -->
    <div class="absolute inset-0 overflow-hidden">
      <!-- Large static circles -->
      <div class="absolute top-20 left-10 w-32 h-32 bg-[#FFD700]/5 rounded-full blur-2xl"></div>
      <div class="absolute top-40 right-20 w-24 h-24 bg-amber-400/8 rounded-full blur-xl"></div>
      <div class="absolute bottom-20 left-1/4 w-20 h-20 bg-yellow-500/6 rounded-full blur-lg"></div>

      <!-- Small static elements -->
      <div class="absolute top-1/3 right-1/3 w-4 h-4 bg-[#FFD700]/20 rounded-full"></div>
      <div class="absolute bottom-1/3 left-1/3 w-3 h-3 bg-amber-300/15 rounded-full"></div>
      <div class="absolute top-2/3 right-1/4 w-2 h-2 bg-yellow-400/25 rounded-full"></div>

      <!-- Subtle static grid pattern -->
      <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0 bg-[linear-gradient(rgba(255,215,0,0.1)_1px,transparent_1px),linear-gradient(90deg,rgba(255,215,0,0.1)_1px,transparent_1px)] bg-[size:50px_50px]"></div>
      </div>
    </div>

    <!-- Static color overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-transparent via-amber-900/5 to-transparent"></div>

    <div class="relative mx-auto w-full max-w-7xl px-4 py-24">
      <Reveal mode="up">
        <div class="text-center">
          <h2 class="text-4xl font-bold mb-6">
            <span class="text-[#FFD700]">Ready to Get Started?</span>
          </h2>
          <p class="text-xl text-neutral-300 mb-8 max-w-3xl mx-auto">
            Don't let car problems slow you down. Book your appointment today and experience the Teviot Tyres difference.
          </p>

          <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-12">
            <a
              :href="`tel:${phone.replace(/\s+/g, '')}`"
              class="inline-flex items-center gap-3 rounded-xl bg-gradient-to-r from-[#FFD700] to-yellow-500 px-8 py-4 text-lg font-bold text-black shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300"
              aria-label="Call Teviot Tyres"
            >
              <Phone class="h-5 w-5" />
              <span>Call {{ phone }}</span>
            </a>

            <Link
              href="/contact"
              class="inline-flex items-center gap-3 rounded-xl border-2 border-[#FFD700] bg-transparent px-8 py-4 text-lg font-bold text-[#FFD700] hover:bg-[#FFD700] hover:text-black transition-all duration-300"
              aria-label="View contact details"
            >
              <MapPin class="h-5 w-5" />
              <span>Contact & Hours</span>
            </Link>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
            <div class="text-center">
              <div class="w-16 h-16 rounded-full bg-[#FFD700]/20 flex items-center justify-center mx-auto mb-4">
                <Tools class="h-8 w-8 text-[#FFD700]" />
              </div>
              <h3 class="text-lg font-semibold text-white mb-2">Same Day Service</h3>
              <p class="text-neutral-300">Most repairs completed on the same day</p>
            </div>

            <div class="text-center">
              <div class="w-16 h-16 rounded-full bg-[#FFD700]/20 flex items-center justify-center mx-auto mb-4">
                <Shield class="h-8 w-8 text-[#FFD700]" />
              </div>
              <h3 class="text-lg font-semibold text-white mb-2">Fully Guaranteed</h3>
              <p class="text-neutral-300">All work comes with our guarantee</p>
            </div>

            <div class="text-center">
              <div class="w-16 h-16 rounded-full bg-[#FFD700]/20 flex items-center justify-center mx-auto mb-4">
                <CheckCircle class="h-8 w-8 text-[#FFD700]" />
              </div>
              <h3 class="text-lg font-semibold text-white mb-2">Expert Technicians</h3>
              <p class="text-neutral-300">DVSA-approved testing and repairs</p>
            </div>
          </div>
        </div>
      </Reveal>
    </div>
  </section>
</template>

<style scoped>
/* Static background elements - No animations needed */
</style>
