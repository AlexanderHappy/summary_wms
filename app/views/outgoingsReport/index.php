<?php
ob_start();
$title = 'Outgoings Goods Report';
$info = 'Information About Outgoing Goods Report';
$project_name = APP_BASE_PATH;
$link = "<a href='/$project_name/'>Dashboard</a> / <span>Master of Outgoings Report</span>";
?>

  <div class="container">
    <div class="wrapper">
      <canvas id="myChart" height="80"></canvas>
    </div>
  </div>

  <!-- Данные из БД переводим в JSON для передачи их JS-у -->
  <?php $json = json_encode($outgoings); ?>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    let outgoings = <?=$json?>;
    // Создадим два массива для chart.js
    namesOfGoods = Array();
    totalOfGoods = Array();

    for (const info of outgoings) {
      namesOfGoods.push(info['good_name']);
      totalOfGoods.push(info['total']);
    }

    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
      type: 'bar',
      data: {
        // Сюда подаём массив с именами
        labels: namesOfGoods,
        datasets: [{
          label: 'Number of Incoming Items',
          // Сюда подаем массив с цифрами заказов
          data: totalOfGoods,
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>

<?php
$content = ob_get_clean();
include 'app/views/layout.php';
?>