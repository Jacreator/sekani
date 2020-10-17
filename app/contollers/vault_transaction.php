<?php
include ('../../path.php');
include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
//include(ROOT_PATH . "/app/helpers/validateAccounts.php");

$table = 'vault_transaction';

$errors = array();
$id = '';
$name = '';
$description = '';

$valTrans = selectAll($table);
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
    ];
}

/**
 * a isset that takes the trigger from the views button
 * use the middleware to check if the user have rights for the
 * action
 *
 */
if (isset($_POST['submit-val-trans'])) {
    adminOnly();

    $errors = validateAccount($_POST);


    if (count($errors) === 0) {
        unset($_POST['submit-val-trans']);
        $data = [
            'credit'=>$_POST[''],
            'debit'=>$_POST[''],
            'transaction_type'=>$_POST[''],
            'vault_idvault'=>$_POST['']
        ];
        $valTrans_id = create($table, $data);
//        dd($account_id);
        $_SESSION['message'] = 'Successful';
        $_SESSION['type'] = 'success';
//        go to base page
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit(); 
    }
    outputData($_POST);
}

/**
 * a isset that takes the trigger from the views button
 * and returns an individual details
 *
 */
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $valTransDetails = selectOne($table, ['idvault_transaction' => $id]);
    outputData($valTransDetails);
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
 * update the specified records
 *
 */
if (isset($_POST['update-topic'])) {
    adminOnly();
    $errors = validateTopic($_POST);

    if (count($errors) === 0) { 
        $id = $_POST['id'];
        unset($_POST['update-topic'], $_POST['id']);
        $data = [
            'credit'=>$_POST[''],
            'debit'=>$_POST[''],
            'transaction_type'=>$_POST[''],
            'vault_idvault'=>$_POST['']
        ];
        $query = update($table, $id, $data);
        $_SESSION['message'] = 'Transaction updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit();
    }
    outputData($_POST);

}
