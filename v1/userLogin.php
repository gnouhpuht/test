<?php 
	require_once '../includes/DbOperations.php';
	$response = array();

	if ($_SERVER['REQUEST_METHOD']=='POST') {
		if (isset($_POST['username']) and isset($_POST['password'])) {
			$db = new DbOperations();

			if ($db->userLogin($_POST['username'], $_POST['password'])) {
				$user = $db->getUserByUserName($_POST['username']);
				$response['success'] = true;
				$response['id'] = $user['id'];
				$response['email'] = $user['email'];
				$response['username'] = $user['username'];
			}else{
				$response['success'] = flase;
				$response['message'] = "Invalid username or password";
			}
		}else{
			$response['success'] = false;
			$response['message'] = "Required field are missing";
		}
	}

	echo json_encode($response);
 ?>