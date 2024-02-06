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
  import { createTable } from '/record_wms/app/scripts/build-table.js';
  let goods = <?=$json?>;
  createTable(goods);
</script>

<?php
$content = ob_get_clean();
include 'app/views/layout.php';
?>