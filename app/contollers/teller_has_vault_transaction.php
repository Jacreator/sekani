<?php
include('../../path.php');
include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
//include(ROOT_PATH . "/app/helpers/validateAccounts.php");

$table = 'teller_has_vault_transaction';

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
    ];
}

if (isset($_POST['submit-tel-has-vault'])) {
    adminOnly();

    $errors = validate($_POST);


    if (count($errors) === 0) {
        unset($_POST['submit']);
        $data = [
            'teller_idteller' => $_POST[''],
            'vault_transaction_idvault_transaction' => $_POST[''],
        ];
        $hasVault_id = create($table, $data);
//        dd($account_id);
        $_SESSION['message'] = 'Information Created Successful';
        $_SESSION['type'] = 'success';
//        go to base page
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit();
    }
    outputData($_POST);
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $hasVaultDetails = selectOne($table, ['teller_idteller' => $id]);
    outputData($hasVaultDetails);
}

if (isset($_GET['del_id'])) {
    adminOnly();
    $id = $_GET['del_id'];
    $count = delete($table, $id);
    $_SESSION['message'] = 'Teller value deleted successfully';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/admin/topics/index.php');
    exit();
}


if (isset($_POST['update-has-vault'])) {
    adminOnly();
    $errors = validate($_POST);

    if (count($errors) === 0) {
        $id = $_POST['id'];
        unset($_POST['update'], $_POST['id']);
        $data = [
            'teller_idteller' => $_POST[''],
            'vault_transaction_idvault_transaction' => $_POST[''],
        ];
        $query = update($table, $id, $data);
        $_SESSION['message'] = 'Teller value updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit();
    }
    outputData($_POST);

}
