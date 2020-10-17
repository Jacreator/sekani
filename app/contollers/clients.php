<?php
include('../../path.php');
include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
//include(ROOT_PATH . "/app/helpers/validateAccounts.php");

$table = 'clients';

$errors = array();
$id = '';
$name = '';
$description = '';

$accounts = selectAll($table);
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
if (isset($_POST['add-client'])) {
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
        unset($_POST['add-branch']);

//        move post into database column
        $data = [
            'firstname' => $_POST[''],
            'middlename' => $_POST[''],
            'lastname' => $_POST[''],
            'displayname' => $_POST[''],
            'account_officer' => $_POST[''],
            'client_type' => $_POST[''],
            'phone_no' => $_POST[''],
            'email' => $_POST[''],
            'state_of_origin' => $_POST[''],
            'country' => $_POST[''],
            'lga' => $_POST[''],
            'occupation' => $_POST[''],
            'gender' => $_POST[''],
            'is_staff' => $_POST[''],
            'activation_date' => $_POST[''],
            'submitted_on_date' => $_POST[''],
            'client_status' => $_POST[''],
            'institution_idinstitution' => $_POST[''],
            'branch_idbranch' => $_POST[''],
        ];

//        the sql query to add to database
        $client_id = create($table, $data);
        dd($client_id);
        $_SESSION['message'] = 'Client created successfully';
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
    $clientDetails = selectOne($table, ['idclient' => $id]);
    outputData($clientDetails);
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
    $_SESSION['message'] = 'Client deleted successfully';
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
if (isset($_POST['update-client'])) {
    adminOnly();
    $errors = validate($_POST);

    if (count($errors) === 0) {
        $id = $_POST['id'];
        unset($_POST['update-client'], $_POST['id']);
        $clientUpdate = update($table, $id, $_POST);
        $_SESSION['message'] = 'Client Information updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit();
    } else {
        outputData($_POST);
    }

}
