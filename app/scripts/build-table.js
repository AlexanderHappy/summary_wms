export { createTable };

function createTable(json_data) {
  let pagination = document.querySelector('#pagination');

  const rowNumber = 5;
  const usersLength = json_data.length;
  const numberPages = Math.ceil(usersLength / rowNumber);

  // Отрисовка пагинации
  let liObjects = [];
  for (let pageNum = 1; pageNum <= numberPages; pageNum++) {
    let li = document.createElement('li');
    li.innerHTML = pageNum;
    pagination.appendChild(li);
    liObjects.push(li);
  }
  // Отрисовка пагинации
  
  // Отрисовка таблицы
  let table = document.querySelector('#myTable');
  let tbody = table.createTBody();

  renderTBody(liObjects[0], tbody);
  renderTHead(json_data);
  
  liObjects.forEach((liObject) => {
    liObject.addEventListener('click', function() {
      renderTBody(liObject, tbody);
    });
  });
  
  function renderTHead(json_data) {
    let table = document.querySelector('#myTable');
    let trthead = table.createTHead().insertRow();
    
    const namesOfColumns = Object.keys(json_data[0]);
    
    for (const nameOfColumn of namesOfColumns) {
      let th = document.createElement('th');
      th.innerHTML = nameOfColumn;
      trthead.appendChild(th);
    }
  }

  function renderTBody(liObj, tbody) {
    let active = document.querySelector('#pagination li.active');
    if (active) {
      active.classList.remove('active');
    }
    liObj.classList.add('active');

    const pageNum = +liObj.innerHTML;
    
    const start = (pageNum - 1) * rowNumber;
    const end = start + rowNumber;
    
    const data = json_data.slice(start, end);
    tbody.innerHTML = '';

    for (const user of data) {
      let tr = tbody.insertRow();
      for (const info in user) {
        let td = document.createElement('td');
        td.innerHTML = user[info];
        tr.appendChild(td);
      }
    }  
  }
}
// Отрисовка таблицы