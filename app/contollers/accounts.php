<?php
include('../../path.php');
include(ROOT_PATH . "/app/database/db.php");
//include(ROOT_PATH . "/app/helpers/middleware.php");
//include(ROOT_PATH . "/app/helpers/validateAccounts.php");

$table = 'accounts';

$errors = array();
$id = '';
$name = '';
$description = '';

$accounts = selectAll($table);
//dd($accounts);

function outputData($data)
{
    return [
        'description' => $data['account_no'],
        'description1' => $data['account_type'],
        'description2' => $data['last_deposit'],
        'description3' => $data['last_withdrawal'],
        'description4' => $data['activation_date'],
        'description5' => $data['last_activity_date'],
        'description6' => $data['client_idClient'],
//        'description7' => $data[''],
//        'description8' => $data[''],
//        'description9' => $data[''],
//        'description0' => $data[''],
    ];
}

/**
 * a isset that takes the trigger from the views button
 * use the middleware to check if the user have rights for the
 * action
 *
 */
if (isset($_POST['add-account'])) {
    adminOnly();

//    check the post array before sending to database
    $errors = validateAccount($_POST);

//    $data = [
//        'account_no' => '1234556',
//        'account_type' => '1234556',
//        'last_deposit' => '1234556',
//        'last_withdrawal' => '1234556',
//        'activation_date' => '1234556',
//        'last_activity_date' => '1234556',
//        'client_idClient' => '1234556'
//    ];
    if (count($errors) === 0) {
        unset($_POST['add-account']);

//        move post into database column
        $data = [
            'account_no' => $_POST[''],
            'account_type' => $_POST[''],
            'last_deposit' => $_POST[''],
            'last_withdrawal' => $_POST[''],
            'activation_date' => $_POST[''],
            'last_activity_date' => $_POST[''],
            'client_idClient' => $_POST['']
        ];

//        the sql query to add to database
        $account_id = create($table, $data);
        dd($account_id);
        $_SESSION['message'] = 'Account created successfully';
        $_SESSION['type'] = 'success';
//        go to base page
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit();
    } else {

        outputData($data);
    }
}

/**
 * a isset that takes the trigger from the views button
 * and returns an individual account details
 *
 */
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $accounts = selectOne($table, ['idaccounts' => $id]);
    outputData($accounts);
}

/**
 * a isset that takes the trigger from the views button
 * use the middleware to check if the user have rights for the
 * action
 * and delete the record from database
 */
if (isset($_GET['del_id'])) {
    adminOnly();
    $id = $_GET['del_id'];
    $count = delete($table, $id);
    $_SESSION['message'] = 'Topic deleted successfully';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/admin/topics/index.php');
    exit();
}

/**
 * a isset that takes the trigger from the views button
 * use the middleware to check if the user have rights for the action
 * update the specified account records
 *
 */
if (isset($_POST['update-account'])) {
    adminOnly();
    $errors = validateTopic($_POST);

    if (count($errors) === 0) {
        $id = $_POST['id'];
        unset($_POST['update-account'], $_POST['id']);
        $topic_id = update($table, $id, $_POST);
        $_SESSION['message'] = 'Topic updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit();
    } else {
        outputData($_POST);
    }

}
