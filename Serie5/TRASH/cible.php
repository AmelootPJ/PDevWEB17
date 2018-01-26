<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<?php
echo '<pre>';
	print_r($_POST);
echo '</pre>';


if (isset($_POST['Cible'])) 
{
/*
Exercice 1 : 
La zone nom et prénom doit reprendre une virgule : XXX,XXX (test si virgule est dans la variable pour séparation tableau)
La zone Email doit reprendre un @ et un point

Pour chaque erreur un libellé rouge doit apparaitre en dessous de la zone testée

Exercice 2 :

Si le formulaire est correct : la zone Nom doit être enregistrée dans la session dans la zone "UTILISATEUR_NOM" et la zone UTILISATEUR_OK doit être à 1.

Exercice 3 :
Si la zone UTILISATEUR_OK est affectée à 1 : afficer bienvenue et le contenu de la zone UTILISATEUR_NOM

Exercice 4 :
Ajouter un bouton "se déconnecter" à côté de Bienvenu NOM, Prénom (ce bouton est un formulaire qui va pointer sur une nouvelle page php réceptrice du formulaire qui doit détruire la session et faire un require sur la première page du site


*/




}
?>
