<?php
//test błędu 404
   // header("HTTP/1.0 404 Not Found");
    //exit();
require_once "connect.php";
session_start();
try {
	if ($polaczenie->connect_errno != 0) {
		throw new Exception(mysqli_connect_errno());
	} else {

		$id = $polaczenie->real_escape_string($_POST['id']);
		$odp = $polaczenie->real_escape_string($_POST['odp']);

		if ($polaczenie->query("UPDATE wyniki SET $odp = $odp + 1 WHERE id_pytania = $id")) {
			$_SESSION['udanyzapis'] = true;
		} else {
			throw new Exception($polaczenie->error);
		}
	}

	$polaczenie->close();
} catch (Exception $e) {
	echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o używanie serwisu w innym terminie!</span>';
	echo '<br />Informacja developerska: ' . $e;
}
