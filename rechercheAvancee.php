<?php 
session_start();
if(isset($_SESSION['connect'])){
if($_SESSION['connect']!=1)
{
	echo"<script type='text/javascript'>alert('Vous devez etre connecte pour acceder a cette page !');
			document.location.href='index.php';</script>";


}else {
	if(isset($_SESSION["safe"])){
		if($_SESSION['safe']==false){echo "<script type='text/javascript'>alert('Votre mot de passe n est pas securise , Redirection vers la parge de changement de mdp.');
								document.location.href='reglage.php';
					</script>";}
	}
}
}else 
	echo"<script type='text/javascript'>window.alert('Vous devez etre connecte pour acceder a cette page !');
			document.location.href='index.php';</script>";

?>

<?php
//index.php

$connect = mysqli_connect("localhost", "root", "", "mydb");
$filiere= '';
$query = "SELECT ReG.codeGroupe ,ReG.nom FROM 
	ressources_groupes ReG 
	where ReG.codeGroupe in (287,288,275,279,283)
	ORDER BY `nom` ASC
";
$result = mysqli_query($connect, $query);

while($row = mysqli_fetch_array($result))
{
 $filiere .= '<option value="'.$row["codeGroupe"].'">'.$row["nom"].'</option>';
}



$prof='';
$queryprof="SELECT nom,prenom,codeProf FROM ressources_profs order by 'nom' ASC";


$resultprof = mysqli_query($connect,$queryprof);

while($row = mysqli_fetch_array($resultprof))
{
 $prof .= '<option value="'.$row["codeProf"].'">'.$row["nom"].' '.$row["prenom"].'</option>';
}

?>

<html>
<head>
<style>

#typerech{
margin-top:1%;
margin-left:37%;
}
#ainchock
{
    margin-right: 10%;
    margin-top: 20px;
    float: right;
    height: 100px;
    width: 100px;
    
}
#uh2c{
   
    margin-left:10%;
    margin-top: 20px;
     height: 100px;
    width: 100px;
    
}
#topbar{
     margin-top: 0px;
    height:22%;
 
}
#top_div{
margin-top:-6%;
margin-left:15%;
	}
#buttons{
	width:70%;
	float:right;
	margin-right:1%;
}
#datepick{
    margin: auto;
    height: 300px;
    
}

#rechParDate{
    width: 40%;
    margin-left: 10%;
}

.switch{
    margin-top: 20px;
    height: 30px;
    margin-left:auto;
    margin-right: 20px;
    float: left;
}

.select{
    float:left;
    width: 200px;
    margin: auto;
    margin-right: 2%;
    margin-top: 3%;
}
#afficher_button{
  
    margin:auto;
    position:relative;
    bottom:0;
}
#options_container{
    margin-top: 100px;
    width: 60%;
    margin:auto;
    margin-left: 26%

}
#logout{
	width:14%;
	font-size:75%;
	
	float:right;
}
#reglage{
margin-left:95%;
margin-top:20%;
}
.reglage{
  position: relative;
  display: block;
  height: 55px;
  width: 55px;
  background: url(interface/img/reglage.png);
  background-size: contain;
  text-decoration: none;
}
#profs{
margin-top:2%;
margin-left:37%;}
.btns{

margin-top:2%;
margin-left:37%;
}
</style>





    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="UTF-8">
<script type="text/javascript" src="js/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="interface/css/materialize.min.css">

<script type="text/javascript" src="interface/js/jquery.min.js"></script>
<script type="text/javascript" src="interface/js/materialize.min.js"></script>
</head>
<body>
<div id="container">
    <div id="topbar" class="z-depth-2">

<img src="interface/img/logoAinchok.jpg" class="z-depth-3" id="ainchock" >
<img src="interface/img/logouh2c.jpg" class="z-depth-3" id="uh2c">
    
    <div id="top_div">
    <div>
       <h5 align="center" id="toptext" > Recherche avancee</h5>
        </div>
        
        
         <div id="buttons"  align="center">
         
         <a class="btn waves-effect z-depth-3" href="<?php 
         		if(isset($_SESSION['connect']))
         	{
         		if($_SESSION['connect']==1)
         		{
         			switch($_SESSION['user_type']){
					case 'pr':echo 'ProfUI.php'; break;
					case 'cd':echo 'chefUI.php'; break;
					}
        	 	}
			}?>									
													">accueil</a>
        <?php 
         		switch($_SESSION['user_type']){
					case 'cd':
						echo "<a class='btn waves-effect z-depth-3' href='choisir.php'>Modifier</a>  ";
						echo '<a class="btn waves-effect z-depth-3" href="gererUsers.php">Gerer utilisateurs</a>'; 
					 
								break;
          case 'pr':
                      echo "<a class='btn waves-effect z-depth-3' href='modifierProf.php'>Changer Seance</a>  ";

                break;
			}?>  
          <a  class="btn waves-effect z-depth-3" href='logout.php' id='logout'> log out</a>
        </div>
        
        </div>
