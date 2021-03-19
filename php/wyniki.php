<?php

session_start();

require_once "connect.php";

if ($polaczenie->connect_errno != 0) {
  echo "Error: " . $polaczenie->connect_errno;
}

?>
<!DOCTYPE HTML>
<html lang="pl">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ankieta | Wyniki</title>
  <link rel="stylesheet" href="../style.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

</head>

<body>
<header>
    <nav>
      <ul>
        <li class="left"><a href="../index.html">Dodaj ankietę</a></li>
        <li><a href="wyniki.php?ankieta=1">Wyniki</a></li>
        <li><a href="ankieta.php?ankieta=1">Ankiety</a></li>
        <li>
          <form action="wyniki.php" method="get" class="select">
            <label for="ankieta">Wpisz kod ankiety:</label>
            <input type="number" id="ankieta" name="ankieta" placeholder="Nr Ankiety">
          </form>
        </li>
      </ul>
    </nav>
  </header>
<?php 
    $id = htmlspecialchars($_GET["ankieta"]);
    $query = $polaczenie->query("SELECT * FROM wyniki where id_pytania = ".$id."");
    while ($row = $query->fetch_assoc()) {
      $a = $row["wyniki_a"];
      $b = $row["wyniki_b"];
      $c = $row["wyniki_c"];
      $d = $row["wyniki_d"];
    }
    $query = $polaczenie->query("SELECT * FROM pytania where id_pytania = ".$id."");
    while ($row = $query->fetch_assoc()) {
      $py = $row["pytanie"];
      $py_a = $row["odp_a"];
      $py_b = $row["odp_b"];
      $py_c = $row["odp_c"];
      $py_d = $row["odp_d"];
    }
    if(!isset($py) || $py==NULL){
      header("Location: wyniki.php?ankieta=1");
    }
    ?>
  <h1 id="title">Wyniki - <?php echo $py; ?></h1>
  <article class="flex-container" id="ranking">
    <div id="canvas-holder" style="width:50%; margin-left:auto; margin-right:auto;">
      <canvas id="chart-area"></canvas>
    </div>
  </article>
  <script>
    var config = {
      type: 'pie',
      data: {
        datasets: [{
          data: [
            <?php echo $a; ?>,
            <?php echo $b; ?>,
            <?php echo $c; ?>,
            <?php echo $d; ?>,
          ],
          backgroundColor: [
            'rgb(255, 30, 58)',
            'rgb(8, 207, 4)',
            'rgb(255, 205, 86)',
            'rgb(54, 162, 235)',
          ],
          label: 'Wyniki'
        }],
        labels: [
          '<?php echo $py_a; ?>',
            '<?php echo $py_b; ?>',
            '<?php echo $py_c; ?>',
            '<?php echo $py_d; ?>'
        ]
      },
      options: {
        responsive: true
      }
    };

    window.onload = function() {
      var ctx = document.getElementById('chart-area').getContext('2d');
      window.myPie = new Chart(ctx, config);
    };
  </script>
</body>

</html>