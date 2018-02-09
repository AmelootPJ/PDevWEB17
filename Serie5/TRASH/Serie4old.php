<?php 
	$Montitle= 'Mon Title 1';
	require 'RESSOURCES\haut.php' ;
?>
	<div class="container-fluid">
		<div class="row">
			<header id="header" class="col-lg-10 offset-3">
				<h1>Les Tableaux</h1>
			</header>	
		</div>
	</div>
	<div class="container">
		
		<div class="row">
			<section class="col-lg-10">
				<div class="row">
					<article class="col-sm-8">
						<p>Exercice 1 : tableau jour de semaines</p>
						<table>
							   <tr>
							      <td>Lundi</td>
							      <td>Mardi</td>
							      <td>Mercredi</td>
							      <td>Jeudi</td>
							      <td>Vendredi</td>
							      <td>Samedi</td>
							   </tr>
							   <tr>
							      <td>ligne2 colonne1</td>
							      <td>ligne2 colonne2</td>
							      <td>ligne2 colonne3</td>
							      <td>ligne2 colonne4</td>
							   </tr>
							...
							</table> 
					</article>
				</div>
			</section>
			<aside class="col-lg-2">
			</aside>
		</div>
	</div>
<?php 
	require 'bas.php' ;
?>