<?php

include_once('model/Model.php');

class User extends Model {
    
    public function verify($userId, $password)
    {
        $statment = $this->pdo->prepare("select * from users where id = ?");
        $statment->execute([$userId]);
        $user = $statment->fetch();

        if ($user['id'] == $userId && $user['password'] == $password) {
            return $user;
        } else {
            return false;
        }
    }
    public function exists($studentNo) {
        $statment = $this->pdo->prepare("select * from users where id= ?");
        $statment->execute([$studentNo]);
        $user = $statment->fetch();

        if ($user) {
            return true;
        } else {
            return false;
        }
    }   

    public function save($id, $name, $password,$role,$class) {
        $statment = $this->pdo->prepare("insert into users (id,name,password,role,class) values (?,?,?,?,?)");
        $statment->execute([$id, $name, $password,$role,$class]);

    }
}