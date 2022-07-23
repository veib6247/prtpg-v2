/**
 * main state manager across all component for easy usage
 */
import { reactive } from 'vue'

export const request = reactive({
  memberId: '',
  totype: '',
  amount: '1.00',
  merchantTransactionId: '',
  merchantRedirectUrl: 'https://prtpg.herokuapp.com/display_request_result.php',
  secureKey: '',
})
