<?php

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function getPasswordError($password) {
    $errors = [];
    if (strlen($password) < 8) {
        $errors[] = "Le mot de passe doit être 8 caractère de long minimum.";
    }
    if (!preg_match('/[0-9]/', $password)) {
        $errors[] = "Le mot de passe doit contenir au moin un chiffre.";
    }
    if (!preg_match('/[A-Z]/', $password)) {
        $errors[] = "Le mot de passe  doit contenir au moin une majuscule";
    }
    if (!preg_match('/[\W_]/', $password)) {
        $errors[] = "Le mot de passe  doit contenir au moin un caractère spécial";
    }
    return $errors;
}
function validatePassword($password) {

    if (strlen($password) < 8) {
        return false;
    }
    if (!preg_match('/[0-9]/', $password)) {
        return false;
    }
    if (!preg_match('/[A-Z]/', $password)) {
        return false;
    }
    if (!preg_match('/[\W_]/', $password)) {
        return false;
    }
    return true;
}