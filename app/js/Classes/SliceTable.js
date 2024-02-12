export { SliceTable };

class SliceTable {
  constructor(data, whatLookFor, whereLoookFor) {
    this.data = data;
    this.whereLoookFor = whereLoookFor;
    this.whatLookFor = whatLookFor;
  }

  #sliceDataByPattern() {
    let arr = Array();
    const regexp = new RegExp(`^${this.whatLookFor}`, "i");

    for (const row of this.data) {
      if (regexp.test(row[this.whereLoookFor])) {
        arr.push(row);
      }
    }
    return arr;
  }

  getNewData() {
    return this.#sliceDataByPattern();
  }
}