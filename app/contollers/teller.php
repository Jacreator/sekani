<?php
include ('../../path.php');
include(ROOT_PATH . "/app/database/db.php");
//include(ROOT_PATH . "/app/helpers/middleware.php");
//include(ROOT_PATH . "/app/helpers/validateAccounts.php");

$table = 'teller';

$errors = array();
$id = '';
$name = '';
$description = '';

$accounts = selectAll($table);
//dd($accounts);

function outputData($data)
{
    return [
        'description' => $data['name'],
        'description1' => $data['description'],
        'description1' => $data['post_limit'],
        'description1' => $data['valid_from'],
        'description1' => $data['valid_to'],
        'description1' => $data['is_deleted'],
        'description1' => $data['till'],
        'description1' => $data['state'],
    ];
}

if (isset($_POST['submit'])) {
    adminOnly();

    $errors = validateAccount($_POST);


    if (count($errors) === 0) {
        unset($_POST['submit']);
        $data = [
            'name'=>$_POST[''],
            'description'=>$_POST[''],
            'post_limit'=>$_POST[''],
            'valid_from'=>$_POST[''],
            'valid_to'=>$_POST[''],
            'is_deleted'=>$_POST[''],
            'till'=>$_POST[''],
            'state'=>$_POST[''],
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
    $query = selectOne($table, ['idteller' => $id]);
    $id = $topic['id'];
    $name = $topic['name'];
    $description = $topic['description'];
}

if (isset($_GET['del_id'])) {
    adminOnly();
    $id = $_GET['del_id'];
    $count = delete($table, $id);
    $_SESSION['message'] = 'Teller deleted successfully';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/admin/topics/index.php');
    exit();
}


if (isset($_POST['update'])) {
    adminOnly();
    $errors = validateTopic($_POST);
    $data = [
        'name'=>$_POST[''],
        'description'=>$_POST[''],
        'post_limit'=>$_POST[''],
        'valid_from'=>$_POST[''],
        'valid_to'=>$_POST[''],
        'is_deleted'=>$_POST[''],
        'till'=>$_POST[''],
        'state'=>$_POST[''],
    ];
    if (count($errors) === 0) { 
        $id = $_POST['id'];
        unset($_POST['updat'], $_POST['id']);
        $topic_id = update($table, $id, $data);
        $_SESSION['message'] = 'Teller updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit();
    } else {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
    }

}
