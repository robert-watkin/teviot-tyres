<script setup lang="ts">
import { ShieldCheck, BadgeCheck, Handshake } from 'lucide-vue-next';
</script>

<template>
  <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
    <div class="flex items-center gap-3 rounded-lg border border-neutral-800 bg-neutral-950 p-4">
      <ShieldCheck class="h-5 w-5 text-[#FFD700]" />
      <div>
        <p class="text-sm font-semibold text-white">MOT preparation & checks</p>
        <p class="text-xs text-neutral-400">Repairs and advice</p>
      </div>
    </div>
    <div class="flex items-center gap-3 rounded-lg border border-neutral-800 bg-neutral-950 p-4">
      <BadgeCheck class="h-5 w-5 text-[#FFD700]" />
      <div>
        <p class="text-sm font-semibold text-white">Complimentary tyre safety check</p>
        <p class="text-xs text-neutral-400">Ask in store</p>
      </div>
    </div>
    <div class="flex items-center gap-3 rounded-lg border border-neutral-800 bg-neutral-950 p-4">
      <Handshake class="h-5 w-5 text-[#FFD700]" />
      <div>
        <p class="text-sm font-semibold text-white">Friendly, local team</p>
        <p class="text-xs text-neutral-400">Honest advice & fair pricing</p>
      </div>
    </div>
  </div>
</template>
