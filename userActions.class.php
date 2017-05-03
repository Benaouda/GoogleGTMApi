<?php
class userActions extends baseActions 
{
  
  public function executeindex() 
  {
  }
  
  public function executelogin() 
  {	
    if(isset($_POST["login"])) 
      {
	// Connexion a la base de donnees
	$strCon = 'mysql:host=localhost;dbname=thomas.YOUPHONE';
	$arrExtraParam= array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"); 
	$pdo = new PDO($strCon, 'root', '123', $arrExtraParam); 
	
	$nam=$_POST["login"];
	$res="select*from users where pseudo='$nam'";
	$a=$pdo->query($res);
	$c=$a->fetch(PDO::FETCH_OBJ);
	if(($c->pseudo==null) or ($c->pseudo==false)){
	  echo("erreur le pseudo n'existe pas");
	}
	else
	  {
	    if ($c->mdp==$_POST['mdp'])
	      {
		$pdo->exec("update users set nbConnexion=nbConnexion+1,dateConnexion=curdate() where pseudo='$nam'");
		$_SESSION['login'] = $_POST["login"]; // on stocke l'identifiant de session
		header('Location:index.php');	
	      }
	    else 
	      {
		echo("mauvais mot de passe");
	      }
	  }
      }
  }
  
  public function executelogout()
  {
    unset($_SESSION['login']);
    header("Location:index.php");
  }
  
  public function executesignin() 
  {  
    
    // Connexion a la base de donnees
    $strCon = 'mysql:host=localhost;dbname=thomas.YOUPHONE';
    $arrExtraParam= array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"); 
    $pdo = new PDO($strCon, 'root', '123', $arrExtraParam); 
    
    if(isset($_POST["login"])) 
      { 
	$x=$_POST['login'];
	$res="select * from users";
	$o=$pdo->query($res);
	$vrai=true;
	while(($p=$o->fetch(PDO::FETCH_OBJ))&&($vrai==true))
	  {
	    if($p->pseudo==$x)
	      {
		$vrai=false;
	      }
	  }
	if($vrai==true)
	  {
	    $mail=$_POST['mail'];
	    $pass=$_POST['password'];
	    $login=$_POST['login'];
	    $sexe=$_POST['sexe'];
	    $nom=$_POST['nom'];
	    $prenom=$_POST['prenom'];
	    $res="INSERT INTO users(nom,prenom,pseudo,email,mdp,idType,sexe,dateConnexion,nbConnexion) VALUES ('$nom','$prenom','$login','$mail','$pass',1,'$sexe',curdate(),1)";
	    $pdo->exec($res);
	  }
	else
	  {
	    echo("le pseudo existe deja veuillez choisir un autre pseudo");
	    sleep(2);
	    header('Location: index.php?module=user&action=signin');
	  }
	header("Location:index.php");	
      } 
  }
  public function executeupload()
  {
    if(isset($_FILES['avatar']))
      {
	// Connexion a la base de donnees
	$strCon = 'mysql:host=localhost;dbname=thomas.YOUPHONE';
	$arrExtraParam= array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"); 
	$pdo = new PDO($strCon, 'root', '123', $arrExtraParam); 
	
	$dossier = 'videos/';
	$fichier = basename($_FILES['avatar']['name']);
	$taille_maxi = 10000000000000000000000000000000000000000000;
	$taille = filesize($_FILES['avatar']['tmp_name']);
	$extensions = array('.mp4', '.avi', '.ogg');
	$extension = strrchr($_FILES['avatar']['name'], '.'); 
	if(!in_array($extension, $extensions))
	  {
	    $erreur = 'Vous devez uploader une video de type mp4 ogg ou mvoc...';
	  }
	if($taille>$taille_maxi)
	  {
	    $erreur = 'Le fichier est trop gros...';
	  }
	if(!isset($erreur))	
	  {
	    
	    $fichier = strtr($fichier, 
			     'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝ�&nbsp;áâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
			     'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
	    $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
	    if(move_uploaded_file($_FILES['avatar']['tmp_name'],$dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
	      {	 $users=$_SESSION['login'];//login de l'utilisateur
		$desc=$_POST['desc'];//description
		$pri=$_POST['choix'];
		$xixi="select * from users where pseudo='$users'";
		$duree=$_POST['dur'];
		$o=$pdo->query($xixi);
		$kiki=$o->fetch(PDO::FETCH_OBJ);
		$iduser=$kiki->id;
		$titi="INSERT INTO video(titre,idUser,totalVues,datePublication,description,duree,privee,noteMoyenne) VALUES ('$fichier','$iduser',0,curdate(),'$desc','$duree','$pri',0)";
		$pdo->exec($titi);
		echo 'Upload effectué avec succ�es !';
		sleep(2);
		header("Location:index.php");
	      }
	    else 
	      {
		echo 'Echec de l\'upload !';
	      }
	  }
	else
	  {
	    echo $erreur;
	  }	
	
	sleep(2);
	header("loaction:index.php");
      }	
  }
  public function executemesvideos(){
    
    
  }
}
?>
