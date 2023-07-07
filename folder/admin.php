<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Առաջարկել հարց</title>

    <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

  <!-- Flag Icon CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
</head>
<body bgcolor="#000B46">
    
    <div class="centered login-container">
        <div class="login-container-inside">
            <h1 class="title-1">Առաջարկել հարց</h1>
            <br>
            <form action="your-server-side-script" method="POST">
                <input type="text" class="input-1" placeholder="Հարց" id="a_question" name="a_question" required>
                <br>
                <input type="text" class="input-1" placeholder="Պատասխան 1" id="a_ans1" name="a_ans1" required>
                <input type="radio" id="radio_ans1" name="correct_answer" value="Պատասխան 1">
                <br>
                <input type="text" class="input-1" placeholder="Պատասխան 2" id="a_ans2" name="a_ans2" required>
                <input type="radio" id="radio_ans2" name="correct_answer" value="Պատասխան 2">
                <br>
                <input type="text" class="input-1" placeholder="Պատասխան 3" id="a_ans3" name="a_ans3" required>
                <input type="radio" id="radio_ans3" name="correct_answer" value="Պատասխան 3">
                <br>
                <input type="text" class="input-1" placeholder="Պատասխան 4" id="a_ans4" name="a_ans4" required>
                <input type="radio" id="radio_ans4" name="correct_answer" value="Պատասխան 4">
                <br><br>
                <label for="a_difficulty">Դժվարություն: </label>
                <br>
                <select class="dropdown-1" id="a_difficulty" name="a_difficulty">
                    <option value="1">1 (Շատ հեշտ)</option>
                    <option value="2">2 (Հեշտ)</option>
                    <option value="3">3 (Միջին)</option>
                    <option value="4">4 (Դժվար)</option>
                    <option value="5">5 (Շատ դժվար)</option>
                </select>
                <br><br>
                <label for="a_category">Տեսակ: </label>
                <br>
                <select class="dropdown-1" id="a_category" name="a_category">
                    <option value="Սպորտ">Սպորտ</option>
                    <option value="Արվեստ">Արվեստ</option>
                    <option value="Գիտություն">Գիտություն</option>
                    <option value="Ծրագրավորում">Ծրագրավորում</option>
                    <option value="Պատմություն">Պատմություն</option>
                    <option value="Աստղագիտություն">Աստղագիտություն</option>
                    <option value="Աշխարագրություն">Աշխարագրություն</option>
                    <option value="Կենդանիներ">Կենդանիներ</option>
                    <option value="Մաթեմատիկա">Մաթեմատիկա</option>
                    <option value="Քաղաքականություն">Քաղաքականություն</option>
                    <option value="Փոփ մշակույթ">Փոփ մշակույթ</option>
                    <option value="Կինո">Կինո</option>
                </select>
                <br><br>
                <input type="submit" class="button-1" value="Ուղարկել">
            </form>
        </div>
    </div>
    <script src="script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js"></script>
    <script src="ajax.js"></script>
</body>
</html>