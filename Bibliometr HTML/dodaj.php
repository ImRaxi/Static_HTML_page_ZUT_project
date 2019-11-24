<?php 
     @session_start();
     $autor = $_POST['autor-add'];
     $nazwa = $_POST['nazwa-add'];
     $data = $_POST['data-add'];
     $doi = $_POST['doi-add'];
     $tytul = $_POST['tytul-add'];
     $pkt = $_POST['pkt-add'];
     

     require_once 'connect.php';
     mysqli_report(MYSQLI_REPORT_STRICT);

		try {
            $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
            
			if($polaczenie->connect_errno != 0) {
				throw new Exception(mysqli_connect_errno());
			} else {

                    $email = htmlentities($_SESSION['email'], ENT_QUOTES, "UTF-8");

                    $query = $polaczenie->query("SELECT id_user, uczelnia FROM uzytkownik WHERE email = '$email'");
                    
                    foreach($query as $newquery) {
                        $uid = htmlentities($newquery['id_user'], ENT_QUOTES, "UTF-8");
                        $uczelnia = htmlentities($newquery['uczelnia'], ENT_QUOTES, "UTF-8");
                    }

					if($polaczenie->query("INSERT INTO publikacja VALUES ('$uid', '$autor', NULL, '$data', '$nazwa', '$doi', '$uczelnia', '$pkt', '$tytul')")) {
						header("Location: panel_uz.php");
					} else {
						throw new Exception(mysqli_connect_errno());
					}

				$polaczenie->close();
			}

		} catch(Exception $e) {
			error_log("Błąd serwera {$e->getMessage()}");
		}

?>