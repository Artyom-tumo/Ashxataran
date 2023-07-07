    

function handleRegisterFormSubmit() {
    let data = {
        'name': document.getElementById('r_name').value,
        'surname': document.getElementById('r_surname').value,
        'password': document.getElementById('r_password').value,
        'phone': document.getElementById('r_phone_number').value,
        'age': parseInt(document.getElementById('r_age').value),
        'gender': parseInt(document.getElementById('r_gender').value),
        'nation': document.getElementById('r_country').value,
        'username':document.getElementById('r_username').value
    }
    console.log(data)
    $.ajax({
        url: "api.php",
        type: "POST",
        data: JSON.stringify(data),
        contentType: 'application/json',
        success: function(response) {
            let jsonResponsev = JSON.parse(response);
            if(jsonResponsev.status){
                localStorage.setItem("id", jsonResponsev.id);
                window.location.href = "http://localhost:8888/havaq/login.php";
            }
            
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });

}




