<?php
include ('../../path.php');
include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
//include(ROOT_PATH . "/app/helpers/validateAccounts.php");

$table = 'savings_product';

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
    ];
}

if (isset($_POST['submit-saving-pro'])) {
    adminOnly();

    $errors = validate($_POST);

    if (count($errors) === 0) {
        unset($_POST['submit-saving-pro']);
        $data = [
            'min_amount'=>$_POST[''],
            'intetrest'=>$_POST[''],
            'products_idproducts'=>$_POST['']
        ];
        $savingProduct_id = create($table, $data);
//        dd( $query);
        $_SESSION['message'] = 'Saving Product Created Successful';
        $_SESSION['type'] = 'success';
//        go to base page
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit(); 
    }
    outputData($_POST);
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $savingProductDetails = selectOne($table, ['idsavings_product ' => $id]);
    outputData($savingProductDetails);
}

if (isset($_GET['del_id'])) {
    adminOnly();
    $id = $_GET['del_id'];
    $count = delete($table, $id);
    $_SESSION['message'] = 'Savings product deleted successfully';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/admin/topics/index.php');
    exit();
}


if (isset($_POST['update-saving-pro'])) {
    adminOnly();
    $errors = validate($_POST);

    if (count($errors) === 0) { 
        $id = $_POST['id'];
        unset($_POST['update-topic'], $_POST['id']);
        $data = [
            'min_amount'=>$_POST[''],
            'intetrest'=>$_POST[''],
            'products_idproducts'=>$_POST['']
        ];
        $savingProductUpdate = update($table, $id, $data);
        $_SESSION['message'] = 'Savings product updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit();
    }
    outputData($_POST);

}
