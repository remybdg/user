
<?php

class SigninController{

	public function showForm() {
		
		$page = 'signin_form';

		include 'views/layout.phtml';

	}
	
	public function signin() {
		
		$flashBag = new FlashBag;
		$userSession = new UserSession;
		
		$email = $_POST['email'];
		$password = $_POST['password'];

		$usermodel = new UserModel;
	
	
	try {
		
		$user= $usermodel->checkUser($email, $password);

		$userSession->createUser($user['Id'], $user['Email'], $user['Firstname']);
		
		$flashBag->add('Vous etes bien connecté');
		
		header('location: index.php');	
		exit;

	}	
	
	catch(Exception $e) {
		$error = $e->getMessage();
		$flashBag->add($error);
		
		$page = 'signin_form';

		include 'views/layout.phtml';
	}
	
	}
	
	public function signout() {
		$userSession = new UserSession;


		$userSession->signout();
		
		$flashBag = new FlashBag;
		
		$flashBag->add('Vous etes bien déconnecté');
		

		header('location: index.php');

		exit;
	}

}