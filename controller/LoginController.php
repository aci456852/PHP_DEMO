<?php
include('model/User.php');

class LoginController
{
	public function login_page()
	{
		include('view/login_page.php');
	}
	public function do_login()
	{
		$userId=$_POST['userId'];
		$password=$_POST['password'];
		$userModel=new User();
		$user=$userModel->verify($userId,$password);
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
}
