<?php

namespace App\Model;
use Core\DB\AbstractModel;

class UserModel extends AbstractModel{
	

	function addUser($email, $password, $firstname, $lastname) {
		
		$sql = 'SELECT Email FROM User WHERE Email=? ' ;	
		$newUser = $this->db->QueryOne($sql, [$email]);
		if (!empty ($newUser)) {
			throw new Exception('Cet email est deja utilisé !');
		}
		
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
		$sql = 'INSERT INTO user (email, password, firstname, lastname, createdAt) 
				VALUES (?, ?, ?, ?, NOW())';
				
		$this->db->queryAction($sql, [$email, $hashedPassword, $firstname, $lastname]);	
		var_dump($this);
		
		
	}

	function checkUser($email,$password) {
		
		$sql = 'SELECT Id,Password, Firstname FROM User WHERE Email=? ' ;

		$user = $this->db->QueryOne($sql, [$email]);

		$hash = $user['Password'];

		if(!empty ($user)) {

			if(password_verify($password,$hash)) {
				//var_dump( 'Le mot de passe est valide !');

			return $user;				
			} 
			/*
			else {
				var_dump( 'Le mot de passe est invalide.');
			}
			*/

			
		}
		throw new Exception('Identifiants incorrects');
	}
	
}