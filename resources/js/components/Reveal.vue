<script setup lang="ts">
import { onMounted, ref } from 'vue';

interface Props {
  as?: string;
  once?: boolean;
  delay?: number; // ms
  mode?: 'up' | 'fade' | 'scale';
}

const props = withDefaults(defineProps<Props>(), {
  as: 'div',
  once: true,
  delay: 0,
  mode: 'up',
});

const isVisible = ref(false);
const root = ref<HTMLElement | null>(null);

onMounted(() => {
  const el = root.value;
  if (!el || typeof window === 'undefined') return;
  // Respect reduced motion
  const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (prefersReduced) {
    isVisible.value = true;
    return;
  }
  const io = new IntersectionObserver(
    (entries) => {
      for (const entry of entries) {
        if (entry.isIntersecting) {
          window.setTimeout(() => (isVisible.value = true), props.delay);
          if (props.once) io.disconnect();
          break;
        }
      }
    },
    { threshold: 0.15 },
  );
  io.observe(el);
});
</script>

<template>
  <component
    :is="as"
    ref="root"
    :class="[
      'transition duration-700 will-change-transform',
      mode === 'up' && !isVisible && 'translate-y-3 opacity-0',
      mode === 'up' && isVisible && 'translate-y-0 opacity-100',
      mode === 'fade' && !isVisible && 'opacity-0',
      mode === 'fade' && isVisible && 'opacity-100',
      mode === 'scale' && !isVisible && 'scale-[0.98] opacity-0',
      mode === 'scale' && isVisible && 'scale-100 opacity-100',
    ]"
  >
    <slot />
  </component>
</template>
