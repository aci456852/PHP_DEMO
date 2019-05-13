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

    public function findStudentCourse($studentId){
        $sql="select c.*,u.name as student_name,ut.name as teacher_name 
        from course_students cs 
            join courses c on cs.course_id=c.id 
            join users u on u.id=cs.student_id
            join users ut on ut.id=c.teacher_id
        where cs.student_id=? ";
        $statment = $this->pdo->prepare($sql);
        $statment->execute([$studentId]);
        $courses = $statment->fetchAll();
        return $courses;
    }

    
}