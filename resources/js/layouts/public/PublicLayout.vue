<script setup lang="ts">
import AppShell from '@/components/AppShell.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed, onMounted, ref } from 'vue';
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { ArrowUp, Menu, X } from 'lucide-vue-next';
import { cn, urlIsActive } from '@/lib/utils';

interface Props {
  title?: string;
}

const props = withDefaults(defineProps<Props>(), {
  title: 'Teviot Tyres',
});

const page = usePage();
const auth = computed(() => page.props.auth);
const currentUrl = computed(() => page.url as string);
const isActive = (href: string) => urlIsActive(href, currentUrl.value);
// Brand + contact details from shared Inertia props
const site = computed(() => (page.props as any).site || {});
const phone = computed(() => site.value.phone || '01450 374875');
const email = computed(() => site.value.email || 'teviottyres@outlook.com');
const address = computed(() => site.value.address || 'Unit 10, Lochpark Industrial Estate, Hawick TD9 9JA');
const facebookUrl = computed(() => site.value.facebook || 'https://www.facebook.com');
const showToTop = ref(false);
const headerHasShadow = ref(false);
const mobileOpen = ref(false);

onMounted(() => {
  const onScroll = () => {
    const y = window.scrollY || document.documentElement.scrollTop;
    showToTop.value = y > 500;
    headerHasShadow.value = y > 8;
  };
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();
});

function backToTop() {
  if (typeof window !== 'undefined') {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }
}

</script>

