<?php
	@session_start();

	if(isset($_POST['reg-email'])) {
		
		$validatedRight = true;

		$regName = $_POST['reg-imie'];
		$regNazwisko = $_POST['reg-nazwisko'];
		$regHaslo = $_POST['reg-haslo'];
		$regPotwierdzenieHasla = $_POST['reg-potwierdzenie_hasla'];
		$regUczelnia = $_POST['reg-uczelnia'];
		$regEmail = $_POST['reg-email'];
		
		$date = date("Y-m-d");
		$hash = password_hash($regHaslo, PASSWORD_DEFAULT);

		if(strlen($regName) > 20) {
			$validatedRight = false;
			$_SESSION['error']['reg-imie'] = "Imię nie może być dłuższe niż 20 znaków.";
		}

		if(strlen($regNazwisko) > 25) {
			$validatedRight = false;
			$_SESSION['error']['reg-nazwisko'] = "Nazwisko nie może być dłuższe niż 25 znaków.";
		}

		if(strlen($regHaslo) < 8) {
			$validatedRight = false;
			$_SESSION['error']['reg-haslo'] = "Hasło musi zawierać minimum 8 znaków.";
		}

		if($regHaslo != $regPotwierdzenieHasla) {
			$validatedRight = false;
			$_SESSION['error']['reg-potwierdzenie_hasla'] = "Hasła muszą być takie same.";
		}

		if(strlen($regUczelnia) <= 0) {
			$validatedRight = false;
			$_SESSION['error']['reg-uczelnia'] = "Pole uczelnia nie może być puste";
		}

		if(!isset($_POST['checkbox'])) {
			$validatedRight = false;
			$_SESSION['error']['reg-regulamin'] = "Proszę zaakceptować regulamin";
		}

		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);

		try {
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if($polaczenie->connect_errno != 0) {
				throw new Exception(mysqli_connect_errno());
			} else {
				$query = $polaczenie->query("SELECT id_user FROM uzytkownik WHERE email='$regEmail'");

				if(!$query) {
					throw new Exception($polaczenie->error);
				}


				$mailMatch = $query->num_rows;
				if ($mailMatch > 0) {
					$validatedRight = false;
					$_SESSION['error']['reg-email'] = "Taki email juz istnieje";
				}


				if($validatedRight == true) {
					
					if($polaczenie->query("INSERT INTO uzytkownik VALUES (NULL, '0', '$regName', '$regNazwisko', '$regEmail', '$regUczelnia', '$hash', '$date')")) {
						$_SESSION['registered'] = true;
						header("Location: login.php");
					} else {
						throw new Exception(mysqli_connect_errno());
					}
					
				}

				$polaczenie->close();
			}

		} catch(Exception $e) {
			error_log("Błąd serwera {$e->getMessage()}");
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
				
				<form method = "post" class="register-form">
					<hr>
						<?php 
						if (isset($_SESSION['error']['reg-imie'])) {
							echo '<div class="error">' . $_SESSION['error']['reg-imie'] . '</div>'; 
							unset($_SESSION['error']['reg-imie']);
						}	?>
							<input required type="text" placeholder="Imię" id="reg-imie" name="reg-imie">
						<?php 
						if (isset($_SESSION['error']['reg-nazwisko'])) {
							echo '<div class="error">' . $_SESSION['error']['reg-nazwisko'] . '</div>'; 
							unset($_SESSION['error']['reg-nazwisko']);
						}	?>
							<input required type="text" placeholder="Nazwisko" id="reg-nazwisko" name="reg-nazwisko"></br>
						<?php 
						if (isset($_SESSION['error']['reg-email'])) {
							echo '<div class="error">' . $_SESSION['error']['reg-email'] . '</div>'; 
							unset($_SESSION['error']['reg-email']);
						}	?>
							<input required type="email" placeholder="E-mail" id="reg-email" name="reg-email"></br>
						<?php 
						if (isset($_SESSION['error']['reg-haslo'])) {
							echo '<div class="error">' . $_SESSION['error']['reg-haslo'] . '</div>'; 
							unset($_SESSION['error']['reg-haslo']);
						}	?>

						<?php 
						if (isset($_SESSION['error']['reg-potwierdzenie_hasla'])) {
							echo '<div class="error">' . $_SESSION['error']['reg-potwierdzenie_hasla'] . '</div>'; 
							unset($_SESSION['error']['reg-potwierdzenie_hasla']);
						}	?>
							<input required type="password" placeholder="Hasło" id="reg-haslo" name="reg-haslo"></br>
							<input required type="password" placeholder="Potwierdzenie hasła" id="reg-potwierdzenie_hasla" name="reg-potwierdzenie_hasla"></br>
						<?php 
						if (isset($_SESSION['error']['reg-uczelnia'])) {
							echo '<div class="error">' . $_SESSION['error']['reg-uczelnia'] . '</div>'; 
							unset($_SESSION['error']['reg-uczelnia']);
						}	?>
							<input required type="text" placeholder="Uczelnia" id="reg-uczelnia" name="reg-uczelnia"></br>
						<?php 
						if (isset($_SESSION['error']['reg-uczelnia'])) {
							echo '<div class="error">' . $_SESSION['error']['reg-uczelnia'] . '</div>'; 
							unset($_SESSION['error']['reg-uczelnia']);
						}	?>
							<input type="checkbox" name="checkbox">
							<span>Akceptuję regulamin</span>
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