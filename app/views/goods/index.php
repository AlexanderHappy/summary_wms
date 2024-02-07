<?php
ob_start();
$title = 'Goods';
?>

<table id="myTable">
  <!-- Таблица нарисованная JS-ом -->
</table>
<ul id="pagination">
  <!-- Пагинация нарисованная JS-ом -->
</ul>

<?php $json = json_encode($goods); ?>

<script type="module">
  import { CreateTable } from '/record_wms/app/scripts/CreateTable.js';
  let goods = <?=$json?>;

  let table = new CreateTable(5, goods).renderTable();
</script>

<?php
$content = ob_get_clean();
include 'app/views/layout.php';
?>