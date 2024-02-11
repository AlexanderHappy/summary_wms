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
        <p>
          Search by:
        </p>
        <select name="" id="">
          <option value="name" class="active">Name</option>
          <option value="brand">Brand</option>
        </select>
        <input class="search-bar" type="search">
        <button class="submit-button">
          <i class="fa fa-search" aria-hidden="true"></i>
        </button>
      </div>

      <table id="myTable">
      <!-- Таблица отрендеринная JS-ом -->
      </table>

      <ul class="ul-table" id="pagination">
      <!-- Пагинация отрендеринная JS-ом -->
      </ul>
    </div>
  </div>
  
  <?php $json = json_encode($goods); ?>

  <script type="module">
    import { CreateTable } from '/summary_wms/app/js/Classes/CreateTable.js';
    let goods = <?=$json?>;

    let table = new CreateTable(2, goods).renderTable();
  </script>

<?php
$content = ob_get_clean();
include 'app/views/layout.php';
?>