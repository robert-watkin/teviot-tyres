<script setup lang="ts">
import { computed, ref, onMounted, onBeforeUnmount, watch, nextTick } from 'vue'
import { Phone, MapPin, Tools, CheckCircle, Star } from '@iconoir/vue'
import { usePage, Link } from '@inertiajs/vue3'
import { Head } from '@inertiajs/vue3'
import Reveal from '../Reveal.vue'
import TrustBadges from '../TrustBadges.vue'
import AppLogoIcon from '../AppLogoIcon.vue'

// Replaced inline SVG icons with Iconoir components

// Video preloading and management
let videoElement: HTMLVideoElement | null = null
let preloadQueue: string[] = []
const videoElRef = ref<HTMLVideoElement | null>(null)

// Fallback to images if videos fail to load
const parallaxY = ref(0)

const onScroll = () => {
  parallaxY.value = window.scrollY * 0.5
}

const useVideos = ref(true)
const videoLoading = ref(true)

const updateVideoSource = () => {
  if (videoElement && useVideos.value) {
    // src is bound reactively; just ensure the player loads and plays
    ;(videoElement as HTMLVideoElement).load()
    ;(videoElement as HTMLVideoElement).play().catch((e) => {
      console.warn('Autoplay prevented, attempting muted play', e)
      ;(videoElement as HTMLVideoElement).muted = true
      ;(videoElement as HTMLVideoElement).play().catch(() => {})
    })
  }
}

// Preload next video
const preloadNextVideo = () => {
  const currentIndex = currentImageIndex.value
  const nextIndex = (currentIndex + 1) % 5
  const heroVideos = [
    '/videos/hero-video-1.mp4', // Person repairing automobile
    '/videos/hero-video-2.mp4', // Updated video
    '/videos/hero-video-3.mp4', // Mechanic raising an engine
    '/videos/hero-video-4.mp4', // Moving wheels of car on lifter
    '/videos/hero-video-5.mp4', // Additional automotive work
  ]

  const nextVideo = heroVideos[nextIndex]
  if (nextVideo && !preloadQueue.includes(nextVideo)) {
    preloadQueue.push(nextVideo)
    const link = document.createElement('link')
    link.rel = 'preload'
    link.as = 'video'
    link.href = nextVideo
    document.head.appendChild(link)
  }
}

const page = usePage()
const site = computed(() => (page.props as any).site || {})
const phone = computed(() => site.value.phone || '01450 374875')

const currentImageIndex = ref(0)
let imageCycleInterval: number | null = null
let isTransitioning = ref(false)

const heroVideo = computed(() => {
  if (!useVideos.value) {
    // Fallback to images
    const heroImages = [
      'https://images.unsplash.com/photo-1615906655593-ad0386982a0f?q=80&w=1600&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // Busy garage workshop
      'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?q=80&w=1600&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // Clean automotive shop
      'https://images.unsplash.com/photo-1486754735734-325b5831c3ad?q=80&w=1600&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // Professional garage bay
    ]
    return heroImages[currentImageIndex.value]
  }

  const heroVideos = [
    '/videos/hero-video-1.mp4', // Person repairing automobile
    '/videos/hero-video-2.mp4', // Updated video
    '/videos/hero-video-3.mp4', // Mechanic raising an engine
    '/videos/hero-video-4.mp4', // Moving wheels of car on lifter
    '/videos/hero-video-5.mp4', // Additional automotive work
  ]

  const envUrl = (import.meta.env.VITE_HERO_VIDEO_URL as string | undefined)
  // Only use env override if it's a non-empty string not equal to 'auto'
  if (envUrl && envUrl.trim() !== '' && envUrl.trim().toLowerCase() !== 'auto') {
    return envUrl
  }
  return heroVideos[currentImageIndex.value]
})

// Always resolve to an absolute URL for the <video> element
const resolvedHeroVideo = computed(() => {
  const v = heroVideo.value
  return /^https?:\/\//.test(v) ? v : (window.location.origin + v)
})

