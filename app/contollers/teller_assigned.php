<?php
include ('../../path.php');
include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
//include(ROOT_PATH . "/app/helpers/validateAccounts.php");

$table = 'teller_assigned';

$errors = array();
$id = '';
$name = '';
$description = '';

$accounts = selectAll($table);
//dd($accounts);
function outputData($data)
{
    return [
        'description' => $data[''],
        'description1' => $data[''],
    ];
}


if (isset($_POST['submit-assigned'])) {
    adminOnly();

    $errors = validateAccount($_POST);


    if (count($errors) === 0) {
        unset($_POST['submit-assigned']);
        $data = [
            'staff_idstaff'=>$_POST[''],
            'teller_idteller'=>$_POST[''],
        ];
        $tellerAssigned_id = create($table, $data);
//        dd($account_id);
        $_SESSION['message'] = 'Teller Assign Created Successful';
        $_SESSION['type'] = 'success';
//        go to base page
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit(); 
    }
    outputData($_POST);
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $tellerAssignedDetails = selectOne($table, ['idteller_assigned' => $id]);
    outputData($tellerAssignedDetails);
}

if (isset($_GET['del_id'])) {
    adminOnly();
    $id = $_GET['del_id'];
    $count = delete($table, $id);
    $_SESSION['message'] = 'Teller assigned deleted successfully';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/admin/topics/index.php');
    exit();
}


if (isset($_POST['update-tel-assign'])) {
    adminOnly();
    $errors = validate($_POST);

    if (count($errors) === 0) { 
        $id = $_POST['id'];
        unset($_POST['update'], $_POST['id']);
        $data = [
            'staff_idstaff'=>$_POST[''],
            'teller_idteller'=>$_POST[''],
        ];
        $topic_id = update($table, $id, $data);
        $_SESSION['message'] = 'Teller assigned updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit();
    }
    outputData($_POST);

}
