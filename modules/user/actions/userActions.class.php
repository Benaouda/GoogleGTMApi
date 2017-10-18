<?php
class userActions extends baseActions 
{
  
  public function executeindex() 
  {
    //pas de page pour quand on est loguer 
  }
  
  public function executelogin()
  {
  }
  
  public function executelogout() 
  {}

  public function executesignin()
  {}
  public function executereponse()
  {}
  public function executesupprimer(){
}
  public function executeQuery(){
   
    if(! isset($_Get['q'])){
    $requete = $_Get['q'];
    $this->returnValue=preg_split(,$requete,null,null);
  
    }
  }
}
?>
