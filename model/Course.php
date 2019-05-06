<?php
include_once('model/Model.php');

class Course extends Model {
    


    public function exists($courseNo) {
        $statment = $this->pdo->prepare("select * from courses where subject_no = ?");
        $statment->execute([$courseNo]);
        $user = $statment->fetch();

        if ($user) {
            return true;
        } else {
            return false;
        }
    }   

    public function save($courseNo, $courseName, $teacherId) {
        $statment = $this->pdo->prepare("insert into courses (subject, subject_no, teacher_id ) values (?,?,?)");
        $statment->execute([$courseName, $courseNo, $teacherId]);
        return $this->pdo->lastInsertId();
    }

    public function find($teacherId) {
        $statment = $this->pdo->prepare('select * from courses where teacher_id = ? ');
        $statment->execute([$teacherId]);
        $courses = $statment->fetchAll();
        return $courses;
    }

}