<template>
  <AppShell variant="header">
    <Head :title="props.title" />

    <!-- Header -->
    <header class="fixed top-0 z-40 w-full border-b text-white transition-all duration-300" :class="headerHasShadow ? 'border-neutral-800/80 backdrop-blur supports-[backdrop-filter]:bg-black/80 shadow-[0_1px_0_0_rgba(255,255,255,0.04)]' : 'border-transparent'">
      <div class="mx-auto grid h-16 grid-cols-3 items-center px-4 md:max-w-7xl">
        <!-- Left: Logo / Mobile menu button -->
        <div class="flex items-center gap-3">
          <button class="inline-flex items-center justify-center rounded-md border p-2 text-neutral-300 hover:bg-neutral-900 md:hidden" :class="headerHasShadow ? 'border-neutral-800' : 'border-neutral-700/50'" @click="mobileOpen = true" aria-label="Open menu" :aria-expanded="mobileOpen">
            <Menu class="h-5 w-5" />
          </button>
          <Link href="/" class="flex items-center gap-2">
            <span class="flex items-center justify-center rounded-md p-1.5" :class="headerHasShadow ? 'bg-[#FFD700]/15' : 'bg-[#FFD700]/20'">
              <AppLogoIcon class="size-5 text-[#FFD700]" />
            </span>
            <span class="text-lg font-semibold tracking-tight">
              <span class="text-[#FFD700]">Teviot</span> Tyres
            </span>
          </Link>
        </div>

        <!-- Center: Nav (desktop) -->
        <nav class="pointer-events-auto hidden items-center justify-center gap-6 md:flex">
          <Link href="/services" :aria-current="isActive('/services') ? 'page' : undefined" :class="cn('text-sm transition-colors', isActive('/services') ? 'text-[#FFD700]' : 'text-neutral-300 hover:text-white', headerHasShadow ? '' : 'drop-shadow-sm')">
            Services
          </Link>
          <Link href="/reg-lookup" :aria-current="isActive('/reg-lookup') ? 'page' : undefined" :class="cn('text-sm transition-colors', isActive('/reg-lookup') ? 'text-[#FFD700]' : 'text-neutral-300 hover:text-white', headerHasShadow ? '' : 'drop-shadow-sm')">
            Reg Lookup
          </Link>
          <Link href="/contact" :aria-current="isActive('/contact') ? 'page' : undefined" :class="cn('text-sm transition-colors', isActive('/contact') ? 'text-[#FFD700]' : 'text-neutral-300 hover:text-white', headerHasShadow ? '' : 'drop-shadow-sm')">
            Contact
          </Link>
          <Link href="/terms" :aria-current="isActive('/terms') ? 'page' : undefined" :class="cn('text-sm transition-colors', isActive('/terms') ? 'text-[#FFD700]' : 'text-neutral-300 hover:text-white', headerHasShadow ? '' : 'drop-shadow-sm')">
            T&Cs
          </Link>
          <Link href="/privacy" :aria-current="isActive('/privacy') ? 'page' : undefined" :class="cn('text-sm transition-colors', isActive('/privacy') ? 'text-[#FFD700]' : 'text-neutral-300 hover:text-white', headerHasShadow ? '' : 'drop-shadow-sm')">
            Privacy
          </Link>
        </nav>

        <!-- Right: CTAs -->
        <div class="ml-auto flex items-center justify-end gap-3">
          <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="hidden rounded-md bg-[#FFD700] px-3 py-1.5 text-sm font-semibold text-black shadow hover:brightness-95 md:inline-block">
            Call {{ phone }}
          </a>
          <template v-if="auth?.user">
            <Link href="/dashboard" class="hidden rounded-md border border-neutral-700 px-3 py-1.5 text-sm font-medium text-neutral-100 hover:bg-neutral-900 sm:inline-block">Dashboard</Link>
          </template>
          <template v-else>
            <Link href="/login" class="hidden text-sm sm:inline-block" :class="headerHasShadow ? 'text-neutral-300 hover:text-white' : 'text-neutral-200 hover:text-white drop-shadow-sm'">Log in</Link>
            <Link href="/register" class="hidden rounded-md bg-white px-3 py-1.5 text-sm font-medium text-black hover:bg-neutral-200 shadow-md sm:inline-block">Register</Link>
          </template>
        </div>
      </div>
    </header>

    <!-- Page content -->
    <main class="bg-neutral-950 text-neutral-100" style="padding-top: 4rem;">
      <slot />
    </main>

    <!-- Footer -->
    <footer class="border-t border-neutral-800 bg-black/95 py-12 text-neutral-300">
      <div class="mx-auto grid w-full max-w-7xl grid-cols-1 gap-10 px-4 sm:grid-cols-2 md:grid-cols-4">
        <div>
          <div class="mb-4 flex items-center gap-2">
            <span class="flex items-center justify-center rounded-md bg-[#FFD700]/15 p-1.5">
              <AppLogoIcon class="size-5 text-[#FFD700]" />
            </span>
            <span class="text-base font-semibold"><span class="text-[#FFD700]">Teviot</span> Tyres</span>
          </div>
          <p class="text-sm">{{ address }}</p>
          <p class="mt-2 text-sm"><a :href="`tel:${phone.replace(/\s+/g, '')}`" class="text-[#FFD700] hover:underline">{{ phone }}</a></p>
          <p class="mt-1 text-sm"><a :href="`mailto:${email}`" class="hover:underline">{{ email }}</a></p>
          <p class="mt-3 text-sm"><a :href="facebookUrl" target="_blank" rel="noopener" class="hover:underline">Facebook</a></p>
        </div>
        <div>
          <h3 class="mb-3 text-sm font-semibold uppercase tracking-wider text-neutral-400">Navigation</h3>
          <ul class="space-y-2 text-sm">
            <li><Link href="/">Home</Link></li>
            <li><Link href="/services">Services</Link></li>
            <li><Link href="/reg-lookup">Reg Lookup</Link></li>
            <li><Link href="/contact">Contact</Link></li>
            <li><Link href="/terms">T&Cs</Link></li>
            <li><Link href="/privacy">Privacy</Link></li>
          </ul>
        </div>
        <div>
          <h3 class="mb-3 text-sm font-semibold uppercase tracking-wider text-neutral-400">Services</h3>
          <ul class="space-y-2 text-sm">
            <li><Link href="/services#tyres">Tyres</Link></li>
            <li><Link href="/services#mot-class-4">Class 4 MOTs</Link></li>
            <li><Link href="/services#mot-prep">MOT Preparation</Link></li>
            <li><Link href="/services#servicing">Servicing</Link></li>
            <li><Link href="/services#diagnostics">Diagnostics</Link></li>
            <li><Link href="/services#battery">Battery Replacement</Link></li>
            <li><Link href="/services#payment-assist">Payment Assist</Link></li>
          </ul>
        </div>
        <div>
          <h3 class="mb-3 text-sm font-semibold uppercase tracking-wider text-neutral-400">Opening Hours</h3>
          <table class="w-full text-left text-sm">
            <tbody class="[&_td]:py-1">
              <tr><td>Mon–Fri</td><td class="text-right">9:00 – 17:00</td></tr>
              <tr><td>Saturday</td><td class="text-right">9:00 – 13:00</td></tr>
              <tr><td>Sunday</td><td class="text-right">Closed</td></tr>
            </tbody>
          </table>
          <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="mt-3 inline-block rounded-md bg-[#FFD700] px-3 py-1.5 text-sm font-semibold text-black hover:brightness-95">Call {{ phone }}</a>
        </div>
      </div>
      <div class="mx-auto mt-10 max-w-7xl px-4">
        <div class="flex flex-col items-center justify-between gap-4 border-t border-neutral-800 pt-8 text-xs text-neutral-500 md:flex-row">
          <div>&copy; {{ new Date().getFullYear() }} Teviot Tyres. All rights reserved.</div>
          <div class="flex items-center gap-6">
            <Link href="/privacy" class="hover:text-[#FFD700] transition-colors">Privacy Policy</Link>
            <Link href="/terms" class="hover:text-[#FFD700] transition-colors">Terms of Service</Link>
          </div>
        </div>
      </div>
    </footer>

    <!-- Mobile menu overlay -->
    <div v-show="mobileOpen" class="fixed inset-0 z-50 md:hidden" @click.self="mobileOpen = false">
      <div class="absolute inset-0 bg-black/60"></div>
      <div class="absolute right-0 top-0 h-full w-72 max-w-[85%] border-l border-neutral-800 bg-neutral-950 p-4 shadow-xl">
        <div class="mb-4 flex items-center justify-between">
          <div class="flex items-center gap-2">
            <span class="flex items-center justify-center rounded-md bg-[#FFD700]/15 p-1.5">
              <AppLogoIcon class="size-5 text-[#FFD700]" />
            </span>
            <span class="text-base font-semibold"><span class="text-[#FFD700]">Teviot</span> Tyres</span>
          </div>
          <button class="rounded-md border border-neutral-800 p-2 text-neutral-300 hover:bg-neutral-900" @click="mobileOpen = false" aria-label="Close menu">
            <X class="h-5 w-5" />
          </button>
        </div>
        <nav class="grid gap-2 text-sm">
          <Link href="/services" @click="mobileOpen = false" :class="cn('rounded-md px-3 py-2', isActive('/services') ? 'bg-neutral-900 text-[#FFD700]' : 'text-neutral-300 hover:bg-neutral-900')">Services</Link>
          <Link href="/reg-lookup" @click="mobileOpen = false" :class="cn('rounded-md px-3 py-2', isActive('/reg-lookup') ? 'bg-neutral-900 text-[#FFD700]' : 'text-neutral-300 hover:bg-neutral-900')">Reg Lookup</Link>
          <Link href="/contact" @click="mobileOpen = false" :class="cn('rounded-md px-3 py-2', isActive('/contact') ? 'bg-neutral-900 text-[#FFD700]' : 'text-neutral-300 hover:bg-neutral-900')">Contact</Link>
          <Link href="/terms" @click="mobileOpen = false" :class="cn('rounded-md px-3 py-2', isActive('/terms') ? 'bg-neutral-900 text-[#FFD700]' : 'text-neutral-300 hover:bg-neutral-900')">T&Cs</Link>
          <Link href="/privacy" @click="mobileOpen = false" :class="cn('rounded-md px-3 py-2', isActive('/privacy') ? 'bg-neutral-900 text-[#FFD700]' : 'text-neutral-300 hover:bg-neutral-900')">Privacy</Link>
        </nav>
        <div class="mt-6 grid gap-2">
          <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="rounded-md bg-[#FFD700] px-3 py-2 text-center text-sm font-bold text-black">Call {{ phone }}</a>
          <a :href="`https://maps.google.com/?q=${encodeURIComponent(address)}`" target="_blank" rel="noopener" class="rounded-md border border-neutral-800 px-3 py-2 text-center text-sm text-neutral-200 hover:bg-neutral-900">Directions</a>
          <div class="mt-2 text-xs text-neutral-500">{{ address }}</div>
        </div>
      </div>
    </div>

    <!-- Back to top floating button -->
    <button
      v-show="showToTop"
      @click="backToTop"
      class="fixed bottom-20 right-5 z-40 inline-flex items-center gap-2 rounded-full border border-neutral-800 bg-neutral-950/90 px-4 py-2 text-sm text-neutral-200 shadow transition hover:bg-neutral-900 md:bottom-5"
      aria-label="Back to top"
    >
      <ArrowUp class="h-4 w-4" /> Top
    </button>

    <!-- Mobile call/directions bar -->
    <div class="fixed inset-x-0 bottom-0 z-40 border-t border-neutral-800 bg-black/80 px-4 py-3 backdrop-blur md:hidden">
      <div class="mx-auto flex max-w-7xl gap-2">
        <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="sheen flex-1 rounded-md bg-[#FFD700] px-4 py-2 text-center text-sm font-extrabold text-black shadow hover:brightness-95">Call {{ phone }}</a>
        <a :href="`https://maps.google.com/?q=${encodeURIComponent(address)}`" target="_blank" rel="noopener" class="flex-1 rounded-md border border-neutral-700 px-4 py-2 text-center text-sm text-neutral-100 hover:bg-neutral-900">Directions</a>
      </div>
    </div>
  </AppShell>
</template>
