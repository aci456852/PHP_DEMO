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
		$my_assignments=$assignmentModel->findstudentAssignment($user['id']);
		include ('view/student/my_assignment.php');
	}
	public function download_template() {
		$assignmentId=$_REQUEST['id'];
		$assignmentModel=new Assignment();
		$my_assignment=$assignmentModel->getAssignment($assignmentId);
		header("Content-Type:application/octet-stream");
		header("Content-Disposition:attachment;filename=".$my_assignment['attachment']);
		$templateContent = file_get_contents("../storage/uploads/template/" . $my_assignment['attachment']);
		echo $templateContent;
	}
}
