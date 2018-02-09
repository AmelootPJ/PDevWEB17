<?php 
	$Montitle= 'POO';
	require 'haut.php' ;
?>


<!-- Série 6 -->
<!-- 
    Notes personnelles :
-->


<!-- Exercice 3 : enregistrement Zone NOM Zone Session --><!-- éclaircir zone / session ? mode connect,...?-->
<!-- Exercice 4 : notification utilisateur dans l'en-tête -->
	<!--<div class="container-fluid">
		<div class="row">
			<Header>
			</Header>
		</div>
	</div>-->
	<div class="container">
		
		<div class="row">
			<section class="col-lg-10">
				<div class="row">
					<article class="col-sm-6">
						<h2>Que le combat commence!</h2>
									<?php

										require "Class\Personnage.php";

										// autoload : 
										//function chargerClasse($classe)
										//{
										//  require $classe . '.php'; // On inclut la classe correspondante au paramètre passé.
										//}

										//spl_autoload_register('chargerClasse'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.

										$Perso1 = new Personnage("Personnage 1", 50, 1, 200, 0, 0);
										$Perso2 = new Personnage("Personnage 2", 100, 1, 300, 0, 0);

										if ($Perso1->GetForce() != $Perso2->GetForce()):
										{
											$StrComp = " contrairement au ";
											$StrComp2 = " qui a ";
										}
										else:
										{
											$StrComp = " et le ";
											$StrComp2 = " a ";
										}
										endif;

										echo $Perso1->GetNom() . ' a ' . $Perso1->GetForce() . $StrComp . $Perso2->GetNom() . $StrComp2 . $Perso2->GetForce() . ' de force.<Br>' ;

										$i=0;
										while (($Perso1->GetPvie() >=1) AND ($Perso2->GetPvie() >=1))
										{
											$i=$i+1;
											echo 'Tour : ' . $i .'<Br>';
											$Perso1->Frapper($Perso2);
											echo $Perso1->GetNom() . ' frappe ' . $Perso2->GetNom() . ' et fait ' . $Perso1->GetDegats() . ' points de dégats.<Br>';
											$Perso1->SetExperience($Perso1->GetExperience()+1);
												if ($Perso2->GetPvie() >=1):
												{
													$Perso2->Frapper($Perso1);
													echo $Perso2->GetNom() . ' frappe ' . $Perso1->GetNom() . ' et fait ' . $Perso2->GetDegats() . ' points de dégats.<Br>';
													$Perso2->SetExperience($Perso2->GetExperience()+1);
												}
												endif;

											if ($Perso1->GetPVie() != $Perso2->GetPVie()):
											{
												$StrComp = " contrairement au ";
												$StrComp2 = " qui a ";
											}
											else:
											{
												$StrComp = " et le ";
												$StrComp2 = " a ";
											}
											endif;
											echo $Perso1->GetNom() . ' a ' . $Perso1->GetPVie() . $StrComp . $Perso2->GetNom() . $StrComp2 . $Perso2->GetPVie() . ' de points de vie.<Br>'; 
										}
										if ($Perso1->GetExperience() != $Perso2->GetExperience()):
										{
											$StrComp = " contrairement au ";
											$StrComp2 = " qui a ";
										}
										else:
										{
											$StrComp = " et le ";
											$StrComp2 = " a ";
										}
										endif;
										echo $Perso1->GetNom() . ' a ' . $Perso1->GetExperience() . $StrComp . $Perso2->GetNom() . $StrComp2 . $Perso2->GetExperience() . ' d\'expérience.<Br>' ; 
										?>
					</article>

				</div>
			</section>
		</div>
	</div>
<?php 
	require 'bas.php' ;
?>