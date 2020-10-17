<?php
include ('../../path.php');
include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
//include(ROOT_PATH . "/app/helpers/validateAccounts.php");

$table = 'products';

$errors = array();
$id = '';
$name = '';
$description = '';

$accounts = selectAll($table);
//dd($accounts);

/**
 * get information from the controller back to frontend
 *
 * @param $data
 * @return array
 */
function outputData($data)
{
    return [
        'description' => $data[''],
        'description1' => $data[''],
        'description2' => $data[''],
        'description3' => $data[''],
    ];
}

/**
 * a isset that takes the trigger from the views button
 * use the middleware to check if the user have rights for the
 * action
 *
 */
if (isset($_POST['submit-product'])) {
    adminOnly();

    $errors = validate($_POST);


    if (count($errors) === 0) {
        unset($_POST['submit-product']);
        $data = [
            'name'=>$_POST[''],
            'short_code'=>$_POST[''],
            'description'=>$_POST[''],
            'charges_idcharges'=>$_POST['']
        ];
        $product_id  = create($table, $data);
//        dd($account_id);
        $_SESSION['message'] = 'Product Created Successful';
        $_SESSION['type'] = 'success';
//        go to base page
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit(); 
    }
    outputData($_POST);
}

/**
 * a isset that takes the trigger from the views button
 * and returns an individual account details
 *
 */
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $productDetails = selectOne($table, ['idproducts' => $id]);
    outputData($productDetails);
}

/**
 * a isset that takes the trigger from the views button
 * use the middleware to check if the user have rights for the
 * action
 * and delete the record from database
 */
if (isset($_GET['del_id'])) {
    adminOnly();
    $id = $_GET['del_id'];
    $count = delete($table, $id);
    $_SESSION['message'] = 'Product deleted successfully';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/admin/topics/index.php');
    exit();
}

/**
 * a isset that takes the trigger from the views button
 * use the middleware to check if the user have rights for the action
 * update the specified account records
 *
 */
if (isset($_POST['update-product'])) {
    adminOnly();
    $errors = validateTopic($_POST);

    if (count($errors) === 0) { 
        $id = $_POST['id'];
        unset($_POST['update-product'], $_POST['id']);
        $data = [
            'name'=>$_POST[''],
            'short_code'=>$_POST[''],
            'description'=>$_POST[''],
            'charges_idcharges'=>$_POST['']
        ];
        $query = update($table, $id,  $data);
        $_SESSION['message'] = 'Product updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit();
    }
    outputData($_POST);

}
