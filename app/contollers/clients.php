<?php
include ('../../path.php');
include(ROOT_PATH . "/app/database/db.php");
//include(ROOT_PATH . "/app/helpers/middleware.php");
//include(ROOT_PATH . "/app/helpers/validateTopic.php");

$table = 'client';

$errors = array();
$id = '';
$name = '';
$description = '';

//$topics = selectAll($table);


//if (isset($_POST['add-topic'])) {
//    adminOnly();
//    $errors = validateTopic($_POST);

//    if (count($errors) === 0) {
//        unset($_POST['add-topic']);
$data = [
    'firstname'=>'1234567890',
    'middlename'=>'saving',
    'lastname'=>11000.00,
    'displayname'=>2000.00,
    'account_officer'=>'12-8-2020',
    'client_type'=>'20-9-2020',
    'phone_no'=>'2',
    'email'=>'test@test.com',
    'state_of_origin'=>'test@test.com',
    'country'=>'test@test.com',
    'lga'=>'test@test.com',
    'occupation'=>'test@test.com',
    'gender'=>'test@test.com',
    'is_staff'=>'test@test.com',
    'activation_date'=>'test@test.com',
    'submitted_on_date'=>'test@test.com',
    'client_status'=>'test@test.com',
    'institution_idinstitution'=>'1',
    'branch_idbranch '=>'1',

];
        $topic_id = create($table, $data);
        dd($topic_id);
//        $_SESSION['message'] = 'Topic created successfully';
//        $_SESSION['type'] = 'success';
//        header('location: ' . BASE_URL . '/admin/topics/index.php');
//        exit();
//    } else {
//        $name = $_POST['name'];
//        $description = $_POST['description'];
//    }
//}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $topic = selectOne($table, ['id' => $id]);
    $id = $topic['id'];
    $name = $topic['name'];
    $description = $topic['description'];
}

if (isset($_GET['del_id'])) {
    adminOnly();
    $id = $_GET['del_id'];
    $count = delete($table, $id);
    $_SESSION['message'] = 'Topic deleted successfully';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/admin/topics/index.php');
    exit();
}


if (isset($_POST['update-topic'])) {
    adminOnly();
    $errors = validateTopic($_POST);

    if (count($errors) === 0) { 
        $id = $_POST['id'];
        unset($_POST['update-topic'], $_POST['id']);
        $topic_id = update($table, $id, $_POST);
        $_SESSION['message'] = 'Topic updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit();
    } else {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
    }

}
