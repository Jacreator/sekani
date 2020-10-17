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
        'description' => $data[''],
        'description1' => $data[''],
        'description2' => $data[''],
        'description3' => $data[''],
        'description4' => $data[''],
        'description5' => $data[''],
        'description6' => $data[''],
        'description7' => $data[''],
//        'description8' => $data[''],
//        'description9' => $data[''],
//        'description0' => $data[''],
    ];
}

if (isset($_POST['add-deposit-product'])) {
    adminOnly();

    $errors = validateAccount($_POST);


    if (count($errors) === 0) {
        unset($_POST['add-deposit-product']);
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
        $depositProduct_id = create($table, $data);
//        dd($query);
        $_SESSION['message'] = 'Fixed Deposit Product created Successful';
        $_SESSION['type'] = 'success';
//        go to base page
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit(); 
    }
    outputData($_POST);
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $depositProductDetails = selectOne($table, ['idlfixed_deposit_product ' => $id]);
    outputData($depositProductDetails);
}

if (isset($_GET['del_id'])) {
    adminOnly();
    $id = $_GET['del_id'];
    $count = delete($table, $id);
    $_SESSION['message'] = 'Fixed deposit product deleted successfully';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/admin/topics/index.php');
    exit();
}


if (isset($_POST['update-deposit-product'])) {
    adminOnly();
    $errors = validate($_POST);

    if (count($errors) === 0) { 
        $id = $_POST['id'];
        unset($_POST['update-deposit-product'], $_POST['id']);
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
        $depositProductUpdate = update($table, $id, $data);
        $_SESSION['message'] = 'Details updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit();
    }
    outputData($_POST);

}
