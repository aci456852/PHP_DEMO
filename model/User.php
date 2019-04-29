<?php

include('model/Model.php');

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

}