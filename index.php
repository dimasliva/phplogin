<?php


require_once "./app/config/config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cosjdia</title>
</head>

<body>
	<?php

	// require_once APPPUBLIC . "/include/navbar.php";
	// require_once APPPUBLIC . "/pages/home.php"; 

	require_once 'app/lib/Dev.php';

	use app\core\Router;

	spl_autoload_register(function ($class) {
		$path = str_replace("\\", "/", $class . '.php');
		if (file_exists($path)) {
			require $path;
		}
	});
	session_start();
	$router = new Router;

	?>

</body>

</html>