// Watch for video index changes and update video source
watch(currentImageIndex, () => {
  if (useVideos.value) {
    console.log(`Video index changed to ${currentImageIndex.value}`)
    updateVideoSource()
  }
})

// When the resolved URL changes, ensure the player reloads and plays
watch(resolvedHeroVideo, () => {
  updateVideoSource()
})

// Watch for useVideos changes to switch between videos and images
watch(useVideos, (newValue) => {
  if (newValue && videoElement) {
    // Switching to videos
    console.log('Switching to video mode:', resolvedHeroVideo.value)
    updateVideoSource()
  }
})

onMounted(async () => {
  const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches
  if (reduce) return

  // Capture the template ref for the video element
  await nextTick()
  if (videoElRef.value) {
    videoElement = videoElRef.value
  }

  imageCycleInterval = setInterval(() => {
    isTransitioning.value = true

    // Preload next video
    preloadNextVideo()

    setTimeout(() => {
      const oldIndex = currentImageIndex.value
      currentImageIndex.value = (currentImageIndex.value + 1) % 5
      console.log(`Switching from video ${oldIndex} to video ${currentImageIndex.value}`)
      // Update video source if videos are enabled
      if (useVideos.value) {
        updateVideoSource()
      }
      setTimeout(() => {
        isTransitioning.value = false
      }, 500)
    }, 300)
  }, 8000)

  // Load the first video immediately
  setTimeout(() => {
    if (useVideos.value && videoElement) {
      console.log('Loading first video:', resolvedHeroVideo.value)
      updateVideoSource()
    }
  }, 500)

  // Test video file accessibility
  setTimeout(() => {
    const heroVideos = [
      '/videos/hero-video-1.mp4', // Person repairing automobile
      '/videos/hero-video-2.mp4', // Updated video
      '/videos/hero-video-3.mp4', // Mechanic raising an engine
      '/videos/hero-video-4.mp4', // Moving wheels of car on lifter
      '/videos/hero-video-5.mp4', // Additional automotive work
    ]

    heroVideos.forEach((videoPath, index) => {
      fetch(videoPath)
        .then((response) => {
          console.log(`Video ${index + 1} (${videoPath}) is accessible:`, response.ok)
        })
        .catch((error) => {
          console.error(`Video ${index + 1} (${videoPath}) failed to load:`, error)
        })
    })
  }, 200)
})

onBeforeUnmount(() => {
  if (imageCycleInterval) {
    clearInterval(imageCycleInterval)
  }
})

const onVideoEnded = () => {
  console.log('Video ended, cycling to next video')
  // Cycle to next video when current one ends
  const oldIndex = currentImageIndex.value
  currentImageIndex.value = (currentImageIndex.value + 1) % 5
  console.log(`Switching from video ${oldIndex} to video ${currentImageIndex.value}`)

  // Update video source
  if (videoElement && useVideos.value) {
    updateVideoSource()
  }
}

onMounted(() => {
  window.addEventListener('scroll', onScroll, { passive: true })
})

onBeforeUnmount(() => {
  window.removeEventListener('scroll', onScroll)
})
</script>

