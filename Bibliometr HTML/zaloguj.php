<?php
    @session_start();

    if(!isset($_POST['email']) || !isset($_POST['haslo'])) {
        header('Location: login.php');
        exit();
    }

    require_once "connect.php";

    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

    if($polaczenie->connect_errno != 0) {
        echo 'Błąd połączenia z bazą';
    } else {
        $email  = $_POST['email'];
        $haslo  = $_POST['haslo'];

        $email = htmlentities($email, ENT_QUOTES, "UTF-8");
        
        if ($result = @$polaczenie->query(sprintf("SELECT * FROM uzytkownik WHERE email='%s'", mysqli_real_escape_string($polaczenie, $email)))) {
            
            $x = $result->num_rows;
            
            if ($x == 1) {
                $get_dane = $result->fetch_assoc();

                if (password_verify($haslo, $get_dane['haslo'])) {

                $_SESSION['loggedin'] = true;

                $_SESSION['id'] = $get_dane['id'];
                $_SESSION['imie'] = $get_dane['imie'];
                $_SESSION['nazwisko'] = $get_dane['nazwisko'];
                $_SESSION['email'] = $get_dane['email'];

                unset($_SESSION['err']);
                $result->free_result();
                header('Location: Strona_glowna_z.php');

            } else {
                $_SESSION['err'] = '<p class = "error-logowania">Nieprawidłowy login lub hasło.</p>';
                header('Location: login.php');
            }
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