<?php
//gère la connection / affectation des vars de la session.

session_start();
include_once 'Methods.php';
if($_SESSION['connect']==1){
	switch($_SESSION['user_type']){
		case 'pr':header('Location:ProfUI.php'); break;
		case 'cd':header('Location:chefUI.php'); break;
	}
}
else {
if (isset($_POST['username'])&&isset($_POST['password'])) 
{	
		
	
	
	
	 //On check le mot de passe
		$conn=db_connect();
		if(!mysqli_connect_errno()){
		$username= $_POST['username'];       
		$password=$_POST['password'];		
		$pwd_sh=sha1($password);
		$req="SELECT login_user,password_user,type_user,id_user
        FROM users WHERE login_user ='$username' AND password_user='$pwd_sh'";
		
		$res=$conn->query($req);
		
		if ($res)
		{
			
			// Retourne le nombre de rows trouvé
			
			$rowcount=mysqli_num_rows($res);
			if($rowcount==0) {
				echo"<script type='text/javascript'>window.alert('Nom d\'utilisateur ou mot de passe incorrect.');
			document.location.href='index.php';</script>";
			} 
			else {
				$res->data_seek(0);
				$row=$res->fetch_row();
				$_SESSION['user_type']=$row[2];
				
				switch($_SESSION['user_type']){
					case 'pr':$req2="select nom,codeDept from ressources_profs where codeProf=$row[3]-5";
									$_SESSION['code_prof']=$row[3]-5;
								    break;
					case 'cd':$req2="select nom,codeDept from chef_departement where codeChefDep=$row[3]"; 
									$_SESSION['code_chef']=$row[3];
									break;
				}
				$_SESSION['id_us']=$row[3];
				$res2=$conn->query($req2);
				if($res2){
					$res2->data_seek(0);
					$row2=$res2->fetch_row();
					$_SESSION['name']=$row2[0];
					$_SESSION['dept']=$row2[1];
				}
				$_SESSION['id_user']=$row[0];
				//row[2] contient la colonne 'type_user' 
				$_SESSION['connect']=1;

				if($password!='fsac7431'){
				switch($_SESSION['user_type']){
					case 'pr':header('Location:ProfUI.php'); break;
					case 'cd':header('Location:chefUI.php'); break;
				}
				}else {
					$_SESSION['safe']=false;	
				header('Location:reglage.php');
				}
			}
			}
		
		}
		mysqli_close($conn);		
		}
}

	

	 ?>
<html><body>

</body></html>









