<?php
require_once "connect.php";
session_start();
try {
	if ($polaczenie->connect_errno != 0) {
		throw new Exception(mysqli_connect_errno());
	} else {

		$pytanie = $polaczenie->real_escape_string($_POST['pytanie']);
		$odp_a = $polaczenie->real_escape_string($_POST['odp_a']);
		$odp_b = $polaczenie->real_escape_string($_POST['odp_b']);
		$odp_c = $polaczenie->real_escape_string($_POST['odp_c']);
		$odp_d = $polaczenie->real_escape_string($_POST['odp_d']);

		if ($polaczenie->query("INSERT INTO pytania VALUES (NULL, '".$pytanie."', '".$odp_a."', '".$odp_b."', '".$odp_c."', '".$odp_d."')")) {
			if ($polaczenie->query("INSERT INTO wyniki VALUES (NULL, 0, 0, 0, 0)")) {
				$query = $polaczenie->query("SELECT * FROM pytania ORDER BY id_pytania DESC LIMIT 1");
				while ($row = $query->fetch_assoc()) {
					echo $row["id_pytania"];
					$_SESSION['udanyzapis'] = true;
				}
			}
			else{
				throw new Exception($polaczenie->error);
			}
		} else {
			throw new Exception($polaczenie->error);
		}
	}

	$polaczenie->close();
} catch (Exception $e) {
	echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o używanie serwisu w innym terminie!</span>';
	echo '<br />Informacja developerska: ' . $e;
}
