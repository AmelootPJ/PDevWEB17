<?php
// Supprimer une categorie
if (isset($_POST['supprimer'])) {
	$reqDelLn = $bdd->prepare('
		DELETE FROM ln_titres_categories
		WHERE categorie = :categorie');
	$reqDelLn->execute(array('categorie' => $_POST['categorie']));
	$reqDelCategorie = $bdd->prepare('
		DELETE FROM categories
		WHERE categorie = :categorie');
	$reqDelCategorie->execute(array('categorie' => $_POST['categorie']));
}
// Ajouter une categorie
elseif (isset($_POST['addCategorie'])) {
    $_POST = secure($_POST);
	$_POST['categorie'] = strtoupper($_POST['categorie']);
	$reqAddCategorie = $bdd->prepare('
		INSERT INTO categories( categorie)
		VALUES(:categorie)');
	$reqAddCategorie->execute(array('categorie' => $_POST['categorie']));
}

//formulaire de nouvelle categorie
?>
	<form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
		<label for="categorie">Nom : </label>
		<input type="text" name="categorie" maxlength="20" autofocus />
		<input type="submit" name="addCategorie" value="Ajouter">
	</form>
<?php

// Affiche les categories avec le bouton supprimer
$categories = getCategories($bdd);
echo '<table><thead><th>Nom</th><th></th></thead><tbody>';
foreach ($categories as $key => $value) {
	echo '<form method="POST" action="'.$_SERVER['REQUEST_URI'].'")';
	echo '<tr><td>'.$value.'</td>';
	echo '<td><input type="hidden" name="categorie" value="'.$value.'" />';
	echo '<input type="submit" name="supprimer" value="Supprimer" />';
	echo '</td></tr></form>';
}
echo '</tbody></table>';

?>