export { sliceTable };

function sliceTable(data, whatLookFor, whereLoookFor) {
  let arr = Array();
  const regexp = new RegExp(`^${whatLookFor}`, 'i');

  for (const row of data) {
    if (regexp.test(row[whereLoookFor])) {
      arr.push(row);
    }
  }

  return arr;
}