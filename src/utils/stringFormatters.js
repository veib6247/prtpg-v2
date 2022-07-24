import { _ } from 'lodash'

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
