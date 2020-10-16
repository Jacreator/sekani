<?php

function validateClients($user)
{
    $errors = array();

    if (empty($user['username'])) {
        $errors[] = 'Username is required';
    }

    if (empty($user['email'])) {
        $errors[] = 'Email is required';
    }

    if (empty($user['password'])) {
        $errors[] = 'Password is required';
    }

    if ($user['passwordConf'] !== $user['password']) {
        $errors[] = 'Password do not match';
    }


    $existingUser = selectOne('users', ['email' => $user['email']]);
    if ($existingUser) {
        if (isset($user['update-user']) && $existingUser['id'] !== $user['id']) {
            $errors[] = 'Email already exists';
        }

        if (isset($user['create-admin'])) {
            $errors[] = 'Email already exists';
        }
    }

    return $errors;
}


function validateLogin($user)
{
    $errors = array();

    if (empty($user['username'])) {
        $errors[] = 'Username is required';
    }

    if (empty($user['password'])) {
        $errors[] = 'Password is required';
    }

    return $errors;
}