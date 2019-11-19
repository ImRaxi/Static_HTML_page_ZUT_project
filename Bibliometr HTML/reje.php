<?php
	@session_start();

	if(isset($_POST['reg-email'])) {
		$validatedRight = true;

		$regName = $_POST['reg-imie'];

		if(strlen($regName) > 30) {
			$validatedRight = false;
			$_SESSION['e_imie'] = "Imię nie może być dłuższe niż 30 znaków.";
		}

		$regNazwisko = $_POST['reg-nazwisko'];

		if(strlen($regNazwisko) > 30) {
			$validatedRight = false;
			$_SESSION['e_nazwisko'] = "Nazwisko nie może być dłuższe niż 40 znaków.";
		}

		$regHaslo = $_POST['reg-haslo'];

		if(strlen($regHaslo) < 8) {
			$validatedRight = false;
			$_SESSION['e_haslo'] = "Hasło musi zawierać minimum 8 znaków.";
		}

		$hash = password_hash($regHaslo, PASSWORD_DEFAULT);

		$regPotwierdzenieHasla = $_POST['reg-potwierdzenie_hasla'];

		if($regHaslo != $regPotwierdzenieHasla) {
			$validatedRight = false;
			$_SESSION['e_haslo'] = "Hasła muszą być takie same.";
		}

		$regUczelnia = $_POST['reg-uczelnia'];

		if(strlen($regUczelnia) <= 0) {
			$validatedRight = false;
			$_SESSION['e_uczelnia'] = "Pole uczelnia nie może być puste";
		}

		$regEmail = $_POST['reg-email'];

		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);

		try {
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if($polaczenie->connect_errno != 0) {
				throw new Exception(mysqli_connect_errno());
			} else {
				$res = $polaczenie->query("SELECT id FROM uzytkownicy WHERE email='$regEmail'");

				if(!$res) {
					throw new Exception($polaczenie->error);
				}

				$mailMatch = $res->num_rows;
				if($mailMatch > 0) {
					$validatedRight = false;
					$_SESSION['e_email'] = "Taki email juz istnieje";
				}

				if($validatedRight == true) {
					
					if($polaczenie->query("INSERT INTO uzytkownicy VALUES (NULL, '$regName', '$regNazwisko', '$regEmail', '$hash', '$regUczelnia', '0')")) {
						$_SESSION['registered'] = true;
						header("Location: login.php");
					} else {
						throw new Exception(mysqli_connect_errno());
					}
					
					//$sendToDB = 
				}

				$polaczenie->close();
			}

		} catch(Exception $e) {
			echo 'Bład serwera';
		}
	}
?>

<html>
    <head>
        <title>SKPN</title>
        <link rel="stylesheet" href="./css/template.css">
		<link rel="stylesheet" href="./css/reje.css">
    </head>
    <body>
        <div id="box">

            <header>
                <h3>SYSTEM BIBLIOMETRYCZNY</h3>
			</header>
			
            <div id="divider"></div>

            <div id="content">
				<a href="strona_glowna_niez.php"><img src="IMG/logoskpn.png"></a>
				
				<div id="form">
				<h1> REJESTRACJA </h1>
				
				<form method ="post" class="register-form">
					<hr>
						<?php 
						if(isset($_SESSION['e_imie'])) {
							echo '<div class="error">' . $_SESSION['e_imie'] . '</div>'; 
							unset($_SESSION['e_imie']);
							} 
						?>
							<input required type="text" placeholder="Imię" id="reg-imie" name="reg-imie">
						<?php 
						if(isset($_SESSION['e_nazwisko'])) {
							echo '<div class="error">' . $_SESSION['e_nazwisko'] . '</div>'; 
							unset($_SESSION['e_nazwisko']);
							} 
						?>
							<input required type="text" placeholder="Nazwisko" id="reg-nazwisko" name="reg-nazwisko"></br>
						<?php 
						if(isset($_SESSION['e_email'])) {
							echo '<div class="error">' . $_SESSION['e_email'] . '</div>'; 
							unset($_SESSION['e_email']);
							} 
						?>
							<input required type="email" placeholder="E-mail" id="reg-email" name="reg-email"></br>
						<?php 
						if(isset($_SESSION['e_haslo'])) {
							echo '<div class="error">' . $_SESSION['e_haslo'] . '</div>'; 
							unset($_SESSION['e_haslo']);
							} 
						?>
							<input required type="password" placeholder="Hasło" id="reg-haslo" name="reg-haslo"></br>
							<input required type="password" placeholder="Potwierdzenie hasła" id="reg-potwierdzenie_hasla" name="reg-potwierdzenie_hasla"></br>
						<?php 
						if(isset($_SESSION['e_uczelnia'])) {
							echo '<div class="error">' . $_SESSION['e_uczelnia'] . '</div>'; 
							unset($_SESSION['e_uczelnia']);
							} 
						?>
							<input required type="text" placeholder="Uczelnia" id="reg-uczelnia" name="reg-uczelnia"></br>
							<input type="checkbox"><span>Akceptuję regulamin</span>
					<hr>
					<input type="submit" class="button" value="Załóż konto">
				</form>
				 
				 
				</div>
				
            </div>

			<footer>
				<p>Pingwiny&copy; 2019 ZUT PSIAI</p>
			</footer>
    </body>
</html>