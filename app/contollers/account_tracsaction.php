<?php
include('../../path.php');
include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
//include(ROOT_PATH . "/app/helpers/validateAccounts.php");

$table = 'account_transaction';

$errors = array();
$id = '';
$name = '';
$description = '';

$account_transaction = selectAll($table);
//dd($accounts);

/**
 * get information from the controller back to frontend
 *
 * @param $data
 * @return array
 */
function outputData($data)
{
    return [
        'description' => $data[''],
        'description1' => $data[''],
        'description2' => $data[''],
        'description3' => $data[''],
        'description4' => $data[''],
        'description5' => $data[''],
        'description6' => $data[''],
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
if (isset($_POST['add-acc-tract'])) {
    adminOnly();

//    check the post array before sending to database
    $errors = validate($_POST);

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
        unset($_POST['add-acc-tract']);

//        move post into database column
        $data = [
            'transaction_id' => $_POST[''],
            'description' => $_POST[''],
            'transaction_type' => $_POST[''],
            'credit' => $_POST[''],
            'debit' => $_POST[''],
            'amount' => $_POST[''],
            'created_date' => $_POST['']
        ];

//        the sql query to add to database
        $acct_trans_id = create($table, $data);
        dd($acct_trans_id);
        $_SESSION['message'] = 'Account Transaction created successfully';
        $_SESSION['type'] = 'success';
//        go to base page
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit();
    } else {
        outputData($_POST);
    }
}

/**
 * a isset that takes the trigger from the views button
 * and returns an individual account details
 *
 */
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $transDetails = selectOne($table, ['idaccount_transaction' => $id]);
    outputData($transDetails);
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
    $_SESSION['message'] = 'Account Transaction deleted successfully';
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
if (isset($_POST['update-acc-tract'])) {
    adminOnly();
    $errors = validate($_POST);

    if (count($errors) === 0) {
        $id = $_POST['id'];
        unset($_POST['update-acc-tract'], $_POST['id']);
        $data=[
            'transaction_id' => $_POST[''],
            'description' => $_POST[''],
            'transaction_type' => $_POST[''],
            'credit' => $_POST[''],
            'debit' => $_POST[''],
            'amount' => $_POST[''],
            'created_date' => $_POST['']
        ];
        $branchUpdate = update($table, $id, $data);
        $_SESSION['message'] = 'Account Transaction Information updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit();
    } else {
        outputData($_POST);
    }

}
