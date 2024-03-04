<?php 
ob_start();
$title = 'Users';
$info = 'Information about User:';
$link = "<a href='/<?= APP_BASE_PATH ?>/'>Dashboard</a> / <span>Users</span>";
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
            <option value="full_name">Full Name</option>
            <option value="user_name">User Name</option>
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

        <a href="/<?= APP_BASE_PATH ?>/users/create" class="create-link">
          <button>
            <i class="fa fa-plus" aria-hidden="true"></i>
            Add new User
          </button>
        </a>
      </div>
    </div>
  </div>

  <!-- Данные из БД переводим в JSON для передачи их JS-у -->
  <?php $json = json_encode($users); ?>

  <script type="module">
    import { RenderTableUsers } from '/<?= APP_BASE_PATH?>/app/js/Classes/RenderTableUsers.js';
    import { deleteTable } from '/<?= APP_BASE_PATH ?>/app/js/functions/deleteTable.js';
    import { sliceTable } from '/<?= APP_BASE_PATH ?>/app/js/functions/sliceTable.js';
    
    // Передаем данные полученные выше из БД
    let users = <?=$json?>;
    // Ренедерим таблицу
    let table = new RenderTableUsers(4, users).renderTable();

    // Добавляем отрисовку таблицы в зависимости от выбранного числа в select
    const size_charger = document.querySelector('.js-size-charger');
    size_charger.addEventListener('change', () => {
      const amtRowInTable = Number(size_charger.value);
      // Стираем содержимое таблицы
      deleteTable();
      // Рендерим её заново
      table = new RenderTableUsers(amtRowInTable, users).renderTable();
    });

    // Получаем введенное значение из полей поиска и select
    const search_button = document.querySelector('.js-submit-button');
    search_button.addEventListener('click', () => {
      const text = document.getElementById('search-string');
      const option = document.querySelector('.js-search-option');
      const selected_column = option.value;
      const entered_text = String(text.value);

      let data = sliceTable(users, entered_text, selected_column);

      const amtRowInTable = Number(size_charger.value);
      // Стираем содержимое таблицы
      deleteTable();
      // Рендерим её заново
      table = new RenderTableUsers(amtRowInTable, data).renderTable();
    });

    const refresh_button = document.querySelector('.js-refresh-button');
    refresh_button.addEventListener('click', () => {
      const amtRowInTable = Number(size_charger.value);
      // Стираем содержимое таблицы
      deleteTable();
      // Рендерим её заново
      table = new RenderTableUsers(amtRowInTable, users).renderTable();
    });
  </script>

<?php
$content = ob_get_clean();
include 'app/views/layout.php';
?>