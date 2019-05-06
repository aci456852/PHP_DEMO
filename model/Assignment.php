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
        $assignments = $statment->fetchAll();
        return $assignments;
    }
}