<?php
include "functions.php";
$jsonData = file_get_contents('php://input');
if($jsonData){   
	$data =  json_decode($jsonData);
	if (isset($data->name) && isset($data->surname) && isset($data->age) && isset($data->gender) && isset($data->phone) && isset($data->username) && isset($data->password) && isset($data->nation)) {
		echo registration($data->name, $data->surname ,$data->username, $data->phone, $data->age, $data->gender, $data->password, $data->nation);
	}elseif (isset($data->username) && isset($data->password)) {
		echo sign_in($data->username, $data->password);
	}elseif (isset($data->question) && isset($data->answer)) {
		echo requestQuestion($data->question, $data->answer);
	}elseif (isset($data->give_question) && isset($data->level) && isset($data->user)) {
		echo getQuestion($data->level,$data->user);
	}elseif(isset($data->level) && isset($data->question_id) && isset($data->answer_id) && isset($data->status) && isset($data->game_played) && isset($data->user_id)){
		echo setAnswer($data->user_id, $data->level, $data->question_id, $data->answer_id, $data->status, $data->game_played);
	}
}
?>



