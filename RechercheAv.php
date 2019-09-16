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
margin-left:40%;
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
#login{
  width:14%;
  font-size:75%;
  margin-right:15px;
  float:right;
  background-color:green;
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
         
         <a class="btn waves-effect z-depth-3" href="index.php">accueil</a>
       
          <a  class="btn waves-effect z-depth-3" href='login.php' id='login'> login</a>
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
  <select id="typeRech" class="input-field col s6">
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
					$(location).attr('href','rechercheAvSalle.php');
					}
				if(this.value==3){
					$(location).attr('href','rechercheAvModule.php');
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
  <button type="submit" >rechercher</button>
  <button type="reset">reset</button>
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