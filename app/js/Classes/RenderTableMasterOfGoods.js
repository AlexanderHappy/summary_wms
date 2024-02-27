import { RenderTable } from "./RenderTable.js";
export { RenderTableMasterOfGoods };

class RenderTableMasterOfGoods extends RenderTable {
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
    let nameOfColumns = ['id', 'Goods', 'Brand', 'Stock', 'Date', 'Actions'];

    for (const name of nameOfColumns) {
      if (name === 'created_at') {
        let th = document.createElement('th');
        th.innerHTML = 'Date';
        trTHead.appendChild(th);
        
        th = document.createElement('th');
        th.classList.add('action-head');
        th.innerHTML = 'Action';
        trTHead.appendChild(th);
        break;
      }

      if (name === 'Stock') {
        let th = document.createElement('th');
        const capitalizedWord = name[0].toUpperCase() + name.slice(1);
        th.innerHTML = capitalizedWord;
        th.classList.add('stock-head');
        trTHead.appendChild(th);
        continue;
      }

      let th = document.createElement('th');
      const capitalizedWord = name[0].toUpperCase() + name.slice(1);
      th.innerHTML = capitalizedWord;
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

    for (const good of data) {
      let tr = this.tbody.insertRow();
      for (const info in good) {
        if (info === 'created_at') {
          // Создает в элементе td два divа для create_at и updated_at
          super.renderDate(good, tr);
          // Создает в элементе td два divа для create_at и updated_at
          break;
        }

        if (info === 'stock') {
          let td = document.createElement('td');
          td.classList.add('stock');
          td.innerHTML = good[info];
          tr.appendChild(td);
          continue;
        }

        let td = document.createElement('td');
        td.innerHTML = good[info];
        tr.appendChild(td);
      }
      // В конце каждой строки создает кнопки Action - Edit и Delete
      this.#renderLink(good, tr);
      // В конце каждой строки создает кнопки Action - Edit и Delete
    }
  }

  #renderLink(good, tr) {
    let td = document.createElement('td');
    td.classList.add('link-td');

    let a = document.createElement('a');
    a.classList.add('edit-link');
    a.innerHTML = '<i class="fa fa-pencil" aria-hidden="true"></i>';
    a.href = `/summary_wms/goods/edit/${good['goodId']}`;
    td.appendChild(a);
    tr.appendChild(td);
    
    a = document.createElement('a');
    a.classList.add('delete-link');
    a.innerHTML = '<i class="fa fa-trash" aria-hidden="true"></i>';
    a.href = `/summary_wms/goods/delete/${good['goodId']}`;
    td.appendChild(a);
    tr.appendChild(td);
  }

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