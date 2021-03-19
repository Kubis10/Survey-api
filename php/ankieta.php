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
  <title>Ankieta | Pytania</title>
  <link rel="stylesheet" href="../style.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="../script2.js" defer></script>
</head>

<body>
  <header>
    <nav>
      <ul>
        <li class="left"><a href="../index.html">Dodaj ankietę</a></li>
        <li><a href="wyniki.php?ankieta=1">Wyniki</a></li>
        <li><a href="ankieta.php?ankieta=1">Ankiety</a></li>
        <li>
          <form action="ankieta.php" method="get" class="select">
            <label for="ankieta">Wpisz kod ankiety:</label>
            <input type="number" id="ankieta" name="ankieta" placeholder="Nr Ankiety">
          </form>
        </li>
      </ul>
    </nav>
  </header>
  <article class="flex-container" id="ranking">
    <?php
    $id = htmlspecialchars($_GET["ankieta"]);
    $query = $polaczenie->query("SELECT * FROM pytania where id_pytania = " . $id . "");
    while ($row = $query->fetch_assoc()) {
      echo "<form id='ankiety' class='box'>";
      echo "<h1>" . $row["pytanie"] . "</h1>";
      echo '<label class="container">a) '. $row["odp_a"] .'';
      echo '<input type="radio" id="b" name="que" value="odp0">';
      echo '<span class="checkmark"></span>';
      echo '</label>';
      echo '<label class="container">b) '. $row["odp_b"] .'';
      echo '<input type="radio" id="b" name="que" value="odp1">';
      echo '<span class="checkmark"></span>';
      echo '</label>';
      echo '<label class="container">c) '. $row["odp_c"] .'';
      echo '<input type="radio" id="b" name="que" value="odp2">';
      echo '<span class="checkmark"></span>';
      echo '</label>';
      echo '<label class="container">d) '. $row["odp_d"] .'';
      echo '<input type="radio" id="b" name="que" value="odp3">';
      echo '<span class="checkmark"></span>';
      echo '</label>';
      echo '<input type="submit" value="Zagłosuj">';
      echo "</form>";
    }
    ?>
  </article>
  <script>
    window.id_pytania = <?php echo $id; ?>;
  </script>
</body>

</html>