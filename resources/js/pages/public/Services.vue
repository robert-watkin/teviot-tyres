<script setup lang="ts">
import PublicLayout from '@/layouts/public/PublicLayout.vue';
import { Link } from '@inertiajs/vue3';
import { CheckCircle2, Wrench, Gauge, Battery, Hammer, CreditCard } from 'lucide-vue-next';
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
  const ids = ['tyres', 'mot-class-4-7', 'mot-prep', 'servicing', 'diagnostics', 'battery', 'payment-assist'];
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
            <a href="#tyres" :class="['snap-start rounded-full border px-3 py-1.5 hover:bg-neutral-900 flex items-center gap-2', isActive('tyres') ? 'bg-neutral-900 text-[#FFD700] border-neutral-700' : 'text-neutral-300 border-neutral-800']"><Wrench class="h-4 w-4" /><span>Tyres</span></a>
            <a href="#mot-class-4-7" :class="['snap-start rounded-full border px-3 py-1.5 hover:bg-neutral-900 flex items-center gap-2', isActive('mot-class-4-7') ? 'bg-neutral-900 text-accent-blue border-neutral-700' : 'text-neutral-300 border-neutral-800']"><CheckCircle2 class="h-4 w-4" /><span>Class 4 & 7 MOTs</span></a>
            <a href="#mot-prep" :class="['snap-start rounded-full border px-3 py-1.5 hover:bg-neutral-900 flex items-center gap-2', isActive('mot-prep') ? 'bg-neutral-900 text-accent-orange border-neutral-700' : 'text-neutral-300 border-neutral-800']"><Hammer class="h-4 w-4" /><span>MOT Preparation</span></a>
            <a href="#servicing" :class="['snap-start rounded-full border px-3 py-1.5 hover:bg-neutral-900 flex items-center gap-2', isActive('servicing') ? 'bg-neutral-900 text-accent-violet border-neutral-700' : 'text-neutral-300 border-neutral-800']"><Wrench class="h-4 w-4" /><span>Servicing</span></a>
            <a href="#diagnostics" :class="['snap-start rounded-full border px-3 py-1.5 hover:bg-neutral-900 flex items-center gap-2', isActive('diagnostics') ? 'bg-neutral-900 text-accent-emerald border-neutral-700' : 'text-neutral-300 border-neutral-800']"><Gauge class="h-4 w-4" /><span>Diagnostics</span></a>
            <a href="#battery" :class="['snap-start rounded-full border px-3 py-1.5 hover:bg-neutral-900 flex items-center gap-2', isActive('battery') ? 'bg-neutral-900 text-accent-rose border-neutral-700' : 'text-neutral-300 border-neutral-800']"><Battery class="h-4 w-4" /><span>Battery</span></a>
            <a href="#payment-assist" :class="['snap-start rounded-full border px-3 py-1.5 hover:bg-neutral-900 flex items-center gap-2', isActive('payment-assist') ? 'bg-neutral-900 text-accent-yellow border-neutral-700' : 'text-neutral-300 border-neutral-800']"><CreditCard class="h-4 w-4" /><span>Payment Assist</span></a>
          </nav>
        </div>
      </Reveal>

      <div class="mt-6 rounded-lg border border-neutral-800 bg-neutral-950 p-4 text-sm text-neutral-300">
        <span class="mr-2 rounded bg-[#FFD700] px-2 py-0.5 text-xs font-semibold text-black">Seasonal</span>
        FREE Winter Check — book now to stay safe on the road.
      </div>
    </section>

    <!-- Tyres -->
    <section id="tyres" class="mx-auto w-full max-w-7xl scroll-mt-24 px-4 py-12">
      <Reveal mode="up">
        <div class="overflow-hidden rounded-xl border border-neutral-800 bg-neutral-950 shadow transition hover:shadow-lg hover:shadow-black/20">
          <div class="h-28 w-full bg-cover bg-center" style="background-image:url('https://images.unsplash.com/photo-1515923162045-7b3b3f9ae1ae?q=80&w=1200&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')"></div>
          <div class="p-6">
          <div class="flex items-center gap-3 text-[#FFD700]"><Wrench class="h-5 w-5" /><h2 class="text-2xl font-semibold">Tyres</h2></div>
          <p class="mt-2 text-neutral-300">Budget, mid-range, and premium tyres. Fitted and balanced. Includes FREE Tyre Check. Bring your reg or size; we’ll advise the best option for your vehicle and budget.</p>
          <div class="mt-4 flex flex-wrap items-center gap-3">
            <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="rounded-md bg-[#FFD700] px-4 py-2 text-sm font-semibold text-black hover:brightness-95">Phone to book</a>
            <Link href="/reg-lookup" class="text-sm text-[#FFD700] hover:underline">Use Reg Lookup</Link>
            <a href="#top" class="text-sm text-neutral-400 hover:underline">Back to top</a>
          </div>
          </div>
        </div>
      </Reveal>
    </section>

    <!-- Class 4 & 7 MOTs -->
    <section id="mot-class-4-7" class="mx-auto w-full max-w-7xl scroll-mt-24 px-4 py-12">
      <Reveal mode="up" :delay="60">
        <div class="overflow-hidden rounded-xl border border-neutral-800 bg-neutral-950 shadow transition hover:shadow-lg hover:shadow-black/20">
          <div class="h-28 w-full bg-cover bg-center" style="background-image:url('https://images.unsplash.com/photo-1517170652703-225d4bd1b699?q=80&w=1200&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')"></div>
          <div class="p-6">
          <div class="flex items-center gap-3 text-[#38bdf8]"><CheckCircle2 class="h-5 w-5" /><h2 class="text-2xl font-semibold">Class 4 & 7 MOTs</h2></div>
          <p class="mt-2 text-neutral-300">DVSA‑approved testing with quick results. We’ll keep you informed and advise on any advisories or failures with clear next steps.</p>
          <div class="mt-4 flex flex-wrap items-center gap-3">
            <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="rounded-md bg-[#38bdf8] px-4 py-2 text-sm font-semibold text-black hover:brightness-95">Phone to book</a>
            <a href="#top" class="text-sm text-neutral-400 hover:underline">Back to top</a>
          </div>
          </div>
        </div>
      </Reveal>
    </section>

    <!-- MOT Preparation -->
    <section id="mot-prep" class="mx-auto w-full max-w-7xl scroll-mt-24 px-4 py-12">
      <Reveal mode="up" :delay="80">
        <div class="overflow-hidden rounded-xl border border-neutral-800 bg-neutral-950 shadow transition hover:shadow-lg hover:shadow-black/20">
          <div class="h-28 w-full bg-cover bg-center" style="background-image:url('https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=1200&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')"></div>
          <div class="p-6">
          <div class="flex items-center gap-3 text-[#f97316]"><Hammer class="h-5 w-5" /><h2 class="text-2xl font-semibold">MOT Preparation</h2></div>
          <p class="mt-2 text-neutral-300">Pre‑checks to help you avoid failures. We’ll identify likely issues ahead of time and fix them quickly where needed.</p>
          <div class="mt-4 flex flex-wrap items-center gap-3">
            <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="rounded-md bg-[#f97316] px-4 py-2 text-sm font-semibold text-black hover:brightness-95">Phone to book</a>
            <a href="#top" class="text-sm text-neutral-400 hover:underline">Back to top</a>
          </div>
          </div>
        </div>
      </Reveal>
    </section>

    <!-- Servicing -->
    <section id="servicing" class="mx-auto w-full max-w-7xl scroll-mt-24 px-4 py-12">
      <Reveal mode="up" :delay="100">
        <div class="overflow-hidden rounded-xl border border-neutral-800 bg-neutral-950 shadow transition hover:shadow-lg hover:shadow-black/20">
          <div class="h-28 w-full bg-cover bg-center" style="background-image:url('https://images.unsplash.com/photo-1517167685280-1456c9b3c1f5?q=80&w=1200&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')"></div>
          <div class="p-6">
          <div class="flex items-center gap-3 text-[#a78bfa]"><Wrench class="h-5 w-5" /><h2 class="text-2xl font-semibold">Servicing</h2></div>
          <p class="mt-2 text-neutral-300">General maintenance for all vehicles. Oil and filters, fluids, safety inspections, and more — keeping you running smoothly.</p>
          <div class="mt-4 flex flex-wrap items-center gap-3">
            <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="rounded-md bg-[#a78bfa] px-4 py-2 text-sm font-semibold text-black hover:brightness-95">Phone to book</a>
            <a href="#top" class="text-sm text-neutral-400 hover:underline">Back to top</a>
          </div>
          </div>
        </div>
      </Reveal>
    </section>

    <!-- Diagnostics -->
    <section id="diagnostics" class="mx-auto w-full max-w-7xl scroll-mt-24 px-4 py-12">
      <Reveal mode="up" :delay="120">
        <div class="overflow-hidden rounded-xl border border-neutral-800 bg-neutral-950 shadow transition hover:shadow-lg hover:shadow-black/20">
          <div class="h-28 w-full bg-cover bg-center" style="background-image:url('https://images.unsplash.com/photo-1525609004556-c46c7d6cf023?q=80&w=1200&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')"></div>
          <div class="p-6">
          <div class="flex items-center gap-3 text-[#34d399]"><Gauge class="h-5 w-5" /><h2 class="text-2xl font-semibold">Diagnostics</h2></div>
          <p class="mt-2 text-neutral-300">Modern diagnostic tools to quickly identify faults and get you back on the road with confidence.</p>
          <div class="mt-4 flex flex-wrap items-center gap-3">
            <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="rounded-md bg-[#34d399] px-4 py-2 text-sm font-semibold text-black hover:brightness-95">Phone to book</a>
            <a href="#top" class="text-sm text-neutral-400 hover:underline">Back to top</a>
          </div>
          </div>
        </div>
      </Reveal>
    </section>

    <!-- Battery Replacement -->
    <section id="battery" class="mx-auto w-full max-w-7xl scroll-mt-24 px-4 py-12">
      <Reveal mode="up" :delay="140">
        <div class="overflow-hidden rounded-xl border border-neutral-800 bg-neutral-950 shadow transition hover:shadow-lg hover:shadow-black/20">
          <div class="h-28 w-full bg-cover bg-center" style="background-image:url('https://images.unsplash.com/photo-1616803140344-5465f6e93dfd?q=80&w=1200&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')"></div>
          <div class="p-6">
          <div class="flex items-center gap-3 text-[#f43f5e]"><Battery class="h-5 w-5" /><h2 class="text-2xl font-semibold">Battery Replacement</h2></div>
          <p class="mt-2 text-neutral-300">Battery testing and replacement while you wait. We’ll supply and fit the right battery for your vehicle.</p>
          <div class="mt-4 flex flex-wrap items-center gap-3">
            <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="rounded-md bg-[#f43f5e] px-4 py-2 text-sm font-semibold text-black hover:brightness-95">Phone to book</a>
            <a href="#top" class="text-sm text-neutral-400 hover:underline">Back to top</a>
          </div>
          </div>
        </div>
      </Reveal>
    </section>

    <!-- Payment Assist -->
    <section id="payment-assist" class="mx-auto w-full max-w-7xl scroll-mt-24 px-4 py-12">
      <Reveal mode="up" :delay="160">
        <div class="overflow-hidden rounded-xl border border-neutral-800 bg-neutral-950 shadow transition hover:shadow-lg hover:shadow-black/20">
          <div class="flex items-center gap-3 text-[#FFD700]"><CreditCard class="h-5 w-5" /><h2 class="text-2xl font-semibold">Payment Assist</h2></div>
          <p class="mt-2 text-neutral-300">Spread the cost easily with finance options — no deposit, low monthly payments, subject to status. Ask our team for details.</p>
          <ol class="mt-4 grid grid-cols-1 gap-4 text-sm text-neutral-300 md:grid-cols-3">
            <li><span class="font-semibold text-white">1) Quote</span><p>Get your service cost.</p></li>
            <li><span class="font-semibold text-white">2) Approval</span><p>Fast eligibility check.</p></li>
            <li><span class="font-semibold text-white">3) Payments</span><p>Split over 3–12 months.</p></li>
          </ol>
          <div class="mt-4 flex flex-wrap items-center gap-3">
            <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="rounded-md bg-[#FFD700] px-4 py-2 text-sm font-semibold text-black hover:brightness-95">Phone to book</a>
            <a href="#top" class="text-sm text-neutral-400 hover:underline">Back to top</a>
          </div>
        </div>
      </Reveal>
    </section>
  </PublicLayout>
</template>
