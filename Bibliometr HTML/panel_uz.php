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

              <div id="prawa"><a class="button1" href="logout.php">Wyloguj</a>
                
              <a class="button1" onclick="panelToggleE()">Edytuj Profil</a>
              <div id="panel_edycja">
                    <p style="float:right" onclick="panelToggleE()"><i class="fa fa-times" aria-hidden="true"></i></p>
       
                   
                       <form>
                           <input required type="text" placeholder="imie" id="imie"><br>
                           <input required type="text" placeholder="nazwisko" id="nazwisko"></br>
                           <input required type="text" placeholder="email" id="email"></br>
                           <input required type="text" placeholder="haslo" id="haslo"></br>
                           <input required type="text" placeholder="Uczelnia" id="uczelnia"></br>
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
                    <td>Autor</td>
                    <td>Nazwa pub.</td>
                    <td>Data</td>
                    <td>DOI</td>
                    <td>Tytuł</td>
                    <td>Pkt</td>
                    <td class="editTable"><a class="dodaj" onclick="panelToggle()">DODAJ <b>+</b></a></td>
                </tr>
                <tr>
                    <td>Paweł Krawczak</td>
                    <td>Moja pierwsza publikacja </td>
                    <td>11.11.2011</td>
                    <td>ZUT</td>
                    <td>Doktor rehabilitowany</td>
                    <td>100/100</td>
                    <td class="editTable"><i class="fa fa-pencil" aria-hidden="true"></i></td>
                    <td class="editTable"><i class="fa fa-trash-o" aria-hidden="true"></i></td>
                    
                </tr>
                </table>
                
              </div>
              <div id="panel">
                <p style="float:right" onclick="panelToggle()"><i class="fa fa-times" aria-hidden="true"></i></p>
                <form>
                    <input required type="text" placeholder="Autorzy" id="Autor"><br>
                    <input required type="text" placeholder="Nazwa" id="Nazwa"></br>
                    <input required type="text" placeholder="Data" id="Data"></br>
                    <input required type="text" placeholder="DOI" id="DOI"></br>
                    <input required type="text" placeholder="Tytul" id="Tytul"></br>
                    <input required type="text" placeholder="Punkty" id="Pkt">
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