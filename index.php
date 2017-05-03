<?php
	session_start();
	include "helpers/HTML.class.php";
	include("modules/baseActions.class.php");

	if(isset($_GET['module'])){
		$module = $_GET['module'];
	}
	else {
		$module="main";
		$action='index';
	}

	if(isset($_GET['action'])){
		$action = $_GET['action'];
	}
	else {
		if(!isset($action)) $action="index";
	}	
	try {
		include "modules/$module/actions/".$module."Actions.class.php";
		$class=$module."Actions";
		$m = new $class();
	}
	catch(Exception $e) {
		echo "Probleme";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
	<head>
		<title>Lambda</title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<link rel='stylesheet' type='text/css' href='./css/style.css' />
		<script type="text/javascript" src="js/mootools.js"></script> 
		<script type="text/javascript" src="js/mootools-more.js"></script> 
		<link rel="stylesheet" href="js/formcheck/theme/classic/formcheck.css" type="text/css" media="screen" />
		<script type="text/javascript" src="js/formcheck/formcheck.js"></script>
		<script type="text/javascript" src="js/formcheck/lang/fr.js"></script>
		<link rel="stylesheet" href="css/form.css" type="text/css" media="screen" />
		<script type="text/javascript" src="js/moostarrating.js"></script>
		<meta http-equiv="Content-Language" content="fr" />
	</head>
	<body>
		<div class="menu">
		<?php
		
		$h = new HTML();
		if(isset($_SESSION["login"])) {
		
		} else {
		}
		?>
		</div>

		<div id='header'>

		</div>
		<div id="main">
			<?php
				$result = $m->execute($action);
				echo $result; // $result contient le résultat de module->action. 
			?>
		</div>

		<div id='footer'>
		</div>
	</body>
	</body>
	
</html>
