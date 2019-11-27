<html>
    <head>
        <title>SKPN</title>
        <link rel="stylesheet" href="./css/template.css">
        <link rel="stylesheet" href="./css/edycja.css">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">
        <meta charset ="UTF-8">
        <?php
            $id_publikacji = $_POST['modify'];

            ?>
    </head>
    <body>
        <div id="box">

            <header>
                <h3>SYSTEM BIBLIOMETRYCZNY</h3>
            </header>
            <div id="divider"></div>

            <div id="content">

            <img src="IMG/logoskpn.png">
                <div id="edycja">
                <h2>EDYCJA DANYCH W ARTYKULE</h2>
                <hr>
                <form action="editarticle.php" method="post">
                    
                    <input type="text" placeholder="Tytuł" id="nazwa" name ="tytul"></br>
                    <input type="date" placeholder="Data" id="data" name ="data_publikacji"></br>
                    <input type="text" placeholder="DOI" id="doi" name ="doi"></br>
                    <input type="text" placeholder="Tytul naukowy" id="tytul_naukowy" name ="tytul_naukowy"></br>
                    <input type="text" placeholder="Uczelnia" id="uczelnia" name ="uczelnia"></br>
                    <input type="text" placeholder="Punkty" id="pkt" name ="punkty"></br>
                 <hr>   
                    <?php
                      echo '<p><span>EDYTUJ</span><input class="btn" type="submit" name="id" class="dodaj_w" value='.$id_publikacji.'></p>';
                    ?>
                    
                </form>
                
                </div>
                
            </div>
<footer>
                    <p>Pingwiny&copy; 2019 ZUT PSIAI</p>
            </footer>

    </body>
</html>