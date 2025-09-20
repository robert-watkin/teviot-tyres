<script setup lang="ts">
import PublicLayout from '@/layouts/public/PublicLayout.vue';
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { CheckCircle2, CreditCard, Wrench, Phone, MapPin, Star } from 'lucide-vue-next';
import Reveal from '@/components/Reveal.vue';
import TrustBadges from '@/components/TrustBadges.vue';
import { computed, ref, onMounted, onBeforeUnmount } from 'vue';

const page = usePage();
const site = computed(() => (page.props as any).site || {});
const phone = computed(() => site.value.phone || '01450 374875');

let currentImageIndex = ref(0);
let imageCycleInterval: number | null = null;
let isTransitioning = ref(false);

// Video preloading and management
let videoElement: HTMLVideoElement | null = null;
let preloadQueue: string[] = [];

// Fallback to images if videos fail to load
const useVideos = ref(true);
const videoLoading = ref(true);

const updateVideoSource = () => {
  if (videoElement && useVideos.value) {
    const newSrc = heroVideo.value;
    if ((videoElement as HTMLVideoElement).src !== window.location.origin + newSrc) {
      (videoElement as HTMLVideoElement).src = newSrc;
      (videoElement as HTMLVideoElement).load();
    }
  }
};

// Preload next video
const preloadNextVideo = () => {
  const currentIndex = currentImageIndex.value;
  const nextIndex = (currentIndex + 1) % 5; // Updated to 5 videos
  const heroVideos = [
    '/videos/8470289-uhd_3840_2160_25fps.mp4',
    '/videos/4488707-uhd_4096_2160_25fps.mp4',
    '/videos/4488720-uhd_4096_2160_25fps.mp4',
    '/videos/7564883-uhd_4096_2160_25fps.mp4',
    '/videos/8986875-uhd_3840_2160_30fps.mp4',
  ];

  const nextVideo = heroVideos[nextIndex];
  if (nextVideo && !preloadQueue.includes(nextVideo)) {
    preloadQueue.push(nextVideo);
    const link = document.createElement('link');
    link.rel = 'preload';
    link.as = 'video';
    link.href = nextVideo;
    document.head.appendChild(link);
  }
};

const heroVideo = computed(() => {
  if (!useVideos.value) {
    // Fallback to images
    const heroImages = [
      'https://images.unsplash.com/photo-1615906655593-ad0386982a0f?q=80&w=1600&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // Busy garage workshop
      'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?q=80&w=1600&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // Clean automotive shop
      'https://images.unsplash.com/photo-1486754735734-325b5831c3ad?q=80&w=1600&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // Professional garage bay
    ];
    return heroImages[currentImageIndex.value];
  }

  const heroVideos = [
    '/videos/8470289-uhd_3840_2160_25fps.mp4', // Person repairing automobile
    '/videos/4488707-uhd_4096_2160_25fps.mp4', // Man sitting in garage with red light
    '/videos/4488720-uhd_4096_2160_25fps.mp4', // New video added
    '/videos/7564883-uhd_4096_2160_25fps.mp4', // Mechanic raising an engine
    '/videos/8986875-uhd_3840_2160_30fps.mp4', // Moving wheels of car on lifter
  ];

  return (import.meta.env.VITE_HERO_VIDEO_URL as string) || heroVideos[currentImageIndex.value];
});

