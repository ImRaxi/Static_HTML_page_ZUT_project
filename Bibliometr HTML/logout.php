<?php 
    session_start();

    session_unset();
    header('Location: Strona_glowna_niez.php');
?>