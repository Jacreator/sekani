<?php
include('../../path.php');
include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
//include(ROOT_PATH . "/app/helpers/validateAccounts.php");

$table = 'pc_bio';

$errors = array();
$id = '';
$name = '';
$description = '';

$pc_bio = selectAll($table);
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
if (isset($_POST['add-pc-bio'])) {
    adminOnly();

//    check the post array before sending to database
    $errors = validate($_POST);

    if (count($errors) === 0) {
        unset($_POST['add-pc-bio']);

//        move post into database column
        $data = [
            'pc_title' => $_POST[''],
            'pc_surname' => $_POST[''],
            'pc_othername' => $_POST[''],
            'pc_designation' => $_POST[''],
            'pc_phone' => $_POST[''],
            'pc_email' => $_POST[''],
            'institution_idinstitution' => $_POST['']
        ];

//        the sql query to add to database
        $acct_trans_id = create($table, $data);
        dd($acct_trans_id);
        $_SESSION['message'] = 'Pc bio created successfully';
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
    $nextOfKinDetails = selectOne($table, ['idpc_bio' => $id]);
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
    $_SESSION['message'] = 'Information deleted successfully';
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
if (isset($_POST['update-pc-bio'])) {
    adminOnly();
    $errors = validate($_POST);

    if (count($errors) === 0) {
        $id = $_POST['id'];
        unset($_POST['update-pc-bio'], $_POST['id']);
//        move post into database column
        $data = [
            'pc_title' => $_POST[''],
            'pc_surname' => $_POST[''],
            'pc_othername' => $_POST[''],
            'pc_designation' => $_POST[''],
            'pc_phone' => $_POST[''],
            'pc_email' => $_POST[''],
            'institution_idinstitution' => $_POST['']
        ];
        $branchUpdate = update($table, $id, $data);
        $_SESSION['message'] = 'Information updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit();
    }

    outputData($_POST);

}