onMounted(() => {
  const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reduce) return;

  // Set video element reference after DOM is ready
  setTimeout(() => {
    const videoEl = document.querySelector('video[key="hero-video-player"]') as HTMLVideoElement;
    if (videoEl) {
      videoElement = videoEl;
    }
  }, 100);

  imageCycleInterval = setInterval(() => {
    isTransitioning.value = true;

    // Preload next video
    preloadNextVideo();

    setTimeout(() => {
      currentImageIndex.value = (currentImageIndex.value + 1) % 5; // Updated to 5 videos
      // Update video source if videos are enabled
      if (useVideos.value) {
        updateVideoSource();
      }
      setTimeout(() => {
        isTransitioning.value = false;
      }, 500); // Keep transition visible for half second
    }, 300); // Brief transition period
  }, 15000);

  // Load the first video immediately
  setTimeout(() => {
    if (useVideos.value && videoElement) {
      const firstVideo = heroVideo.value;
      (videoElement as HTMLVideoElement).src = firstVideo;
      (videoElement as HTMLVideoElement).load();
      console.log('Loading first video:', firstVideo);
    }
  }, 500);

  // Test video file accessibility
  setTimeout(() => {
    const heroVideos = [
      '/videos/8470289-uhd_3840_2160_25fps.mp4',
      '/videos/4488707-uhd_4096_2160_25fps.mp4',
      '/videos/4488720-uhd_4096_2160_25fps.mp4',
      '/videos/7564883-uhd_4096_2160_25fps.mp4',
      '/videos/8986875-uhd_3840_2160_30fps.mp4',
    ];

    heroVideos.forEach((videoPath, index) => {
      fetch(videoPath)
        .then(response => {
          console.log(`Video ${index + 1} (${videoPath}) is accessible:`, response.ok);
        })
        .catch(error => {
          console.error(`Video ${index + 1} (${videoPath}) failed to load:`, error);
        });
    });
  }, 200);
});

onBeforeUnmount(() => {
  if (imageCycleInterval) {
    clearInterval(imageCycleInterval);
  }
});

const parallaxY = ref(0);

const onScroll = () => {
  parallaxY.value = window.scrollY * 0.5;
};

onMounted(() => {
  window.addEventListener('scroll', onScroll, { passive: true });
});

onBeforeUnmount(() => {
  window.removeEventListener('scroll', onScroll);
});
</script>

