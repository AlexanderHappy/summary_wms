export { CreateTable };

class CreateTable { 
  pagination = document.querySelector('#pagination');
  table = document.querySelector('#myTable');
  tbody = this.table.createTBody();
  liObjects = [];

  constructor(rowNumber, json_data) {
    this.rowNumber = rowNumber;
    this.json_data = json_data;
    this.usersLength = json_data.length;
    this.numbersPages = Math.ceil(this.usersLength / this.rowNumber);
  }
  
  #renderPagination() {
    for (let pageNum = 1; pageNum <= this.numbersPages; pageNum++) {
      let li = document.createElement('li');
      li.innerHTML = pageNum;
      this.pagination.appendChild(li);
      this.liObjects.push(li);
    }
    
    // Отрисовка первой части данных из БД при открытие страницы.
    this.#renderTBody(this.liObjects[0]);

    this.liObjects.forEach((liObject) => {
      liObject.addEventListener('click', () => {
        this.#renderTBody(liObject);
      });
    });
  }

  #renderTHead() {
    let trTHead = this.table.createTHead().insertRow();
    let namesOfColums = Object.keys(this.json_data[0]);

    for (const name of namesOfColums) {
      let th = document.createElement('th');
      th.innerHTML = name;
      trTHead.appendChild(th);
    }
  }

  #renderTBody(liObject) {
    const pageNum = +liObject.innerHTML;

    const start = (pageNum - 1) * this.rowNumber;
    const end = start + this.rowNumber;

    const data = this.json_data.slice(start, end);
    this.tbody.innerHTML = '';

    for (const good of data) {
      let tr = this.tbody.insertRow();
      for (const info in good) {
        let td = document.createElement('td');
        td.innerHTML = good[info];
        tr.appendChild(td);
      }
    }
  }

  renderTable() {
    this.#renderTHead();
    this.#renderPagination();
    this.#renderTBody();
  }
}