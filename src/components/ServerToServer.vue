<script setup>
// utils
import { ref, reactive, onMounted } from 'vue'
import {
  getSubdomain,
  formatParams,
  generateHash,
} from '../utils/stringFormatters.js'

// state manager
import { request } from '../stateStore.js'

// reuseable components
import FormInput from '../components/FormInput.vue'
import FormInputTrxIdGen from '../components/FormInputTrxIdGen.vue'
import FormAlert from '../components/FormAlert.vue'
import FormText from '../components/FormText.vue'

// local vars
const endPoint = ref(
  'https://preprod.prtpg.com/transactionServices/REST/v1/payments'
)
const response = reactive({ data: {} })
const showTokenErrorMsg = ref(false)
const isLoading = ref(false)
const parameters = ref('')
const defaultParameters = ref([
  'orderDescriptor=This is a REST API test transaction.',
  'shipping.country=PH',
  'shipping.city=Makati',
  'shipping.state=NCR',
  'shipping.postcode=1227',
  'shipping.street1=Valero',
  'customer.telnocc=63',
  'customer.phone=9294112356',
  'customer.email=flex.gateway@payreto.com',
  'customer.givenName=John',
  'customer.surname=Wick',
  'customer.birthDate=19930528',
  'customer.ip=192.168.0.1',
  'card.number=4111110000000021',
  'card.expiryMonth=12',
  'card.expiryYear=2030',
  'card.cvv=123',
  'currency=REPLACE_ME',
  'paymentBrand=REPLACE_ME',
  'paymentMode=REPLACE_ME',
  'paymentType=REPLACE_ME',
  'authentication.terminalId=REPLACE_ME',
])

/**
 * Mounted method here
 */
onMounted(() => {
  // format default params on mount to fit into text area
  parameters.value = formatParams(defaultParameters.value, '\n')
})

/**
 * Generate the auth token
 * @returns {boolean} determines if the token was generated or not
 */
async function getAuthToken() {
  // response and error states
  showTokenErrorMsg.value = false
  response.data = {}

  try {
    // using fetch to hit API
    const rawResponse = await fetch('./php/generate_auth.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        subDomain: getSubdomain(endPoint.value),
        partnerId: request.partnerId,
        username: request.username,
        sKey: request.secureKey,
      }),
    })

    // parse response into json
    response.data = await rawResponse.json()

    // if AuthToken exists, autofill the member ID and notify user
    if (response.data.AuthToken) {
      // display generated token to the user in console
      console.info('Token Generation API Response:', response.data)
      // set member ID
      request.memberId = response.data.memberId
      return true
    } else {
      // set error values and clear memberId
      showTokenErrorMsg.value = true
      request.memberId = ''
      return false
    }
  } catch (error) {
    console.error(error)
    return false
  }
}

/**
 * Submit transaction
 */
async function submitServerToServer() {
  try {
    // start loading animation
    isLoading.value = true

    // check if token is generated successfully, else do nothing, become British
    if (await getAuthToken()) {
      console.log('EUREKA!')
    } else {
      console.error("Bullocks! I can't believe you've done this.")
    }
  } catch (err) {
    console.error(err)
  } finally {
    isLoading.value = false
  }
}
</script>

<template>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Server-to-Server</h5>
      <h6 class="card-subtitle mb-2 text-muted fs-6">
        In a synchronous workflow, the payment data are directly sent to the
        server with initial payment request. That means that the transaction can
        be processed straight away.
      </h6>

      <hr />

      <FormInput
        input-id="endpoint"
        input-label="API Endpoint"
        input-placeholder="https://preprod.prtpg.com/transaction/Checkout"
        v-model="endPoint"
        helper-text-id="endpointHelper"
        helper-text="Change the subdomain to 'secure' for a live transaction."
      />

      <FormInput
        input-id="partnerId"
        input-label="Partner ID"
        input-placeholder="421"
        v-model="request.partnerId"
        helper-text-id="partnerIdHelper"
        helper-text="The Partner's unique ID, this is assigned by the gateway provider."
      />

      <FormInput
        input-id="username"
        input-label="Merchant Username"
        input-placeholder="421"
        v-model="request.username"
        helper-text-id="usernameHelper"
        helper-text="This is assigned by the gateway provider."
      />

      <FormInput
        input-id="secureKey"
        input-type="password"
        input-label="Merchant Secure Key"
        input-placeholder="XXXXXXXXX"
        v-model="request.secureKey"
      />

      <FormInput
        input-id="memberId"
        input-label="Member ID"
        input-placeholder="12598"
        v-model="request.memberId"
        helper-text-id="memberIdHelper"
        helper-text="Merchant's unique ID, this is assigned by the gateway provider."
      />

      <FormInputTrxIdGen
        input-id="merchantTransactionId"
        input-label="Merchant Transaction ID"
        input-placeholder="test_transaction_0001"
        v-model="request.merchantTransactionId"
        helper-text-id="merchantTransactionIdHelper"
        helper-text="This is auto-generated by the app on page-load. Click the 'New' button to generate a new one."
      />

      <FormInput
        input-id="amount"
        input-label="Amount"
        input-placeholder="1.00"
        v-model="request.amount"
      />

      <FormInput
        input-id="merchantRedirectUrl"
        input-label="Merchant Redirect URL"
        input-placeholder="https://prtpg.herokuapp.com/display_request_result.php"
        v-model="request.merchantRedirectUrl"
        helper-text-id="merchantRedirectUrlHelper"
        helper-text="The customer is redirected here for async (3DS, APM, etc.) transactions."
      />

      <FormText
        text-id="parameters"
        text-label="Parameters"
        :text-height="500"
        v-model="parameters"
      />

      <div class="mb-3">
        <button
          type="button"
          class="btn btn-dark"
          @click="submitServerToServer"
        >
          Submit
          <span
            class="spinner-grow spinner-grow-sm"
            role="status"
            aria-hidden="true"
            v-if="isLoading"
          ></span>
        </button>
      </div>

      <!-- display alerts re. token generation -->
      <!-- for success -->
      <Transition>
        <FormAlert
          alert-type="alert-success"
          :heading="response.data.result.code"
          :subtitle="response.data.result.description"
          :footer="`Timestamp: ${response.data.timestamp}`"
          v-if="response.data.AuthToken"
        />
      </Transition>

      <!-- for failed -->
      <Transition>
        <FormAlert
          alert-type="alert-danger"
          :heading="response.data.result.code"
          :subtitle="response.data.result.description"
          v-if="showTokenErrorMsg"
        />
      </Transition>
    </div>
  </div>
</template>
