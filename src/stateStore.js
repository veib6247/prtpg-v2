/**
 * main state manager across all component for easy usage
 */
import { reactive } from 'vue'

export const request = reactive({
  partnerId: '',
  username: '',
  memberId: '',
  totype: '',
  amount: '1.00',
  merchantTransactionId: '',
  merchantRedirectUrl: '',
  secureKey: '',
})
