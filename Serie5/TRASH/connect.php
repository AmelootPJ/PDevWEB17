<? php

session_start();
$_SESSION['UTILISATEUR_OK'] = 'Jean-Pierre'; 
$_SESSION['UTILISATEUR_NOM'] = 'test'

session_destroy(); 
$_SESSION = array();
?>