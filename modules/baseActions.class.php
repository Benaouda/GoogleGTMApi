<?php
// La classe de base. Ne touchez pas.


abstract class baseActions {
  protected $pdo;
  public function __construct() {
	global $pdo;
	$this->pdo = $pdo;
  }
  
  public function getModule() {
    $name = get_class($this);
    return substr($name,0,strlen($name)-7);
  }

  public function execute($action) {
    $todo = "execute".$action;
    $this->$todo();
    $m = $this->getModule();
    $v = $action."Vue";
    ob_start();
    include "modules/$m/vues/$v.php";
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
  }
  
}
?>
