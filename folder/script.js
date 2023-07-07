
// function gameTimer(){

//     timerMinute = parseInt(document.getElementById('gameTimer').innerHTML)


//     var timerElement = document.getElementById('timer');
//     timerElement.innerHTML = "00:00"
//     if(timerMinute < 10){
//       timerMinute = '0'+timerMinute
//     }
//     timerElement.innerHTML = '00:'+timerMinute;
//     if(timerMinute != '00'){
//         timerMinute = parseInt(timerMinute) - 1

//         const tm = setTimeout(function(){
//                   document.getElementById('gameTimer').innerHTML = timerMinute
             
//         },1000)   
//         //checkTimer(tm)
//     }else{
//         let answersb = document.getElementsByClassName('answersb')

//         for(let a = 0 ; a < answersb.length; a++){
//             answersb[a].replaceWith(answersb[a].cloneNode(true));
//         }
//     }
// }



// function checkTimer(tm){
//    let timerMinute = parseInt(document.getElementById('gameTimer').innerHTML)
//    console.log(timerMinute)
//   if(timerMinute==60){
//       clearTimeout(tm)
//       document.getElementById('gameTimer').innerHTML = "60"
//       gameTimer()
//   }else{
//     console.log('dd')
//   }

// }




