<?php
$servername = "localhost";
$username = "root";
$password = "root";
$db_name = "millionaire";

// Create connection
$conn = new mysqli($servername, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>

<?php
function requst($conn, $question_id, $user_answer) {
    // Retrieve the correct answer from the database
    $query = "SELECT `answer` FROM `answers` WHERE `questions_id` = ".$question_id." AND right_answer = 1";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Error: " . mysqli_error($conn));
    }
    $row = mysqli_fetch_all($result, ASSOC);
    $correct_answer = $row[0]['answer'];
    
    // Compare the user's answer with the correct answer and return the result
    return ($user_answer == $correct_answer);
}

// Example usage:
$question_id = 1;
$user_answer = 'some answer';
$is_correct = requst($conn, $question_id, $user_answer);
if ($is_correct) {
    return 1;
} else {
    return 0;
}
?>