<?php
include('../../path.php');
include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
//include(ROOT_PATH . "/app/helpers/validateAccounts.php");

$table = 'loan_product';

$errors = array();
$id = '';
$name = '';
$description = '';

$loan_product = selectAll($table);
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
if (isset($_POST['add-loan'])) {
    adminOnly();

//    check the post array before sending to database
    $errors = validate($_POST);

    if (count($errors) === 0) {
        unset($_POST['add-loan']);

//        move post into database column
        $data = [
            'name' => $_POST[''],
            'rcn' => $_POST[''],
            'state' => $_POST[''],
            'lga' => $_POST[''],
            'address' => $_POST[''],
            'incoporation_date' => $_POST[''],
            'phone' => $_POST[''],
            'email' => $_POST[''],
            'website' => $_POST[''],
            'image' => $_POST[''],
            'sender_id' => $_POST[''],
        ];

//        the sql query to add to database
        $loan_id = create($table, $data);
        dd($loan_id);
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
    $loanDetails = selectOne($table, ['idinstitution' => $id]);
    outputData($loanDetails);
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
    $_SESSION['message'] = 'Loan deleted successfully';
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
if (isset($_POST['update-loan'])) {
    adminOnly();
    $errors = validate($_POST);

    if (count($errors) === 0) {
        $id = $_POST['id'];
        unset($_POST['update-loan'], $_POST['id']);
        $institutionUpdate = update($table, $id, $_POST);
        $_SESSION['message'] = 'Loan Product Information updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit();
    } else {
        outputData($_POST);
    }

}
