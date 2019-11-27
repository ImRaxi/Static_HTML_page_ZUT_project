<?php
    ob_start();
    @session_start();
    require_once "connect.php";
    $id = $_POST['delete'];
    $mojeid = $_SESSION['id'];
    mysqli_report(MYSQLI_REPORT_STRICT);

    try {
        $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
        
        if($polaczenie->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {

            $query = $polaczenie->query("SELECT id_user FROM publikacja WHERE id_publikacji = '$id'");
            $fetch = $query->fetch_assoc();
            
            
            $checkid = $fetch['id_user'];

            $query->free_result();

        if($checkid == $mojeid) {
            $query = $polaczenie->query("DELETE FROM publikacja WHERE id_publikacji = '$id'");
        } else {
            echo 'Nie można usunąć publikacji ponieważ nie należy ona do Ciebię';
        }

        $polaczenie->close();
        header("Location: panel_uz.php");
        ob_end_flush();
        }

    } catch(Exception $e) {
        error_log("Błąd serwera {$e->getMessage()}");
    }

?>

