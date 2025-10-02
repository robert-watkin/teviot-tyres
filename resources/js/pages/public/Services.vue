<script setup lang="ts">
import PublicLayout from '@/layouts/public/PublicLayout.vue';
import { Link } from '@inertiajs/vue3';
import { Wrench, Gauge, Battery, Hammer, CreditCard, Phone, Search } from 'lucide-vue-next';
import Reveal from '@/components/Reveal.vue';
import { usePage } from '@inertiajs/vue3';
import { computed, onMounted, onBeforeUnmount, ref } from 'vue';

const page = usePage();
const site = computed(() => (page.props as any).site || {});
const phone = computed(() => site.value.phone || '01450 374875');

// Active section tracking for sticky nav
const activeSection = ref<string>('tyres');
let observer: IntersectionObserver | null = null;

onMounted(() => {
  const ids = ['tyres', 'mot-prep', 'servicing', 'diagnostics', 'brakes', 'exhausts', 'clutches', 'timing-belts', 'suspension', 'wheel-bearings', 'remapping-keys', 'battery', 'emergency', 'payment-assist'];
  const sections = ids
    .map((id) => document.getElementById(id))
    .filter((el): el is HTMLElement => !!el);
  observer = new IntersectionObserver(
    (entries) => {
      // Choose the entry nearest the top that is intersecting
      const visible = entries
        .filter((e) => e.isIntersecting)
        .sort((a, b) => Math.abs(a.boundingClientRect.top) - Math.abs(b.boundingClientRect.top));
      if (visible[0]?.target?.id) {
        activeSection.value = visible[0].target.id;
      }
    },
    { root: null, rootMargin: '-20% 0px -60% 0px', threshold: [0.15, 0.6] },
  );
  sections.forEach((s) => observer?.observe(s));
});

onBeforeUnmount(() => {
  observer?.disconnect();
  observer = null;
});

const isActive = (id: string) => activeSection.value === id;
</script>

