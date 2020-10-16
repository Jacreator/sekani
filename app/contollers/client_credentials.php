<?php
include ('../../path.php');
include(ROOT_PATH . "/app/database/db.php");
//include(ROOT_PATH . "/app/helpers/middleware.php");
//include(ROOT_PATH . "/app/helpers/validateAccounts.php");

$table = 'client_credentials';

$errors = array();
$id = '';
$name = '';
$description = '';

$accounts = selectAll($table);
//dd($accounts);
function outputData($data)
{
    return [
        'description' => $data['id_card'],
        'description1' => $data['ard_url'],
        'description2' => $data['signature'],
        'description3' => $data['passport'],
        'description4' => $data['rcn'],
        'description5' => $data['bvn'],
        'description6' => $data['client_idClient'],
    ];
}


if (isset($_POST['add-account'])) {
    adminOnly();

    $errors = validateAccount($_POST);


    if (count($errors) === 0) {
        unset($_POST['add-account']);
        $data = [
            'id_card'=>$_POST[''],
            'card_url'=>$_POST[''],
            'signature'=>$_POST[''],
            'passport'=>$_POST[''],
            'rcn'=>$_POST[''],
            'bvn'=>$_POST[''],
            'client_idclient'=>$_POST['']
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
    $query = selectOne($table, ['idclient_credentials' => $id]);
    $id = $topic['id'];
    $name = $topic['name'];
    $description = $topic['description'];
}

if (isset($_GET['del_id'])) {
    adminOnly();
    $id = $_GET['del_id'];
    $query = delete($table, $id);
    $_SESSION['message'] = 'Credentials deleted successfully';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/admin/topics/index.php');
    exit();
}


if (isset($_POST['update'])) {
    adminOnly();
    $errors = validateTopic($_POST);
    $data = [
        'id_card'=>$_POST[''],
        'card_url'=>$_POST[''],
        'signature'=>$_POST[''],
        'passport'=>$_POST[''],
        'rcn'=>$_POST[''],
        'bvn'=>$_POST[''],
        'client_idclient'=>$_POST['']
    ];
    if (count($errors) === 0) { 
        $id = $_POST['id'];
        unset($_POST['update'], $_POST['id']);
        $query = update($table, $id,  $data);
        $_SESSION['message'] = 'Credentials updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit();
    } else {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
    }

}
