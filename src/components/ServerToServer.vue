<script setup>
// state manager
import { request } from '../stateStore.js'
</script>

<template>
  <div class="card">
    <div class="card-body">
      <h1>Ahoy!</h1>
      merchantTransactionId: {{ request.merchantTransactionId }}
    </div>
  </div>
</template>
