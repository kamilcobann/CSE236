// For Main.html

function relocate_Admin(){
    location.href = "admin-login.html";
}

loginDOM = document.querySelector('#loginWindow');

function popUpLogin(){
    if(loginDOM.classList.contains('show')){
        loginDOM.classList.remove('show');
    }else{
        loginDOM.classList.add('show');
    }
}

function redirectRegister(){
    window.location = ('register.php') 
}
