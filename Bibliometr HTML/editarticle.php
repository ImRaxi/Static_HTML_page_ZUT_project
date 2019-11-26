<?php
	ob_start();
    @session_start();
    require_once "connect.php";

    $Userid = $_SESSION['id'];
    $id = $_POST['id'];
    $tytul = $_POST['tytul'];
    $data_publikacji = $_POST['data_publikacji'];
    $doi = $_POST['doi'];
    $uczelnia = $_POST['uczelnia'];
    $punkty = $_POST['punkty'];
    $tytul_naukowy = $_POST['tytul_naukowy'];

    echo $id;
    mysqli_report(MYSQLI_REPORT_STRICT);

    try {
        $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
        
        if($polaczenie->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {

            

            if($tytul != ""){
                $query = $polaczenie->query("UPDATE publikacja SET tytul = '$tytul' WHERE id_publikacji ='$id'");

            }
            
            if($data_publikacji != ""){
                $query = $polaczenie->query("UPDATE publikacja SET data_publikacji = '$data_publikacji' WHERE id_publikacji ='$id'");
            }

            if($doi != ""){
                $query = $polaczenie->query("UPDATE publikacja SET doi = '$doi' WHERE id_publikacji ='$id'");

            }

            if($uczelnia != ""){
                $query = $polaczenie->query("UPDATE publikacja SET uczelnia = '$uczelnia' WHERE id_publikacji ='$id'");

            }

            if($punkty != ""){
                $query = $polaczenie->query("UPDATE publikacja SET punkty = '$punkty' WHERE id_publikacji ='$id'");

            }

            if($tytul_naukowy != ""){
                $query = $polaczenie->query("UPDATE publikacja SET tytul_naukowy = '$tytul_naukowy' WHERE id_publikacji ='$id'");

            }
			header("Location: panel_uz.php");
            $polaczenie->close();
			ob_end_flush();
        }

    } catch(Exception $e) {
        error_log("Błąd serwera {$e->getMessage()}");
    }

?>

