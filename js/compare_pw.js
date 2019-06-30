function check_pass() {
    if (document.getElementById('password').value == document.getElementById('confirm_password').value) {
            document.getElementById('register').disabled = false;
            document.getElementById('message').innerHTML = '';
        } else {
            document.getElementById('register').disabled = true;
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'As passwords introduzidas não são iguais';
        }
    }