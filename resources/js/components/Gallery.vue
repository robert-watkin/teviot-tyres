<script setup lang="ts">
interface ImageItem {
  src: string;
  alt?: string;
  href?: string;
  caption?: string;
}

interface Props {
  images: ImageItem[];
}

const props = defineProps<Props>();
</script>

<template>
  <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 md:grid-cols-4">
    <template v-for="(img, i) in props.images" :key="i">
      <a :href="img.href || img.src" target="_blank" rel="noopener"
         class="group block overflow-hidden rounded-lg border border-neutral-800 bg-neutral-950">
        <div class="relative aspect-[4/3] w-full">
          <img :src="img.src" :alt="img.alt || ''" class="absolute inset-0 h-full w-full object-cover transition duration-700 group-hover:scale-105" />
          <div v-if="img.caption" class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/60 to-transparent p-2 text-xs text-neutral-200">
            {{ img.caption }}
          </div>
        </div>
      </a>
    </template>
  </div>
</template>
