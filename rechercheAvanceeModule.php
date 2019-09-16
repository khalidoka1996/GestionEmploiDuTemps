<?php 
session_start();
if(isset($_SESSION['connect'])){
if($_SESSION['connect']!=1)
{
	echo"<script type='text/javascript'>alert('Vous devez etre connecte pour acceder a cette page !');
			document.location.href='index.php';</script>";


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
?>

<html>
<head>
<style>
#reglage{
margin-left:95%;

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

#aff{
margin-left:10%;
}
#typerech{
margin-top:1%;
margin-left:29%;
width:40%;
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


#afficher_button{
  
    margin:auto;
    position:relative;
    bottom:0;
}
#options_container{
    margin-top: 12%;
    width:18%;
    margin:auto;
    margin-left: 40%

}
#logout{
	width:14%;
	font-size:75%;
	
	float:right;
}
.select{
margin-top:2%;
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
  
  
  
    </div><br><br><br><br><br><br>
    
    
    
    
    
        <div id="options_container">
    <form id="formDefaut" method="post" action="afficherEmploiModule.php">
    
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

  <select name="sous_filiere" id="sous_filiere" class="browser-default form-control action">
    <option value="" disabled selected>Selectionner sous filiere</option>
  </select>
    </div>
    
    <div class="select">

  <select name="module" id="module" class="browser-default form-control action">
    <option value="" disabled selected>Selectionner Module</option>
  </select>
    </div>
   
    
  
    <div class="select">
    <button type="submit" style="text-align:center;" id="aff" class="btn waves-effect waves-light z-depth-3 " >Afficher Emploi</button>
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
	    result = 'sous_filiere';
	   }
	   if(action == "sous_filiere")
	   {
	    result = 'module' ;
	   }
	   
	   $.ajax({
	    url:"fetchModule.php",
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