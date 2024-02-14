import { RenderTable } from "./RenderTable.js";
export { RenderTableMasterOfGoods };

class RenderTableMasterOfGoods extends RenderTable { 
  #renderTHead() {
    let trTHead = this.table.createTHead().insertRow();
    let namesOfColums = Object.keys(this.json_data[0]);

    for (const name of namesOfColums) {
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

      if (name === 'stock') {
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
          this.#renderDate(good, tr);
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

  #renderDate(good, tr) {
    let td = document.createElement('td');
    let div = document.createElement('div');

    div.innerHTML = `Created At: ${good['created_at']}`;
    td.appendChild(div);
    tr.appendChild(td);
    
    div = document.createElement('div');
    div.innerHTML = `Updated At: ${good['updated_at']}`;
    td.appendChild(div);
    tr.appendChild(td);
  }

  #renderLink(good, tr) {
    let td = document.createElement('td');
    td.classList.add('link-td');

    let a = document.createElement('a');
    a.classList.add('edit-link');
    a.innerHTML = '<i class="fa fa-pencil" aria-hidden="true"></i>';
    a.href = `/summary_wms/goods/edit/${good['id']}`;
    td.appendChild(a);
    tr.appendChild(td);
    
    a = document.createElement('a');
    a.classList.add('delete-link');
    a.innerHTML = '<i class="fa fa-trash" aria-hidden="true"></i>';
    a.href = `/summary_wms/goods/delete/${good['id']}`;
    td.appendChild(a);
    tr.appendChild(td);
  }

  renderTable() {
    this.#renderTHead();
    super.renderPagination();
    // this.liObjects[0] передаем для отрисовки первых строк таблицы из БД при вызове метода
    this.#renderTBody(this.liObjects[0]);
  }
}