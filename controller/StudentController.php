<?php

include('model/Course.php');
include('model/Assignment.php');

class StudentController
{
	public function home()
	{
		$user=$_SESSION['user'];
		$courseModel=new Course();
		$my_courses=$courseModel->findStudentCourse($user['id']);
		include ('view/student/home.php');
	}
	public function my_assignment()
	{
		$user=$_SESSION['user'];
		$assignmentModel=new Assignment();
		$my_assignment=$assignmentModel->findstudentAssignment($user['id']);
		include ('view/student/my_assignment.php');
	}
}
