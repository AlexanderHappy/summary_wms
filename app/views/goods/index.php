<?php
ob_start();
$title = 'Goods';
$info = 'Information about Goods:';

$link = "<a href='/summary_wms/'>Dashboard</a> / <span>Master of Goods</span>";
?>

  <div class="container">
    <div class="wrapper">        
      <p>
        View Goods Data
      </p>
      <div class="search-option-bar">
        <div>
          <p>
            Search by:
          </p>
          <select class="js-search-option">
            <option value="name">Name</option>
            <option value="brand">Brand</option>
          </select>
          <input class="search-bar" type="search" id="search-string">
          <button class="js-submit-button">
            <i class="fa fa-search" aria-hidden="true"></i>
          </button>
        </div>

        <div>
          <button class="js-refresh-button">
            <i class="fa fa-refresh" aria-hidden="true"></i>
          </button>
        </div>
      </div>

      <table id="myTable">
      <!-- Таблица отрендеринная JS-ом -->
      </table>

      <select class="js-size-charger">
        <option value="4">4</option>
        <option value="6">6</option>
        <option value="8">8</option>
      </select>

      <ul class="ul-table" id="pagination">
      <!-- Пагинация отрендеринная JS-ом -->
      </ul>
    </div>
  </div>
  
  <!-- Данные из БД переводим в JSON для передачи их JS-у -->
  <?php $json = json_encode($goods); ?>

  <script type="module">
    import { RenderTable } from '/summary_wms/app/js/Classes/RenderTable.js';
    import { SearchTable } from '/summary_wms/app/js/Classes/SearchTable.js';
    // Передаем данные полученные выше
    let goods = <?=$json?>;
    // Ренедерим таблицу
    let table = new RenderTable(4, goods).renderTable();

    // Добавляем отрисовку таблицы в зависимости от выбранного числа в select
    const size_charger = document.querySelector('.js-size-charger');
    size_charger.addEventListener('change', () => {
      const amtRowInTable = Number(size_charger.value);
      // Стираем содержимое таблицы
      let table = document.getElementById('myTable');
      let pagination = document.getElementById('pagination');
      table.innerHTML = '';
      pagination.innerHTML = '';
      // Рендерим её заново
      table = new RenderTable(amtRowInTable, goods).renderTable();
    });

    // Получаем введенное значение из полей поиска и select
    const search_button = document.querySelector('.js-submit-button');
    search_button.addEventListener('click', () => {
      const text = document.getElementById('search-string');
      const option = document.querySelector('.js-search-option');
      const selected_column = option.value;
      const entered_text = text.value;

      let data = new SearchTable(goods, entered_text, selected_column).getNewData();

      const amtRowInTable = Number(size_charger.value);
      // Стираем содержимое таблицы
      let table = document.getElementById('myTable');
      let pagination = document.getElementById('pagination');
      table.innerHTML = '';
      pagination.innerHTML = '';
      // Рендерим её заново
      table = new RenderTable(amtRowInTable, data).renderTable();
    });

    const refresh_button = document.querySelector('.js-refresh-button');
    refresh_button.addEventListener('click', () => {
      const amtRowInTable = Number(size_charger.value);
      // Стираем содержимое таблицы
      let table = document.getElementById('myTable');
      let pagination = document.getElementById('pagination');
      table.innerHTML = '';
      pagination.innerHTML = '';
      // Рендерим её заново
      table = new RenderTable(amtRowInTable, goods).renderTable();
    });
  </script>

<?php
$content = ob_get_clean();
include 'app/views/layout.php';
?>