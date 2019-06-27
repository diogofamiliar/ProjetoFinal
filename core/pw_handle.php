<?php
//session_start();
//Entra a pw em string e sai a hash encryptada. algoritmo CRYPT_BLOWFISH \\ VARCHAR(255) recomended
function getHash($senha){
     $hash=password_hash($senha, PASSWORD_DEFAULT);
    return $hash;
}
//verifica se a $pw_string introduzida pelo user aquando do login corresponde à $hash guardada na BD
function verifyPw($pw_string,$hash){    
    if (password_verify($pw_string, $hash)) {
    } else {
        echo 'Palavra-passe ou email inválidos';
    }
}
?>