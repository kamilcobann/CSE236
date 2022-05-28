function relocate_Admin(){
    window.location = ('admin-login.php') 
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