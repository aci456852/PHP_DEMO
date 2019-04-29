<?php
include('libs/PHPExcel/PHPExcel/IOFactory.php');
include('model/Course.php');
class TeacherController
{
	public function home()
	{
		include ('view/teacher/home.php');
	}
	public function file_get_contents()
	{
		echo "this is file get contents";
	}
	public function add_course()
	{
		include('view/teacher/add_course.php');
	}
	public function do_add_course() 
	{
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
			$courseModel->save($courseNo, $courseName, $user['id']);

		}
	}
}