<?php

include_once('model/Model.php');

class Assignment extends Model {


    public function exists($studentNo) {
        $statment = $this->pdo->prepare("select * from users where id = ?");
        $statment->execute([$studentNo]);
        $user = $statment->fetch();

        if ($user) {
            return true;
        } else {
            return false;
        }
    }   

    public function save($title, $attachment, $courseId) {
        $statment = $this->pdo->prepare("insert into assignments (title, attachment, course_id) values (?,?,?)");
        $statment->execute([$title, $attachment, $courseId]);

        $lastInsertId = $this->pdo->lastInsertId();
        return $lastInsertId;
    }

    public function find($courseId) {
        $statment = $this->pdo->prepare('select * from assignments where course_id = ? ');
        $statment->execute([$courseId]);
        $assignments = $statment->fetch();
        return $assignments;
    }

    public function getAssignment($id) {
        $statment = $this->pdo->prepare('select * from assignments where id = ? ');
        $statment->execute([$id]);
        $assignment = $statment->fetch();
        return $assignment;
    }

    public function findstudentAssignment($studentId){
        $sql="select a.*,ar.id as ar_id,ar.attachment as my_work
        from assignments a
            join course_students cs on cs.course_id=a.course_id 
            left join assignment_records ar on ar.assignment_id=a.id and ar.student_id=cs.student_id
        where cs.student_id =? ";
        $statment = $this->pdo->prepare($sql);
        $statment->execute([$studentId]);
        $my_assignments = $statment->fetchAll();
        return $my_assignments;
    }
}