<?php
include ('../../path.php');
include(ROOT_PATH . "/app/database/db.php");
//include(ROOT_PATH . "/app/helpers/middleware.php");
//include(ROOT_PATH . "/app/helpers/validateAccounts.php");

$table = 'users';

$errors = array();
$id = '';
$name = '';
$description = '';

$accounts = selectAll($table);
//dd($accounts);
function outputData($data)
{
    return [
        'description' => $data['username'],
        'description1' => $data['vpasskey'],
        'description1' => $data['lastlogin'],
        'description1' => $data['forgot_passkey'],
        'description1' => $data['pin'],
        'description1' => $data['pc_bio_idpc_bio'],
        'description1' => $data['staff_idstaff'],
        'description1' => $data['users_idusers'],
    ];
}

if (isset($_POST['submit'])) {
    adminOnly();

    $errors = validateAccount($_POST);


    if (count($errors) === 0) {
        unset($_POST['submit']);
        $data = [
            'username'=>$_POST[''],
            'vpasskey'=>$_POST[''],
            'lastlogin'=>$_POST[''],
            'forgot_passkey'=>$_POST[''],
            'time_created'=>$_POST[''],
            'pin'=>$_POST[''],
            'pc_bio_idpc_bio'=>$_POST[''],
            'staff_idstaff'=>$_POST[''],
            'users_idusers'=>$_POST[''],
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
    $topic = selectOne($table, ['idusers' => $id]);
    $id = $topic['id'];
    $name = $topic['name'];
    $description = $topic['description'];
}

if (isset($_GET['del_id'])) {
    adminOnly();
    $id = $_GET['del_id'];
    $query = delete($table, $id);
    $_SESSION['message'] = 'User deleted successfully';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/admin/topics/index.php');
    exit();
}


if (isset($_POST['update'])) {
    adminOnly();
    $errors = validateTopic($_POST);
    $data = [
        'username'=>$_POST[''],
        'vpasskey'=>$_POST[''],
        'lastlogin'=>$_POST[''],
        'forgot_passkey'=>$_POST[''],
        'time_created'=>$_POST[''],
        'pin'=>$_POST[''],
        'pc_bio_idpc_bio'=>$_POST[''],
        'staff_idstaff'=>$_POST[''],
        'users_idusers'=>$_POST[''],
    ];
    if (count($errors) === 0) { 
        $id = $_POST['id'];
        unset($_POST['update'], $_POST['id']);
        $query = update($table, $id,$data);
        $_SESSION['message'] = 'User updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit();
    } else {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
    }

}
