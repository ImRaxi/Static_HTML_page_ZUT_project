<?php 
  session_start();

  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header('Location:  Strona_glowna_z.php');
    exit();
  }
?>

<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./css/login.css">
  <link rel="stylesheet" href="./css/template.css">
  <title>System Bibliometryczny</title>
</head>

<body class ="preload">
    <div id="box">
    
    <header>
      <h3>SYSTEM BIBLIOMETRYCZNY</h3>
    </header>
    
    <div id="divider"></div>
    
    <div id="content">

    <a href="strona_glowna_niez.php">
      <img src="IMG/logoskpn.png">
    </a>
    
    
    <div id="form">

    
    <form action = "zaloguj.php" method = "post">
      <h1>LOGOWANIE</h1>

    <hr>
      <?php if(isset($_SESSION['err'])) {
        echo $_SESSION['err'];
      } else { echo ''; } 
      ?>
    
      <input type="email" placeholder="E-mail" name="email" required />
      <input type="password" placeholder="Hasło" name = "haslo" required/>
      
    <hr>
    
      <input type="submit" class="button" value="ZALOGUJ SIĘ"/> 
      
      <input type="button" class="button" value="ZAREJESTRUJ SIĘ" onclick="location.href = 'reje.php'"/> 
    </form>


  </div>
  </div>
  <footer>
    <p>Pingwiny&copy; 2019 ZUT PSIAI</p>
  </footer>  
  </div>

</body>

</html>