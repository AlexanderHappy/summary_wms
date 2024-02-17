<?php
ob_start();
$title = 'Incomings Goods';
$info = 'Informations about Incomings Goods:';
$project_name = APP_BASE_PATH;
$link = "<a href='/$project_name/'>Dashboard</a> / <span>Master of Incomings</span>";
?>
  <div class="container">
    <div class="wrapper">        
      <p>
        View Incomings
      </p>
      <div class="search-option-bar">
        <div>
          <p>
            Search by:
          </p>
          <select class="js-search-option">
            <option value="name">Name of Good</option>
            <option value="address">Name of Supplier</option>
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

      <div class="pagination-sizer-add">
        <div>
          <select class="js-size-charger">
            <option value="4">4</option>
            <option value="6">6</option>
            <option value="8">8</option>
          </select>

          <ul class="ul-table" id="pagination">
          <!-- Пагинация отрендеринная JS-ом -->
          </ul>
        </div>

        <a href="/<?= APP_BASE_PATH ?>/incomings/create" class="create-link">
          <button>
            <i class="fa fa-plus" aria-hidden="true"></i>
            Add new Incoming
          </button>
        </a>
      </div>
    </div>
  </div>

  <!-- Данные из БД переводим в JSON для передачи их JS-у -->
  <?php $json = json_encode($incomings); ?>

  <script type="module">
    import { RenderTableIncomings } from '/<?= APP_BASE_PATH?>/app/js/Classes/RenderTableIncomings.js';
    import { sliceTable } from '/<?= APP_BASE_PATH?>/app/js/functions/sliceTable.js';
    import { deleteTable } from '/<?= APP_BASE_PATH?>/app/js/functions/deleteTable.js';

    // Передаем данные полученные выше из БД
    let incomings = <?=$json?>;
    // Ренедерим таблицу
    let table = new RenderTableIncomings(4, incomings).renderTable();

    // Добавляем отрисовку таблицы в зависимости от выбранного числа в select
    const size_charger = document.querySelector('.js-size-charger');
    size_charger.addEventListener('change', () => {
      const amtRowInTable = Number(size_charger.value);
      // Стираем содержимое таблицы
      deleteTable();
      // Рендерим её заново
      table = new RenderTableIncomings(amtRowInTable, incomings).renderTable();
    });

    // Получаем введенное значение из полей поиска и select
    const search_button = document.querySelector('.js-submit-button');
    search_button.addEventListener('click', () => {
      const text = document.getElementById('search-string');
      const option = document.querySelector('.js-search-option');
      const selected_column = option.value;
      const entered_text = text.value;

      let data = sliceTable(incomings, entered_text, selected_column);

      const amtRowInTable = Number(size_charger.value);
      // Стираем содержимое таблицы
      deleteTable();
      // Рендерим её заново
      table = new RenderTableIncomings(amtRowInTable, data).renderTable();
    });

    const refresh_button = document.querySelector('.js-refresh-button');
    refresh_button.addEventListener('click', () => {
      const amtRowInTable = Number(size_charger.value);
      // Стираем содержимое таблицы
      deleteTable();
      // Рендерим её заново
      table = new RenderTableIncomings(amtRowInTable, incomings).renderTable();
    });
  </script>
<?php
$content = ob_get_clean();
include 'app/views/layout.php';
?>