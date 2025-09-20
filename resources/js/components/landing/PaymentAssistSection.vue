<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'
import Reveal from '../Reveal.vue'
import { CreditCard, Shield, Settings, CheckCircle, Phone } from '@iconoir/vue'

// Get page props for phone number
const page = usePage()
const site = computed(() => (page.props as any).site || {})
const phone = computed(() => site.value.phone || '01450 374875')
</script>

<template>
  <!-- Payment Assist Section -->
  <section class="relative overflow-hidden bg-gradient-to-br from-neutral-900 via-neutral-950 to-black">
    <!-- Background Elements -->
    <div class="absolute inset-0 opacity-20">
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_10%_20%,rgba(34,197,94,0.3),transparent_30%)]"></div>
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_90%_80%,rgba(34,197,94,0.2),transparent_40%)]"></div>
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_50%,rgba(34,197,94,0.1),transparent_60%)]"></div>
    </div>

    <!-- Subtle background shapes -->
    <div class="absolute inset-0 overflow-hidden">
      <div class="absolute top-20 left-10 w-32 h-32 bg-green-500/8 rounded-full blur-2xl"></div>
      <div class="absolute top-40 right-20 w-24 h-24 bg-emerald-400/10 rounded-full blur-xl"></div>
      <div class="absolute bottom-20 left-1/4 w-20 h-20 bg-green-600/6 rounded-full blur-lg"></div>
    </div>

    <div class="relative mx-auto w-full max-w-7xl px-4 py-16">
      <Reveal mode="up">
        <div class="text-center mb-12">
          <h2 class="text-4xl font-bold mb-4">
            <span class="text-green-400">Payment Assist</span>
          </h2>
          <p class="text-lg text-neutral-300 max-w-2xl mx-auto leading-relaxed">
            Spread the cost of your vehicle repairs with our flexible payment options.
          </p>
        </div>
      </Reveal>

      <!-- Main Content Grid -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-12">
        <!-- Left Content -->
        <Reveal mode="up">
          <div class="space-y-6">
            <div class="space-y-4">
              <h3 class="text-2xl font-bold text-white mb-3">Flexible Payment Solutions</h3>
              <p class="text-base text-neutral-300 leading-relaxed">
                Don't let unexpected repair costs catch you off guard. With Payment Assist, you can spread the cost of your vehicle maintenance over 3, 6, or 12 months.
              </p>
            </div>

            <!-- Features List -->
            <div class="space-y-3">
              <div class="flex items-start gap-3">
                <div class="w-10 h-10 rounded-full bg-green-500/20 flex items-center justify-center border border-green-500/30 flex-shrink-0">
                  <CheckCircle class="h-5 w-5 text-green-400" />
                </div>
                <div>
                  <h4 class="text-base font-semibold text-white mb-1">Quick Application</h4>
                  <p class="text-sm text-neutral-300">Get approved in minutes</p>
                </div>
              </div>

              <div class="flex items-start gap-3">
                <div class="w-10 h-10 rounded-full bg-green-500/20 flex items-center justify-center border border-green-500/30 flex-shrink-0">
                  <Settings class="h-5 w-5 text-green-400" />
                </div>
                <div>
                  <h4 class="text-base font-semibold text-white mb-1">Flexible Terms</h4>
                  <p class="text-sm text-neutral-300">Choose 3, 6, or 12 months</p>
                </div>
              </div>

              <div class="flex items-start gap-3">
                <div class="w-10 h-10 rounded-full bg-green-500/20 flex items-center justify-center border border-green-500/30 flex-shrink-0">
                  <Shield class="h-5 w-5 text-green-400" />
                </div>
                <div>
                  <h4 class="text-base font-semibold text-white mb-1">Secure & Safe</h4>
                  <p class="text-sm text-neutral-300">Bank-level security</p>
                </div>
              </div>
            </div>
          </div>
        </Reveal>

        <!-- Right Content - CTA Card -->
        <Reveal mode="up" :delay="120">
          <div class="bg-gradient-to-br from-neutral-800/50 to-neutral-900/50 backdrop-blur-sm border border-green-500/20 rounded-2xl p-6">
            <div class="text-center space-y-4">
              <div class="w-16 h-16 rounded-full bg-green-500/20 flex items-center justify-center mx-auto mb-4">
                <CreditCard class="h-8 w-8 text-green-400" />
              </div>

              <h3 class="text-xl font-bold text-white mb-3">Get Started Today</h3>
              <p class="text-sm text-neutral-300 mb-6">
                Apply now and get your vehicle repaired without upfront costs.
              </p>

              <div class="space-y-3">
                <a
                  :href="`tel:${phone.replace(/\/s+/g, '')}`"
                  class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-green-500 to-emerald-500 px-6 py-3 text-base font-bold text-white shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300 w-full justify-center"
                >
                  <Phone class="h-4 w-4" />
                  <span>Call {{ phone }}</span>
                </a>

                <div class="text-xs text-neutral-400 text-center">
                  <p>✓ No hidden fees</p>
                  <p>✓ Instant decision</p>
                  <p>✓ APR 19.9%</p>
                </div>
              </div>
            </div>
          </div>
        </Reveal>
      </div>

      <!-- Bottom Info Section -->
      <Reveal mode="up" :delay="300">
        <div class="bg-neutral-800/30 backdrop-blur-sm border border-neutral-700/50 rounded-xl p-6">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
            <div>
              <div class="w-12 h-12 rounded-full bg-green-500/20 flex items-center justify-center mx-auto mb-3">
                <CheckCircle class="h-6 w-6 text-green-400" />
              </div>
              <h4 class="text-base font-semibold text-white mb-1">No Credit Checks</h4>
              <p class="text-xs text-neutral-300">Soft search only</p>
            </div>

            <div>
              <div class="w-12 h-12 rounded-full bg-green-500/20 flex items-center justify-center mx-auto mb-3">
                <Settings class="h-4 w-4 text-green-400" />
              </div>
              <h4 class="text-base font-semibold text-white mb-1">Same Day Approval</h4>
              <p class="text-xs text-neutral-300">Instant decisions</p>
            </div>

            <div>
              <div class="w-12 h-12 rounded-full bg-green-500/20 flex items-center justify-center mx-auto mb-3">
                <Shield class="h-6 w-6 text-green-400" />
              </div>
              <h4 class="text-base font-semibold text-white mb-1">Fully Protected</h4>
              <p class="text-xs text-neutral-300">Secure payments</p>
            </div>
          </div>
        </div>
      </Reveal>
    </div>
  </section>
</template>
