<?php

include('libs/PHPExcel/PHPExcel/IOFactory.php');
include('model/Course.php');
include('model/User.php');
include('model/CourseStudent.php');
session_start();

class TeacherController {

	public function home() {

		$user = $_SESSION['user'];
		$courseModel = new Course();
		$courses = $courseModel->find($user['id']);
		var_export($user);
		include('view/teacher/home.php');

	}

	public function add_course() {

		include('view/teacher/add_course.php');
	}

	public function do_add_course() {
		$tmp_name = $_FILES['nameBook']['tmp_name'];
		$filename = $_FILES['nameBook']['name'];
		$clean_filename = iconv("UTF-8","gbk","../storage/uploads/name_book/" . $filename);
		move_uploaded_file($tmp_name,  $clean_filename);

		$objPHPExcel = PHPExcel_IOFactory::load($clean_filename);

		$workSheet = $objPHPExcel->getActiveSheet();

		$courseName = $workSheet->getCell('E3')->getCalculatedValue();
		$courseNo = $workSheet->getCell('A3')->getCalculatedValue();

		$courseModel = new Course();
		if (!$courseModel->exists($courseNo)) {
			$user = $_SESSION['user'];
			$courseId = $courseModel->save($courseNo, $courseName, $user['id']);
			$rowNum = 6;
			$userModel = new User();
			$courseStudentModel = new CourseStudent();
			while (true) {
				$studentNo = $workSheet->getCell('B' . $rowNum)->getCalculatedValue();
				if (!$studentNo) {
					break;
				}
				$studentName = $workSheet->getCell('C' . $rowNum)->getCalculatedValue();
				$studentClass = $workSheet->getCell('E' . $rowNum)->getCalculatedValue();
				if (!$userModel->exists($studentNo)) {
					$userModel->save($studentNo, $studentName, $studentNo, "student", $studentClass);
				}
				$courseStudentModel->save($studentNo, $courseId);
				$rowNum = $rowNum + 1;
			}
		}
		header("Location: /index.php?r=teacher/home");
	}

}