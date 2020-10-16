<?php

/**
 * a function to clean all string entered
 *
 * @param $string
 * @return string|string[]|null
 *
 */
function clean($string)
{
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

/**
 *
 *
 * @param $account
 * @return array
 */
function validateAccount($account)
{
    $errors = array();
    $data = array();


//    foreach ($account as &$value) {
//        if (empty($value)) {
//            $errors[] = 'Account is required';
//        } else {
//            $nameOfVar = trim($value);
//            clean($nameOfVar);
//        }
//    }
//    unset($value); // break the reference with the last element


    if (empty($account[''])) {
        $errors[] = 'Account is required';
    } else {
        $nameOfVar = trim($account['']);
        $data[] = clean($nameOfVar);
    }

    if (empty($account[''])) {
        $errors[] = 'Account is required';
    } else {
        $nameOfVar = trim($account['']);
        clean($nameOfVar);
    }

    if (empty($account[''])) {
        $errors[] = 'Account is required';
    } else {
        $nameOfVar = trim($account['']);
        clean($nameOfVar);
    }

    $existingAccounts = selectOne('accounts', ['account_no' => $account['account_no']]);
    if ($existingAccounts) {
        if (isset($post['update-account']) && $existingAccounts['idaccounts'] !== $post['id']) {
            $errors[] = 'Account already exists';
        }

        if (isset($post['add-account'])) {
            $errors[] = 'Account already exists';
        }
    }

    if ($errors) {
        return $errors;
    }

    return $data;
}