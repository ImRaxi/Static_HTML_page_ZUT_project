<?php
    @session_start();
    require_once "connect.php";
    $id = $_POST['delete'];
    mysqli_report(MYSQLI_REPORT_STRICT);

    try {
        $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
        
        if($polaczenie->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {


        $query = $polaczenie->query("DELETE FROM publikacja WHERE id_publikacji = '$id'");
        header("Location: panel_uz.php");

            $polaczenie->close();
        }

    } catch(Exception $e) {
        error_log("Błąd serwera {$e->getMessage()}");
    }

?>

