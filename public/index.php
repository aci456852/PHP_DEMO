<?php

$route=isset($_GET['r'])?$_GET['r']:NULL;
set_include_path(get_include_path().PATH_SEPARATOR.'../');
if($route)
{
	session_start();
	$partials=explode("/", $route);
	if(count($partials)!=2)
	{
		die('invalid route');
	}
	if($partials[0]!='login')
	{
		if(!isset($_SESSION['user']))
		{
			header('Location:/index.php?r=login/login_page');
		}
		$user=$_SESSION['user'];
		if($user['role']=='student'){
			if($partials[0]!='student'){
				die('权限不足');
			}
		}
		else if($user['role']=='teacher'){
			if(!in_array($partials[0], ['teacher','assignment'])){
				die('权限不足');
			}
		}
		else{
			die('权限不足');
		}
	}

	$filename=$partials[0];
	$class_name=ucfirst(strtolower($filename))."Controller";
	$function_name=$partials[1];
	if(!file_exists('../controller/'.$class_name.'.php'))
	{
		die('error route1');
	}
	include('controller/'.$class_name.'.php');
	if(!class_exists($class_name))
	{
		die('error route2');
	}
	$controller=new $class_name();
	if(!method_exists($controller,$function_name))
	{
		die('error route3');
	}
	$controller->$function_name();
}
else
{
	include('controller/LoginController.php');
	$login=new LoginController();
	$login->login_page();
}
?>