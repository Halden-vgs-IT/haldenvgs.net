function startAnimation(){

    entering = true;

    document.body.classList.add('enter');

    setTimeout(function(){

        entering = false; document.body.classList.remove('enter');

    },1500);

}



startAnimation();



// backClick

function goback() {

    window.history.back();

}