<template>
  <PublicLayout title="Services">
    <section id="top" class="mx-auto w-full max-w-7xl px-4 py-12">
      <Reveal mode="up">
        <h1 class="text-3xl font-bold tracking-tight sm:text-4xl"><span class="text-[#FFD700]">Our</span> Services</h1>
        <p class="mt-2 max-w-prose text-neutral-300">
          From tyres to diagnostics, we offer a complete range of garage services in Hawick.
        </p>
      </Reveal>

      <div class="mt-6 rounded-lg border border-neutral-800 bg-neutral-950 p-4 text-sm text-neutral-300">
        <span class="mr-2 rounded bg-[#FFD700] px-2 py-0.5 text-xs font-semibold text-black">Seasonal</span>
        FREE Tyre Check — stay safe in ice, rain & snow (Mon–Fri).
      </div>
    </section>

    <!-- Tyres -->
    <section id="tyres" class="mx-auto w-full max-w-7xl scroll-mt-24 px-4 py-16">
      <Reveal mode="up">
        <div class="group relative overflow-hidden rounded-3xl border border-neutral-800/50 bg-gradient-to-br from-neutral-900/90 to-neutral-950/90 backdrop-blur-sm hover:border-[#FFD700]/30 transition-all duration-500 hover:scale-[1.01]">
          <!-- Background Image -->
          <div class="absolute inset-0 opacity-60">
            <img src="https://images.pexels.com/photos/3806249/pexels-photo-3806249.jpeg" alt="Tyre fitting" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-br from-neutral-900/60 to-transparent"></div>
          </div>

          <div class="relative z-10 p-12">
            <div class="flex items-center gap-6 mb-8">
              <div class="w-20 h-20 rounded-3xl bg-gradient-to-br from-[#FFD700]/20 to-amber-500/10 flex items-center justify-center border border-[#FFD700]/20">
                <Wrench class="h-10 w-10 text-[#FFD700]" />
              </div>
              <div>
                <h2 class="text-4xl font-bold text-white mb-2">Tyres</h2>
                <p class="text-neutral-200 text-lg">Budget to premium options</p>
                <div class="mt-3 flex items-center gap-2">
                  <div class="w-2 h-2 rounded-full bg-[#FFD700]"></div>
                  <span class="text-sm text-neutral-300">Professional fitting & balancing</span>
                </div>
              </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
              <div>
                <p class="text-xl text-neutral-100 mb-4 leading-relaxed">
                  Budget, mid-range, and premium tyres. Professional fitting & balancing. Complimentary tyre safety check — ask in store. Bring your reg or size; we’ll advise the best option for your vehicle and budget.
                </p>
                <p class="text-lg text-neutral-200 mb-6">
                  Same-day fitting available for most tyres. We stock all major brands and can usually source specialist tyres within 24 hours.
                </p>
              </div>

              <div class="space-y-4">
                <h3 class="text-lg font-semibold text-white mb-3">What We Offer:</h3>
                <ul class="space-y-3 text-neutral-200">
                  <li class="flex items-start gap-3">
                    <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                    <span>Budget, mid-range & premium tyre brands</span>
                  </li>
                  <li class="flex items-start gap-3">
                    <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                    <span>Professional fitting and wheel balancing</span>
                  </li>
                  <li class="flex items-start gap-3">
                    <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                    <span>Complimentary tyre safety checks</span>
                  </li>
                  <li class="flex items-start gap-3">
                    <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                    <span>Same-day service for most tyres</span>
                  </li>
                  <li class="flex items-start gap-3">
                    <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                    <span>Expert advice on the best option for your budget</span>
                  </li>
                </ul>
              </div>
            </div>

            <div class="flex flex-wrap items-center gap-4 pt-4 border-t border-neutral-800/50">
              <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-[#FFD700] to-yellow-500 px-8 py-4 text-lg font-semibold text-black shadow-lg hover:brightness-95 transition-all duration-300">
                <Phone class="h-5 w-5" />
                <span>Call {{ phone }}</span>
              </a>
              <Link href="/reg-lookup" class="inline-flex items-center gap-2 rounded-xl border border-[#FFD700] bg-transparent px-8 py-4 text-lg font-semibold text-[#FFD700] hover:bg-[#FFD700] hover:text-black transition-all duration-300">
                <Search class="h-5 w-5" />
                <span>Use Reg Lookup</span>
              </Link>
              <a href="#top" class="text-base text-neutral-400 hover:text-[#FFD700] transition-colors">Back to top</a>
            </div>
          </div>
        </div>
      </Reveal>
    </section>

    <!-- MOT Preparation & Repairs -->
    <section id="mot-prep" class="mx-auto w-full max-w-7xl scroll-mt-24 px-4 py-16">
      <Reveal mode="up" :delay="60">
        <div class="group relative overflow-hidden rounded-3xl border border-neutral-800/50 bg-gradient-to-br from-neutral-900/90 to-neutral-950/90 backdrop-blur-sm hover:border-[#FFD700]/30 transition-all duration-500 hover:scale-[1.01]">
          <!-- Background Image -->
          <div class="absolute inset-0 opacity-60">
            <img src="https://images.pexels.com/photos/3894030/pexels-photo-3894030.jpeg" alt="MOT Testing Bay" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-br from-neutral-900/60 to-transparent"></div>
          </div>

          <div class="relative z-10 p-12">
            <div class="flex items-center gap-6 mb-8">
              <div class="w-20 h-20 rounded-3xl bg-gradient-to-br from-[#FFD700]/20 to-amber-500/10 flex items-center justify-center border border-[#FFD700]/20">
                <Hammer class="h-10 w-10 text-[#FFD700]" />
              </div>
              <div>
                <h2 class="text-4xl font-bold text-white mb-2">MOT Preparation & Repairs</h2>
                <p class="text-neutral-200 text-lg">Pre-checks and repairs</p>
                <div class="mt-3 flex items-center gap-2">
                  <div class="w-2 h-2 rounded-full bg-[#FFD700]"></div>
                  <span class="text-sm text-neutral-300">Quick turnaround service</span>
                </div>
              </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
              <div>
                <p class="text-xl text-neutral-100 mb-4 leading-relaxed">
                  Pre‑checks to help avoid failures, plus repairs for advisories or fails. Clear next steps to keep you road‑ready.
                </p>
                <p class="text-lg text-neutral-200 mb-6">
                  We provide honest advice about what needs to be done and can usually complete repairs the same day. All work is fully guaranteed.
                </p>
              </div>

              <div class="space-y-4">
                <h3 class="text-lg font-semibold text-white mb-3">Our MOT Services:</h3>
                <ul class="space-y-3 text-neutral-200">
                  <li class="flex items-start gap-3">
                    <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                    <span>Pre‑MOT inspections and advice</span>
                  </li>
                  <li class="flex items-start gap-3">
                    <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                    <span>Repairs for common failure items</span>
                  </li>
                  <li class="flex items-start gap-3">
                    <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                    <span>Re‑tests and follow‑up support</span>
                  </li>
                  <li class="flex items-start gap-3">
                    <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                    <span>Same-day repairs where possible</span>
                  </li>
                  <li class="flex items-start gap-3">
                    <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                    <span>Honest advice on repair priorities</span>
                  </li>
                </ul>
              </div>
            </div>

            <div class="flex flex-wrap items-center gap-4 pt-4 border-t border-neutral-800/50">
              <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-[#FFD700] to-yellow-500 px-8 py-4 text-lg font-semibold text-black shadow-lg hover:brightness-95 transition-all duration-300">
                <Phone class="h-5 w-5" />
                <span>Phone to book</span>
              </a>
              <a href="#top" class="text-base text-neutral-400 hover:text-[#FFD700] transition-colors">Back to top</a>
            </div>
          </div>
        </div>
      </Reveal>
    </section>

    <!-- Servicing -->
    <section id="servicing" class="mx-auto w-full max-w-7xl scroll-mt-24 px-4 py-12">
      <Reveal mode="up" :delay="100">
        <div class="group relative overflow-hidden rounded-2xl border border-neutral-800/50 bg-gradient-to-br from-neutral-900/80 to-neutral-950/80 backdrop-blur-sm hover:border-[#FFD700]/30 transition-all duration-500 hover:scale-[1.02]">
          <!-- Background Image -->
          <div class="absolute inset-0 opacity-30">
            <img src="https://images.pexels.com/photos/4489731/pexels-photo-4489731.jpeg" alt="Vehicle Servicing" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-br from-[#FFD700]/10 to-transparent"></div>
          </div>

          <div class="relative z-10 p-8">
            <div class="flex items-center gap-4 mb-6">
              <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-[#FFD700]/20 to-amber-500/10 flex items-center justify-center border border-[#FFD700]/20">
                <Wrench class="h-8 w-8 text-[#FFD700]" />
              </div>
              <div>
                <h2 class="text-3xl font-bold text-white">Servicing</h2>
                <p class="text-neutral-300 text-sm">General maintenance</p>
              </div>
            </div>

            <p class="text-lg text-neutral-200 mb-6 leading-relaxed">
              General maintenance for all vehicles. Oil and filters, fluids, safety inspections, and more — keeping you running smoothly.
            </p>

            <div class="flex flex-wrap items-center gap-4">
              <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-[#FFD700] to-yellow-500 px-6 py-3 text-base font-semibold text-black shadow-lg hover:brightness-95 transition-all duration-300">
                <Phone class="h-4 w-4" />
                <span>Phone to book</span>
              </a>
              <a href="#top" class="text-sm text-neutral-400 hover:text-[#FFD700] transition-colors">Back to top</a>
            </div>
          </div>
        </div>
      </Reveal>
    </section>

    <!-- Diagnostics -->
    <section id="diagnostics" class="mx-auto w-full max-w-7xl scroll-mt-24 px-4 py-12">
      <Reveal mode="up" :delay="120">
        <div class="group relative overflow-hidden rounded-2xl border border-neutral-800/50 bg-gradient-to-br from-neutral-900/80 to-neutral-950/80 backdrop-blur-sm hover:border-[#FFD700]/30 transition-all duration-500 hover:scale-[1.02]">
          <!-- Background Image -->
          <div class="absolute inset-0 opacity-30">
            <img src="https://images.pexels.com/photos/8478265/pexels-photo-8478265.jpeg" alt="Vehicle Diagnostics Equipment" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-br from-[#FFD700]/10 to-transparent"></div>
          </div>

          <div class="relative z-10 p-8">
            <div class="flex items-center gap-4 mb-6">
              <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-[#FFD700]/20 to-amber-500/10 flex items-center justify-center border border-[#FFD700]/20">
                <Gauge class="h-8 w-8 text-[#FFD700]" />
              </div>
              <div>
                <h2 class="text-3xl font-bold text-white">Diagnostics</h2>
                <p class="text-neutral-300 text-sm">Advanced fault finding</p>
              </div>
            </div>

            <p class="text-lg text-neutral-200 mb-6 leading-relaxed">
              Modern diagnostic tools to quickly identify faults and get you back on the road with confidence.
            </p>

            <div class="flex flex-wrap items-center gap-4">
              <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-[#FFD700] to-yellow-500 px-6 py-3 text-base font-semibold text-black shadow-lg hover:brightness-95 transition-all duration-300">
                <Phone class="h-4 w-4" />
                <span>Phone to book</span>
              </a>
              <a href="#top" class="text-sm text-neutral-400 hover:text-[#FFD700] transition-colors">Back to top</a>
            </div>
          </div>
        </div>
      </Reveal>
    </section>

    <!-- Battery Replacement -->
    <section id="battery" class="mx-auto w-full max-w-7xl scroll-mt-24 px-4 py-12">
      <Reveal mode="up" :delay="140">
        <div class="group relative overflow-hidden rounded-2xl border border-neutral-800/50 bg-gradient-to-br from-neutral-900/80 to-neutral-950/80 backdrop-blur-sm hover:border-[#FFD700]/30 transition-all duration-500 hover:scale-[1.02]">
          <!-- Background Image -->
          <div class="absolute inset-0 opacity-30">
            <img src="https://images.pexels.com/photos/5572270/pexels-photo-5572270.jpeg" alt="Jumper cables on car battery" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-br from-[#FFD700]/10 to-transparent"></div>
          </div>

          <div class="relative z-10 p-8">
            <div class="flex items-center gap-4 mb-6">
              <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-[#FFD700]/20 to-amber-500/10 flex items-center justify-center border border-[#FFD700]/20">
                <Battery class="h-8 w-8 text-[#FFD700]" />
              </div>
              <div>
                <h2 class="text-3xl font-bold text-white">Battery Replacement</h2>
                <p class="text-neutral-300 text-sm">Testing and replacement</p>
              </div>
            </div>

            <p class="text-lg text-neutral-200 mb-6 leading-relaxed">
              Battery testing and replacement while you wait. We’ll supply and fit the right battery for your vehicle.
            </p>

            <div class="flex flex-wrap items-center gap-4">
              <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-[#FFD700] to-yellow-500 px-6 py-3 text-base font-semibold text-black shadow-lg hover:brightness-95 transition-all duration-300">
                <Phone class="h-4 w-4" />
                <span>Phone to book</span>
              </a>
              <a href="#top" class="text-sm text-neutral-400 hover:text-[#FFD700] transition-colors">Back to top</a>
            </div>
          </div>
        </div>
      </Reveal>
    </section>

    <!-- Payment Assist -->
    <section id="payment-assist" class="mx-auto w-full max-w-7xl scroll-mt-24 px-4 py-12">
      <Reveal mode="up" :delay="160">
        <div class="group relative overflow-hidden rounded-2xl border border-neutral-800/50 bg-gradient-to-br from-neutral-900/80 to-neutral-950/80 backdrop-blur-sm hover:border-[#FFD700]/30 transition-all duration-500 hover:scale-[1.02]">
          <!-- Background Image -->
          <div class="absolute inset-0 opacity-30">
            <img src="https://images.pexels.com/photos/590016/pexels-photo-590016.jpeg" alt="Payment options" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-br from-[#FFD700]/10 to-transparent"></div>
          </div>

          <div class="relative z-10 p-8">
            <div class="flex items-center gap-4 mb-6">
              <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-[#FFD700]/20 to-amber-500/10 flex items-center justify-center border border-[#FFD700]/20">
                <CreditCard class="h-8 w-8 text-[#FFD700]" />
              </div>
              <div>
                <h2 class="text-3xl font-bold text-white">Payment Assist</h2>
                <p class="text-neutral-300 text-sm">0% interest over 4 months</p>
              </div>
            </div>

            <p class="text-lg text-neutral-200 mb-6 leading-relaxed">
              Spread the cost over 4 equal monthly payments at 0% interest. Subject to status; soft credit search. Ask our team for details.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
              <div class="text-center">
                <div class="w-12 h-12 rounded-xl bg-[#FFD700]/20 flex items-center justify-center mx-auto mb-3">
                  <span class="text-2xl font-bold text-[#FFD700]">1</span>
                </div>
                <h3 class="font-semibold text-white mb-2">Quote</h3>
                <p class="text-sm text-neutral-300">Get your service cost</p>
              </div>
              <div class="text-center">
                <div class="w-12 h-12 rounded-xl bg-[#FFD700]/20 flex items-center justify-center mx-auto mb-3">
                  <span class="text-2xl font-bold text-[#FFD700]">2</span>
                </div>
                <h3 class="font-semibold text-white mb-2">Approval</h3>
                <p class="text-sm text-neutral-300">Quick decision with soft credit search</p>
              </div>
              <div class="text-center">
                <div class="w-12 h-12 rounded-xl bg-[#FFD700]/20 flex items-center justify-center mx-auto mb-3">
                  <span class="text-2xl font-bold text-[#FFD700]">3</span>
                </div>
                <h3 class="font-semibold text-white mb-2">Payments</h3>
                <p class="text-sm text-neutral-300">Split over 4 months at 0% interest</p>
              </div>
            </div>

            <div class="flex flex-wrap items-center gap-4">
              <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-[#FFD700] to-yellow-500 px-6 py-3 text-base font-semibold text-black shadow-lg hover:brightness-95 transition-all duration-300">
                <Phone class="h-4 w-4" />
                <span>Phone to book</span>
              </a>
              <a href="#top" class="text-sm text-neutral-400 hover:text-[#FFD700] transition-colors">Back to top</a>
            </div>
          </div>
        </div>
      </Reveal>
    </section>

    <!-- Brakes -->
    <section id="brakes" class="mx-auto w-full max-w-7xl scroll-mt-24 px-4 py-12">
      <Reveal mode="up" :delay="180">
        <div class="group relative overflow-hidden rounded-2xl border border-neutral-800/50 bg-gradient-to-br from-neutral-900/80 to-neutral-950/80 backdrop-blur-sm hover:border-[#FFD700]/30 transition-all duration-500 hover:scale-[1.02]">
          <!-- Background Image -->
          <div class="absolute inset-0 opacity-30">
            <img src="https://images.pexels.com/photos/3747134/pexels-photo-3747134.jpeg" alt="Brake system repair" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-br from-[#FFD700]/10 to-transparent"></div>
          </div>

          <div class="relative z-10 p-8">
            <div class="flex items-center gap-4 mb-6">
              <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-[#FFD700]/20 to-amber-500/10 flex items-center justify-center border border-[#FFD700]/20">
                <Wrench class="h-8 w-8 text-[#FFD700]" />
              </div>
              <div>
                <h2 class="text-3xl font-bold text-white">Brakes</h2>
                <p class="text-neutral-300 text-sm">Safety and performance</p>
              </div>
            </div>

            <p class="text-lg text-neutral-200 mb-6 leading-relaxed">
              Brake pads, discs, and system repairs. Essential for your safety — we use quality parts and provide honest advice on when work is needed.
            </p>

            <ul class="space-y-2 text-neutral-200 mb-6">
              <li class="flex items-start gap-3">
                <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                <span>Brake pads and disc replacement</span>
              </li>
              <li class="flex items-start gap-3">
                <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                <span>Full brake system inspections</span>
              </li>
              <li class="flex items-start gap-3">
                <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                <span>Emergency brake repairs</span>
              </li>
            </ul>

            <div class="flex flex-wrap items-center gap-4">
              <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-[#FFD700] to-yellow-500 px-6 py-3 text-base font-semibold text-black shadow-lg hover:brightness-95 transition-all duration-300">
                <Phone class="h-4 w-4" />
                <span>Phone to book</span>
              </a>
              <a href="#top" class="text-sm text-neutral-400 hover:text-[#FFD700] transition-colors">Back to top</a>
            </div>
          </div>
        </div>
      </Reveal>
    </section>

    <!-- Exhausts -->
    <section id="exhausts" class="mx-auto w-full max-w-7xl scroll-mt-24 px-4 py-12">
      <Reveal mode="up" :delay="200">
        <div class="group relative overflow-hidden rounded-2xl border border-neutral-800/50 bg-gradient-to-br from-neutral-900/80 to-neutral-950/80 backdrop-blur-sm hover:border-[#FFD700]/30 transition-all duration-500 hover:scale-[1.02]">
          <!-- Background Image -->
          <div class="absolute inset-0 opacity-30">
            <img src="https://images.pexels.com/photos/3972755/pexels-photo-3972755.jpeg" alt="Exhaust system repair" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-br from-[#FFD700]/10 to-transparent"></div>
          </div>

          <div class="relative z-10 p-8">
            <div class="flex items-center gap-4 mb-6">
              <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-[#FFD700]/20 to-amber-500/10 flex items-center justify-center border border-[#FFD700]/20">
                <Wrench class="h-8 w-8 text-[#FFD700]" />
              </div>
              <div>
                <h2 class="text-3xl font-bold text-white">Exhausts</h2>
                <p class="text-neutral-300 text-sm">Repairs and replacements</p>
              </div>
            </div>

            <p class="text-lg text-neutral-200 mb-6 leading-relaxed">
              Exhaust system repairs, replacements, and emissions work. We fix leaks, rattles, and MOT failures quickly and cost-effectively.
            </p>

            <ul class="space-y-2 text-neutral-200 mb-6">
              <li class="flex items-start gap-3">
                <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                <span>Exhaust repairs and welding</span>
              </li>
              <li class="flex items-start gap-3">
                <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                <span>Full system replacement</span>
              </li>
              <li class="flex items-start gap-3">
                <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                <span>Catalytic converter work</span>
              </li>
            </ul>

            <div class="flex flex-wrap items-center gap-4">
              <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-[#FFD700] to-yellow-500 px-6 py-3 text-base font-semibold text-black shadow-lg hover:brightness-95 transition-all duration-300">
                <Phone class="h-4 w-4" />
                <span>Phone to book</span>
              </a>
              <a href="#top" class="text-sm text-neutral-400 hover:text-[#FFD700] transition-colors">Back to top</a>
            </div>
          </div>
        </div>
      </Reveal>
    </section>

    <!-- Clutches -->
    <section id="clutches" class="mx-auto w-full max-w-7xl scroll-mt-24 px-4 py-12">
      <Reveal mode="up" :delay="220">
        <div class="group relative overflow-hidden rounded-2xl border border-neutral-800/50 bg-gradient-to-br from-neutral-900/80 to-neutral-950/80 backdrop-blur-sm hover:border-[#FFD700]/30 transition-all duration-500 hover:scale-[1.02]">
          <!-- Background Image -->
          <div class="absolute inset-0 opacity-30">
            <img src="https://images.pexels.com/photos/7166586/pexels-photo-7166586.jpeg" alt="Clutch repair" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-br from-[#FFD700]/10 to-transparent"></div>
          </div>

          <div class="relative z-10 p-8">
            <div class="flex items-center gap-4 mb-6">
              <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-[#FFD700]/20 to-amber-500/10 flex items-center justify-center border border-[#FFD700]/20">
                <Wrench class="h-8 w-8 text-[#FFD700]" />
              </div>
              <div>
                <h2 class="text-3xl font-bold text-white">Clutches</h2>
                <p class="text-neutral-300 text-sm">Manual and automatic</p>
              </div>
            </div>

            <p class="text-lg text-neutral-200 mb-6 leading-relaxed">
              Clutch repairs and replacements for manual and automatic vehicles. We diagnose issues quickly and provide cost-effective solutions.
            </p>

            <ul class="space-y-2 text-neutral-200 mb-6">
              <li class="flex items-start gap-3">
                <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                <span>Clutch plate and bearing replacement</span>
              </li>
              <li class="flex items-start gap-3">
                <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                <span>Flywheel machining and replacement</span>
              </li>
              <li class="flex items-start gap-3">
                <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                <span>Dual-mass flywheel repairs</span>
              </li>
            </ul>

            <div class="flex flex-wrap items-center gap-4">
              <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-[#FFD700] to-yellow-500 px-6 py-3 text-base font-semibold text-black shadow-lg hover:brightness-95 transition-all duration-300">
                <Phone class="h-4 w-4" />
                <span>Phone to book</span>
              </a>
              <a href="#top" class="text-sm text-neutral-400 hover:text-[#FFD700] transition-colors">Back to top</a>
            </div>
          </div>
        </div>
      </Reveal>
    </section>

    <!-- Timing Belts -->
    <section id="timing-belts" class="mx-auto w-full max-w-7xl scroll-mt-24 px-4 py-12">
      <Reveal mode="up" :delay="240">
        <div class="group relative overflow-hidden rounded-2xl border border-neutral-800/50 bg-gradient-to-br from-neutral-900/80 to-neutral-950/80 backdrop-blur-sm hover:border-[#FFD700]/30 transition-all duration-500 hover:scale-[1.02]">
          <!-- Background Image -->
          <div class="absolute inset-0 opacity-30">
            <img src="https://images.pexels.com/photos/163100/circuit-circuit-board-resistor-computer-163100.jpeg" alt="Engine timing belt" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-br from-[#FFD700]/10 to-transparent"></div>
          </div>

          <div class="relative z-10 p-8">
            <div class="flex items-center gap-4 mb-6">
              <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-[#FFD700]/20 to-amber-500/10 flex items-center justify-center border border-[#FFD700]/20">
                <Wrench class="h-8 w-8 text-[#FFD700]" />
              </div>
              <div>
                <h2 class="text-3xl font-bold text-white">Timing Belts</h2>
                <p class="text-neutral-300 text-sm">Critical engine maintenance</p>
              </div>
            </div>

            <p class="text-lg text-neutral-200 mb-6 leading-relaxed">
              Timing belt and chain replacement. Essential maintenance to prevent engine damage — we follow manufacturer schedules and use quality parts.
            </p>

            <ul class="space-y-2 text-neutral-200 mb-6">
              <li class="flex items-start gap-3">
                <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                <span>Timing belt and water pump kits</span>
              </li>
              <li class="flex items-start gap-3">
                <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                <span>Timing chain replacement</span>
              </li>
              <li class="flex items-start gap-3">
                <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                <span>Engine mount replacement</span>
              </li>
            </ul>

            <div class="flex flex-wrap items-center gap-4">
              <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-[#FFD700] to-yellow-500 px-6 py-3 text-base font-semibold text-black shadow-lg hover:brightness-95 transition-all duration-300">
                <Phone class="h-4 w-4" />
                <span>Phone to book</span>
              </a>
              <a href="#top" class="text-sm text-neutral-400 hover:text-[#FFD700] transition-colors">Back to top</a>
            </div>
          </div>
        </div>
      </Reveal>
    </section>

    <!-- Springs & Suspension -->
    <section id="suspension" class="mx-auto w-full max-w-7xl scroll-mt-24 px-4 py-12">
      <Reveal mode="up" :delay="260">
        <div class="group relative overflow-hidden rounded-2xl border border-neutral-800/50 bg-gradient-to-br from-neutral-900/80 to-neutral-950/80 backdrop-blur-sm hover:border-[#FFD700]/30 transition-all duration-500 hover:scale-[1.02]">
          <!-- Background Image -->
          <div class="absolute inset-0 opacity-30">
            <img src="https://images.pexels.com/photos/8478265/pexels-photo-8478265.jpeg" alt="Suspension repair" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-br from-[#FFD700]/10 to-transparent"></div>
          </div>

          <div class="relative z-10 p-8">
            <div class="flex items-center gap-4 mb-6">
              <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-[#FFD700]/20 to-amber-500/10 flex items-center justify-center border border-[#FFD700]/20">
                <Wrench class="h-8 w-8 text-[#FFD700]" />
              </div>
              <div>
                <h2 class="text-3xl font-bold text-white">Springs & Suspension</h2>
                <p class="text-neutral-300 text-sm">Comfort and handling</p>
              </div>
            </div>

            <p class="text-lg text-neutral-200 mb-6 leading-relaxed">
              Suspension repairs, shock absorbers, and springs. We restore your vehicle's ride quality and handling characteristics.
            </p>

            <ul class="space-y-2 text-neutral-200 mb-6">
              <li class="flex items-start gap-3">
                <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                <span>Shock absorber replacement</span>
              </li>
              <li class="flex items-start gap-3">
                <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                <span>Spring and strut repairs</span>
              </li>
              <li class="flex items-start gap-3">
                <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                <span>Suspension arm and bush replacement</span>
              </li>
            </ul>

            <div class="flex flex-wrap items-center gap-4">
              <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-[#FFD700] to-yellow-500 px-6 py-3 text-base font-semibold text-black shadow-lg hover:brightness-95 transition-all duration-300">
                <Phone class="h-4 w-4" />
                <span>Phone to book</span>
              </a>
              <a href="#top" class="text-sm text-neutral-400 hover:text-[#FFD700] transition-colors">Back to top</a>
            </div>
          </div>
        </div>
      </Reveal>
    </section>

    <!-- Wheel Bearings -->
    <section id="wheel-bearings" class="mx-auto w-full max-w-7xl scroll-mt-24 px-4 py-12">
      <Reveal mode="up" :delay="280">
        <div class="group relative overflow-hidden rounded-2xl border border-neutral-800/50 bg-gradient-to-br from-neutral-900/80 to-neutral-950/80 backdrop-blur-sm hover:border-[#FFD700]/30 transition-all duration-500 hover:scale-[1.02]">
          <!-- Background Image -->
          <div class="absolute inset-0 opacity-30">
            <img src="https://images.pexels.com/photos/3806249/pexels-photo-3806249.jpeg" alt="Wheel bearing repair" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-br from-[#FFD700]/10 to-transparent"></div>
          </div>

          <div class="relative z-10 p-8">
            <div class="flex items-center gap-4 mb-6">
              <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-[#FFD700]/20 to-amber-500/10 flex items-center justify-center border border-[#FFD700]/20">
                <Wrench class="h-8 w-8 text-[#FFD700]" />
              </div>
              <div>
                <h2 class="text-3xl font-bold text-white">Wheel Bearings</h2>
                <p class="text-neutral-300 text-sm">Smooth and quiet operation</p>
              </div>
            </div>

            <p class="text-lg text-neutral-200 mb-6 leading-relaxed">
              Wheel bearing replacement and hub repairs. We fix noisy bearings and restore smooth, quiet wheel operation.
            </p>

            <ul class="space-y-2 text-neutral-200 mb-6">
              <li class="flex items-start gap-3">
                <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                <span>Front and rear wheel bearing replacement</span>
              </li>
              <li class="flex items-start gap-3">
                <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                <span>Hub assembly repairs</span>
              </li>
              <li class="flex items-start gap-3">
                <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                <span>ABS sensor and wheel speed sensor work</span>
              </li>
            </ul>

            <div class="flex flex-wrap items-center gap-4">
              <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-[#FFD700] to-yellow-500 px-6 py-3 text-base font-semibold text-black shadow-lg hover:brightness-95 transition-all duration-300">
                <Phone class="h-4 w-4" />
                <span>Phone to book</span>
              </a>
              <a href="#top" class="text-sm text-neutral-400 hover:text-[#FFD700] transition-colors">Back to top</a>
            </div>
          </div>
        </div>
      </Reveal>
    </section>

    <!-- Remapping & Keys -->
    <section id="remapping-keys" class="mx-auto w-full max-w-7xl scroll-mt-24 px-4 py-12">
      <Reveal mode="up" :delay="300">
        <div class="group relative overflow-hidden rounded-2xl border border-neutral-800/50 bg-gradient-to-br from-neutral-900/80 to-neutral-950/80 backdrop-blur-sm hover:border-[#FFD700]/30 transition-all duration-500 hover:scale-[1.02]">
          <!-- Background Image -->
          <div class="absolute inset-0 opacity-30">
            <img src="https://images.pexels.com/photos/163100/circuit-circuit-board-resistor-computer-163100.jpeg" alt="ECU remapping and key programming" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-br from-[#FFD700]/10 to-transparent"></div>
          </div>

          <div class="relative z-10 p-8">
            <div class="flex items-center gap-4 mb-6">
              <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-[#FFD700]/20 to-amber-500/10 flex items-center justify-center border border-[#FFD700]/20">
                <Gauge class="h-8 w-8 text-[#FFD700]" />
              </div>
              <div>
                <h2 class="text-3xl font-bold text-white">Remapping & Keys</h2>
                <p class="text-neutral-300 text-sm">Performance and security</p>
              </div>
            </div>

            <p class="text-lg text-neutral-200 mb-6 leading-relaxed">
              ECU remapping, key programming, and immobiliser work. Partnered with <strong>Rae's Remapping & Automotive Key Solutions</strong> for specialist services.
            </p>

            <ul class="space-y-2 text-neutral-200 mb-6">
              <li class="flex items-start gap-3">
                <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                <span>ECU remapping for performance</span>
              </li>
              <li class="flex items-start gap-3">
                <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                <span>DPF, EGR, and AdBlue solutions</span>
              </li>
              <li class="flex items-start gap-3">
                <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                <span>Key programming and replacement</span>
              </li>
            </ul>

            <div class="flex flex-wrap items-center gap-4">
              <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-[#FFD700] to-yellow-500 px-6 py-3 text-base font-semibold text-black shadow-lg hover:brightness-95 transition-all duration-300">
                <Phone class="h-4 w-4" />
                <span>Phone to book</span>
              </a>
              <a href="#top" class="text-sm text-neutral-400 hover:text-[#FFD700] transition-colors">Back to top</a>
            </div>
          </div>
        </div>
      </Reveal>
    </section>

    <!-- Emergency Assistance -->
    <section id="emergency" class="mx-auto w-full max-w-7xl scroll-mt-24 px-4 py-12">
      <Reveal mode="up" :delay="320">
        <div class="group relative overflow-hidden rounded-2xl border border-neutral-800/50 bg-gradient-to-br from-neutral-900/80 to-neutral-950/80 backdrop-blur-sm hover:border-[#FFD700]/30 transition-all duration-500 hover:scale-[1.02]">
          <!-- Background Image -->
          <div class="absolute inset-0 opacity-30">
            <img src="https://images.pexels.com/photos/1409999/pexels-photo-1409999.jpeg" alt="Emergency roadside assistance" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-br from-[#FFD700]/10 to-transparent"></div>
          </div>

          <div class="relative z-10 p-8">
            <div class="flex items-center gap-4 mb-6">
              <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-[#FFD700]/20 to-amber-500/10 flex items-center justify-center border border-[#FFD700]/20">
                <Hammer class="h-8 w-8 text-[#FFD700]" />
              </div>
              <div>
                <h2 class="text-3xl font-bold text-white">Emergency Assistance</h2>
                <p class="text-neutral-300 text-sm">24/7 roadside support</p>
              </div>
            </div>

            <p class="text-lg text-neutral-200 mb-6 leading-relaxed">
              Emergency roadside repairs and recovery. Call for availability — we provide fast response for breakdowns and urgent repairs.
            </p>

            <ul class="space-y-2 text-neutral-200 mb-6">
              <li class="flex items-start gap-3">
                <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                <span>Roadside breakdown assistance</span>
              </li>
              <li class="flex items-start gap-3">
                <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                <span>Emergency repairs on location</span>
              </li>
              <li class="flex items-start gap-3">
                <div class="w-2 h-2 rounded-full bg-[#FFD700] mt-2 flex-shrink-0"></div>
                <span>Recovery and towing services</span>
              </li>
            </ul>

            <div class="flex flex-wrap items-center gap-4">
              <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-[#FFD700] to-yellow-500 px-6 py-3 text-base font-semibold text-black shadow-lg hover:brightness-95 transition-all duration-300">
                <Phone class="h-4 w-4" />
                <span>Call {{ phone }}</span>
              </a>
              <a href="#top" class="text-sm text-neutral-400 hover:text-[#FFD700] transition-colors">Back to top</a>
            </div>
          </div>
        </div>
      </Reveal>
    </section>
</PublicLayout>
</template>
