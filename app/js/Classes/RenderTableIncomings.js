import { RenderTable } from "./RenderTable.js";
export { RenderTableIncomings };

class RenderTableIncomings extends RenderTable {
  #renderPagination() {
    for (let pageNum = 1; pageNum <= this.numbersPages; pageNum++) {
      let li = document.createElement('li');
      li.innerHTML = pageNum;
      this.pagination.appendChild(li);
      this.liObjects.push(li);
    }

    // Вставка стрелки для пагинации слева
    let li = document.createElement('li');
    li.addEventListener('click', () => {
      this.#renderPreviousData();
    });
    li.innerHTML = "&laquo;";
    this.pagination.prepend(li);
    
    // Вставка стрелки для пагинации справа
    li = document.createElement('li');
    li.addEventListener('click', () => {
      this.#renderNextData();
    });
    li.innerHTML = "&raquo;";
    this.pagination.appendChild(li);
    
    this.liObjects.forEach((liObject) => {
      liObject.addEventListener('click', () => {
        this.#renderTBody(liObject);
      });
    });
  }

  #renderTHead() {
    let trTHead = this.table.createTHead().insertRow();
    let nameOfColumns = ['id', 'Goods', 'Suppliers', 'Total', 'Date', 'Actions'];

    for (const name of nameOfColumns) {
      if (name === 'Total') {
        let th = document.createElement('th');
        th.innerHTML = name;
        th.classList.add('total-head');
        trTHead.appendChild(th);
        continue;
      }

      let th = document.createElement('th');
      th.innerHTML = name;
      trTHead.appendChild(th);
    }
  }

  #renderTBody(liObject) {
    let active = document.querySelector('#pagination li.active');
    if (active) {
      active.classList.remove('active');
    }
    liObject.classList.add('active');

    const pageNum = +liObject.innerHTML;

    const start = (pageNum - 1) * this.rowNumber;
    const end = start + this.rowNumber;

    const data = this.json_data.slice(start, end);
    this.tbody.innerHTML = '';

    for (const incoming of data) {
      let tr = this.tbody.insertRow();
      for (const info in incoming) {
        if (info === 'created_at') {
          // Создает в элементе td два divа для create_at и updated_at
          super.renderDate(incoming, tr);
          // Создает в элементе td два divа для create_at и updated_at
          break;
        }

        if (info === 'good_name') {
          this.#renderGood(incoming, tr);
          continue;
        }

        if (info === 'supplier_name') {
          this.#renderSupplier(incoming, tr);
          continue;
        }

        if (info === 'brand' || info === 'address' || info === 'telephone') {
          continue;
        }

        if (info === 'total') {
          let td = document.createElement('td');
          td.classList.add('total');
          td.innerHTML = incoming[info];
          tr.appendChild(td);
          continue;
        }

        let td = document.createElement('td');
        td.innerHTML = incoming[info];
        tr.appendChild(td);
      }
      // В конце каждой строки создает кнопки Action - Edit и Delete
      this.#renderLink(incoming, tr);
      // В конце каждой строки создает кнопки Action - Edit и Delete
    }
  }

  #renderGood(incoming, tr) {
    let td = document.createElement('td');
    let div = document.createElement('div');

    div.innerHTML = `Name: ${incoming['good_name']}`;
    td.appendChild(div);
    tr.appendChild(td);
    
    div = document.createElement('div');
    div.innerHTML = `Brand: ${incoming['brand']}`;
    td.appendChild(div);
    tr.appendChild(td);
  }

  #renderSupplier(incoming, tr) {
    let td = document.createElement('td');
    let div = document.createElement('div');

    div.innerHTML = `Name: ${incoming['supplier_name']}`;
    td.appendChild(div);
    tr.appendChild(td);
    
    div = document.createElement('div');
    div.innerHTML = `Address: ${incoming['address']}`;
    td.appendChild(div);
    tr.appendChild(td);

    div = document.createElement('div');
    div.innerHTML = `Phone: ${incoming['telephone']}`;
    td.appendChild(div);
    tr.appendChild(td);
  }

  #renderLink(incoming, tr) {
    let td = document.createElement('td');
    td.classList.add('link-td');

    let a = document.createElement('a');
    a.classList.add('edit-link');
    a.innerHTML = '<i class="fa fa-pencil" aria-hidden="true"></i>';
    a.href = `/summary_wms/incomings/edit/${incoming['incomingId']}`;
    td.appendChild(a);
    tr.appendChild(td);
    
    a = document.createElement('a');
    a.classList.add('delete-link');
    a.innerHTML = '<i class="fa fa-trash" aria-hidden="true"></i>';
    a.href = `/summary_wms/incomings/delete/${incoming['incomingId']}`;
    td.appendChild(a);
    tr.appendChild(td);
  }

  // Метод для правой стрелки в пагинации
  #renderNextData() {
    let active = document.querySelector('#pagination li.active');
    const num = Number(active.innerHTML);
    if (num < this.liObjects.length) {
      this.#renderTBody(this.liObjects[num]);
    }
  }
  
  // Метод для левой стрелки в пагинации
  #renderPreviousData() {
    let active = document.querySelector('#pagination li.active');
    const num = Number(active.innerHTML);
    if (num != 1) {
      this.#renderTBody(this.liObjects[num - 2]);
    }
  }

  renderTable() {
    this.#renderTHead();
    this.#renderPagination();
    // this.liObjects[0] передаем для отрисовки первых строк таблицы из БД при вызове метода
    this.#renderTBody(this.liObjects[0]);
  }
}