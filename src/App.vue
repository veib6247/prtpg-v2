<script setup>
// utils
import { reactive, ref, computed, onMounted } from 'vue'
import { nanoid } from 'nanoid'

// init state manager before all other components use it
import { request } from './stateStore.js'

// imports for components
import Nav from './components/Nav.vue'
import Footer from './components/Footer.vue'
import StandardCheckout from './components/StandardCheckout.vue'
import ServerToServer from './components/ServerToServer.vue'
import NotFound from './components/NotFound.vue'

// local vars
const clsStdCheckout = reactive({
  active: false,
})
const clsServerToServer = reactive({
  active: false,
})

/**
 * Toggle the 'active' class for the list group
 */
function navToggle(event) {
  updateSelectedMenu(event.target.id)
}

/**
 * Updates the currently selected menu
 */
function updateSelectedMenu(hashId) {
  switch (hashId) {
    case '':
      clsStdCheckout.active = true
      clsServerToServer.active = false
      break

    case '#/':
      clsStdCheckout.active = true
      clsServerToServer.active = false
      break

    case '#/StandardCheckout':
      clsStdCheckout.active = true
      clsServerToServer.active = false
      break

    case '#/ServerToServer':
      clsStdCheckout.active = false
      clsServerToServer.active = true
      break

    default:
      clsStdCheckout.active = false
      clsServerToServer.active = false
      break
  }
}

// routes per integration
const routes = {
  '/': StandardCheckout,
  '/StandardCheckout': StandardCheckout,
  '/ServerToServer': ServerToServer,
}

// get current hash
const currentPath = ref(window.location.hash)

// returns the component based on the current hash
const currentView = computed(() => {
  return routes[currentPath.value.slice(1) || '/'] || NotFound
})

// update location hash to display correct dynamic component
window.addEventListener('hashchange', () => {
  currentPath.value = window.location.hash
})

/**
 * execute these once mounted
 */
onMounted(() => {
  // assign a merchant transaction ID
  request.merchantTransactionId = nanoid()

  // update the selected menu based on the hash in the URL
  updateSelectedMenu(currentPath.value)
})
</script>

<template>
  <!-- top section -->
  <Nav />

  <!-- main content -->
  <div class="container-lg p-4">
    <div class="row g-5">
      <!-- left column -->
      <div class="col-3 p-4">
        <!-- menu for the available integrations -->
        <div class="list-group">
          <a
            href="#/StandardCheckout"
            id="#/StandardCheckout"
            class="list-group-item list-group-item-action"
            :class="clsStdCheckout"
            @click="navToggle"
          >
            Standard Checkout
          </a>

          <a
            href="#/ServerToServer"
            id="#/ServerToServer"
            class="list-group-item list-group-item-action"
            :class="clsServerToServer"
            @click="navToggle"
          >
            Server-to-Server
          </a>

          <a href="#" class="list-group-item list-group-item-action disabled">
            Filler - For future use
          </a>
        </div>
      </div>

      <!-- right column -->
      <div class="col p-4">
        <!-- dynamic component that changes depending on the selected hash -->

        <Transition>
          <KeepAlive>
            <component :is="currentView" />
          </KeepAlive>
        </Transition>
      </div>
    </div>
  </div>

  <!-- footer -->
  <Footer />
</template>

<style>
/* Generic fast transitions */
.v-enter-active {
  transition: opacity 0.5s ease;
}
.v-enter-from,
.v-leave-to {
  opacity: 0;
}
</style>
