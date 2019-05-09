<?php
//session_start();
//Entra a pw em string e sai a hash encryptada. algoritmo CRYPT_BLOWFISH \\ VARCHAR(255) recomended
function getHash($pw){
     $hash=password_hash($pw, PASSWORD_DEFAULT);
    return $hash;
}
//verifica se a $pw_string introduzida pelo user aquando do login corresponde à $hash guardada na BD
function verifyPw($pw_string,$hash){    
    if (password_verify($pw_string, $hash)) {
        include 'verify_user_role.php';
    } else {
        echo 'Invalid password or email.';
    }
}
?>