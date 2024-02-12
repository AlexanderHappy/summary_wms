export { deleteTable };

function deleteTable() {
  let table = document.getElementById('myTable');
  let pagination = document.getElementById('pagination');
  table.innerHTML = '';
  pagination.innerHTML = '';
}