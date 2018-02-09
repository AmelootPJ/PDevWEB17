<?php 
	$Montitle= 'Formulaire';
	require 'haut.php' ;
?>


<!-- Série 5 -->
<!-- 
    Notes personnelles :
    Reprogrammer en POO 
    CSS Form
    Tbl td tr fields form 
    revoir connect et vérification 

    utliser un preg match pour la verification d'email. -> regex
    	#(séparateur choisi)
    	^(commence par)
    	$(termine par)

    	#^[a-zA-Z0-9]{1,}@[a-zA-Z0-9]{2,}.[a-zA-Z0-9]{2,6} $#
    insérer les balises de mise à la ligne dans les valeurs d'erreur (idem pour les bootstrap warning)

    php '' et non pas ""
-->

<!-- initialisation des variables -->
<?php $Error = ""; ?>
<!-- Exercice 2 : Erreur nom -->
<?php   if (isset($_POST['NOM'])): 
            if (strpos($_POST['NOM'], ",") == FALSE): 
                $Error = $Error . "ErrNom";
            endif; ?>
<!-- Exercice 2 : Erreur Mail -->
<?php       if (strpos($_POST['EMAIL'], "@") == FALSE OR strpos($_POST['EMAIL'], ".") == FALSE):
                $Error = $Error . "ErrMail";
            endif; ?>
<!-- erreur message vide -->
<?php       if ($_POST['MESSAGE'] == ""):
                $Error = $Error . "ErrMess";
            endif;
        endif; ?>
<!-- Gestion du statut de la session : formulaire vierge, connecté, réquisition pour correction -->
<?php 
/*Connecté*/
        if (isset($_POST['NOM']) AND $Error == ""): 
            $Nom = $_POST['NOM']; 
            $Email = $_POST['EMAIL']; 
            $Jesuis = $_POST['JESUIS']; 
            $Message = $_POST['MESSAGE']; 
                if (isset($_POST['NEWSLETTER'])) : 
                    $Newsletter = $_POST['NEWSLETTER']; 
                else: 
                    $Newsletter = "0"; 
                endif; 
            session_start(); 
            $_SESSION['UTILISATEUR_OK'] = "1"; 
            $_SESSION['UTILISATEUR_NOM'] = $_POST['NOM']; 
            $Status = 1;
/*Correction*/
        elseif (isset($_POST['NOM']) AND $Error != ""): 
            $Nom = $_POST['NOM']; 
            $Email = $_POST['EMAIL']; 
            $Jesuis = $_POST['JESUIS']; 
            $Message = $_POST['MESSAGE']; 
                if (isset($_POST['NEWSLETTER'])) : 
                    $Newsletter = $_POST['NEWSLETTER']; 
                else: 
                    $Newsletter = "0"; 
                endif; 
            $_SESSION['UTILISATEUR_OK'] = "0"; 
            $_SESSION['UTILISATEUR_NOM'] = $_POST['NOM']; 
            $Status = 2; 
/*Vierge*/
        else: 
        /*initialisation des variables*/
            $Nom = ""; 
            $Email = ""; 
            $Jesuis = ""; 
            $Message = ""; 
            $Newsletter = "0";
            $Status = 0; 
        endif; ?>
<!-- Exercice 3 : enregistrement Zone NOM Zone Session --><!-- éclaircir zone / session ? mode connect,...?-->
<!-- Exercice 4 : notification utilisateur dans l'en-tête -->
	<div class="container-fluid">
		<div class="row">
			<Header>
			    <?php if($Status == 1): ?>
			        <NOM>
			            <?php if ($_SESSION['UTILISATEUR_OK'] == 1): ?>
			            <TABLE>
			                <TR>
			                    <TD><label for="UTILISATEUR_NOM"><?php echo 'Bienvenue ' . $Nom ?></label></TD>
			                    <TD><input type="hidden" name="UTILISATEUR_OK" value=<?php echo $_SESSION['UTILISATEUR_OK'] ?>></TD>
			                    <TD><?php include 'S5P1FormBPDeconnect.php'; ?></TD>
			                <TR>
			            </TABLE>
			            
			            <?php endif ?>
			        </NOM>
			    <?php endif ?>
			</Header>
		</div>
	</div>
	<div class="container">
		
		<div class="row">
			<section class="col-lg-10">
				<div class="row">
					<article class="col-sm-6">
						<h2>Formulaire de contact</h2>
						<p>Les champs (*) sont des champs obligatoires</p>
							<form enctype="multipart/form-data"action="page3.php" method="post" accept-charset="utf-8">
									<!-- * Hidden Status  -->
						             <input type="hidden" value= <?php echo $Status ?> name="Status"/>
						             <!-- * Input box Nom value : nom, prénom -->
						            <p><label for="NOM">*Nom : </label>
						        	<?php echo '<input type="text" name="NOM" id="Nom" placeholder="nom, prénom" size="50" maxlength="100" autofocus="" required value="'.$Nom.'"'?></p>
						                <?php if (strpos($Error,"ErrNom")!== FALSE): ?>
						                        <div class="alert alert-warning">
                             						<strong>Warning!</strong> Votre nom doit être encodé sous forme "nom, prénom"
                       							</div>       
						                <?php else: ?>
						                        <Br>
						                <?php endif; ?>
						            <!-- * Input box email value : roberto.deguglielmo@promsocatc.net -->
						            <label for="EMAIL">*Email :</label>
						            <input type="text" name="EMAIL" placeholder="adressemail@fournisseur.domaine" size="50" maxlength="120" required value=<?php echo $Email ?> ><Br>
						                <?php if (strpos($Error,"ErrMail")!== FALSE): ?>
						                        <div class="alert alert-warning">
                             						<strong>Warning!</strong> Votre adresse mail doit contenir un "@" et un point.
                       							</div>       
						                <?php else: ?>
						                        <Br>
						                <?php endif; ?>
						                <!-- DropDown box etat value : PROF -->
						            <label for="JESUIS">Je suis :</label>
						            <select name="JESUIS">
						                	<option value="PART"<?php if($Jesuis == 'PART'){echo 'selected="selected"';} ?>>Particulier</option>
						                	<option value="PROF"<?php if($Jesuis == 'PROF'){echo 'selected="selected"';} ?>>Professionel</option>
						            </select><br>
						             <!--Input box Message value : Bon travail à tous! -->
						                <label for="MESSAGE">Votre message :</label><br>
						                <textarea name="MESSAGE" rows="10" cols="50" placeholder="Tapez votre message." ><?php echo $Message; ?></textarea><br>
						                <?php if (strpos($Error,"ErrMess")!== FALSE): ?>
						                        <div class="alert alert-warning">
                             						<strong>Warning!</strong> Vous avez oubliez d'insérer votre message.
                       							</div>       
						                <?php else: ?>
						                        <Br>
						                <?php endif; ?>
						             <!--Checkbox Newsletter value : 1 -->      
						                <input type="checkbox" name="NEWSLETTER" value="1"<?php if($Newsletter == 1){echo 'checked';} ?> /> 
						                <label for="checkbox">Je veux recevoir la newsletter.</label><br>
						            <!--End Button Submit -->  
						        	    <input type="submit" name="Envoyer" value="Envoyer">


						</form>

					</article>

				</div>
			</section>
			 <!--<aside class="col-lg-2">
					<?php
					/*echo '<pre>';
					        print_r($_POST);
					echo '</pre>';*/
					?>
			</aside> --> 
		</div>
	</div>
<?php 
	require 'bas.php' ;
?>