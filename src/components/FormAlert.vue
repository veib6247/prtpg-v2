<script setup>
defineProps({
  heading: {
    type: String,
    required: true,
  },

  alertType: {
    type: String,
    required: true,
  },

  subtitle: {
    type: String,
  },
})
</script>

<template>
  <div class="alert" :class="alertType" role="alert">
    <h5 class="alert-heading">{{ heading }}</h5>
    <p v-if="subtitle">{{ subtitle }}</p>
  </div>
</template>
