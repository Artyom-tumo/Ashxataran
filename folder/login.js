

function handleRegisterFormSubmit() {
    let data = {
        'username' : document.getElementById('l_username').value,
        'password' : document.getElementById('l_password').value
    }
    $.ajax({
        url: "api.php",
        type: "POST",
        data: JSON.stringify(data),
        contentType: 'application/json',
        success: function(response) {

            let jsonResponsev = JSON.parse(response);
            if(jsonResponsev.status){
                localStorage.setItem("id", jsonResponsev.id);
                window.location.href = "http://localhost:8888/havaq/play.php";
            }
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
    
}