<template>
  <section id="top" class="relative min-h-screen overflow-hidden" style="margin-top: -4rem; padding-top: 4rem;">
    <!-- Background video/image layer -->
    <div aria-hidden class="absolute inset-0 z-0">
      <video
        v-if="useVideos"
        ref="videoElRef"
        :src="resolvedHeroVideo"
        class="absolute inset-0 h-full w-full object-cover"
        autoplay
        playsinline
        disablePictureInPicture
        controlsList="nodownload nofullscreen noremoteplayback"
        preload="metadata"
        muted
        @error="(event) => { console.error('Video load error:', event); useVideos = false; }"
        @loadstart="videoLoading = true"
        @canplay="videoLoading = false"
        @ended="onVideoEnded">
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
            <span class="font-medium">Fast, friendly local garage</span>
            <span class="hidden rounded-sm bg-[#FFD700]/20 px-1.5 py-0.5 text-[#FFD700] md:inline">Complimentary tyre safety
              check — ask in store</span>
          </div>

          <!-- Headline -->
          <h1 class="text-balance text-5xl font-extrabold leading-tight tracking-tight sm:text-6xl">
            <span class="text-[#FFD700]">Your trusted</span> local Tyre & MOT experts in Hawick
          </h1>
          <p class="mt-4 max-w-[65ch] text-lg text-neutral-200">
            Same‑day tyres and MOT preparation with honest advice and fair pricing. Servicing, diagnostics and
            batteries — all under one roof.
          </p>

          <!-- CTAs -->
          <div class="mt-7 flex flex-wrap gap-3">
            <a :href="`tel:${phone.replace(/\s+/g, '')}`"
              class="sheen inline-flex items-center gap-2 rounded-md bg-[#FFD700] px-5 py-2.5 text-sm font-extrabold text-black shadow-lg hover:brightness-95"
              aria-label="Call Teviot Tyres">
              <Phone class="h-4 w-4" />
              <span>Call {{ phone }}</span>
            </a>
            <Link href="/services"
              class="inline-flex items-center gap-2 rounded-md border border-neutral-700/80 bg-black/40 px-5 py-2.5 text-sm font-medium text-white backdrop-blur hover:bg-black/50 shadow-md"
              aria-label="View services">
              <Tools class="h-4 w-4" />
              <span>View Services</span>
            </Link>
            <a :href="`https://maps.google.com/?q=Unit%2010,%20Lochpark%20Industrial%20Estate,%20Hawick%20TD9%209JA`"
              target="_blank" rel="noopener"
              class="inline-flex items-center gap-2 rounded-md border border-neutral-700/80 bg-black/40 px-5 py-2.5 text-sm font-medium text-white backdrop-blur hover:bg-black/50 shadow-md"
              aria-label="Get directions">
              <MapPin class="h-4 w-4" />
              <span>Directions</span>
            </a>
          </div>

          <!-- Stats -->
          <div class="mt-7 grid max-w-lg grid-cols-3 gap-3 text-center">
            <div class="group relative rounded-xl border border-neutral-800/70 bg-gradient-to-br from-neutral-900/60 to-black/40 p-4 backdrop-blur-sm hover:border-[#FFD700]/50 hover:from-[#FFD700]/10 hover:to-amber-900/20 transition-all duration-300">
              <div class="w-8 h-8 rounded-lg bg-[#FFD700]/20 flex items-center justify-center mb-2 mx-auto group-hover:bg-[#FFD700]/30 transition-colors duration-300">
                <Tools class="h-4 w-4 text-[#FFD700]" />
              </div>
              <div class="text-base font-semibold text-white">Same‑day</div>
              <div class="text-sm text-neutral-300">Tyres</div>
            </div>
            <div class="group relative rounded-xl border border-neutral-800/70 bg-gradient-to-br from-neutral-900/60 to-black/40 p-4 backdrop-blur-sm hover:border-[#FFD700]/50 hover:from-[#FFD700]/10 hover:to-amber-900/20 transition-all duration-300">
              <div class="w-8 h-8 rounded-lg bg-[#FFD700]/20 flex items-center justify-center mb-2 mx-auto group-hover:bg-[#FFD700]/30 transition-colors duration-300">
                <CheckCircle class="h-4 w-4 text-[#FFD700]" />
              </div>
              <div class="text-base font-semibold text-white">MOT</div>
              <div class="text-sm text-neutral-300">Preparation</div>
            </div>
            <div class="group relative rounded-xl border border-neutral-800/70 bg-gradient-to-br from-neutral-900/60 to-black/40 p-4 backdrop-blur-sm hover:border-[#FFD700]/50 hover:from-[#FFD700]/10 hover:to-amber-900/20 transition-all duration-300">
              <div class="w-8 h-8 rounded-lg bg-[#FFD700]/20 flex items-center justify-center mb-2 mx-auto group-hover:bg-[#FFD700]/30 transition-colors duration-300">
                <Star class="h-4 w-4 text-[#FFD700]" />
              </div>
              <div class="text-base font-semibold text-white">100% Recommend</div>
              <div class="text-sm text-neutral-300">Facebook</div>
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

</template>
