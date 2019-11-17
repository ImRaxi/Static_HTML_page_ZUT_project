<?php 
    @session_start();

    session_unset();
    header('Location: strona_glowna_niez.php');
?>