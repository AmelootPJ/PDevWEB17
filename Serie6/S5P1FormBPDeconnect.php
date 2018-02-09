<form method="POST">
<button class="btn-href" name="submit">se déconnecter</button><Br>
</form>
 
<?php
 
if(isset($_POST['submit'])){
 /*<!-- session_start(); --> <!-- utile? -->*/
	session_destroy();
 	require_once('S5P1FormContact.php');
 	exit();
}
 
?>