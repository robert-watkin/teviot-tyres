<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import { Shield, ArrowRight } from '@iconoir/vue'
import Reveal from '../Reveal.vue'
</script>

<template>
  <!-- Reg Lookup Section -->
  <section class="relative bg-gradient-to-br from-blue-950/20 via-neutral-950 to-neutral-900">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_80%,rgba(59,130,246,0.1),transparent_50%)]"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_20%,rgba(59,130,246,0.05),transparent_50%)]"></div>

    <div class="relative mx-auto w-full max-w-7xl px-4 py-24">
      <Reveal mode="up">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold mb-4">
            <span class="text-blue-400">Quick Vehicle Check</span>
          </h2>
          <p class="text-xl text-neutral-300 max-w-3xl mx-auto">
            Enter your registration for instant vehicle information. Create an account to save your vehicles for future reference.
          </p>
        </div>
      </Reveal>

      <div class="max-w-2xl mx-auto">
        <Reveal mode="up" :delay="120">
          <div class="relative rounded-2xl border border-blue-800/30 bg-gradient-to-br from-blue-900/20 to-neutral-900/80 p-8 backdrop-blur-sm">
            <form action="/reg-lookup" method="get" class="space-y-6" aria-label="Vehicle registration lookup">
              <div>
                <label for="hero-reg" class="block text-sm font-medium text-neutral-300 mb-2">
                  Vehicle Registration
                </label>
                <input
                  id="hero-reg"
                  name="reg"
                  inputmode="text"
                  autocomplete="on"
                  placeholder="e.g. AB12 CDE"
                  class="w-full rounded-xl border border-neutral-700 bg-neutral-900/50 px-4 py-3 text-white placeholder-neutral-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 backdrop-blur-sm"
                  required
                />
              </div>

              <button
                type="submit"
                class="w-full rounded-xl bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-3 text-white font-semibold hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center gap-2 group"
              >
                <span>Search Vehicle</span>
                <ArrowRight class="h-4 w-4 group-hover:translate-x-1 transition-transform duration-300" />
              </button>
            </form>

            <div class="mt-6 pt-6 border-t border-neutral-700">
              <div class="flex items-start gap-3 text-sm text-neutral-400">
                <Shield class="h-4 w-4 text-blue-400 mt-0.5 flex-shrink-0" />
                <div>
                  <p class="mb-2">Powered by DVLA Vehicle Enquiry Service</p>
                  <p>By using this lookup you agree to our <Link href="/privacy" class="text-blue-400 hover:text-blue-300 underline">privacy policy</Link></p>
                </div>
              </div>
            </div>
          </div>
        </Reveal>
      </div>
    </div>
  </section>
</template>
