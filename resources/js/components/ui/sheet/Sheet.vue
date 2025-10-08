<script setup lang="ts">
import { DialogRoot, type DialogRootEmits, type DialogRootProps, useForwardPropsEmits } from 'reka-ui'
import { computed } from 'vue'

const props = defineProps<DialogRootProps>()
const emits = defineEmits<DialogRootEmits>()

const forwarded = useForwardPropsEmits(props, emits)

const modelValue = computed({
  get: () => forwarded.value.open ?? false,
  set: (value: boolean) => emits('update:open', value)
})
</script>

<template>
  <DialogRoot
    data-slot="sheet"
    v-bind="forwarded"
    v-model:open="modelValue"
  >
    <slot :open="modelValue" />
  </DialogRoot>
</template>
