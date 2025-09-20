<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'
import { Phone, MapPin } from '@iconoir/vue'
import AppLogoIcon from '../AppLogoIcon.vue'

const page = usePage()
const site = computed(() => (page.props as any).site || {})
const phone = computed(() => site.value.phone || '01450 374875')
</script>

<template>
  <!-- Footer -->
  <footer class="relative bg-neutral-950 border-t border-neutral-800">
    <div class="mx-auto w-full max-w-7xl px-4 py-12">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <!-- Company Info -->
        <div class="md:col-span-2">
          <div class="flex items-center gap-3 mb-4">
            <AppLogoIcon class="size-8 text-[#FFD700]" />
            <span class="text-xl font-bold text-white">Teviot Tyres</span>
          </div>
          <p class="text-neutral-300 mb-4 max-w-md">
            Your trusted local garage in Hawick. Same-day tyres, MOT testing, and expert automotive repairs with honest advice and fair pricing.
          </p>
          <div class="flex items-center gap-4 text-sm text-neutral-400">
            <span>Mon–Fri: 9:00–17:00</span>
            <span>Sat: 9:00–13:00</span>
          </div>
        </div>

        <!-- Services -->
        <div>
          <h3 class="text-lg font-semibold text-white mb-4">Services</h3>
          <ul class="space-y-2 text-neutral-300">
            <li><Link href="/services#tyres" class="hover:text-[#FFD700] transition-colors">Tyres & Fitting</Link></li>
            <li><Link href="/services#mot-class-4-7" class="hover:text-[#FFD700] transition-colors">MOT Testing</Link></li>
            <li><Link href="/services#servicing" class="hover:text-[#FFD700] transition-colors">Vehicle Servicing</Link></li>
            <li><Link href="/services#diagnostics" class="hover:text-[#FFD700] transition-colors">Diagnostics</Link></li>
          </ul>
        </div>

        <!-- Contact -->
        <div>
          <h3 class="text-lg font-semibold text-white mb-4">Contact</h3>
          <ul class="space-y-2 text-neutral-300">
            <li class="flex items-center gap-2">
              <Phone class="h-4 w-4 text-[#FFD700]" />
              <a :href="`tel:${phone.replace(/\s+/g, '')}`" class="hover:text-[#FFD700] transition-colors">{{ phone }}</a>
            </li>
            <li class="flex items-center gap-2">
              <MapPin class="h-4 w-4 text-[#FFD700]" />
              <span>Unit 10, Lochpark Industrial Estate</span>
            </li>
            <li class="flex items-center gap-2">
              <MapPin class="h-4 w-4 text-[#FFD700]" />
              <span>Hawick TD9 9JA</span>
            </li>
          </ul>
        </div>
      </div>

      <div class="border-t border-neutral-800 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
        <p class="text-neutral-400 text-sm">
          © {{ new Date().getFullYear() }} Teviot Tyres. All rights reserved.
        </p>
        <div class="flex items-center gap-6 text-sm text-neutral-400">
          <Link href="/privacy" class="hover:text-[#FFD700] transition-colors">Privacy Policy</Link>
          <Link href="/terms" class="hover:text-[#FFD700] transition-colors">Terms of Service</Link>
        </div>
      </div>
    </div>
  </footer>
</template>
