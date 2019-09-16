<?php 

session_start();

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

		if($_SESSION['user_type']!='pr'){

			echo"<script type='text/javascript'>alert('Redirection vers la page adequate.');
			document.location.href='index.php';</script>";
		}
	}
}else
	echo"<script type='text/javascript'>window.alert('Vous devez etre connecte pour acceder a cette page !');
			document.location.href='index.php';</script>";



?><html>
<head>
<style>
#options_container{
    margin-top: 100px;
    width: 60%;
    margin:auto;
    margin-left: 26%

}
    .select{
    float:left;
    width:150px;
    margin: auto;
    margin-right: 2%;
    margin-top: 3%;
}
      .select1{
    float:left;
    width:200px;
    margin: auto;
    margin-right: 2%;
    margin-top: 3%;
}
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

         input{
         	height:35px;	
         }
             .op{
                 width: 100%;
                 margin: auto;
             }
             .select{
                align-self: center;
                 
             }
#tablediv{
                 width: 80%;
                 margin: auto;
                 margin-top: 15%;
             
                 
             }
             table {
   
    border: 1px solid #aa0000;
    width: 80%;
    
}
 .pause{
                 width: 1px;
                 border: 2px solid #aaaaaa;
             }
 .tdc, .thc{
   text-align: center;
	height:auto;
    width:auto;
    border: 2px solid #aaaaaa;
    text-align: left;
    padding: 8px;
}
select{
font-size:12;
}

             th,.jour,.a {
    background-color: #dddddd;
    border: 2px solid #aaaaaa;
	width:100px;
}
             .seance{
 	               text-align:center;
                   background-color: #eeeeee;
                   font-size: 9px;
                   font-weight: bold;
}
#but{
	margin-top:10px;
	margin-right:10%;
	float:right;
}
       
#logout{
	width:14%;
	font-size:75%;
	
	float:right;
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
     
       <h5 align="center" id="toptext" > Changement de seance </h5>
        </div>
        
        
         <div id="buttons"  align="center">
         
         <a class="btn waves-effect z-depth-3" href="ProfUI.php">Accueil</a>
          <a class="btn waves-effect z-depth-3" href="rechercheAvancee.php">Recherche Avancee</a>
  
          <a  class="btn waves-effect z-depth-3" href='logout.php' id='logout'> log out</a>
        </div>
        
        </div>
       </div>
            
           <form action="modifierprofp2.php" method="post"> 
            <div id="options_container">

    
    <div class="select1">
   
  <select name="jour" id="jour"  class="browser-default ">
    <option value="" disabled selected>Select Jour</option>
       <option value="monday" >Lundi</option>
       <option value="tuesday" >Mardi</option>
       <option value="wednesday" >Mercredi</option>
       <option value="thursday" >Jeudi</option>
       <option value="friday" >Vendredi</option>
        <option value="saturday" >Samedi</option>
      

  </select>
    </div>
    
    <div class="select1">

  <select name="seance" id="seance" class="browser-default ">
    <option value="" disabled selected>Select Seance</option>
       <option value="830" >Seance 1</option>
       <option value="1015" >Seance 2</option>
       <option value="1245" >Seance 3</option>
       <option value="1430" >Seance 4</option>
  </select>
    </div>
    
    
  
   
    
  
    <div class="select">
    <button type="submit" style="text-align:center;"  class="btn waves-effect waves-light z-depth-3 action" >Afficher Seance</button>
    </div>
  
    

    </div>  
             
  </form>
 
    
    
        </div>
    </body>
</html>
