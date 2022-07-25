<script setup>
import { computed } from 'vue'
/**
 * define props here
 */
const props = defineProps({
  textId: {
    type: String,
    required: true,
  },

  textLabel: {
    type: String,
    required: true,
  },

  textHeight: {
    type: Number,
    required: true,
  },

  modelValue: {
    type: String,
  },
})

/**
 * Emits
 */
defineEmits(['update:modelValue'])

/**
 * Bootstrap does not recommend using the 'rows' attribute for form-floating textAreas
 * @returns {string} inline height style by px.
 */
const textAreaHeight = computed(() => {
  return `height: ${props.textHeight}px`
})
</script>

<template>
  <div class="form-floating mb-3">
    <textarea
      class="form-control font-monospace"
      :id="textId"
      placeholder="[INSERT PARAMETERS HERE]"
      :style="textAreaHeight"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
    ></textarea>
    <label :for="textId">{{ textLabel }}</label>
  </div>
</template>
