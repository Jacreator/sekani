<?php
include('../../path.php');
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
        'description' => $data[''],
        'description1' => $data[''],
        'description2' => $data[''],
        'description3' => $data[''],
        'description4' => $data[''],
        'description5' => $data[''],
        'description6' => $data[''],
    ];
}


if (isset($_POST['add-account'])) {
    adminOnly();

    $errors = validateAccount($_POST);

    if (count($errors) === 0) {
        unset($_POST['add-account']);
        $data = [
            'id_card' => $_POST[''],
            'card_url' => $_POST[''],
            'signature' => $_POST[''],
            'passport' => $_POST[''],
            'rcn' => $_POST[''],
            'bvn' => $_POST[''],
            'client_idclient' => $_POST['']
        ];
        $credentials_id = create($table, $data);
//        dd($account_id);
        $_SESSION['message'] = 'Successful';
        $_SESSION['type'] = 'success';
//        go to base page
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit();
    }
    outputData($_POST);
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $clientCredentialsDetails = selectOne($table, ['idclient_credentials' => $id]);
    outputData($clientCredentialsDetails);
}

if (isset($_GET['del_id'])) {
    adminOnly();
    $id = $_GET['del_id'];
    $count = delete($table, $id);
    $_SESSION['message'] = 'Credentials deleted successfully';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/admin/topics/index.php');
    exit();
}


if (isset($_POST['update-cli-cred'])) {
    adminOnly();
    $errors = validate($_POST);
    $data = [
        'id_card' => $_POST[''],
        'card_url' => $_POST[''],
        'signature' => $_POST[''],
        'passport' => $_POST[''],
        'rcn' => $_POST[''],
        'bvn' => $_POST[''],
        'client_idclient' => $_POST['']
    ];
    if (count($errors) === 0) {
        $id = $_POST['id'];
        unset($_POST['update-cli-cred'], $_POST['id']);
        $query = update($table, $id, $data);
        $_SESSION['message'] = 'Credentials updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit();
    }
    outputData($_POST);

}