</div>
    
      
  </div>
    
    
  
         <script type="text/javascript">
         
          $(document).ready(function() {
    $('select').material_select();
  });
         </script>
          <script type="text/javascript">
          $('select').material_select('destroy');
         </script>
         
         
         
         
         
      
  
                 <div id="typerech" class="select">
                 
<label></label>
  <select id="typeRech" class="browser-default">
    <option value="" disabled selected>Rechercher par :</option>
    <option value="1">Prof</option>
    <option value="2">Salle</option>
    <option value="3">Module</option>
  </select>
  <script type="text/javascript">
  $(document).ready(function(){
	  $("#form1").hide();
	  $("#typeRech").on('change',function(){
				if(this.value==1){
					$("#form1").show();
					$("#formDefaut").hide();
					};
				if(this.value==2){
					$(location).attr('href','rechercheAvanceeSalle.php');
					}
				if(this.value==3){
					$(location).attr('href','rechercheAvanceeModule.php');
					}
				
				
			});
	  });
  </script>
  <div id="form1">
  <form  method="post" action="afficherEmploiProf.php"> 
  
   <select name="profs" id="profs" class="browser-default">
  	<option value="" disabled selected> select prof</option>
  	<?php echo  $prof ;?>
  </select>  
  <button class="btn waves-effect z-depth-3 btns" type="submit" >rechercher</button>
  <button class="btn waves-effect z-depth-3 btns" type="reset">reset</button>
 
  </form>
  </div>
  
  
    </div><br><br><br><br><br><br>
    
    
    
    
    
        <div id="options_container">
    <form id="formDefaut" method="post" action="afficherEmploi.php">
    
    <div class="select">
   
  <select name="filiere" id="filiere"  class="browser-default form-control action">
    <option value="" disabled selected>Selectionner filiere</option>
     <?php echo $filiere; ?>
  </select>
    </div>
    
    <div class="select">

  <select name="semestre" id="semestre" class="browser-default form-control action">
    <option value="" disabled selected>Selectionner semestre</option>
  </select>
    </div>
    
    <div class="select">

  <select name="section" id="section" class="browser-default form-control action">
    <option value="" disabled selected>Selectionner Section</option>
  </select>
    </div>
   
     <div class="select">

  <select name="td" id="td" class="browser-default form-control action">
    <option value="" disabled selected>Selectionner TD</option>

  </select>
    </div>
     <br>
    <div class="select">

  <select name="groupe" id="groupe"  class="browser-default form-control ">
    <option value="" disabled selected>Selectionner Groupe</option>

  </select> 
    
    </div>
    
  
    <div class="select">
    <button type="submit" style="text-align:center;"  class="btn waves-effect waves-light z-depth-3" >Afficher Emploi</button>
    </div>
    
    
    </form> 
    </div>  
             
  
       <div id="reglage"><a href="reglage.php" class="reglage"></a></div>    
     
  

     
    
   
</body>
</html>
<script>
$(document).ready(function(){
	 $('.action').change(function(){
	  if($(this).val() != '')
	  {
	   var action = $(this).attr("id");
	   var query = $(this).val();
	   var result = '';
	   if(action == "filiere")
	   {
	    result = 'semestre';
	   }
	   if(action == "semestre")
	   {
	    result = 'section';
	   }
	   if(action == "section")
	   {
	    result = 'td';
	   }
	   if(action == "td")
	   {
	    result = 'groupe';
	   }
	   $.ajax({
	    url:"fetch.php",
	    method:"POST",
	    data:{action:action, query:query},
	    success:function(data){
	     $('#'+result).html(data);
	    }
	   })
	  }
	 });
	});
	</script>