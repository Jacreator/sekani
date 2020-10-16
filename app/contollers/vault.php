<?php
include ('../../path.php');
include(ROOT_PATH . "/app/database/db.php");
//include(ROOT_PATH . "/app/helpers/middleware.php");
//include(ROOT_PATH . "/app/helpers/validateAccounts.php");

$table = 'vault';

$errors = array();
$id = '';
$name = '';
$description = '';

$accounts = selectAll($table);
//dd($accounts);
function outputData($data)
{
    return [
        'description' => $data['description'],
        'description1' => $data['last_transaction_date'],
        'description1' => $data['balance'],
        'description1' => $data['created_day'],
        'description1' => $data['institution_idinstitution'],
        'description1' => $data['branch_idbranch'],
    ];
}


if (isset($_POST['submit'])) {
    adminOnly();

    $errors = validateAccount($_POST);


    if (count($errors) === 0) {
        unset($_POST['submit']);
        $data = [
            'description'=>$_POST[''],
            'last_transaction_date'=>$_POST[''],
            'balance'=>$_POST[''],
            'created_day'=>$_POST[''],
            'institution_idinstitution'=>$_POST[''],
            'branch_idbranch'=>$_POST['']
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
    $topic = selectOne($table, ['idvault_transaction' => $id]);
    $id = $topic['id'];
    $name = $topic['name'];
    $description = $topic['description'];
}

if (isset($_GET['del_id'])) {
    adminOnly();
    $id = $_GET['del_id'];
    $query = delete($table, $id);
    $_SESSION['message'] = 'Vault deleted successfully';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/admin/topics/index.php');
    exit();
}


if (isset($_POST['update'])) {
    adminOnly();
    $errors = validateTopic($_POST);
    $data = [
        'description'=>$_POST[''],
        'last_transaction_date'=>$_POST[''],
        'balance'=>$_POST[''],
        'created_day'=>$_POST[''],
        'institution_idinstitution'=>$_POST[''],
        'branch_idbranch'=>$_POST['']
    ];

    if (count($errors) === 0) { 
        $id = $_POST['id'];
        unset($_POST['update'], $_POST['id']);
        $query = update($table, $id,  $data);
        $_SESSION['message'] = 'Vault updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit();
    } else {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
    }

}
