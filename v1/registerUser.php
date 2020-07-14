<?php 
	require_once '../includes/DbOperations.php';
	$response = array();

	if ($_SERVER['REQUEST_METHOD']=='POST') {
		if (isset($_POST['username']) and isset($_POST['email']) and isset($_POST['password'])) {

			$db = new DbOperations();

			$result = $db->createUser($_POST['username'],
										$_POST['password'],
										$_POST['email']
										);

			if ($result == 1) {
				$response['success'] = true;
				$response['message'] = "User registered successfully";
			}elseif ($result == 2) {
				$response['success'] = false;
				$response['message'] = "Some error occurred please try again";
				
			}elseif ($result == 0) {
				$response['success'] = false;
				$response['message'] = "It sees you are already registered, please choose a different email and username";
			}
		}else{
			$response['success'] = false;
			$response['message'] = "Required fields are missing";
		}
	}else{
		$response['success'] = false;
		$response['message'] = "Invalid Request";
	}
	echo json_encode($response);
 ?>