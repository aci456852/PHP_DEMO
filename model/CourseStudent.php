<?php

include_once('model/Model.php');

class CourseStudent extends Model {

	public function save($studentId, $courseId) {
		$statment = $this->pdo->prepare("insert into course_students (course_id, student_id) values (?,?)");
        $statment->execute([$courseId, $studentId]);
	}

}
