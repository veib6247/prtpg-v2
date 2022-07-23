<script setup>
// utils
import { nanoid } from 'nanoid'

// init state manager before all other components use it
import { request } from './../stateStore.js'

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

  helperTextId: {
    type: String,
  },

  helperText: {
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

/**
 * update merchantTransactionId state on click
 */
function generateNewMerchantTransactionId() {
  request.merchantTransactionId = nanoid()
}
</script>

<template>
  <!-- wrapper to include the bottom margin -->
  <div class="mb-3">
    <!-- main group -->
    <div class="input-group">
      <!-- floating label for input -->
      <div class="form-floating">
        <input
          :type="inputType"
          class="form-control font-monospace"
          :aria-describedby="helperTextId"
          :id="inputId"
          :placeholder="inputPlaceholder"
          :value="modelValue"
          @input="$emit('update:modelValue', $event.target.value)"
        />

        <label :for="inputId" class="form-label">
          {{ inputLabel }}
        </label>
      </div>

      <!-- generate button -->
      <button
        class="btn btn-dark"
        type="button"
        @click="generateNewMerchantTransactionId"
      >
        New
      </button>
    </div>

    <!-- helper text outside the group -->
    <div :id="helperTextId" class="form-text" v-if="helperText">
      {{ helperText }}
    </div>
  </div>
</template>
