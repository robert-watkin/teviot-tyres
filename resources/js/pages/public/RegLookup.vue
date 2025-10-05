<script setup lang="ts">
import PublicLayout from '@/layouts/public/PublicLayout.vue';
import { Head, usePage, useForm } from '@inertiajs/vue3';
import { computed, onMounted } from 'vue';
import Reveal from '@/components/Reveal.vue';
import { CheckCircle, Shield, CreditCard, Phone } from '@iconoir/vue';
import reg from '@/routes/reg';

interface VehicleData {
  registration: string;
  make: string;
  colour: string;
  fuel_type: string;
  year_of_manufacture: number | string;
  engine_capacity?: number;
  co2_emissions?: number;
  tax_status: string;
  tax_due_date?: string;
  mot_status: string;
  month_of_first_registration?: string;
  marked_for_export: boolean;
  euro_status?: string;
}

interface Props {
  vehicle?: VehicleData | null;
  searched?: boolean;
}

const props = withDefaults(defineProps<Props>(), {
  vehicle: null,
  searched: false,
});

const page = usePage();
const isAuthed = computed(() => !!page.props.auth?.user);
const site = computed(() => (page.props as any).site || {});
const phone = computed(() => site.value.phone || '01450 374875');

const form = useForm({
  registration: '',
});

const submit = () => {
  form.post(reg.lookup.search.url(), {
    preserveScroll: true,
  });
};

const formatEngineSize = (cc?: number) => {
  if (!cc) return 'N/A';
  return `${cc}cc (${(cc / 1000).toFixed(1)}L)`;
};

// Handle query parameters from hero form
onMounted(() => {
  const urlParams = new URLSearchParams(window.location.search);
  const registration = urlParams.get('registration');
  const autoSubmit = urlParams.get('autoSubmit');
  
  if (registration) {
    form.registration = registration;
    
    // Auto-submit if flag is set
    if (autoSubmit === '1' && !props.vehicle) {
      // Small delay to ensure UI is ready
      setTimeout(() => {
        submit();
      }, 100);
    }
  }
});
</script>

