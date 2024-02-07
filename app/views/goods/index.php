<?php
ob_start();
$title = 'Goods';
?>

<table id="myTable">
  <!-- Таблица отрендеринная JS-ом -->
</table>
<ul id="pagination">
  <!-- Пагинация отрендеринная JS-ом -->
</ul>

<?php $json = json_encode($goods); ?>

<script type="module">
  import { CreateTable } from '/record_wms/app/js/Classes/CreateTable.js';
  let goods = <?=$json?>;

  let table = new CreateTable(5, goods).renderTable();
</script>

<?php
$content = ob_get_clean();
include 'app/views/layout.php';
?>