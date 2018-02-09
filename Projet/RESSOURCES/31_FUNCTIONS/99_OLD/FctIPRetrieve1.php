<?php

$ip = $_SERVER['REMOTE_ADDR'];//On obtient l'adresse IP
$gethostbyaddr = gethostbyaddr($ip);
$dyn = explode('.', $gethostbyaddr);
$nb_points = substr_count($gethostbyaddr, '.');// Nombre de point(s) dans la ligne

if(IsSet($dyn[$nb_points],$dyn[$nb_points - 1])){
    $fichier = $dyn[$nb_points - 1].'.'.$dyn[$nb_points];// Adresse du fichier
    if(@fopen('http://www.'.$fichier,'r') || @fopen('http://'.$fichier,'r')){//Il existe ;-)
        echo 'Votre IP est <span class="Gras">',$ip,'</span><br />',"\r\n"
        ,'Votre FAI est <a href="http://www.',$dyn[$nb_points - 1],'.',$dyn[$nb_points],'" title="Portail de ',ucfirst($dyn[$nb_points - 1]),'">',ucfirst($dyn[$nb_points - 1]),'</a>';
    }else{
        echo '<div style="text-align:center; color:#FF0000;">L&#39; adresse <span class="Gras">',$fichier,'</span> n&#39; existe pas.</div>',"\r\n";// Il n' existe pas :'(
    }
}else{
    echo '<div style="text-align:center;">La fonction n&#39; est pas disponnible.</div>',"\r\n";
}

?>