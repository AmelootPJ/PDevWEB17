<?php
$ip = $_SERVER['REMOTE_ADDR'];//On obtient l'adresse IP
$gethostbyaddr = gethostbyaddr($ip);
$dyn = explode('.', $gethostbyaddr);
$nb_points = substr_count($gethostbyaddr, '.');// Nombre de point(s) dans la ligne
  
echo 'Votre IP est <strong>',$ip,'</strong><br />',"\r\n"
,'Votre FAI est <a href="http://www.',$dyn[$nb_points - 1],'.',$dyn[$nb_points],'" title="Portail de ',ucfirst($dyn[$nb_points - 1]),'">',ucfirst($dyn[$nb_points - 1]),'</a>';
?>