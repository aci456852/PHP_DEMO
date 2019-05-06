<?php

include('model/Course.php');
include('model/User.php');
include('model/CourseStudent.php');
include('model/Assignment.php');


class AssignmentController {

	public function home() {
		$courseId = $_GET['course_id'];
		$assignmentModel = new Assignment();
		$assignments = $assignmentModel->find($courseId);
		
		include('view/assignment/home.php');
	}

	public function create_assignment_form() {

		$courseId = $_GET['course_id'];
		include('view/assignment/create_assignment_form.php');
	}

	public function do_create_assignment() {
		$courseId = $_REQUEST['course_id'];
		$title = $_REQUEST['title'];

		$tmp_name = $_FILES['template']['tmp_name'];
		$filename = $_FILES['template']['name'];

		$md5_filename = md5_file($tmp_name) . '.'. explode(".", $filename)[1];
		$clean_filename = iconv("UTF-8","gbk","../storage/uploads/template/" . $md5_filename);
		move_uploaded_file($tmp_name,  $clean_filename);

		$assignmentModel = new Assignment();
		$assignmentModel->save($title, $md5_filename, $courseId);
		header("Location: /index.php?r=assignment/home&course_id=" . $courseId);
	}
}