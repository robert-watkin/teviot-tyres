<script setup lang="ts">
import PublicLayout from '@/layouts/public/PublicLayout.vue';
import { Link } from '@inertiajs/vue3';
import { CheckCircle, Tools, DashboardSpeed, Shield, Settings, CreditCard, Phone } from '@iconoir/vue';
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
  const ids = ['tyres', 'mot-class-4', 'mot-prep', 'servicing', 'diagnostics', 'battery', 'payment-assist'];
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
      <!-- Sticky section nav -->
      <Reveal mode="fade" :delay="80">
        <div class="sticky top-16 z-30 mt-6 -mx-4 border-b border-neutral-900/60 bg-neutral-950/75 px-4 py-3 backdrop-blur supports-[backdrop-filter]:bg-neutral-950/50 md:top-16">
          <nav aria-label="Services sections" class="no-scrollbar flex w-full snap-x items-center gap-2 overflow-x-auto text-sm [scrollbar-width:none]">
            <a href="#tyres" :class="['snap-start rounded-full border px-3 py-1.5 hover:bg-neutral-900 flex items-center gap-2', isActive('tyres') ? 'bg-neutral-900 text-[#FFD700] border-neutral-700' : 'text-neutral-300 border-neutral-800']"><Tools class="h-4 w-4" /><span>Tyres</span></a>
            <a href="#mot-class-4" :class="['snap-start rounded-full border px-3 py-1.5 hover:bg-neutral-900 flex items-center gap-2', isActive('mot-class-4') ? 'bg-neutral-900 text-[#FFD700] border-neutral-700' : 'text-neutral-300 border-neutral-800']"><CheckCircle class="h-4 w-4" /><span>Class 4 MOTs</span></a>
            <a href="#mot-prep" :class="['snap-start rounded-full border px-3 py-1.5 hover:bg-neutral-900 flex items-center gap-2', isActive('mot-prep') ? 'bg-neutral-900 text-[#FFD700] border-neutral-700' : 'text-neutral-300 border-neutral-800']"><CheckCircle class="h-4 w-4" /><span>MOT Preparation</span></a>
            <a href="#servicing" :class="['snap-start rounded-full border px-3 py-1.5 hover:bg-neutral-900 flex items-center gap-2', isActive('servicing') ? 'bg-neutral-900 text-[#FFD700] border-neutral-700' : 'text-neutral-300 border-neutral-800']"><Settings class="h-4 w-4" /><span>Servicing</span></a>
            <a href="#diagnostics" :class="['snap-start rounded-full border px-3 py-1.5 hover:bg-neutral-900 flex items-center gap-2', isActive('diagnostics') ? 'bg-neutral-900 text-[#FFD700] border-neutral-700' : 'text-neutral-300 border-neutral-800']"><DashboardSpeed class="h-4 w-4" /><span>Diagnostics</span></a>
            <a href="#battery" :class="['snap-start rounded-full border px-3 py-1.5 hover:bg-neutral-900 flex items-center gap-2', isActive('battery') ? 'bg-neutral-900 text-[#FFD700] border-neutral-700' : 'text-neutral-300 border-neutral-800']"><Shield class="h-4 w-4" /><span>Battery</span></a>
            <a href="#payment-assist" :class="['snap-start rounded-full border px-3 py-1.5 hover:bg-neutral-900 flex items-center gap-2', isActive('payment-assist') ? 'bg-neutral-900 text-[#FFD700] border-neutral-700' : 'text-neutral-300 border-neutral-800']"><CreditCard class="h-4 w-4" /><span>Payment Assist</span></a>
          </nav>
        </div>
      </Reveal>

      <div class="mt-6 rounded-lg border border-neutral-800 bg-neutral-950 p-4 text-sm text-neutral-300">
        <span class="mr-2 rounded bg-[#FFD700] px-2 py-0.5 text-xs font-semibold text-black">Seasonal</span>
        FREE Winter Check — book now to stay safe on the road.
      </div>
    </section>

    <!-- Tyres - Featured Service -->
    <section id="tyres" class="mx-auto w-full max-w-7xl scroll-mt-24 px-4 py-8">
      <Reveal mode="up">
        <div class="group relative overflow-hidden rounded-2xl border-2 border-[#FFD700]/30 bg-gradient-to-br from-neutral-900 to-neutral-950 shadow-xl transition-all duration-500 hover:border-[#FFD700]/60 hover:shadow-2xl hover:shadow-[#FFD700]/10 hover:scale-[1.02]">
          <!-- Featured Badge -->
          <div class="absolute top-4 right-4 z-10 rounded-full bg-[#FFD700] px-3 py-1 text-xs font-bold text-black shadow-lg">
            MOST POPULAR
          </div>
          
          <!-- Hero Image with Gradient Overlay -->
          <div class="relative h-64 w-full overflow-hidden">
            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-110" style="background-image:url('https://images.pexels.com/photos/3806249/pexels-photo-3806249.jpeg?auto=compress&cs=tinysrgb&w=1200')"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-neutral-950 via-neutral-950/60 to-transparent"></div>
          </div>
          
          <div class="relative -mt-20 p-8">
            <div class="mb-4 inline-flex items-center gap-3 rounded-xl bg-[#FFD700]/20 px-4 py-2 backdrop-blur-sm border border-[#FFD700]/30">
              <Tools class="h-6 w-6 text-[#FFD700]" />
              <h2 class="text-3xl font-bold text-white">Tyres</h2>
            </div>
            
            <p class="mt-4 text-lg text-neutral-200 max-w-3xl">
              Budget, mid-range, and premium tyres. Professional fitting and balancing with a <span class="font-semibold text-[#FFD700]">FREE Tyre Safety Check</span>. Same-day service available.
            </p>
            
            <!-- Key Features Grid -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
              <div class="flex items-start gap-3 rounded-lg bg-neutral-900/50 p-4 border border-neutral-800">
                <CheckCircle class="h-5 w-5 text-[#FFD700] flex-shrink-0 mt-0.5" />
                <div>
                  <div class="font-semibold text-white text-sm">Same-Day Fitting</div>
                  <div class="text-xs text-neutral-400">Most sizes in stock</div>
                </div>
              </div>
              <div class="flex items-start gap-3 rounded-lg bg-neutral-900/50 p-4 border border-neutral-800">
                <CheckCircle class="h-5 w-5 text-[#FFD700] flex-shrink-0 mt-0.5" />
                <div>
                  <div class="font-semibold text-white text-sm">Free Safety Check</div>
                  <div class="text-xs text-neutral-400">Ask in store</div>
                </div>
              </div>
              <div class="flex items-start gap-3 rounded-lg bg-neutral-900/50 p-4 border border-neutral-800">
                <CheckCircle class="h-5 w-5 text-[#FFD700] flex-shrink-0 mt-0.5" />
                <div>
                  <div class="font-semibold text-white text-sm">All Budgets</div>
                  <div class="text-xs text-neutral-400">Budget to premium</div>
                </div>
              </div>
            </div>
            
            <div class="mt-6 flex flex-wrap items-center gap-3">
              <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="inline-flex items-center gap-2 rounded-lg bg-[#FFD700] px-6 py-3 text-base font-bold text-black shadow-lg hover:brightness-95 transition-all hover:scale-105">
                <Phone class="h-5 w-5" />
                <span>Call {{ phone }}</span>
              </a>
              <Link href="/reg-lookup" class="inline-flex items-center gap-2 rounded-lg border-2 border-[#FFD700]/50 bg-neutral-900/50 px-6 py-3 text-base font-semibold text-[#FFD700] backdrop-blur hover:bg-[#FFD700]/10 transition-all">
                <span>Use Reg Lookup</span>
              </Link>
            </div>
          </div>
        </div>
      </Reveal>
    </section>

    <!-- MOT Services Grid -->
    <section class="mx-auto w-full max-w-7xl px-4 py-8">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Class 4 MOTs -->
        <Reveal mode="up" :delay="60">
          <div id="mot-class-4" class="scroll-mt-24 group overflow-hidden rounded-xl border border-neutral-800 bg-neutral-950 shadow-lg transition-all duration-300 hover:border-[#FFD700]/40 hover:shadow-xl hover:shadow-black/30 hover:scale-[1.02]">
            <div class="relative h-48 w-full overflow-hidden">
              <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110" style="background-image:url('https://images.pexels.com/photos/3894030/pexels-photo-3894030.jpeg?auto=compress&cs=tinysrgb&w=1200')"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-neutral-950 via-neutral-950/40 to-transparent"></div>
              <div class="absolute top-3 right-3 rounded-full bg-[#FFD700]/90 px-2.5 py-1 text-xs font-bold text-black backdrop-blur">
                DVSA APPROVED
              </div>
            </div>
            <div class="p-6">
              <div class="flex items-center gap-3 text-[#FFD700]">
                <CheckCircle class="h-6 w-6" />
                <h2 class="text-2xl font-bold">Class 4 MOTs</h2>
              </div>
              <p class="mt-3 text-neutral-300">DVSA‑approved testing with quick results. We'll keep you informed and advise on any advisories or failures with clear next steps.</p>
              <div class="mt-4 flex flex-wrap items-center gap-3">
                <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="inline-flex items-center gap-2 rounded-lg bg-[#FFD700] px-4 py-2.5 text-sm font-semibold text-black hover:brightness-95 transition-all hover:scale-105">
                  <Phone class="h-4 w-4" />
                  <span>Call {{ phone }}</span>
                </a>
              </div>
            </div>
          </div>
        </Reveal>

        <!-- MOT Preparation -->
        <Reveal mode="up" :delay="80">
          <div id="mot-prep" class="scroll-mt-24 group overflow-hidden rounded-xl border border-neutral-800 bg-neutral-950 shadow-lg transition-all duration-300 hover:border-[#FFD700]/40 hover:shadow-xl hover:shadow-black/30 hover:scale-[1.02]">
            <div class="relative h-48 w-full overflow-hidden">
              <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110" style="background-image:url('https://images.pexels.com/photos/13065690/pexels-photo-13065690.jpeg?auto=compress&cs=tinysrgb&w=1200')"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-neutral-950 via-neutral-950/40 to-transparent"></div>
            </div>
            <div class="p-6">
              <div class="flex items-center gap-3 text-[#FFD700]">
                <CheckCircle class="h-6 w-6" />
                <h2 class="text-2xl font-bold">MOT Preparation</h2>
              </div>
              <p class="mt-3 text-neutral-300">Pre‑checks to help you avoid failures. We'll identify likely issues ahead of time and fix them quickly where needed.</p>
              <div class="mt-4 flex flex-wrap items-center gap-3">
                <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="inline-flex items-center gap-2 rounded-lg bg-[#FFD700] px-4 py-2.5 text-sm font-semibold text-black hover:brightness-95 transition-all hover:scale-105">
                  <Phone class="h-4 w-4" />
                  <span>Call {{ phone }}</span>
                </a>
              </div>
            </div>
          </div>
        </Reveal>
      </div>
    </section>

    <!-- Servicing - Image Left -->
    <section id="servicing" class="mx-auto w-full max-w-7xl scroll-mt-24 px-4 py-8">
      <Reveal mode="up" :delay="100">
        <div class="group overflow-hidden rounded-xl border border-neutral-800 bg-neutral-950 shadow-lg transition-all duration-300 hover:border-[#FFD700]/40 hover:shadow-xl hover:shadow-black/30">
          <div class="grid grid-cols-1 md:grid-cols-2">
            <div class="relative h-64 md:h-auto overflow-hidden">
              <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110" style="background-image:url('https://images.pexels.com/photos/4489731/pexels-photo-4489731.jpeg?auto=compress&cs=tinysrgb&w=1200')"></div>
              <div class="absolute inset-0 bg-gradient-to-r from-transparent to-neutral-950/60"></div>
            </div>
            <div class="p-8 flex flex-col justify-center">
              <div class="flex items-center gap-3 text-[#FFD700]">
                <Settings class="h-6 w-6" />
                <h2 class="text-2xl font-bold">Servicing</h2>
              </div>
              <p class="mt-4 text-neutral-300">General maintenance for all vehicles. Oil and filters, fluids, safety inspections, and more — keeping you running smoothly.</p>
              <ul class="mt-4 space-y-2 text-sm text-neutral-400">
                <li class="flex items-center gap-2"><CheckCircle class="h-4 w-4 text-[#FFD700]" /> Oil & filter changes</li>
                <li class="flex items-center gap-2"><CheckCircle class="h-4 w-4 text-[#FFD700]" /> Fluid top-ups</li>
                <li class="flex items-center gap-2"><CheckCircle class="h-4 w-4 text-[#FFD700]" /> Safety inspections</li>
              </ul>
              <div class="mt-6">
                <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="inline-flex items-center gap-2 rounded-lg bg-[#FFD700] px-5 py-2.5 text-sm font-semibold text-black hover:brightness-95 transition-all hover:scale-105">
                  <Phone class="h-4 w-4" />
                  <span>Call {{ phone }}</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </Reveal>
    </section>

    <!-- Diagnostics - Image Right -->
    <section id="diagnostics" class="mx-auto w-full max-w-7xl scroll-mt-24 px-4 py-8">
      <Reveal mode="up" :delay="120">
        <div class="group overflow-hidden rounded-xl border border-neutral-800 bg-neutral-950 shadow-lg transition-all duration-300 hover:border-[#FFD700]/40 hover:shadow-xl hover:shadow-black/30">
          <div class="grid grid-cols-1 md:grid-cols-2">
            <div class="p-8 flex flex-col justify-center order-2 md:order-1">
              <div class="flex items-center gap-3 text-[#FFD700]">
                <DashboardSpeed class="h-6 w-6" />
                <h2 class="text-2xl font-bold">Diagnostics</h2>
              </div>
              <p class="mt-4 text-neutral-300">Modern diagnostic tools to quickly identify faults and get you back on the road with confidence.</p>
              <ul class="mt-4 space-y-2 text-sm text-neutral-400">
                <li class="flex items-center gap-2"><CheckCircle class="h-4 w-4 text-[#FFD700]" /> Engine diagnostics</li>
                <li class="flex items-center gap-2"><CheckCircle class="h-4 w-4 text-[#FFD700]" /> Fault code reading</li>
                <li class="flex items-center gap-2"><CheckCircle class="h-4 w-4 text-[#FFD700]" /> Electronic systems</li>
              </ul>
              <div class="mt-6">
                <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="inline-flex items-center gap-2 rounded-lg bg-[#FFD700] px-5 py-2.5 text-sm font-semibold text-black hover:brightness-95 transition-all hover:scale-105">
                  <Phone class="h-4 w-4" />
                  <span>Call {{ phone }}</span>
                </a>
              </div>
            </div>
            <div class="relative h-64 md:h-auto overflow-hidden order-1 md:order-2">
              <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110" style="background-image:url('https://images.pexels.com/photos/8478265/pexels-photo-8478265.jpeg?auto=compress&cs=tinysrgb&w=1200')"></div>
              <div class="absolute inset-0 bg-gradient-to-l from-transparent to-neutral-950/60"></div>
            </div>
          </div>
        </div>
      </Reveal>
    </section>

    <!-- Battery Replacement - Image Left -->
    <section id="battery" class="mx-auto w-full max-w-7xl scroll-mt-24 px-4 py-8">
      <Reveal mode="up" :delay="140">
        <div class="group overflow-hidden rounded-xl border border-neutral-800 bg-neutral-950 shadow-lg transition-all duration-300 hover:border-[#FFD700]/40 hover:shadow-xl hover:shadow-black/30">
          <div class="grid grid-cols-1 md:grid-cols-2">
            <div class="relative h-64 md:h-auto overflow-hidden">
              <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110" style="background-image:url('https://images.pexels.com/photos/5572270/pexels-photo-5572270.jpeg?auto=compress&cs=tinysrgb&w=1200')"></div>
              <div class="absolute inset-0 bg-gradient-to-r from-transparent to-neutral-950/60"></div>
            </div>
            <div class="p-8 flex flex-col justify-center">
              <div class="flex items-center gap-3 text-[#FFD700]">
                <Shield class="h-6 w-6" />
                <h2 class="text-2xl font-bold">Battery Replacement</h2>
              </div>
              <p class="mt-4 text-neutral-300">Battery testing and replacement while you wait. We'll supply and fit the right battery for your vehicle.</p>
              <ul class="mt-4 space-y-2 text-sm text-neutral-400">
                <li class="flex items-center gap-2"><CheckCircle class="h-4 w-4 text-[#FFD700]" /> Free battery testing</li>
                <li class="flex items-center gap-2"><CheckCircle class="h-4 w-4 text-[#FFD700]" /> While-you-wait service</li>
                <li class="flex items-center gap-2"><CheckCircle class="h-4 w-4 text-[#FFD700]" /> All makes & models</li>
              </ul>
              <div class="mt-6">
                <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="inline-flex items-center gap-2 rounded-lg bg-[#FFD700] px-5 py-2.5 text-sm font-semibold text-black hover:brightness-95 transition-all hover:scale-105">
                  <Phone class="h-4 w-4" />
                  <span>Call {{ phone }}</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </Reveal>
    </section>

    <!-- Payment Assist -->
    <section id="payment-assist" class="mx-auto w-full max-w-7xl scroll-mt-24 px-4 py-8 pb-16">
      <Reveal mode="up" :delay="160">
        <div class="group overflow-hidden rounded-xl border border-neutral-800 bg-gradient-to-br from-neutral-900 to-neutral-950 shadow-lg transition-all duration-300 hover:border-[#FFD700]/40 hover:shadow-xl hover:shadow-black/30">
          <div class="p-8">
            <div class="flex items-center gap-3 text-[#FFD700]">
              <CreditCard class="h-6 w-6" />
              <h2 class="text-2xl font-bold">Payment Assist</h2>
            </div>
            <p class="mt-4 text-lg text-neutral-300">Split your repair bill into manageable monthly payments. We split the bill for you — pay an initial deposit in-branch, then make monthly payments on agreed dates.</p>
            
            <!-- Process Steps -->
            <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-5">
              <div class="relative rounded-lg border border-neutral-800 bg-neutral-900/50 p-6 text-center">
                <div class="absolute -top-4 left-1/2 -translate-x-1/2 flex h-8 w-8 items-center justify-center rounded-full bg-[#FFD700] text-sm font-bold text-black">1</div>
                <h3 class="mt-2 text-base font-semibold text-white">Total Bill</h3>
                <p class="mt-2 text-sm text-neutral-400">We provide your service cost</p>
              </div>
              <div class="relative rounded-lg border border-neutral-800 bg-neutral-900/50 p-6 text-center">
                <div class="absolute -top-4 left-1/2 -translate-x-1/2 flex h-8 w-8 items-center justify-center rounded-full bg-[#FFD700] text-sm font-bold text-black">2</div>
                <h3 class="mt-2 text-base font-semibold text-white">Deposit In-Branch</h3>
                <p class="mt-2 text-sm text-neutral-400">Pay initial deposit when collecting vehicle</p>
              </div>
              <div class="relative rounded-lg border border-neutral-800 bg-neutral-900/50 p-6 text-center">
                <div class="absolute -top-4 left-1/2 -translate-x-1/2 flex h-8 w-8 items-center justify-center rounded-full bg-[#FFD700] text-sm font-bold text-black">3</div>
                <h3 class="mt-2 text-base font-semibold text-white">Second Payment</h3>
                <p class="mt-2 text-sm text-neutral-400">Payment plan set up — pay on agreed date</p>
              </div>
              <div class="relative rounded-lg border border-neutral-800 bg-neutral-900/50 p-6 text-center">
                <div class="absolute -top-4 left-1/2 -translate-x-1/2 flex h-8 w-8 items-center justify-center rounded-full bg-[#FFD700] text-sm font-bold text-black">4</div>
                <h3 class="mt-2 text-base font-semibold text-white">Third Payment</h3>
                <p class="mt-2 text-sm text-neutral-400">Repeat — sit back and let it go out</p>
              </div>
              <div class="relative rounded-lg border border-neutral-800 bg-neutral-900/50 p-6 text-center">
                <div class="absolute -top-4 left-1/2 -translate-x-1/2 flex h-8 w-8 items-center justify-center rounded-full bg-[#FFD700] text-sm font-bold text-black">5</div>
                <h3 class="mt-2 text-base font-semibold text-white">Last Payment</h3>
                <p class="mt-2 text-sm text-neutral-400">Final payment — all complete</p>
              </div>
            </div>
            
            <div class="mt-8 rounded-lg bg-neutral-900/50 border border-neutral-800 p-4">
              <p class="text-sm text-neutral-400">
                <span class="font-semibold text-white">Example:</span> £500 bill split — we split the bill for you. Pay an initial deposit in-branch, then monthly payments on agreed dates.
              </p>
            </div>
            
            <div class="mt-8">
              <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="inline-flex items-center gap-2 rounded-lg bg-[#FFD700] px-5 py-2.5 text-sm font-semibold text-black hover:brightness-95 transition-all hover:scale-105">
                <Phone class="h-4 w-4" />
                <span>Call {{ phone }} for details</span>
              </a>
            </div>
          </div>
        </div>
      </Reveal>
    </section>
  </PublicLayout>
</template>
