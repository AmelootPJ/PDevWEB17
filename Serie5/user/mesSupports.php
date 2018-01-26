<?php
// Ajouter un support
if (isset($_POST['addSupport'])) {
    $_POST = secure($_POST);
	$reqAddSupport = $bdd->prepare('
		INSERT INTO supports( support, type_support, idUser, actif)
		VALUES( :support, :type_support, :idUser, :actif)');
	$reqAddSupport->execute(array(
		'support' => $_POST['newSupport'],
		'type_support' =>$_POST['type_support'],
		'idUser' => $_SESSION['idUser'],
        'actif' => 1
		));
}
// Supprimer un support
elseif (isset($_POST['supprimer'])) {
	$reqDelLn = $bdd->prepare('
		DELETE FROM ln_titres_supports
		WHERE support = :support');
	$reqDelLn->execute(array('support' => $_POST['support']));

	$reqDelSupport = $bdd->prepare('
		DELETE FROM supports 
		WHERE support = :support
		AND idUser = :idUser');
	$reqDelSupport->execute(array(
		'support' => $_POST['support'],
		'idUser' => $_SESSION['idUser']
		));
}
// formulaire ajout support
$typesSupport = getTypesSupport($bdd);
?>
	<form method="POST" method="".$_SERVER['REQUEST_URI'].".php">
		<label for="support">ref : </label>
		<input type="text" name="newSupport" id="support" maxlength="20" autofocus />
		<select name="type_support">
			<?php
				foreach ($typesSupport as $key => $value) {
					echo '<option value="'.$value.'">'.$value.'</option>';
				}
			?>
		</select>
		<input type="submit" name="addSupport" value="Ajouter" />
	</form>
<?php

// Affichage supports avec bouton supprimer
$supports = getSupports($bdd);
foreach ($supports as $key => $value) {
	echo '<div class="mesSupports-typeSupport">';
	echo '<h4>'.$key.'</h4>';
	foreach ($value as $k => $v) {
		echo '<div class="mesSupports-support">';
		echo "<form method='POST' action='".$_SERVER['REQUEST_URI']."'>";
		echo $v;
		echo "<input type='hidden' name='support' value='".$v."' />";
		echo "<input type='submit' name='supprimer' value='Supprimer' /></form>";
		echo "<div class='mesSupports-titresSupport'><ul>";
		$titresSupport = getTitresSupports($bdd, $v);
		for ($i=0; $i <count($titresSupport) ; $i++) { 
			echo '<li><a>'.$titresSupport[$i].'</a></li>';
		}
		echo "</div>";
		echo '</div>';
	}
	echo "</div>";
}