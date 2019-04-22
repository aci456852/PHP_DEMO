<?php
include('model/User.php');
function login_page()
{
	include('view/login_page.php');
}
function do_login()
{
	$userID=$_POST['userID'];
	$password=$_POST['password'];
	$userModel=new User();
	$user=$userModel->verify($userID,$password);
	//echo $user['role'];
	if($user)
	{
		session_start();
		$_SESSION['user']=$user;
		if($user['role']=='teacher')
		{
			header('Location: /index.php?r=teacher/home');
		}
		else if($user['role']=='student')
		{
			header('Location: /index.php?r=student/home');
		}
	}
	else
	{
		header('Location: /index.php');
	}
}