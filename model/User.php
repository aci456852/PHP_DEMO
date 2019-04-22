<?php
class User
{
	private $pdo;
	public function __construct() {
        $this->pdo = new PDO("mysql:host=127.0.0.1;dbname=class", "root", "123456");
    }
    
    public function __destruct() {
        $this->pdo = null;
    }
    public function verify($userID,$password)
    {
    	$statment = $this->pdo->prepare("select * from users where id=?");
        $statment->execute([$userID]);
        $user = $statment->fetch();
        if($user['id']==$userID&&$user['password']==$password)
        {
            return $user;
        }
        else 
        {
            return false;
        }
    }
}