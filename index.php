<?php
require_once 'vendor/autoload.php';
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
	<title>GTM Arbiter</title>
	<link rel="icon" type="image/png" href="https://cdn.55labs.com/dashux/dist/trunk/components/dashux/assets/images/favicon.ico">
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel='stylesheet' type='text/css' href='./css/bootstrap.css' />
	<link rel='stylesheet' type='text/css' href='./css/style.css' />
	<meta http-equiv="Content-Language" content="fr" />
	<script type="text/javascript" src="/js/helper.js"></script>
</head>
<body>
	<header>
		<div class="container">
			<div class="row">
			    <div class=".col-sm-">
						<div id="logo">55</div>
							</div>
						<div class=".col-md-">
												<button type="button" class="btn btn-danger" id="fifty-red"> Log in with your google account</button>
					</div>
		</div>

	</header>
	<div id="main">

		<?php
		$result = $m->execute($action);
		echo $result; // $result contient le résultat de module->action.
		?>
	</div>

</body>

</html>
