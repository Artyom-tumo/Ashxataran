<?php
include "config.php";

//ASHXATUMA
function checkReg($user_phone, $username){
    global $connection;

    $sql_phone_nums = "SELECT `phone` FROM `users` WHERE `phone` = ".$user_phone." AND `username` = '$username' ";
    $phone_numbers = mysqli_query($connection, $sql_phone_nums);
    $numbers_count = count(mysqli_fetch_all($phone_numbers));
    $status = array();
    if($numbers_count > 0){
        return false;
    }else{
        return true;
    }
}

//ASHXATUMA
function registration($name, $lastName,$username, $number, $age, $gender, $password,$nation)
{
    global $connection;
    $name_escape = mysqli_real_escape_string($connection, $name);
    $lastName_escape = mysqli_real_escape_string($connection, $lastName);
    $number_escape = mysqli_real_escape_string($connection, $number);
    $nation_escape = mysqli_real_escape_string($connection, $nation);
    $md5_password = md5($password);
    $username_escape =  mysqli_real_escape_string($connection, $username);
    $status = array();

    if (checkReg($number_escape,$username_escape)) {
        $sql = "INSERT INTO `users`(`name`,`surname`,`username`,`password`,`age`,`gender`,`phone`,`nationality`)
     VALUES
     ('$name_escape ','$lastName_escape','$username_escape','$md5_password',$age,$gender,'$number_escape','$nation_escape')
     ";
        if (mysqli_query($connection, $sql)) {
            $status['status'] = true;
            $status['msg'] = 'registered';
            return json_encode($status);
        } else {
            $status['status'] = false;
            $status['msg'] = 'not registered';
            return json_encode($status);
        }
    }else{
        $status['status'] = false;
        $status['msg'] = 'դուք արդեն օգտագործել եք այս տվյալները';
        return json_encode($status);
    }

}

//ASHXATUMA
function requsetQuestion($question_id, $user_answer) {
    $question_id = intval($question_id);
    $user_answer  = intval($user_answer);
    global $connection;
    $query = "SELECT `right_answer` FROM `answers` WHERE `question_id` = $question_id AND `right_answer` = $user_answer";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("Error: " . mysqli_error($connection));
    }
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if($row[0]['right_answer'] == $user_answer){
        return true;
    }else{
        return false;
    }
}


//ASHXATUMA
function get_answer($question){
    global $connection;
    $id_query = "SELECT `id` FROM `users` WHERE `questions` = ".$question."";
    $answer_query = "SELECT `answer` FROM `users` WHERE `questions` = ".$question." AND `right_aswer` = 1";

    $id = mysqli_query($connection,$id_query);
    $answer = mysqli_query($connection,$answer_query);
    return array('id' => $id,'answer' => $answer);
}


//ASHXATUMA
function sign_in($username, $password) {
    $password = md5($password);
    global $connection;
    $status = array();
    $sql_username = "SELECT `id` FROM `users` WHERE `username` = '$username' AND `password` = '$password' ";
    $username_query = mysqli_query($connection, $sql_username);

    $fetched = mysqli_fetch_all($username_query, MYSQLI_ASSOC);

    $numbers_count = count($fetched);
   
    if($numbers_count > 0){
        $status['status'] = true;
        $status['msg'] = 'Դուք հաջող գրանցվեցիք';
        $status['id'] = $fetched[0]['id'];
        return json_encode($status);
    }else{
        $status['status'] = false;
        $status['msg'] = 'Սխալ գաղտնաբառ';
        $status['id'] = false;
        return json_encode($status);
    }
}

function getQuestion($level,$user_id) {
    global $connection;
    $level = intval($level);
    $level = ceil($level / 3);
    $user_id = intval($user_id);

    $max = "SELECT MAX(id) 
    FROM `questions` ";
    $max_request = mysqli_query($connection, $max);
    $max_res = mysqli_fetch_assoc($max_request);
    $max_result = $max_res['MAX(id)'];


    $count = "SELECT count(user_id)
        FROM `statistics`
        WHERE user_id = $user_id";
    $count_request = mysqli_query($connection, $count);
    $count_res = mysqli_fetch_assoc($count_request);
    $count_result = $count_res['count(user_id)'];

    if($count_result == $max_result){
        $sql = "DELETE FROM `statistics` WHERE user_id = $user_id";
        mysqli_query($connection,$sql);
    }

    $question_query =   "SELECT DISTINCT `s`.`question_id` 
    FROM `statistics` as `s` LEFT JOIN `questions` as `q` ON (`q`.`id` = `s`.`question_id`), users u
    WHERE u.id = $user_id
    ";
    $question_result = mysqli_query($connection, $question_query);
    $id_result = [];

    while($res = mysqli_fetch_assoc($question_result)){
        $id_result[] = $res['question_id'];
    }

    if(count($id_result) > 0){
        $array = implode(",",$id_result);
        $query = "SELECT `q`.`id`,`q`.`question`,`a`.`answer1`,`a`.`answer2`,`a`.`answer3`,`a`.`answer4`,`a`.`right_answer`
        FROM `questions` as `q` LEFT JOIN `answers` as `a` ON (`a`.`question_id` = `q`.`id`)
        WHERE `q`.`id` NOT IN  ($array) ORDER BY RAND() LIMIT 1";
    }
    else{
        $query = "SELECT `q`.`id`,`q`.`question`,`a`.`answer1`,`a`.`answer2`,`a`.`answer3`,`a`.`answer4`,`a`.`right_answer`
        FROM `questions` as `q` LEFT JOIN `answers` as `a` ON (`a`.`question_id` = `q`.`id`)
        ORDER BY RAND() LIMIT 1";
    }
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Error: ".mysqli_error($connection));
    }
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);  

    if(count($row) == 0){
        $array =  array('msg'=>'datark');
        return json_encode($array);
    }
    return json_encode($row);
}


function setAnswer($user,$level, $question_id, $answer_id, $status, $game_played){
    $user = intval($user);

    $level = intval($level);
    $question_id = intval($question_id);
    $answer_id = intval($answer_id);
    $game_played = intval($game_played);

    global $connection;
    $sql = "INSERT INTO `statistics`(`user_id`,`question_id`,`answer_id`,`status`,`levels_played`,`games_played`)
     VALUES
     ($user,$question_id,$answer_id,'$status',$level,$game_played)
     ";
    $result = mysqli_query($connection, $sql);

    $refresh = "FLUSH TABLES";
    $connection -> query($refresh);

    if (!$result) {
    die("Error: " . mysqli_error($connection));
    }else{
        $status = array();
        $status['status'] = true;
        $status['msg'] = 'inserted';
        return json_encode($status); 
    }
}
function final_message($user_id) {
    global $connection;
    $query = "SELECT `category` FROM `questions` WHERE `id` IN (SELECT `question_id` FROM `statistics` WHERE `user_id` = $user_id AND `status` = 0) GROUP BY `category` ORDER BY COUNT(*) DESC LIMIT 1";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $array = array(
        "msg" => "You need to learn about ".$row[0]['category']
    );
    return json_encode($array["msg  "]) ; 
} 


?>
