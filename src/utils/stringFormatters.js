import { _ } from 'lodash'
import md5 from 'crypto-js/md5'

/**
 * Format params into string by providing a separator
 * @param {array} arrDefault - List of parameters in array format
 * @param {string} separator - Separator for each item
 * @returns {string} Formatted string
 */
export const formatParams = (arrDefault, separator) => {
  let formattedParameters = ''

  _.forEach(arrDefault, function (param, index, array) {
    if (index === array.length - 1) {
      // on the last item, ommit separator
      formattedParameters += `${param}`
    } else {
      formattedParameters += `${param}${separator}`
    }
  })

  return formattedParameters
}

/**
 * Uses md5 module from the crypto-js package, returns md5 hash as value for the checksum
 * @returns {string} Hashed value of the required fields
 */
export const generateHash = (dataString) => {
  return md5(dataString).toString()
}
