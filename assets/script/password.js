
const password = document.getElementById('password');
const eye1 = document.getElementById('eye1');
const eye2 = document.getElementById('eye2');

function showPass(){
    password.type = 'text';
    eye1.style.display = 'block';
    eye1.style.color = '#293241';
    eye2.style.display = 'none';
}

function hidePass(){
    password.type = 'password';
    eye2.style.display = 'block';
    eye1.style.display = 'none';
}