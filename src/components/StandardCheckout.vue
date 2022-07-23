<script setup>
// utils
import { ref } from 'vue'

// state manager
import { request } from '../stateStore.js'

// reuseable components
import FormInput from '../components/FormInput.vue'

// local vars
const endPoint = ref('https://preprod.prtpg.com/transaction/Checkout')
</script>

<template>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Standard Checkout</h5>
      <h6 class="card-subtitle mb-2 text-muted fs-6">
        In a Standard Checkout, the merchant needs to POST the intial request to
        the Paymentz hosted checkout page where customer will provide
        card/account details. Once the payment is verified, the customer is
        redirected back to the <code>merchantRedirectUrl</code> along with the
        payment status.
      </h6>

      <hr />
      <FormInput
        input-id="endpoint"
        input-label="API Endpoint"
        input-placeholder="https://preprod.prtpg.com/transaction/Checkout"
        v-model="endPoint"
      />

      <FormInput
        input-id="memberId"
        input-label="Member ID"
        input-placeholder="12598"
        v-model="request.memberId"
      />

      <FormInput
        input-id="totype"
        input-label="To Type"
        input-placeholder="PSP Name"
        v-model="request.totype"
      />

      <FormInput
        input-id="amount"
        input-label="Amount"
        input-placeholder="1.00"
        v-model="request.amount"
      />

      <FormInput
        input-id="merchantTransactionId"
        input-label="Merchant Transaction ID"
        input-placeholder=""
        v-model="request.merchantTransactionId"
      />

      <FormInput
        input-id="merchantRedirectUrl"
        input-label="Merchant Redirect URL"
        input-placeholder=""
        v-model="request.merchantRedirectUrl"
      />

      <FormInput
        input-id="secureKey"
        input-type="password"
        input-label="Merchant Secure Key"
        input-placeholder="xhhIFmIPyChV09mbkaXrmqoC1m6DZ3bJ"
        v-model="request.secureKey"
      />
    </div>
  </div>
</template>
