<?php
include ('../../path.php');
include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
//include(ROOT_PATH . "/app/helpers/validateAccounts.php");

$table = 'staff';

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
        'description2' => $data[''],
        'description8' => $data[''],
        'description9' => $data[''],
        'description3' => $data[''],
        'description4' => $data[''],
        'description5' => $data[''],
        'description6' => $data[''],
        'description7' => $data[''],
        'description0' => $data[''],
    ];
}


if (isset($_POST['submit-staff'])) {
    adminOnly();

    $errors = validate($_POST);


    if (count($errors) === 0) {
        unset($_POST['submit-staff']);
        $data = [
            'first_name'=>$_POST[''],
            'middle_name'=>$_POST[''],
            'last_name'=>$_POST[''],
            'email'=>$_POST[''],
            'designation'=>$_POST[''],
            'phone_no'=>$_POST[''],
            'home_address'=>$_POST[''],
            'date_joined'=>$_POST[''],
            'employment_status'=>$_POST[''],
            'institution_idinstitution'=>$_POST[''],
            'branch_idbranch'=>$_POST[''],
        ];
        $staff_id = create($table, $data);
//        dd($account_id);
        $_SESSION['message'] = 'Staff Created Successful';
        $_SESSION['type'] = 'success';
//        go to base page
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit(); 
    }
    outputData($_POST);
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = selectOne($table, ['idstaff' => $id]);
    outputData($_POST);
}

if (isset($_GET['del_id'])) {
    adminOnly();
    $id = $_GET['del_id'];
    $count = delete($table, $id);
    $_SESSION['message'] = 'Staff deleted successfully';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/admin/topics/index.php');
    exit();
}

if (isset($_POST['update-staff'])) {
    adminOnly();
    $errors = validate($_POST);

    if (count($errors) === 0) { 
        $id = $_POST['id'];
        unset($_POST['update'], $_POST['id']);
        $data = [
            'first_name'=>$_POST[''],
            'middle_name'=>$_POST[''],
            'last_name'=>$_POST[''],
            'email'=>$_POST[''],
            'designation'=>$_POST[''],
            'phone_no'=>$_POST[''],
            'home_address'=>$_POST[''],
            'date_joined'=>$_POST[''],
            'employment_status'=>$_POST[''],
            'institution_idinstitution'=>$_POST[''],
            'branch_idbranch'=>$_POST[''],
        ];
        $staffUpdate = update($table, $id,  $data);
        $_SESSION['message'] = 'Staff updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit();
    }
    outputData($_POST);
}
