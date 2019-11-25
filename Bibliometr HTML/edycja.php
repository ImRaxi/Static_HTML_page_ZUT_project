<html>
    <head>
        <title>SKPN</title>
        <link rel="stylesheet" href="./css/template.css">
        <link rel="stylesheet" href="./css/edycja.css">
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
                <div id="edycja">
                <h1>EDYCJA DANYCH<h1>
                <form action="editarticle.php" method="post">
                    
                    <input type="text" placeholder="tytuł" id="nazwa" name ="tytul"></br>
                    <input type="date" placeholder="Data" id="data" name ="data_publikacji"></br>
                    <input type="text" placeholder="DOI" id="doi" name ="doi"></br>
                    <input type="text" placeholder="Tytul naukowy" id="tytul_naukowy" name ="tytul_naukowy"></br>
                    <input type="text" placeholder="Uczelnia" id="uczelnia" name ="uczelnia"></br>
                    <input type="text" placeholder="Punkty" id="pkt" name ="punkty">
                    <?php
                      echo '<input type="submit" name="id" class="dodaj_w" value='.$id_publikacji.'>'
                    ?>
                    
                </form>
                </div>
				
            </div>


    </body>
</html>