<template>
  <PublicLayout title="Reg Lookup">
    <Head title="Reg Lookup" />
    <section class="mx-auto w-full max-w-4xl px-4 py-16">
      <Reveal mode="up">
        <h1 class="text-3xl font-bold tracking-tight sm:text-4xl">
          <span class="text-[#FFD700]">Registration</span> Lookup
        </h1>
        <p class="mt-2 text-neutral-300">
          Enter your vehicle registration for instant DVLA details including make, model, tax status, and MOT information.
        </p>

        <!-- Search Form -->
        <form @submit.prevent="submit" class="mt-8">
          <div class="flex gap-3">
            <div class="flex-1">
              <input 
                v-model="form.registration" 
                type="text" 
                placeholder="e.g. AB12 CDE" 
                maxlength="8"
                class="w-full rounded-lg border border-neutral-800 bg-black/50 px-4 py-3 text-sm uppercase outline-none ring-2 ring-transparent placeholder:text-neutral-500 focus:border-[#FFD700]/50 focus:ring-[#FFD700]/20 transition-all"
                :disabled="form.processing"
              />
              <p v-if="form.errors.registration" class="mt-2 text-sm text-red-400">
                {{ form.errors.registration }}
              </p>
            </div>
            <button 
              type="submit" 
              :disabled="form.processing"
              class="relative rounded-lg bg-[#FFD700] px-6 py-3 text-sm font-semibold text-black hover:brightness-95 disabled:opacity-50 disabled:cursor-not-allowed transition-all overflow-hidden"
            >
              <span v-if="!form.processing" class="flex items-center gap-2">
                <span>Search</span>
              </span>
              <span v-else class="flex items-center gap-2">
                <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>Searching...</span>
              </span>
            </button>
          </div>
        </form>
      </Reveal>

      <!-- Loading State -->
      <Reveal v-if="form.processing" mode="up" :delay="60">
        <div class="mt-8 rounded-xl border border-[#FFD700]/30 bg-gradient-to-br from-neutral-900 to-neutral-950 p-12 text-center shadow-lg">
          <!-- Animated Spinner -->
          <div class="relative mx-auto w-20 h-20">
            <!-- Outer ring -->
            <div class="absolute inset-0 rounded-full border-4 border-neutral-800"></div>
            <!-- Spinning ring -->
            <div class="absolute inset-0 animate-spin rounded-full border-4 border-transparent border-t-[#FFD700] border-r-[#FFD700]"></div>
            <!-- Inner pulsing dot -->
            <div class="absolute inset-0 flex items-center justify-center">
              <div class="h-3 w-3 animate-pulse rounded-full bg-[#FFD700]"></div>
            </div>
          </div>
          
          <!-- Loading Text -->
          <div class="mt-6 space-y-2">
            <p class="text-lg font-semibold text-white">Looking up vehicle details</p>
            <p class="text-sm text-neutral-400">Connecting to DVLA database...</p>
          </div>
          
          <!-- Animated dots -->
          <div class="mt-4 flex justify-center gap-1">
            <div class="h-2 w-2 animate-bounce rounded-full bg-[#FFD700] [animation-delay:-0.3s]"></div>
            <div class="h-2 w-2 animate-bounce rounded-full bg-[#FFD700] [animation-delay:-0.15s]"></div>
            <div class="h-2 w-2 animate-bounce rounded-full bg-[#FFD700]"></div>
          </div>
        </div>
      </Reveal>

      <!-- Vehicle Results -->
      <Reveal v-if="props.vehicle && !form.processing" mode="up" :delay="120">
        <div class="mt-8 rounded-xl border border-[#FFD700]/30 bg-gradient-to-br from-neutral-900 to-neutral-950 p-6 shadow-lg animate-in fade-in duration-500">
          <!-- Header -->
          <div class="flex items-center justify-between border-b border-neutral-800 pb-4">
            <div>
              <h2 class="text-2xl font-bold text-white">{{ props.vehicle.registration }}</h2>
              <p class="mt-1 text-neutral-400">{{ props.vehicle.make }} • {{ props.vehicle.year_of_manufacture }}</p>
            </div>
            <div class="rounded-full bg-[#FFD700]/20 p-3 animate-pulse">
              <CheckCircle class="h-6 w-6 text-[#FFD700]" />
            </div>
          </div>

          <!-- Vehicle Details Grid -->
          <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Make & Year -->
            <div class="rounded-lg border border-neutral-800 bg-neutral-900/50 p-4 transition-all hover:border-[#FFD700]/30 hover:bg-neutral-900/70">
              <p class="text-xs text-neutral-500 uppercase tracking-wide">Make & Year</p>
              <p class="mt-1 text-lg font-semibold text-white">{{ props.vehicle.make }}</p>
              <p class="text-sm text-neutral-400">{{ props.vehicle.year_of_manufacture }}</p>
            </div>

            <!-- Colour -->
            <div class="rounded-lg border border-neutral-800 bg-neutral-900/50 p-4 transition-all hover:border-[#FFD700]/30 hover:bg-neutral-900/70">
              <p class="text-xs text-neutral-500 uppercase tracking-wide">Colour</p>
              <p class="mt-1 text-lg font-semibold text-white">{{ props.vehicle.colour }}</p>
            </div>

            <!-- Fuel Type -->
            <div class="rounded-lg border border-neutral-800 bg-neutral-900/50 p-4 transition-all hover:border-[#FFD700]/30 hover:bg-neutral-900/70">
              <p class="text-xs text-neutral-500 uppercase tracking-wide">Fuel Type</p>
              <p class="mt-1 text-lg font-semibold text-white">{{ props.vehicle.fuel_type }}</p>
            </div>

            <!-- Engine Size -->
            <div class="rounded-lg border border-neutral-800 bg-neutral-900/50 p-4 transition-all hover:border-[#FFD700]/30 hover:bg-neutral-900/70">
              <p class="text-xs text-neutral-500 uppercase tracking-wide">Engine Size</p>
              <p class="mt-1 text-lg font-semibold text-white">{{ formatEngineSize(props.vehicle.engine_capacity) }}</p>
            </div>

            <!-- Tax Status -->
            <div class="rounded-lg border border-neutral-800 bg-neutral-900/50 p-4 transition-all hover:border-[#FFD700]/30 hover:bg-neutral-900/70">
              <p class="text-xs text-neutral-500 uppercase tracking-wide">Tax Status</p>
              <p class="mt-1 text-lg font-semibold" :class="props.vehicle.tax_status === 'Taxed' ? 'text-green-400' : 'text-red-400'">
                {{ props.vehicle.tax_status }}
              </p>
              <p v-if="props.vehicle.tax_due_date" class="text-sm text-neutral-400">Due: {{ props.vehicle.tax_due_date }}</p>
            </div>

            <!-- MOT Status -->
            <div class="rounded-lg border border-neutral-800 bg-neutral-900/50 p-4 transition-all hover:border-[#FFD700]/30 hover:bg-neutral-900/70">
              <p class="text-xs text-neutral-500 uppercase tracking-wide">MOT Status</p>
              <p class="mt-1 text-lg font-semibold text-white">{{ props.vehicle.mot_status }}</p>
            </div>

            <!-- CO2 Emissions (if available) -->
            <div v-if="props.vehicle.co2_emissions" class="rounded-lg border border-neutral-800 bg-neutral-900/50 p-4 transition-all hover:border-[#FFD700]/30 hover:bg-neutral-900/70">
              <p class="text-xs text-neutral-500 uppercase tracking-wide">CO₂ Emissions</p>
              <p class="mt-1 text-lg font-semibold text-white">{{ props.vehicle.co2_emissions }}g/km</p>
            </div>

            <!-- Euro Status (if available) -->
            <div v-if="props.vehicle.euro_status" class="rounded-lg border border-neutral-800 bg-neutral-900/50 p-4 transition-all hover:border-[#FFD700]/30 hover:bg-neutral-900/70">
              <p class="text-xs text-neutral-500 uppercase tracking-wide">Euro Status</p>
              <p class="mt-1 text-lg font-semibold text-white">{{ props.vehicle.euro_status }}</p>
            </div>
          </div>

          <!-- Call to Action -->
          <div class="mt-6 rounded-lg border border-neutral-800 bg-neutral-900/50 p-6">
            <div class="flex items-start gap-4">
              <div class="rounded-lg bg-[#FFD700]/20 p-3">
                <Phone class="h-6 w-6 text-[#FFD700]" />
              </div>
              <div class="flex-1">
                <h3 class="text-lg font-semibold text-white">Need tyres or service for this vehicle?</h3>
                <p class="mt-1 text-sm text-neutral-400">Call us now for a quote or to book an appointment</p>
                <a 
                  :href="`tel:${phone.replace(/\s+/g, '')}`" 
                  class="mt-4 inline-flex items-center gap-2 rounded-lg bg-[#FFD700] px-5 py-2.5 text-sm font-semibold text-black hover:brightness-95 transition-all"
                >
                  <Phone class="h-4 w-4" />
                  <span>Call {{ phone }}</span>
                </a>
              </div>
            </div>
          </div>

          <!-- Save to Account (if logged in) -->
          <div v-if="isAuthed" class="mt-4 rounded-lg border border-neutral-800 bg-neutral-900/50 p-4 text-sm text-neutral-400">
            <p>✓ You're logged in. Vehicle saving feature coming soon!</p>
          </div>
          <div v-else class="mt-4 rounded-lg border border-neutral-800 bg-neutral-900/50 p-4 text-sm text-neutral-400">
            <p>Want to save this vehicle? <a href="/register" class="font-semibold text-[#FFD700] hover:underline">Create an account</a> or <a href="/login" class="font-semibold text-[#FFD700] hover:underline">log in</a>.</p>
          </div>
        </div>
      </Reveal>

      <!-- Info Cards (shown when no results) -->
      <Reveal v-if="!props.vehicle && !form.processing && !props.searched" mode="up" :delay="120">
        <div class="mt-12 grid gap-6 md:grid-cols-2">
          <div class="rounded-xl border border-neutral-800 bg-neutral-950 p-6">
            <div class="flex items-center gap-3 text-[#FFD700]">
              <Shield class="h-6 w-6" />
              <h3 class="text-lg font-semibold">DVLA Data</h3>
            </div>
            <p class="mt-3 text-sm text-neutral-400">
              Get official vehicle information directly from the DVLA including make, model, tax status, MOT status, and more.
            </p>
          </div>

          <div class="rounded-xl border border-neutral-800 bg-neutral-950 p-6">
            <div class="flex items-center gap-3 text-[#FFD700]">
              <CreditCard class="h-6 w-6" />
              <h3 class="text-lg font-semibold">Quick Quote</h3>
            </div>
            <p class="mt-3 text-sm text-neutral-400">
              Once you've looked up your vehicle, call us for an instant quote on tyres, servicing, or MOT preparation.
            </p>
          </div>
        </div>
      </Reveal>
    </section>
  </PublicLayout>
</template>
