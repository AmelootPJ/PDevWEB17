<?php

if (isset($_POST['ajoutTitre'])) {
    if (!empty($_FILES['photo']['name']) && $_FILES['photo']['error'] == 0) {
        copy($_FILES['photo']['tmp_name'], "style/affiches/".$_FILES['photo']['name']);
    }
    $_POST = secure($_POST);
    // INSER INTO titres
	if (!checkTitre($bdd, $_POST['titre'])) {
		$reqTitre = $bdd->prepare('
            INSERT INTO titres(titre, description, date_ajout, photo, lien, actif)
            VALUES( :titre, :description, NOW(), :photo, :lien, :actif)');
		$reqTitre->execute(array(
            'titre' => $_POST['titre'],
            'description' => $_POST['description'],
            'photo' => $_FILES['photo']['name'],
            'lien' => $_POST['lien'],
            'actif' => 1
        ));
	}
	// Recuperation de l'id du titre
	$reqIdTitre = $bdd->query('
		SELECT idTitre 
		FROM titres 
		WHERE titre = "'.$_POST['titre'].'"');
	$result = $reqIdTitre->fetch();
	$idTitre = $result['idTitre'];

	// INSERT INTO ln_users_titres
	$reqUser = $bdd->prepare('
		INSERT INTO ln_users_titres(idUser, idTitre)
		VALUES( :idUser, :idTitre)');
	$reqUser->execute(array(
		'idUser' => $_SESSION['idUser'],
		'idTitre' => $idTitre
		));

	// INSERT INTO ln_titres_Categories
	if (isset($_SESSION['tmpCategories'])) {
		foreach ($_SESSION['tmpCategories'] as $key => $value) {
			$reqCategorie = $bdd->prepare('
				INSERT INTO ln_titres_categories(idTitre, categorie)
				VALUES( :idTitre, :categorie)');
			$reqCategorie->execute(array(
				'idTitre' => $idTitre,
				'categorie' => $value
				));
		}
	}

	// INSERT INTO ln_titres_supports
	if (isset($_SESSION['tmpSupports'])) {
		foreach ($_SESSION['tmpSupports'] as $key => $value) {
			$reqCategorie = $bdd->prepare('
				INSERT INTO ln_titres_supports(idTitre, support)
				VALUES( :idTitre, :support)');
			$reqCategorie->execute(array(
				'idTitre' => $idTitre,
				'support' => $value
				));
		}
	}


	unset($_SESSION['tmpSupports']);
	unset($_SESSION['tmpCategories']);
	unset($_POST);
}
// Reinitialiser le formulaire.
elseif (isset($_POST['annuler'])) {
	unset($_SESSION['tmpSupports']);
	unset($_SESSION['tmpCategories']);
	unset($_POST);
}
// Actions Module gestion categories
elseif (isset($_POST['categorie'])) {
	if ($_POST['categorie'] == 'ajouter') {
		$_SESSION['tmpCategories'][] = $_POST['categorieSelect'];
	}
	elseif ($_POST['categorie'] == 'supprimer') {
		if (in_array($_POST['categorieSelect'], $_SESSION['tmpCategories'])) {
			$key = array_keys($_SESSION['tmpCategories'], $_POST['categorieSelect']);
			unset($_SESSION['tmpCategories'][$key[0]]);
		}
	}
}
// Actions Module gestion supports
elseif (isset($_POST['support'])) {
	if ($_POST['support'] == 'ajouter') {
		$_SESSION['tmpSupports'][] = $_POST['supportSelect'];
	}
	elseif ($_POST['support'] == 'supprimer') {
		if (in_array($_POST['supportSelect'], $_SESSION['tmpSupports'])) {
			$key = array_keys($_SESSION['tmpSupports'], $_POST['supportSelect']);
			unset($_SESSION['tmpSupports'][$key[0]]);
		}
	}
}

// Formulaire d'ajout Film
$categories = getCategories($bdd);
$supports = getTypesSupport($bdd);
$titre = (isset($_POST['titre'])) ? $_POST['titre'] : '';
$description = (isset($_POST['description'])) ? $_POST['description'] : '';
?>
	<form enctype="multipart/form-data" method="POST" action="index.php?ajoutTitre">
		<label for="titre">Titre :</label>
		<input type="text" name="titre" id="titre" value="<?php echo $titre; ?>" maxlength="20" autofocus /><br>
        <label for="description">Description :</label>
        <textarea name="description"><?php echo $description; ?></textarea><br>
        <label for="lien">Lien allocine : </label>
        <input type="text" name="lien" id="lien" />
        <br><label for="photo">Affiche :</label>
        <input type="file" name="photo" />
<!--		 Module gestion categories-->
		<fieldset class="formSelect"><legend>Categories</legend>
			<?php 
				if (isset($_SESSION['tmpCategories'])) {
					echo "<ul>";
					foreach ($_SESSION['tmpCategories'] as $key => $value) {
						echo "<li>".$value."</li>";
					}
					echo "</ul>";
				}
				echo genSelectCategorie($bdd);
			?>
			<input type="submit" name="categorie" value="ajouter">
			<input type="submit" name="categorie" value="supprimer">
		</fieldset>
<!--        Module gestion supports-->
		<fieldset class="formSelect"><legend>Supports</legend>
			<?php 
				if (isset($_SESSION['tmpSupports'])) {
					echo "<ul>";
					foreach ($_SESSION['tmpSupports'] as $key => $value) {
						echo "<li>".$value."</li>";
					}
					echo "</ul>";
				}
				echo genSelectSupport($bdd);
			?>
			<input type="submit" name="support" value="ajouter">
			<input type="submit" name="support" value="supprimer">
		</fieldset>
		<input type="submit" name="ajoutTitre" value="Terminer">
		<input type="submit" name="annuler" value="Annuler">
	</form>
<?
