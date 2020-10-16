<?php
include ('../../path.php');
include(ROOT_PATH . "/app/database/db.php");
//include(ROOT_PATH . "/app/helpers/middleware.php");
//include(ROOT_PATH . "/app/helpers/validateAccounts.php");

$table = 'fixed-deposit_product';

$errors = array();
$id = '';
$name = '';
$description = '';

$accounts = selectAll($table);
//dd($accounts);
function outputData($data)
{
    return [
        'description' => $data['interest'],
        'description1' => $data['min_fixed_deposit'],
        'description2' => $data['max_fixed_deposit'],
        'description3' => $data['amortization_method'],
        'description4' => $data['min_principal'],
        'description5' => $data['max_principal'],
        'description6' => $data['rule_type'],
        'description7' => $data['products_idproducts'],
//        'description8' => $data[''],
//        'description9' => $data[''],
//        'description0' => $data[''],
    ];
}

if (isset($_POST['submit'])) {
    adminOnly();

    $errors = validateAccount($_POST);


    if (count($errors) === 0) {
        unset($_POST['submit']);
        $data = [
            'interest'=>$_POST[''],
            'min_fixed_deposit'=>$_POST[''],
            'max_fixed_deposit'=>$_POST[''],
            'amortization_method'=>$_POST[''],
            'min_principal'=>$_POST[''],
            'max_principal'=>$_POST[''],
            'rule_type'=>$_POST[''],
            'products_idproducts'=>$_POST['']
        ];
        $query = create($table, $data);
//        dd($query);
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
    $query = selectOne($table, ['idlfixed_deposit_product ' => $id]);
    $id = $topic['id'];
    $name = $topic['name'];
    $description = $topic['description'];
}

if (isset($_GET['del_id'])) {
    adminOnly();
    $id = $_GET['del_id'];
    $query = delete($table, $id);
    $_SESSION['message'] = 'Fixed deposite product deleted successfully';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/admin/topics/index.php');
    exit();
}


if (isset($_POST['update-topic'])) {
    adminOnly();
    $errors = validateTopic($_POST);
    $data = [
        'interest'=>$_POST[''],
        'min_fixed_deposit'=>$_POST[''],
        'max_fixed_deposit'=>$_POST[''],
        'amortization_method'=>$_POST[''],
        'min_principal'=>$_POST[''],
        'max_principal'=>$_POST[''],
        'rule_type'=>$_POST[''],
        'products_idproducts'=>$_POST['']
    ];
    if (count($errors) === 0) { 
        $id = $_POST['id'];
        unset($_POST['update-topic'], $_POST['id']);
        $query = update($table, $id, $data);
        $_SESSION['message'] = 'Details updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit();
    } else {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
    }

}
