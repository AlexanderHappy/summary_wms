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
      if (name === 'created_at') {
        let th = document.createElement('th');
        th.innerHTML = 'Date';
        trTHead.appendChild(th);
        
        th = document.createElement('th');
        th.innerHTML = 'Action';
        trTHead.appendChild(th);
        break;
      }
      let th = document.createElement('th');
      const capitalizedWord = name[0].toUpperCase() + name.slice(1);
      th.innerHTML = capitalizedWord;
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
        if (info === 'created_at') {
          // Создает в элементе td два divs для create_at и updated_at
          this.#renderDate(good, tr);
          // Создает в элементе td два divs для create_at и updated_at
          break;
        }

        let td = document.createElement('td');
        td.innerHTML = good[info];
        tr.appendChild(td);
      }
      // В конце каждой строки создает кнопки Action - Edit и Delete
      this.#renderButton(tr);
      // В конце каждой строки создает кнопки Action - Edit и Delete
    }
  }

  #renderDate(good, tr) {
    let td = document.createElement('td');
    let div = document.createElement('div');
    // div.classList.add('date'); - Добавление класса тэгу
    div.innerHTML = good['created_at'];
    td.appendChild(div);
    tr.appendChild(td);
    
    div = document.createElement('div');
    div.innerHTML = good['updated_at'];
    td.appendChild(div);
    tr.appendChild(td);
  }

  #renderButton(tr) {
    let td = document.createElement('td');

    let button = document.createElement('button');
    button.innerHTML = 'Edit';
    td.appendChild(button);
    tr.appendChild(td);
    
    button = document.createElement('button');
    button.innerHTML = 'Delete';
    td.appendChild(button);
    tr.appendChild(td);
  }

  renderTable() {
    this.#renderTHead();
    this.#renderPagination();
    // this.liObjects[0] передаем для отрисовки первых строк таблицы из БД при вызове метода
    this.#renderTBody(this.liObjects[0]);
  }
}