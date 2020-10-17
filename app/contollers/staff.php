<?php
include ('../../path.php');
include(ROOT_PATH . "/app/database/db.php");
//include(ROOT_PATH . "/app/helpers/middleware.php");
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
        'description' => $data['first_name'],
        'description1' => $data['middle_name'],
        'description2' => $data['last_name'],
        'description8' => $data['email'],
        'description9' => $data['designation'],
        'description0' => $data['phone_no'],
        'description0' => $data['home_address'],
        'description0' => $data['date_joined'],
        'description0' => $data['employment_status'],
        'description0' => $data['institution_idinstitution'],
        'description0' => $data['branch_idbranch'],
    ];
}


if (isset($_POST['submit'])) {
    adminOnly();

    $errors = validateAccount($_POST);


    if (count($errors) === 0) {
        unset($_POST['submit']);
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
        $query = create($table, $data);
//        dd($account_id);
        $_SESSION['message'] = 'Successful';
        $_SESSION['type'] = 'success';
//        go to base page
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit(); 
    } else {
        $description = $_POST[''];
        $description1 = $_POST[''];
        $description2 = $_POST[''];
        $description3 = $_POST[''];
        $description4 = $_POST[''];
        $description5 = $_POST[''];
        $description6 = $_POST[''];
        $description7 = $_POST[''];
        $description8 = $_POST[''];
        $description9 = $_POST[''];
        $description0 = $_POST[''];
    }
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = selectOne($table, ['idstaff' => $id]);
    $id = $topic['id'];
    $name = $topic['name'];
    $description = $topic['description'];
}

if (isset($_GET['del_id'])) {
    adminOnly();
    $id = $_GET['del_id'];
    $query = delete($table, $id);
    $_SESSION['message'] = 'Staff deleted successfully';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/admin/topics/index.php');
    exit();
}


if (isset($_POST['update'])) {
    adminOnly();
    $errors = validateTopic($_POST);
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
    if (count($errors) === 0) { 
        $id = $_POST['id'];
        unset($_POST['update'], $data);
        $query = update($table, $id,  $data);
        $_SESSION['message'] = 'Staff updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit();
    } else {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
    }

}
