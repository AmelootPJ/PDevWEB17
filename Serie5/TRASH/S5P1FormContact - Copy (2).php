<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<!-- Form : Contact -->
<!-- à effacer exercice 5 -->
<!-- Reprogrammer en POO -->
<!-- CSS Form -->
<!-- Tbl td tr fields form -->
<!-- revoir connect et vérification -->

<!-- initialisation des variables -->
    <?php $Error = "";?>
    <?php echo $Error;?>
<!-- erreur exercice 2 : Nom -->
<?php if (isset($_POST['Nom'])): ?>
    <?php if (strpos($_POST['NOM'], ",") == FALSE): ?>
        <?php $Error = $Error . "ErrNom"; ?>
        <?php echo "Erreur Nom"; ?>
    <?php endif; ?>
    <?php if (strpos($_POST['EMAIL'], "@") == FALSE OR strpos($_POST['EMAIL'], ".") == FALSE): ?>
        <?php $Error = $Error . "ErrMail"; ?>
        <?php echo "Erreur Mail"; ?>
    <?php endif; ?>
<?php endif; ?>
<?php echo $Error;?>
<?php if (isset($_POST['NOM']) AND $Error == ""): ?>
        <?php $Nom = $_POST['NOM']; ?>
        <?php $Email = $_POST['EMAIL']; ?>
        <?php $Jesuis = $_POST['JESUIS']; ?>
        <?php $Message = $_POST['MESSAGE']; ?>
            <?php if (isset($_POST['NEWSLETTER'])) : ?>
                <?php $Newsletter = $_POST['NEWSLETTER']; ?>
            <?php else: ?>
                <?php $Newsletter = "0"; ?>
            <?php endif; ?>
        <?php $_SESSION['UTILISATEUR_OK'] = "1"; ?>
        <?php $_SESSION['UTILISATEUR_NOM'] = $_POST['NOM']; ?>
        <?php $Status = 1; ?>
<!-- à effacer -->
        <label for="Session">Connected</label><Br>
        <?php echo $Error; ?>
<?php elseif (isset($_POST['NOM']) AND $Error != ""): ?>
        <?php $Nom = $_POST['NOM']; ?>
        <?php $Email = $_POST['EMAIL']; ?>
        <?php $Jesuis = $_POST['JESUIS']; ?>
        <?php $Message = $_POST['MESSAGE']; ?>
            <?php if (isset($_POST['NEWSLETTER'])) : ?>
                <?php $Newsletter = $_POST['NEWSLETTER']; ?>
            <?php else: ?>
                <?php $Newsletter = "0"; ?>
            <?php endif; ?>
        <?php $_SESSION['UTILISATEUR_OK'] = "0"; ?>
        <?php $_SESSION['UTILISATEUR_NOM'] = $_POST['NOM']; ?>
        <?php $Status = 2; ?>
<!-- à effacer -->
        <label for="Session">Requiried</label><Br>
<!-- Le formulaire n'a jamais été émis une fois. On démarre la session la première fois -->     
<?php else: ?>
        <?php $Nom = ""; ?>
        <?php $Email = ""; ?>
        <?php $Jesuis = ""; ?>
        <?php $Message = ""; ?>
        <?php $Newsletter = "0"; ?>
        <label for="Session">Initialize</label><Br>
        <?php $Status = 0; ?>
        <?php echo $Status; ?>
<?php endif; ?>
<!-- Exercice 3 : notification utilisateur dans l'en-tête -->
<Header>
    <?php if($Status == 1): ?>
    <Nom>
        <?php echo $Status; ?>
    </Nom>
    <?php endif ?>
</Header>
<body>
    <h2>Formulaire de contact</h2>
    <article>
        <h3>Les champs (*) sont des champs obligatoires</h3>
         <form enctype="multipart/form-data" method="POST" action="S5P1FormContact.php">
            <!-- * Hidden Status  -->
             <input type="hidden" value= <?php echo $Status ?> name="Status"/>


             <!-- * Input box Nom value : nom, prénom -->
            <label for="NOM">*Nom : </label>
        	<input type="text" name="NOM" id="Nom" placeholder="nom, prénom" size="50" maxlength="40" autofocus="" required value=<?php echo $Nom ?> ><Br>
                <?php if (strpos($Error,"ErrNom")!== FALSE): ?>
                        <font color ="red">Votre nom doit être tapé sous forme "nom, prénom." </font><Br>    
                <?php else: ?>
                        <Br>
                <?php endif; ?>
            <!-- * Input box email value : roberto.deguglielmo@promsocatc.net -->
            <label for="EMAIL">*Email :</label>
            <input type="text" name="EMAIL" placeholder="adressemail@fournisseur.domaine" size="50" maxlength="120" required value=<?php echo $Email ?> ><Br>
                <?php if (strpos($Error,"ErrMail")!== FALSE): ?>
                        <font color ="red">Votre adresse email doit être encodée correctement.  </font><Br>    
                <?php else: ?>
                        <Br>
                <?php endif; ?>
                <!-- DropDown box etat value : PROF -->
            <label for="JESUIS">Je suis :</label>
            <select name="JESUIS">
                	<option value="PART">Particulier</option>
                	<option value="PROF">Professionel</option>
            </select><br>
             <!--Input box Message value : Bon travail à tous! -->
                <label for="MESSAGE">Votre message :</label><br>
                <textarea name="MESSAGE" rows="10" cols="50" placeholder="Tapez votre message."></textarea><br>
             <!--Checkbox Newsletter value : 1 -->      
                <input type="checkbox" name="NEWSLETTER" value="1" /> 
                <label for="checkbox">Je veux recevoir la newsletter.</label><br>
            <!--End Button Submit -->  
        	    <input type="submit" name="Envoyer" value="Envoyer">
    	</form>
    </article>
</body>
<?php
echo '<pre>';
        print_r($_POST);
echo '</pre>';
?>