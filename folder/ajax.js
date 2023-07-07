
getQuestion(1);

function getQuestion(userLevel){

    document.getElementById("l"+userLevel).style.color="orange";
    let test = {
        "give_question":"1",
        "level":userLevel,
        "user":localStorage.getItem("id")
    }
    let ransw = '';
    
    $.ajax({
        url: "api.php",
        type: "POST",
        data: JSON.stringify(test),
        contentType: 'application/json',
        success: function(response) {
            let jsonResponsev= JSON.parse(response);

            jsonResponsev.forEach(element => {
                    let answer1 = element.answer1
                    let answer2 = element.answer2
                    let answer3 = element.answer3
                    let answer4 = element.answer4
                    let question_id = element.id
                    let rightAnswer = element.right_answer
                    let question = element.question
    
                    //poxel harcy <===============================================================================================================================>
                    let newArray = []

                    for(let i = 1 ; i < 5 ; i++){
                        let rndQuestion = getRoundQuestion(newArray)
                        newArray.push(rndQuestion)
                        document.querySelector("#answer"+i).textContent = question[rndQuestion] 
                    }
                    //poxel harcy <===============================================================================================================================>
                    document.getElementById('question').innerHTML = question
                    document.getElementById('answer1').innerHTML = answer1
                    document.getElementById('answer2').innerHTML = answer2
                    document.getElementById('answer3').innerHTML = answer3
                    document.getElementById('answer4').innerHTML = answer4
                    document.getElementById('gameTimer').innerHTML = "60"
                    // gameTimer()
                    runGame(element.right_answer,userLevel,question_id)
                });
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}






function runGame(ra,ul,qid){
    

    var ra = ra
    let answersb = document.getElementsByClassName('answersb')

    for(let a = 0 ; a < answersb.length; a++){
        answersb[a].replaceWith(answersb[a].cloneNode(true));
    }
    for(let i = 0 ; i < answersb.length; i++){
        answersb[i].addEventListener('click',function(){
            let orb = document.getElementsByClassName('orange')
            if(orb.length == 0){
                this.classList.add('orange')
                let thisAnswer = this.getAttribute('ans')
                setTimeout(function (){
                    var answ1 = document.getElementsByClassName('orange')
                    if( 'a'+ra == thisAnswer){
                        answ1[0].classList.add('green')
                        answ1[0].classList.remove('orange')
                        setTimeout(function(){
                            let answ2 = document.getElementsByClassName('green')
                            answ2[0].classList.remove('green')
                            ul = parseInt(ul) + 1
                            let test = {
                                "user_id": localStorage.getItem("id"),
                                "level":ul,
                                "question_id":qid,
                                "answer_id":thisAnswer,
                                "level":ul,
                                "status":1,
                                "game_played":1
                            }
                            let ransw = '';
                            
                            $.ajax({
                                url: "api.php",
                                type: "POST",
                                data: JSON.stringify(test),
                                contentType: 'application/json',
                                success: function(response) {
                                    let jsonResponsev= JSON.parse(response);
                                    getQuestion(ul);
                               
                                },
                                error: function(xhr, status, error) {
                                    console.log(error);
                                }
                            });

                         
                        },1000)
                    }else{
                        answ1[0].classList.add('red')
                        answ1[0].classList.remove('orange')
                        document.getElementById('answer'+ra).classList.add('green')

                        let test = {
                            "user_id": localStorage.getItem("id"),
                            "level":ul,
                            "question_id":qid,
                            "answer_id":thisAnswer,
                            "level":ul,
                            "status":0,
                            "game_played":1
                        }
                        let ransw = '';
                            
                        $.ajax({
                            url: "api.php",
                            type: "POST",
                            data: JSON.stringify(test),
                            contentType: 'application/json',
                            success: function(response) {
                                console.log(response)
                                let jsonResponsev= JSON.parse(response);
                                console.log(response)
                                setTimeout(function(){
                                    window.location.href="http://localhost:8888/havaq/index.php"
                                },2500)     
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }
                        });

                    }
                },2500)
            }
        })

    }

}


//poxel harcy <===============================================================================================================================>
function getRoundQuestion(narray){

    var rndQuestion = Math.floor(Math.random() * 4)
    if(!narray.includes(rndQuestion)){
        return rndQuestion
    }else{
        return getRoundQuestion(narray)
    }
    
    
};


