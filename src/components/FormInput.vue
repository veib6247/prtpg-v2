<script setup>
/**
 * define props here
 */
defineProps({
  inputType: {
    type: String,
    default: 'text',
  },

  inputId: {
    type: String,
    required: true,
  },

  inputLabel: {
    type: String,
    required: true,
  },

  inputPlaceholder: {
    type: String,
  },

  modelValue: {
    type: String,
  },
})

/**
 * Emits
 */
defineEmits(['update:modelValue'])
</script>

<template>
  <div class="form-floating mb-3">
    <input
      :type="inputType"
      class="form-control font-monospace"
      :id="inputId"
      :placeholder="inputPlaceholder"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
    />

    <label :for="inputId" class="form-label">
      {{ inputLabel }}
    </label>
  </div>
</template>
