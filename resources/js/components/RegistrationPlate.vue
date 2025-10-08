<script setup lang="ts">
interface Props {
  registration: string;
  size?: 'sm' | 'md' | 'lg';
}

const props = withDefaults(defineProps<Props>(), {
  size: 'md',
});

const sizeClasses = {
  sm: 'px-2 py-1 text-sm',
  md: 'px-3 py-1.5 text-base',
  lg: 'px-4 py-2 text-lg',
};
</script>

<template>
  <div
    :class="[
      'inline-flex items-center justify-center rounded border-2 border-black bg-[#FFD700] font-mono font-bold uppercase tracking-wider text-black shadow-md',
      sizeClasses[size]
    ]"
  >
    {{ registration }}
  </div>
</template>
