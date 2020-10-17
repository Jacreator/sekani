<?php
include('../../path.php');
include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
//include(ROOT_PATH . "/app/helpers/validateAccounts.php");

$table = 'clients_next_of_kin';

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
if (isset($_POST['add-next-kin'])) {
    adminOnly();

//    check the post array before sending to database
    $errors = validate($_POST);

    if (count($errors) === 0) {
        unset($_POST['add-next-kin']);

//        move post into database column
        $data = [
            'first_name' => $_POST[''],
            'last_name' => $_POST[''],
            'middle_name' => $_POST[''],
            'date_of_birth' => $_POST[''],
            'gender' => $_POST[''],
            'relationship' => $_POST[''],
            'home_address' => $_POST[''],
            'phone_no' => $_POST[''],
            'email' => $_POST[''],
            'client_idclient' => $_POST['']
        ];

//        the sql query to add to database
        $acct_trans_id = create($table, $data);
        dd($acct_trans_id);
        $_SESSION['message'] = 'Client Next_of_kin created successfully';
        $_SESSION['type'] = 'success';
//        go to base page
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit();
    }

    outputData($_POST);

}

/**
 * a isset that takes the trigger from the views button
 * and returns an individual account details
 *
 */
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $nextOfKinDetails = selectOne($table, ['idclients_next_of_kin' => $id]);
    outputData($nextOfKinDetails);
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
    $_SESSION['message'] = 'Client Next of Kin deleted successfully';
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
if (isset($_POST['update-next-of-kin'])) {
    adminOnly();
    $errors = validate($_POST);

    if (count($errors) === 0) {
        $id = $_POST['id'];
        unset($_POST['update-next-of-kin'], $_POST['id']);
//        move post into database column
        $data = [
            'first_name' => $_POST[''],
            'last_name' => $_POST[''],
            'middle_name' => $_POST[''],
            'date_of_birth' => $_POST[''],
            'gender' => $_POST[''],
            'relationship' => $_POST[''],
            'home_address' => $_POST[''],
            'phone_no' => $_POST[''],
            'email' => $_POST[''],
            'client_idclient' => $_POST['']
        ];
        $branchUpdate = update($table, $id, $data);
        $_SESSION['message'] = 'Client next of Kin Information updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit();
    }

    outputData($_POST);

}
