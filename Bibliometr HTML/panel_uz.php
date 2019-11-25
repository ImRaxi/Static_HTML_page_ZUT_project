<?php
    @session_start();

    if(!isset($_SESSION['loggedin'])) {
        header('Location:  Strona_glowna_z.php');
        exit();
      }

    ?>

<!doctype html>

<html>
    <head>
        <title>SKPN</title>
        <link rel="stylesheet" href="./css/template.css">
        <link rel="stylesheet" href="./css/panel_uz.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta charset ="UTF-8">
    </head>
    <body>
        <div id="box">

            <header>
                <h3>SYSTEM BIBLIOMETRYCZNY</h3>
            </header>

            <div id="divider"></div>

            <div id="content">

                <a class="button" href="Strona_glowna_z.php">Strona Główna</a>

                <div id="prawa">
                    <a class="button1" href="logout.php">Wyloguj</a>
                    <a class="button1" onclick="panelToggleE()">Edytuj Profil</a>
                    
                    <div id="panel_edycja">
                        <p style="float:right" onclick="panelToggleE()"><i class="fa fa-times" aria-hidden="true"></i></p>
                        <form action="editProfile.php" method="POST">
                            <input type="text" placeholder="imie" id="imie" name="imie"><br>
                            <input type="text" placeholder="nazwisko" id="nazwisko" name="nazwisko"></br>
                            <input type="email" placeholder="email" id="email" name="email"></br>
                            <input type="text" placeholder="Uczelnia" id="uczelnia" name="uczelnia"></br>
                            <input type="submit" value="ZAPISZ">
                        </form>
                    </div>
                </div>	
              
              
              <img src="IMG/logoskpn.png">

              <h1>PANEL UŻYTKOWNIKA</h1>
                
			  <div id="tabela">
                  
                <div id="wyszukaj">
                    <span><b>TWOJE PUBLIKACJE</b></span>
                    
                    <input type="text" placeholder="Wyszukaj" id="wyszukaj-swoje">
                    <button class="szukaj"><i class="fa fa-search" aria-hidden="true"></i></button><br>
                

                </div>
              <table id = "tabela" cellspacing ="0">
                <tr>
                    <td>id</td>
                    <td>Autor</td>
                    <td>Nazwa pub.</td>
                    <td>Data</td>
                    <td>DOI</td>
                    <td>Tytuł</td>
                    <td>Pkt</td>
                    <td class="editTable"><a class="dodaj" onclick="panelToggle()">DODAJ <b>+</b></a></td>
                </tr>

                <?php 
                    
                    require_once "connect.php";

                    $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
                    if($polaczenie->connect_errno != 0) {
                        throw new Exception(mysqli_connect_errno());
                    } else {
                        $imie = htmlentities($_SESSION['imie'], ENT_QUOTES, "UTF-8");
                        $nazwisko = htmlentities($_SESSION['nazwisko'], ENT_QUOTES, "UTF-8");
                        $email = htmlentities($_SESSION['email'], ENT_QUOTES, "UTF-8");

                        $current_user_id = $_SESSION['id'];

                        $query = $polaczenie->query("SELECT * FROM publikacja WHERE id_user = $current_user_id");

                            foreach($query as $newquery) {

                                $id = $newquery['id_publikacji'];
                                $nazwa_publikacji = $newquery['tytul'];
                                $data = $newquery['data_publikacji'];
                                $doi = $newquery['doi'];
                                $tytul_naukowy = $newquery['tytul_naukowy'];
                                $pkt = $newquery['punkty'];
    
                                

                            echo '
                                <tr>
                                <td>'.$id.'</td>
                                <td>'.$imie.' '.$nazwisko.'</td>
                                <td>'.$nazwa_publikacji.'</td>
                                <td>'.$data.'</td>
                                <td>'.$doi.'</td>
                                <td>'.$tytul_naukowy.'</td>
                                <td>'.$pkt.'</td>
                                <td class="editTable">Usuń<form action="delete.php" method="POST"><input type="submit" name="delete" value="'.$id.'"></form></td>
                                <td class="editTable">Modyfikuj<form action="edycja.php" method="POST"><input type="submit" name="modify" value="'.$id.'"></form></td>
                                </tr>'
                            ;
                        
                        
                           
                        }
                    
                    }

                    $polaczenie->close();
                ?>


                </table>
                
              </div>

              <div id="panel">
                <p style="float:right" onclick="panelToggle()"><i class="fa fa-times" aria-hidden="true"></i></p>

                <form action ="dodaj.php" name="add-article" method ="post">

                
                    <input required type="text" placeholder="Autorzy" id="autor" name ="autor-add"><br>
                    <input required type="text" placeholder="Nazwa" id="nazwa" name ="nazwa-add"></br>
                    <input required type="date" placeholder="Data" id="data" name ="data-add"></br>
                    <input required type="text" placeholder="DOI" id="doi" name ="doi-add"></br>
                    <input required type="text" placeholder="Tytul naukowy" id="tytul" name ="tytul-add"></br>
                    <input required type="text" placeholder="Punkty" id="pkt" name ="pkt-add">
                    <input type="submit" class="dodaj_w" value="DODAJ">
                </form>

              </div>
              
            </div>
            <footer>
                    <p>Pingwiny&copy; 2019 ZUT PSIAI</p>
            </footer>
        </div>

            <script src="js/scripts.js"></script>
    </body>
</html>