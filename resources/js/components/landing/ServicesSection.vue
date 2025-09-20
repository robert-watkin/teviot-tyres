<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'
import Reveal from '../Reveal.vue'
import { Tools, CheckCircle, Settings, CreditCard, ArrowRight, DashboardSpeed, Shield } from '@iconoir/vue'

// Get page props for phone number
const page = usePage()
const site = computed(() => (page.props as any).site || {})
const phone = computed(() => site.value.phone || '01450 374875')

// Icons replaced with Iconoir Vue components
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

      <!-- Main Services Grid (with images) -->
      <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8 mb-16">
        <!-- Tyres Service -->
        <Reveal mode="up">
          <Link href="/services#tyres"
            class="group relative overflow-hidden rounded-3xl border border-neutral-800/50 bg-neutral-950">
            <!-- Image background -->
            <img alt="Tyre fitting" src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=1600&auto=format&fit=crop" class="absolute inset-0 h-full w-full object-cover opacity-60 group-hover:opacity-70 transition-opacity duration-300" />
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent"></div>

            <!-- Content -->
            <div class="relative z-10 p-8 flex flex-col h-full">
              <div class="w-16 h-16 rounded-xl bg-[#FFD700]/20 border border-[#FFD700]/30 flex items-center justify-center mb-5">
                <Tools class="h-8 w-8 text-[#FFD700]" />
              </div>
              <h3 class="text-2xl font-bold text-white mb-3">Tyres</h3>
              <p class="text-neutral-200 mb-6">Budget to premium options. Professional fitting & balancing. FREE Tyre Check included.</p>
              <ul class="mt-auto space-y-2 text-sm text-neutral-200">
                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#FFD700]"></span>Same-day fitting available</li>
                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#FFD700]"></span>All major brands stocked</li>
                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#FFD700]"></span>Wheel alignment & balancing</li>
              </ul>
              <div class="mt-6 flex items-center gap-2 text-[#FFD700]">
                <span class="font-semibold">Learn more</span>
                <ArrowRight class="h-5 w-5" />
              </div>
            </div>
          </Link>
        </Reveal>

        <!-- MOT Testing Service -->
        <Reveal mode="up" :delay="120">
          <Link href="/services#mot-class-4-7"
            class="group relative overflow-hidden rounded-3xl border border-neutral-800/50 bg-neutral-950">
            <img alt="MOT bay" src="https://images.unsplash.com/photo-1616683693594-4c61f1f743cd?q=80&w=1600&auto=format&fit=crop" class="absolute inset-0 h-full w-full object-cover opacity-60 group-hover:opacity-70 transition-opacity duration-300" />
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent"></div>

            <div class="relative z-10 p-8 flex flex-col h-full">
              <div class="w-16 h-16 rounded-xl bg-green-500/20 border border-green-500/30 flex items-center justify-center mb-5">
                <CheckCircle class="h-8 w-8 text-green-400" />
              </div>
              <h3 class="text-2xl font-bold text-white mb-3">MOT Testing</h3>
              <p class="text-neutral-200 mb-6">Class 4 & 7 DVSA-approved testing. Quick turnaround. Honest advice on any issues found.</p>
              <ul class="mt-auto space-y-2 text-sm text-neutral-200">
                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-green-400"></span>DVSA approved test centre</li>
                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-green-400"></span>Same-day appointments</li>
                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-green-400"></span>Free re-test within 10 days</li>
              </ul>
              <div class="mt-6 flex items-center gap-2 text-green-400">
                <span class="font-semibold">Learn more</span>
                <ArrowRight class="h-5 w-5" />
              </div>
            </div>
          </Link>
        </Reveal>

        <!-- Servicing Service -->
        <Reveal mode="up" :delay="240">
          <Link href="/services#servicing"
            class="group relative overflow-hidden rounded-3xl border border-neutral-800/50 bg-neutral-950">
            <img alt="Vehicle servicing" src="https://images.unsplash.com/photo-1618641986557-1ecd230959aa?q=80&w=1600&auto=format&fit=crop" class="absolute inset-0 h-full w-full object-cover opacity-60 group-hover:opacity-70 transition-opacity duration-300" />
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent"></div>

            <div class="relative z-10 p-8 flex flex-col h-full">
              <div class="w-16 h-16 rounded-xl bg-blue-500/20 border border-blue-500/30 flex items-center justify-center mb-5">
                <Settings class="h-8 w-8 text-blue-400" />
              </div>
              <h3 class="text-2xl font-bold text-white mb-3">Servicing</h3>
              <p class="text-neutral-200 mb-6">Full service and maintenance. Diagnostics. Repairs. Keep your car running smoothly and safely.</p>
              <ul class="mt-auto space-y-2 text-sm text-neutral-200">
                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>Manufacturer servicing</li>
                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>Computer diagnostics</li>
                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>Oil & filter changes</li>
              </ul>
              <div class="mt-6 flex items-center gap-2 text-blue-400">
                <span class="font-semibold">Learn more</span>
                <ArrowRight class="h-5 w-5" />
              </div>
            </div>
          </Link>
        </Reveal>
      </div>

      <!-- Additional Services Row -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
        <!-- Diagnostics Service -->
        <Reveal mode="up">
          <div class="group relative rounded-3xl border border-neutral-800/50 bg-gradient-to-br from-neutral-900/80 to-neutral-950/80 p-8 backdrop-blur-sm hover:border-[#FFD700]/30 transition-all duration-500 hover:scale-105 overflow-hidden">
            <!-- Background pattern -->
            <div class="absolute inset-0 opacity-20">
              <div class="absolute inset-0 bg-[radial-gradient(circle_at_60%_40%,rgba(168,85,247,0.2),transparent_60%)]"></div>
            </div>

            <div class="relative z-10 flex items-start gap-6">
              <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-purple-500/20 to-purple-600/10 flex items-center justify-center border border-purple-500/20 group-hover:border-purple-500/40 transition-all duration-300">
                <DashboardSpeed class="h-8 w-8 text-purple-400" />
              </div>
              <div class="flex-1">
                <h3 class="text-xl font-bold text-white mb-3 group-hover:text-purple-400 transition-colors duration-300">Diagnostics</h3>
                <p class="text-neutral-300 mb-4">Advanced computer diagnostics to identify issues quickly and accurately. Get to the root of the problem fast.</p>
                <div class="flex items-center gap-2 text-purple-400">
                  <span class="text-sm font-medium">Learn more</span>
                  <ArrowRight class="h-5 w-5" />
                </div>
              </div>
            </div>

            <div class="absolute inset-0 bg-gradient-to-br from-purple-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
          </div>
        </Reveal>

        <!-- Batteries Service -->
        <Reveal mode="up" :delay="120">
          <div class="group relative rounded-3xl border border-neutral-800/50 bg-gradient-to-br from-neutral-900/80 to-neutral-950/80 p-8 backdrop-blur-sm hover:border-[#FFD700]/30 transition-all duration-500 hover:scale-105 overflow-hidden">
            <!-- Background pattern -->
            <div class="absolute inset-0 opacity-20">
              <div class="absolute inset-0 bg-[radial-gradient(circle_at_40%_60%,rgba(245,158,11,0.2),transparent_60%)]"></div>
            </div>

            <div class="relative z-10 flex items-start gap-6">
              <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-amber-500/20 to-amber-600/10 flex items-center justify-center border border-amber-500/20 group-hover:border-amber-500/40 transition-all duration-300">
                <Shield class="h-8 w-8 text-amber-400" />
              </div>
              <div class="flex-1">
                <h3 class="text-xl font-bold text-white mb-3 group-hover:text-amber-400 transition-colors duration-300">Batteries</h3>
                <p class="text-neutral-300 mb-4">Battery testing, replacement, and charging systems. Don't get caught with a dead battery in the cold.</p>
                <div class="flex items-center gap-2 text-amber-400">
                  <span class="text-sm font-medium">Learn more</span>
                  <ArrowRight class="h-5 w-5" />
                </div>
              </div>
            </div>

            <div class="absolute inset-0 bg-gradient-to-br from-amber-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
          </div>
        </Reveal>
      </div>

      <!-- Payment Assist Section -->
      <Reveal mode="up" :delay="300">
        <div class="relative rounded-3xl border border-neutral-800/50 bg-gradient-to-r from-neutral-900/90 to-neutral-950/90 p-10 backdrop-blur-sm overflow-hidden">
          <!-- Enhanced Background with automotive imagery patterns -->
          <div class="absolute inset-0 opacity-15">
            <!-- Automotive pattern overlay -->
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_10%_20%,rgba(255,215,0,0.2),transparent_40%)]"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_90%_80%,rgba(255,215,0,0.15),transparent_40%)]"></div>
            <!-- Subtle automotive grid -->
            <div class="absolute inset-0 bg-[linear-gradient(rgba(255,215,0,0.05)_1px,transparent_1px),linear-gradient(90deg,rgba(255,215,0,0.05)_1px,transparent_1px)] bg-[size:40px_40px] opacity-30"></div>
          </div>

          <!-- Payment method icons background -->
          <div class="absolute top-4 right-4 opacity-10">
            <div class="flex gap-2 text-2xl text-neutral-600">
              <span>💳</span>
              <span>🏦</span>
              <span>💰</span>
              <span>📊</span>
            </div>
          </div>

          <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
            <!-- Left side: Content with enhanced imagery -->
            <div class="space-y-6">
              <div class="flex items-start gap-6">
                <!-- Enhanced icon with automotive imagery -->
                <div class="relative">
                  <div class="w-24 h-24 rounded-3xl bg-gradient-to-br from-[#FFD700]/25 to-[#FFD700]/10 flex items-center justify-center border-2 border-[#FFD700]/30 shadow-lg">
                    <CreditCard class="h-12 w-12 text-[#FFD700]" />
                  </div>
                  <!-- Floating payment icons -->
                  <div class="absolute -top-2 -right-2 w-8 h-8 rounded-full bg-green-500/20 flex items-center justify-center border border-green-400/30">
                    <span class="text-green-400 text-sm">✓</span>
                  </div>
                  <div class="absolute -bottom-2 -left-2 w-6 h-6 rounded-full bg-blue-500/20 flex items-center justify-center border border-blue-400/30">
                    <span class="text-blue-400 text-xs">💳</span>
                  </div>
                </div>

                <div class="flex-1">
                  <h3 class="text-3xl font-bold text-white mb-3">Payment Assist</h3>
                  <p class="text-lg text-neutral-300 leading-relaxed mb-4">Don't let repair costs break the bank. Spread payments over 3–12 months with our flexible financing options.</p>
                  <!-- Trust indicators -->
                  <div class="flex flex-wrap items-center gap-4">
                    <div class="flex items-center gap-2 text-sm text-green-400">
                      <span>🔒</span>
                      <span>Secure & Trusted</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-blue-400">
                      <span>⭐</span>
                      <span>DVSA Approved Partner</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-amber-400">
                      <span>⚡</span>
                      <span>Instant Decision</span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Benefits with imagery -->
              <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="flex items-center gap-3 p-3 rounded-xl bg-neutral-800/30 border border-neutral-700/30">
                  <div class="w-10 h-10 rounded-lg bg-green-500/20 flex items-center justify-center">
                    <span class="text-green-400">💰</span>
                  </div>
                  <div>
                    <div class="text-sm font-semibold text-white">No Hidden Fees</div>
                    <div class="text-xs text-neutral-400">Transparent pricing</div>
                  </div>
                </div>
                <div class="flex items-center gap-3 p-3 rounded-xl bg-neutral-800/30 border border-neutral-700/30">
                  <div class="w-10 h-10 rounded-lg bg-blue-500/20 flex items-center justify-center">
                    <span class="text-blue-400">🏁</span>
                  </div>
                  <div>
                    <div class="text-sm font-semibold text-white">Quick Process</div>
                    <div class="text-xs text-neutral-400">Get back on road fast</div>
                  </div>
                </div>
                <div class="flex items-center gap-3 p-3 rounded-xl bg-neutral-800/30 border border-neutral-700/30">
                  <div class="w-10 h-10 rounded-lg bg-amber-500/20 flex items-center justify-center">
                    <span class="text-amber-400">📞</span>
                  </div>
                  <div>
                    <div class="text-sm font-semibold text-white">Expert Support</div>
                    <div class="text-xs text-neutral-400">We're here to help</div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Right side: Enhanced process steps with imagery -->
            <div class="space-y-4">
              <h4 class="text-xl font-semibold text-white mb-4">How It Works</h4>
              <div class="space-y-4">
                <div class="flex items-center gap-4 p-4 rounded-xl bg-neutral-800/40 border border-neutral-700/40 hover:border-[#FFD700]/30 transition-colors">
                  <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#FFD700]/20 to-amber-500/10 flex items-center justify-center border border-[#FFD700]/20">
                    <span class="text-[#FFD700] font-bold text-lg">1</span>
                  </div>
                  <div class="flex-1">
                    <div class="font-semibold text-white mb-1">Get Your Quote</div>
                    <div class="text-sm text-neutral-400">Quick cost breakdown for your repair</div>
                  </div>
                  <div class="text-2xl">📋</div>
                </div>

                <div class="flex items-center gap-4 p-4 rounded-xl bg-neutral-800/40 border border-neutral-700/40 hover:border-[#FFD700]/30 transition-colors">
                  <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500/20 to-emerald-500/10 flex items-center justify-center border border-green-400/20">
                    <span class="text-green-400 font-bold text-lg">2</span>
                  </div>
                  <div class="flex-1">
                    <div class="font-semibold text-white mb-1">Fast Approval</div>
                    <div class="text-sm text-neutral-400">Eligibility check in minutes</div>
                  </div>
                  <div class="text-2xl">⚡</div>
                </div>

                <div class="flex items-center gap-4 p-4 rounded-xl bg-neutral-800/40 border border-neutral-700/40 hover:border-[#FFD700]/30 transition-colors">
                  <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500/20 to-cyan-500/10 flex items-center justify-center border border-blue-400/20">
                    <span class="text-blue-400 font-bold text-lg">3</span>
                  </div>
                  <div class="flex-1">
                    <div class="font-semibold text-white mb-1">Flexible Payments</div>
                    <div class="text-sm text-neutral-400">Spread over 3–12 months</div>
                  </div>
                  <div class="text-2xl">💳</div>
                </div>
              </div>

              <!-- Call to action with imagery -->
              <div class="mt-6 p-6 rounded-xl bg-gradient-to-r from-[#FFD700]/15 to-amber-500/15 border-2 border-[#FFD700]/30 shadow-lg">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                  <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-lg bg-[#FFD700]/25 flex items-center justify-center border border-[#FFD700]/40">
                      <span class="text-[#FFD700] text-xl">📞</span>
                    </div>
                    <div class="text-center sm:text-left">
                      <div class="font-bold text-white text-lg">Ready to Get Started?</div>
                      <div class="text-sm text-neutral-300">Call now for instant approval</div>
                    </div>
                  </div>
                  <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="sheen flex items-center gap-2 px-6 py-3 bg-[#FFD700] text-black font-bold rounded-lg hover:brightness-95 transition-all shadow-lg hover:shadow-xl">
                    <span>Call {{ phone }}</span>
                  </a>
                </div>
                <div class="mt-4 text-center">
                  <div class="flex flex-wrap items-center justify-center gap-4 text-xs text-neutral-400">
                    <div class="flex items-center gap-1">
                      <span>✓</span>
                      <span>No credit check required</span>
                    </div>
                    <div class="flex items-center gap-1">
                      <span>⚡</span>
                      <span>Instant approval</span>
                    </div>
                    <div class="flex items-center gap-1">
                      <span>💳</span>
                      <span>Flexible terms 3-12 months</span>
                    </div>
                  </div>
                  <div class="mt-2 text-xs text-amber-400 font-medium">
                    🚨 Limited time - Call now to get started!
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </Reveal>
    </div>
  </section>
</template>
