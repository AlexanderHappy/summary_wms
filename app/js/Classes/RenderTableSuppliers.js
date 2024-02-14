import { RenderTable } from "./RenderTable.js";
export { RenderTableSuppliers };

class RenderTableSuppliers extends RenderTable {
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

    for (const supplier of data) {
      let tr = this.tbody.insertRow();
      for (const info in supplier) {
        if (info === 'created_at') {
          // Создает в элементе td два divа для create_at и updated_at
          this.#renderDate(supplier, tr);
          // Создает в элементе td два divа для create_at и updated_at
          break;
        }

        let td = document.createElement('td');
        td.innerHTML = supplier[info];
        tr.appendChild(td);
      }
      // В конце каждой строки создает кнопки Action - Edit и Delete
      this.#renderLink(supplier, tr);
      // В конце каждой строки создает кнопки Action - Edit и Delete
    }
  }

  #renderDate(supplier, tr) {
    let td = document.createElement('td');
    let div = document.createElement('div');

    div.innerHTML = `Created At: ${supplier['created_at']}`;
    td.appendChild(div);
    tr.appendChild(td);
    
    div = document.createElement('div');
    div.innerHTML = `Updated At: ${supplier['updated_at']}`;
    td.appendChild(div);
    tr.appendChild(td);
  }

  #renderLink(supplier, tr) {
    let td = document.createElement('td');
    td.classList.add('link-td');

    let a = document.createElement('a');
    a.classList.add('edit-link');
    a.innerHTML = '<i class="fa fa-pencil" aria-hidden="true"></i>';
    a.href = `/summary_wms/suppliers/edit/${supplier['id']}`;
    td.appendChild(a);
    tr.appendChild(td);
    
    a = document.createElement('a');
    a.classList.add('delete-link');
    a.innerHTML = '<i class="fa fa-trash" aria-hidden="true"></i>';
    a.href = `/summary_wms/suppliers/delete/${supplier['id']}`;
    td.appendChild(a);
    tr.appendChild(td);
  }
  
  renderTable() {
    super.renderTHead();
    super.renderPagination();
    // this.liObjects[0] передаем для отрисовки первых строк таблицы из БД при вызове метода
    this.#renderTBody(this.liObjects[0]);
  }
}