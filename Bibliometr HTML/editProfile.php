<?php
	ob_start();
    @session_start();
    require_once "connect.php";

    $id = $_SESSION['id'];
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $email = $_POST['email'];
    $uczelnia = $_POST['uczelnia'];

    echo $id;
    mysqli_report(MYSQLI_REPORT_STRICT);

    try {
        $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
        
        if($polaczenie->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {

            if($imie != ""){
                $query = $polaczenie->query("UPDATE uzytkownik SET imie = '$imie' WHERE id_user ='$id'");

                $_SESSION['imie']=$imie;
            }
            
            if($nazwisko != ""){
                $query = $polaczenie->query("UPDATE uzytkownik SET nazwisko = '$nazwisko' WHERE id_user ='$id'");

                $_SESSION['nazwisko']=$nazwisko;
            }

            if($email != ""){
                $query = $polaczenie->query("UPDATE uzytkownik SET email = '$email' WHERE id_user ='$id'");

                $_SESSION['email']=$email;
            }

            if($uczelnia != ""){
                $query = $polaczenie->query("UPDATE uzytkownik SET uczelnia = '$uczelnia' WHERE id_user ='$id'");

                $_SESSION['uczelnia']=$uczelnia;
            }
            header("Location: panel_uz.php");
            $polaczenie->close();
			ob_end_flush();
        }

    } catch(Exception $e) {
        error_log("Błąd serwera {$e->getMessage()}");
    }

?>

