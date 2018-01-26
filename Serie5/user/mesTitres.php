<?php
if (isset($_SESSION['idUser'])) {

    // Modifier film
    if (isset($_POST['modifier'])) {
        $titre = getTitre($bdd, $_GET['fiche']);
        if (isset($_POST['annuler'])) {
            unset($_POST);
        } elseif (isset($_POST['send'])) {
            if (isset($_FILES['photo'])) {
                copy($_FILES['affiche']['tmp_name'], "style/affiches/".$_FILES['affiche']['name']);
                $photo = $_FILES['affiche']['name'];
            }
            else {
                $photo = $_POST['photo'];
            }
            $_POST = secure($_POST);
            $reqUpdateTitre = $bdd->prepare('
            UPDATE titres
            SET titre = :titre,
            description = :description,
            lien = :lien,
            photo = :photo
            WHERE idTitre = :idTitre');
            $reqUpdateTitre->execute(array(
                'titre' => $_POST['titre'],
                'description' => $_POST['description'],
                'lien' => $_POST['lien'],
                'photo' => $photo,
                'idTitre' => $_GET['fiche']
            ));
        }
    }

	// Ajout de categorie/support
	if (isset($_POST['ajouter'])) {
		// Categorie
		if (isset($_POST['categorieSelect'])) {
			$reqAddCategorie = $bdd->prepare('
				INSERT INTO ln_titres_categories( idTitre, categorie)
				VALUES( :idTitre, :categorie)');
			$reqAddCategorie->execute(array(
				'idTitre' => $_GET['fiche'],
				'categorie' => $_POST['categorieSelect']));
		}
		// Support
		if (isset($_POST['supportSelect'])) {
			$reqAddSupport = $bdd->prepare('
				INSERT INTO ln_titres_supports( idTitre, support)
				VALUES( :idTitre, :support)');
			$reqAddSupport->execute(array(
				'idTitre' => $_GET['fiche'],
				'support' => $_POST['supportSelect']));
		}
	}
	
	// Supprimer support/categorie
	if (isset($_POST['supprimer'])) {
		if (isset($_POST['categorie'])) {
			$reqDelCategorie = $bdd->prepare('
				DELETE FROM ln_titres_categories
				WHERE idTitre = :idTitre
				AND categorie = :categorie');
			$reqDelCategorie->execute(array(
				'idTitre' => $_GET['fiche'],
				'categorie' => $_POST['categorie']
				));
		}
		if (isset($_POST['support'])) {
			$reqDelSupport = $bdd->prepare('
				DELETE FROM ln_titres_supports
				WHERE idTitre = :idTitre
				AND support = :support');
			$reqDelSupport->execute(array(
				'idTitre' => $_GET['fiche'],
				'support' => $_POST['support']
				));
		}
	}

    // Fermer la fiche
    if (isset($_POST['fermer'])) {
        unset($_POST);
        unset($_GET);
    }
			
	// affiche la fiche du film selectionné
    if (isset($_GET['fiche'])) {
        echo '<div class="fiche">';
        // recuperation des infos du film
		$titre = getTitre($bdd, $_GET['fiche']);
        $compt = 0;
		//generer un <table> avec les infos du titre
		echo "<table>";
		foreach ($titre as $key => $value) {
			// Affiche categorie ou support
			if (is_array($value)) {
				// Prepare affichage supports au titre avec bouton supprimer
				if ($key == 'supports') {
					$str = '<div class="fiche_formSelect"><span class="caseTitre">Supports</span><table>';
                    for ($i=0; $i < count($value); $i++) {
						foreach ($value as $k => $v) {
							$str .= '<form method="POST" action="'.$_SERVER['REQUEST_URI'].'">';
							$i=0;
							while ($i < count($v)) {	
								$str .= '<tr><td class="caseValeur">'.$v[$i].', '.$k.'</td><td>';
								$str .= '<input type="hidden" name="support" value="'.$v[$i].'" />';
								$str .= '<input type="submit" name="supprimer" value="Supprimer" /></td></tr>';
								$i++;
							}
							$str .= '</form>';
						}
					}
                    // Prepare formulaire ajout nouveau support
					$str .= '<form method="POST" action="'.$_SERVER['REQUEST_URI'].'">';
					$str .= '<tr><td colspan="2" class="caseValeur">'.genSelectSupport($bdd, $_GET['fiche']);
					$str .= '<input type="submit" name="ajouter" value="ajouter" /></td></tr></table></div></form>';
				}
				// Prerare affichage categories
				elseif ($key == 'categories') {
					$str = '<div class="fiche_formSelect"><span class="caseTitre">Categories</span><table>';
					// Prepare affichage des categories avec bouton supprimer
					foreach ($value as $k => $v) {
						$str .= '<form method="POST" action="'.$_SERVER['REQUEST_URI'].'">';
						$str .= '<tr><td class="caseValeur">'.$v.'</td><td>';
						$str .= '<input type="hidden" name="categorie" value="'.$v.'" />';
						$str .= '<input type="submit" name="supprimer" value="Supprimer" /></td></tr></form>';
					}
					// Prepare formulaire ajout categorie
					$str .= '<form method="POST" action="'.$_SERVER['REQUEST_URI'].'">';
					$str .= '<tr><td colspan="2" class="caseValeur">'.genSelectCategorie($bdd, $_GET['fiche']);
					$str .= '<input type="submit" name="ajouter" value="ajouter" /></td></tr></table></div></form>';
				}
				// Prepare affichage d'autres arrays
				else {
					$str = implode(',<br>', $value);
				}
                /* Affiche Categories ou Supports suivant $str
                ** verif du compt pour l'alignement en 1 <tr> */
                if ($compt == 0) {
                    echo '<tr><td>' . $str . '</td>';
                    $compt++;
                }
                else {
                    echo '<td>' . $str . '</td></tr>';
                    $compt = 0;
                }
            }
            // Evite d'afficher idTitre ou idUser
            elseif ($key == 'idUser' || $key == 'idTitre') {
                // Ne pas afficher idTitre et idUser dans la <table>
            }
			// Affiche le reste
			else {
				echo '<tr><td class="caseTitre">'.ucfirst($key).'</td><td class="caseValeur">'.$value.'</td></tr>';
			}
		}
		echo "</table>";
        echo '</div>';
        // Modification d'un titre
        echo '<div class="modifTitre">';
        if (isset($_POST['modifier']) && !isset($_POST['send'])) {
            ?>
            <div class="modifTitre_form">
                <form enctype="multipart/form-data" method="POST" action="<? echo $_SERVER['REQUEST_URI']?>" >
                    <label for="titre">Titre :</label>
                    <input type="text" name="titre" id="titre" value="<?php echo $titre['titre']?>" maxlength="20" autofocus/></br>
                    <label for="description">Description :</label>
                    <textarea name="description"><?php echo $titre['description']?></textarea></br>
                    <label for="lien">Lien allocine : </label>
                    <input type="text" name="lien" id="lien" value="<?php echo $titre['lien']?>" />
                    <br><label for="photo">Modifier l'affiche :</label>
                    <input type="file" name="affiche" >
                    <input type="hidden" name="photo" value="<?php echo $titre['photo']?>" />
                    <input type="hidden" name="modifier" />
                    <br><input type="submit" name="send" value="Valider" />
                    <input type="submit" name="annuler" value="Annuler" />
                </form>
            </div>
        <?php
        }
        else {
            echo '<form method="POST" action="'.$_SERVER['REQUEST_URI'].'">';
            echo '<input type="submit" name="modifier" value="Modifier" />';
            echo '<input type="submit" name="fermer" value="Fermer" />';
            echo '</form>';
        }
        echo '</div>';
	}// Fin de fiche

	// Affiche les films de l'utilisateur
	$titres = getTitres($bdd, $_SESSION['idUser']);
	echo affTable($titres);
	
}
else {
	include 'connectionRequise.php';		
}