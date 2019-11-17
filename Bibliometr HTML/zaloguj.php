<?php
    session_start();

    if(!isset($_POST['email']) || !isset($_POST['haslo'])) {
        header('Location: login.php');
        exit();
    }

    require_once "connect.php";

    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

    if($polaczenie->connect_errno != 0) {
        echo 'Error'.$polaczenie->connect_errno;
    } else {
        $email  = $_POST['email'];
        $haslo  = $_POST['haslo'];

        $email = htmlentities($email, ENT_QUOTES, "UTF-8");
        $haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");
        
         if ($result = @$polaczenie->query(
         sprintf("SELECT * FROM uzytkownicy WHERE email='%s' AND password='%s'",
         mysqli_real_escape_string($polaczenie, $email),
         mysqli_real_escape_string($polaczenie, $haslo)))) 
         {
            $x = $result->num_rows;
            if($x == 1) {
                $_SESSION['loggedin'] = true;

                $get_dane = $result->fetch_assoc();
                $_SESSION['id'] = $get_dane['id'];
                $_SESSION['imie'] = $get_dane['imie'];
                $_SESSION['nazwisko'] = $get_dane['nazwisko'];

                unset($_SESSION['err']);
                $result->free_result();
                header('Location: strona_glowna_z.php');
              
            } else {
                $_SESSION['err'] = '<p class = "error-logowania">Nieprawidłowy login lub hasło.</p>';
                header('Location: login.php');
         
            }
         } else {
             echo 'Błąd';
         }

        $polaczenie->close();
    }
?>