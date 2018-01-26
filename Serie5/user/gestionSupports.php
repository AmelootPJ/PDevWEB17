<?php
// Supprimer un type support
if (isset($_POST['supprimer'])) {
    var_dump($_POST);
    $req_supports = $bdd->prepare('
        UPDATE supports
        SET type_support = NULL
        WHERE type_support = :type_support
        ');
    $req_supports->execute(array('type_support' => $_POST['type_support']));
    $req_type_support = $bdd->prepare('
        DELETE FROM types_support
        WHERE type_support = :type_support
        ');
    $req_type_support->execute(array('type_support' => $_POST['type_support']));
}
// Ajout d'un nouveau type support
if (isset($_POST['addTypeSupport'])) {
    $_POST = secure($_POST);
    $typeSupport = strtoupper($_POST['nouvTypeSupport']);
    addTypeSupport($bdd, $typeSupport);
}

?>
    <!-- Formulaire nouveau type support -->
    <form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
		<label for="nouvTypeSupport">Nouveau type : </label>
		<input type="text" name="nouvTypeSupport" id="nouvTypeSupport" maxlength="20" autofocus />
		<input type="submit" name="addTypeSupport" value="Ajouter">
	</form>
<?php
$typesSupport = getTypesSupport($bdd);
echo '<table>';
foreach ($typesSupport as $key => $value) {
    echo '<form method="POST" action="'.$_SERVER['REQUEST_URI'].'")';
    echo '<tr><td>'.$value.'</td>';
    echo '<td><input type="hidden" name="type_support" value="'.$value.'" />';
    echo '<input type="submit" name="supprimer" value="Supprimer" />';
    echo '</td></tr></form>';
}
echo '</table>';

?>