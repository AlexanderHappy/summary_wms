export { sliceTable };

function sliceTable(data, whatLookFor, whereLookFor) {
  let regexp = new RegExp();

  if (whereLookFor === 'telephone') {
    // Проверить на наличие знака + при вводе в поиске
    if (whatLookFor.substring(0, 1) === '+') {
      regexp = new RegExp(`${whatLookFor.substring(1)}`, 'i');
    } else {
      regexp = new RegExp(`${whatLookFor}`, 'i');
    }
  } else {
    regexp = new RegExp(`\^${whatLookFor}`, 'i');
  }

  let arr = Array();

  for (const row of data) {
    if (regexp.test(row[whereLookFor])) {
      arr.push(row);
    }
  }

  return arr;
}