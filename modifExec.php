<?php 
session_start();
include_once 'Methods.php';
$conn=db_connect();
if(isset($_SESSION['connect'])){
	if($_SESSION['connect']!=1)
	{
		echo"<script type='text/javascript'>alert('Vous devez etre connecte pour acceder a cette page !');
			document.location.href='index.php';</script>";


	}else{
		if(isset($_SESSION["safe"])){
			if($_SESSION['safe']==false){echo "<script type='text/javascript'>alert('Votre mot de passe n est pas securise , Redirection vers la parge de changement de mdp.');
								document.location.href='reglage.php';
					</script>";}
		}
	}
}


if(isset($_POST["jours"])&&isset($_POST["seance"])&&isset($_POST["salle"])){
	$sqlin="insert into seances_mod(codeSeance,date,heure,salle) values
			(".$_POST["codeSeance"].",'".$_POST["jours"]."',".$_POST["seance"].",".$_POST["salle"].") 
			";
	$res=$conn->query($sqlin);
	
	if($res){
	echo "<script type='text/javascript'>
			alert('Votre demande a ete enregistre avec succes');
			window.close();</script>";
	} else echo "<script type='text/javascript'>
			alert('Un probleme est survenu durant l enregistrement de la demande.');
			window.close();</script>";
}
else echo"<script type='text/javascript'>alert('Veuillez remplir tous les champs !');
			document.location.href='modifierProf.php';</script>";


?>