<template>
  <PublicLayout title="Teviot Tyres">

    <Head title="Teviot Tyres" />

    <!-- Hero -->
    <section id="top" class="relative min-h-screen overflow-hidden" style="margin-top: -4rem; padding-top: 4rem;">
      <!-- Background video/image layer -->
      <div aria-hidden class="absolute inset-0 z-0">
        <video
          v-if="useVideos"
          ref="videoElement"
          key="hero-video-player"
          class="absolute inset-0 h-full w-full object-cover"
          autoplay
          loop
          playsinline
          disablePictureInPicture
          controlsList="nodownload nofullscreen noremoteplayback"
          preload="metadata"
          @error="(event) => { console.error('Video load error:', event); useVideos = false; }"
          @loadstart="videoLoading = true"
          @canplay="videoLoading = false">
          <source :src="heroVideo" type="video/mp4">
          Your browser does not support the video tag.
        </video>
        <div
          v-else
          class="absolute inset-0 bg-cover bg-center"
          :style="{ backgroundImage: `url('${heroVideo}')` }">
        </div>
      </div>
      <!-- Gradient overlays -->
      <div aria-hidden class="pointer-events-none absolute inset-0 z-0"
        style="background:linear-gradient(180deg, rgba(0,0,0,0.75), rgba(0,0,0,0.70)), radial-gradient(ellipse at 20% 10%, rgba(255,215,0,0.08), transparent 45%), radial-gradient(ellipse at 80% 90%, rgba(255,215,0,0.06), transparent 45%)">
      </div>
      <div
        class="pointer-events-none absolute inset-0 z-0 bg-[radial-gradient(60%_50%_at_50%_0%,rgba(255,215,0,0.12)_0%,transparent_70%)]">
      </div>
      <!-- Additional contrast overlay -->
      <div aria-hidden class="pointer-events-none absolute inset-0 z-0 bg-gradient-to-b from-black/40 via-transparent to-black/60"></div>
      <div
        class="mx-auto grid h-full w-full max-w-7xl grid-cols-1 items-center gap-10 px-4 pt-20 pb-12 md:grid-cols-2 md:pt-28 md:pb-20">
        <!-- Left column: Headline, copy, CTAs, stats -->
        <Reveal mode="up">
          <div class="relative">
            <!-- Badge row -->
            <div
              class="mb-5 inline-flex items-center gap-3 rounded-full border border-neutral-800/70 bg-black/50 px-3 py-1 text-xs text-neutral-300 backdrop-blur">
              <AppLogoIcon class="size-4 text-[#FFD700]" />
              <span class="font-medium">Fast, friendly & DVSA‑approved</span>
              <span class="hidden rounded-sm bg-[#FFD700]/20 px-1.5 py-0.5 text-[#FFD700] md:inline">FREE Tyre
                Check</span>
            </div>

            <!-- Headline -->
            <h1 class="text-balance text-5xl font-extrabold leading-tight tracking-tight sm:text-6xl">
              <span class="text-[#FFD700]">Your trusted</span> local Tyre & MOT experts in Hawick
            </h1>
            <p class="mt-4 max-w-[65ch] text-lg text-neutral-200">
              Same‑day tyres and Class 4 & 7 MOTs with honest advice and fair pricing. Servicing, diagnostics and
              batteries — all under one roof.
            </p>

            <!-- CTAs -->
            <div class="mt-7 flex flex-wrap gap-3">
              <a :href="`tel:${phone.replace(/\s+/g, '')}`"
                class="sheen inline-flex items-center gap-2 rounded-md bg-[#FFD700] px-5 py-2.5 text-sm font-extrabold text-black shadow-lg hover:brightness-95"
                aria-label="Call Teviot Tyres">
                <Phone class="h-4 w-4" aria-hidden="true" />
                <span>Call {{ phone }}</span>
              </a>
              <Link href="/services"
                class="inline-flex items-center gap-2 rounded-md border border-neutral-700/80 bg-black/40 px-5 py-2.5 text-sm font-medium text-white backdrop-blur hover:bg-black/50 shadow-md"
                aria-label="View services">
                <Wrench class="h-4 w-4" aria-hidden="true" />
                <span>View Services</span>
              </Link>
              <a :href="`https://maps.google.com/?q=Unit%2010,%20Lochpark%20Industrial%20Estate,%20Hawick%20TD9%209JA`"
                target="_blank" rel="noopener"
                class="inline-flex items-center gap-2 rounded-md border border-neutral-700/80 bg-black/40 px-5 py-2.5 text-sm font-medium text-white backdrop-blur hover:bg-black/50 shadow-md"
                aria-label="Get directions">
                <MapPin class="h-4 w-4" aria-hidden="true" />
                <span>Directions</span>
              </a>
            </div>

            <!-- Stats -->
            <div class="mt-7 grid max-w-lg grid-cols-3 gap-3 text-center text-sm text-neutral-200">
              <div class="rounded-md border border-neutral-800/70 bg-black/50 p-3 backdrop-blur">
                <Wrench class="mx-auto mb-1 h-4 w-4 text-[#FFD700]" aria-hidden="true" />
                <div class="text-base font-semibold text-white">Same‑day</div>
                <div>Tyres</div>
              </div>
              <div class="rounded-md border border-neutral-800/70 bg-black/50 p-3 backdrop-blur">
                <CheckCircle2 class="mx-auto mb-1 h-4 w-4 text-accent-blue" aria-hidden="true" />
                <div class="text-base font-semibold text-white">Class 4 & 7</div>
                <div>MOTs</div>
              </div>
              <div class="rounded-md border border-neutral-800/70 bg-black/50 p-3 backdrop-blur">
                <Star class="mx-auto mb-1 h-4 w-4 text-accent-rose" aria-hidden="true" />
                <div class="text-base font-semibold text-white">4.9/5</div>
                <div>Reviews</div>
              </div>
            </div>
          </div>
        </Reveal>

        <!-- Right column: Glass card with Reg Lookup -->
        <Reveal mode="up" :delay="120">
          <div class="relative rounded-2xl border border-neutral-800/70 bg-black/50 p-6 shadow-2xl backdrop-blur-md">
            <h2 class="text-lg font-semibold text-[#FFD700]">Quick Reg Lookup</h2>
            <p class="mb-4 mt-1 text-sm text-neutral-300">Enter your reg for instant vehicle info. Create an account
              (soon) to save it.</p>
            <form action="/reg-lookup" method="get" class="flex w-full gap-3" aria-label="Registration lookup">
              <label for="hero-reg" class="sr-only">Registration number</label>
              <input id="hero-reg" name="reg" inputmode="text" autocomplete="on" placeholder="e.g. AB12 CDE"
                class="flex-1 rounded-md border border-neutral-800 bg-black/70 px-3 py-2 text-sm text-white outline-none ring-2 ring-transparent placeholder:text-neutral-400 focus:ring-neutral-700" />
              <button type="submit"
                class="rounded-md bg-[#FFD700] px-4 py-2 text-sm font-semibold text-black hover:brightness-95 shadow-md">Search</button>
            </form>
            <p class="mt-3 text-xs text-neutral-400">Powered by DVLA Vehicle Enquiry Service.</p>
            <p class="mt-2 text-xs text-neutral-500">By using this lookup you agree to our
              <Link href="/privacy" class="underline">privacy policy</Link>.
            </p>
          </div>
        </Reveal>

        <!-- Scroll cue -->
        <div class="pointer-events-none absolute inset-x-0 bottom-6 flex justify-center">
          <div
            class="animate-bounce rounded-full border border-neutral-800/70 bg-black/50 px-3 py-1 text-xs text-neutral-300 backdrop-blur">
            Scroll
          </div>
        </div>

        <!-- Debug info (remove in production) -->
        <div class="pointer-events-none absolute top-4 right-4 rounded-md bg-black/50 px-2 py-1 text-xs text-neutral-300 backdrop-blur">
          {{ useVideos ? 'Videos' : 'Images' }} | {{ videoLoading ? 'Loading...' : 'Ready' }}
        </div>
      </div>
    </section>

    <!-- Trust badges -->
    <div class="bg-surface-alt border-y border-neutral-900">
      <section class="mx-auto w-full max-w-7xl px-4 py-12">
        <Reveal mode="up">
          <TrustBadges />
        </Reveal>
      </section>
    </div>

    <!-- Services overview -->
    <div class="bg-surface-blue border-b border-neutral-900">
      <section class="mx-auto w-full max-w-7xl px-4 py-16">
        <h2 class="mb-6 text-2xl font-semibold"><span class="text-[#FFD700]">Popular</span> Services</h2>
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
          <Reveal mode="up">
            <Link href="/services#tyres"
              class="group overflow-hidden rounded-lg border border-neutral-800 bg-neutral-950 transition hover:bg-neutral-900">
            <div class="h-28 w-full bg-cover bg-center"
              style="background-image:url('https://images.unsplash.com/photo-1515923162045-7b3b3f9ae1ae?q=80&w=1200&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">
            </div>
            <div class="p-5">
              <div class="mb-2 flex items-center gap-3 text-[#FFD700]">
                <Wrench class="h-5 w-5" /> <span class="font-semibold">Tyres</span>
              </div>
              <p class="text-sm text-neutral-300">Budget to premium. Fitted & balanced. FREE Tyre Check.</p>
              <span class="mt-3 inline-block text-sm text-[#FFD700] group-hover:underline">Learn more →</span>
            </div>
            </Link>
          </Reveal>
          <Reveal mode="up" :delay="80">
            <Link href="/services#mot-class-4-7"
              class="group overflow-hidden rounded-lg border border-neutral-800 bg-neutral-950 transition hover:bg-neutral-900">
            <div class="h-28 w-full bg-cover bg-center"
              style="background-image:url('https://images.unsplash.com/photo-1517170652703-225d4bd1b699?q=80&w=1200&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">
            </div>
            <div class="p-5">
              <div class="mb-2 flex items-center gap-3 text-[#FFD700]">
                <CheckCircle2 class="h-5 w-5" /> <span class="font-semibold">Class 4 & 7 MOTs</span>
              </div>
              <p class="text-sm text-neutral-300">DVSA‑approved testing with quick turnaround.</p>
              <span class="mt-3 inline-block text-sm text-[#FFD700] group-hover:underline">Learn more →</span>
            </div>
            </Link>
          </Reveal>
          <Reveal mode="up" :delay="140">
            <Link href="/services#servicing"
              class="group overflow-hidden rounded-lg border border-neutral-800 bg-neutral-950 transition hover:bg-neutral-900">
            <div class="h-28 w-full bg-cover bg-center"
              style="background-image:url('https://images.unsplash.com/photo-1517167685280-1456c9b3c1f5?q=80&w=1200&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">
            </div>
            <div class="p-5">
              <div class="mb-2 flex items-center gap-3 text-[#FFD700]">
                <Wrench class="h-5 w-5" /> <span class="font-semibold">Servicing</span>
              </div>
              <p class="text-sm text-neutral-300">General maintenance for peace of mind.</p>
              <span class="mt-3 inline-block text-sm text-[#FFD700] group-hover:underline">Learn more →</span>
            </div>
            </Link>
          </Reveal>
        </div>
        <div class="mt-6 rounded-lg border border-neutral-800 bg-neutral-950 p-5">
          <div class="flex flex-col items-start justify-between gap-4 md:flex-row md:items-center">
            <div class="flex items-center gap-3 text-[#FFD700]">
              <CreditCard class="h-5 w-5" /><span class="font-semibold">Payment Assist</span>
            </div>
            <div class="grid flex-1 grid-cols-1 gap-4 text-sm text-neutral-300 md:grid-cols-3">
              <div><span class="font-semibold text-white">1. Quote</span>
                <p>Get a quick cost breakdown.</p>
              </div>
              <div><span class="font-semibold text-white">2. Approval</span>
                <p>Fast eligibility check.</p>
              </div>
              <div><span class="font-semibold text-white">3. Payments</span>
                <p>Spread over 3–12 months.</p>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <!-- Why choose us -->
    <section class="mx-auto w-full max-w-7xl px-4 pb-16">
      <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
        <Reveal mode="up">
          <div class="rounded-xl border border-neutral-800 bg-neutral-950 p-6">
            <h3 class="text-xl font-semibold"><span class="text-[#FFD700]">Why</span> Choose Us</h3>
            <ul class="mt-4 list-disc space-y-2 pl-5 text-neutral-300">
              <li>Local Hawick garage — convenient location at Lochpark Industrial Estate</li>
              <li>DVSA‑approved testing and qualified technicians</li>
              <li>FREE checks and quick turnaround</li>
            </ul>
            <div class="mt-6 flex flex-wrap gap-3">
              <a :href="`tel:${phone.replace(/\s+/g, '')}`"
                class="rounded-md bg-[#FFD700] px-4 py-2 text-sm font-semibold text-black hover:brightness-95">Call {{
                phone }}</a>
              <Link href="/contact"
                class="rounded-md border border-neutral-800 px-4 py-2 text-sm font-medium text-white hover:bg-neutral-900">
              Contact & Hours</Link>
            </div>
          </div>
        </Reveal>
        <Reveal mode="up" :delay="120">
          <div class="rounded-xl border border-neutral-800 bg-neutral-950 p-6">
            <h3 class="text-xl font-semibold">Testimonials</h3>
            <div class="mt-4 grid gap-4 md:grid-cols-2">
              <div class="rounded-lg border border-neutral-800 bg-black p-4 text-sm text-neutral-300">“Needed a new tyre
                quickly and Teviot Tyres sorted me out same day at a very reasonable price. Thanks lads!” <span
                  class="block pt-2 text-xs text-neutral-500">Facebook Review</span></div>
              <div class="rounded-lg border border-neutral-800 bg-black p-4 text-sm text-neutral-300">“Tyres replaced
                and source of 'squeaking' located. Brilliant service, and honest, sound advice. Thank you. I also
                revisited for MOT. Highly recommend.” <span class="block pt-2 text-xs text-neutral-500">Facebook
                  Review</span></div>
              <div class="rounded-lg border border-neutral-800 bg-black p-4 text-sm text-neutral-300">“Absolutely
                brilliant service. Can’t thank them enough. Will definitely be using them from now on for my car.
                Brilliant service and very quick and very affordable. I needed a few things done to my car and been
                dreading putting it in to a garage but wow I highly recommend. Thank you so much again.” <span
                  class="block pt-2 text-xs text-neutral-500">Facebook Review</span></div>
              <div class="rounded-lg border border-neutral-800 bg-black p-4 text-sm text-neutral-300">“These guys went
                above and beyond to fix a puncture for me, they were closed and opened just to do that for me, can’t
                thank them enough, thanks again.” <span class="block pt-2 text-xs text-neutral-500">Facebook
                  Review</span></div>
              <div class="rounded-lg border border-neutral-800 bg-black p-4 text-sm text-neutral-300">“Excellent
                service, thank you!” <span class="block pt-2 text-xs text-neutral-500">Facebook Review</span></div>
              <div class="rounded-lg border border-neutral-800 bg-black p-4 text-sm text-neutral-300">“Absolutely
                brilliant service. Was stranded out in the country with no tyre company willing to come out to help…
                Highly recommend.” <span class="block pt-2 text-xs text-neutral-500">Facebook Review</span></div>
              <div class="rounded-lg border border-neutral-800 bg-black p-4 text-sm text-neutral-300">“Great service,
                sorted me out very quickly with new tyres. Highly recommend!” <span
                  class="block pt-2 text-xs text-neutral-500">Facebook Review</span></div>
              <div class="rounded-lg border border-neutral-800 bg-black p-4 text-sm text-neutral-300">“Fast & excellent
                service, had a puncture & needed it fixed ASAP. Was done whilst I waited with a smile. Polite & helpful
                — would definitely recommend.” <span class="block pt-2 text-xs text-neutral-500">Facebook Review</span>
              </div>
              <div class="rounded-lg border border-neutral-800 bg-black p-4 text-sm text-neutral-300">“Great service.
                Fitted me in last minute, wasn't any hassle.” <span class="block pt-2 text-xs text-neutral-500">Facebook
                  Review</span></div>
              <div class="rounded-lg border border-neutral-800 bg-black p-4 text-sm text-neutral-300">“These guys have
                helped me with advice, work on my Ford Galaxy, and MOT. Booked me in super fast, great work, good
                prices, super friendly.” <span class="block pt-2 text-xs text-neutral-500">Facebook Review</span></div>
              <div class="rounded-lg border border-neutral-800 bg-black p-4 text-sm text-neutral-300">“Great fast
                reliable service, would definitely give these guys a go if you haven't already. Come highly
                recommended.” <span class="block pt-2 text-xs text-neutral-500">Facebook Review</span></div>
              <div class="rounded-lg border border-neutral-800 bg-black p-4 text-sm text-neutral-300">“I had an
                excellent experience with Teviot Tyres… within an hour I had a quote and a time to get it fixed first
                thing next morning… within 15 minutes I had a new tyre and I was back on the road.” <span
                  class="block pt-2 text-xs text-neutral-500">Facebook Review</span></div>
              <div class="rounded-lg border border-neutral-800 bg-black p-4 text-sm text-neutral-300">“I got booked in
                quick. Work was done quickly and professionally. Affordable prices. Friendly atmosphere. Will definitely
                still be using them.” <span class="block pt-2 text-xs text-neutral-500">Facebook Review</span></div>
            </div>
          </div>
        </Reveal>
      </div>
    </section>

    <!-- Removed Gallery: imagery is now integrated into hero and cards -->

    <!-- Contact snippet -->
    <div class="bg-surface-emerald border-t border-neutral-900">
      <section class="mx-auto w-full max-w-7xl px-4 pb-24">
        <div
          class="grid grid-cols-1 items-center gap-8 rounded-xl border border-neutral-800 bg-neutral-950 p-6 md:grid-cols-2">
          <div>
            <h3 class="text-xl font-semibold"><span class="text-[#FFD700]">Ready</span> to book?</h3>
            <p class="mt-2 text-neutral-300">Call now or view full contact details and directions.</p>
            <div class="mt-4 flex flex-wrap gap-3">
              <a :href="`tel:${phone.replace(/\s+/g, '')}`"
                class="rounded-md bg-[#FFD700] px-4 py-2 text-sm font-semibold text-black hover:brightness-95">Call {{
                phone }}</a>
              <Link href="/contact"
                class="rounded-md border border-neutral-800 px-4 py-2 text-sm font-medium text-white hover:bg-neutral-900">
              Contact page</Link>
            </div>
          </div>
          <div class="rounded-lg border border-neutral-800 bg-black p-3 text-sm text-neutral-300">
            Open Mon–Fri 9–17, Sat 9–13. Unit 10, Lochpark Industrial Estate, Hawick TD9 9JA.
            <iframe title="Teviot Tyres Map"
              src="https://www.google.com/maps?q=Unit%2010,%20Lochpark%20Industrial%20Estate,%20Hawick%20TD9%209JA&output=embed"
              class="h-64 w-full rounded-md" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </section>
    </div>
  </PublicLayout>
</template>
