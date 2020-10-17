<?php
include ('../../path.php');
include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
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
        'description' => $data[''],
        'description1' => $data[''],
        'description2' => $data[''],
        'description3' => $data[''],
        'description4' => $data[''],
        'description5' => $data[''],
        'description6' => $data[''],
        'description7' => $data[''],
    ];
}

if (isset($_POST['submit-teller'])) {
    adminOnly();

    $errors = validate($_POST);


    if (count($errors) === 0) {
        unset($_POST['submit-teller']);
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
        $teller_id = create($table, $data);
//        dd($account_id);
        $_SESSION['message'] = 'Teller Created Successful';
        $_SESSION['type'] = 'success';
//        go to base page
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit(); 
    }
    outputData($_POST);
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $tellerDetails = selectOne($table, ['idteller' => $id]);
    outputData($tellerDetails);
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


if (isset($_POST['update-teller'])) {
    adminOnly();
    $errors = validate($_POST);

    if (count($errors) === 0) { 
        $id = $_POST['id'];
        unset($_POST['update-teller'], $_POST['id']);
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
        $tellerUpdate = update($table, $id, $data);
        $_SESSION['message'] = 'Teller updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit();
    }
    outputData($_POST);

}
