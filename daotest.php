<?php
require_once "/handlers/Dao.php";
try {
    $dao = new Dao();
    $users = $dao->getUsers();
    echo "<ul>";
    foreach ($users as $user) {
        $userName = $dao->getUser($user['Email'])["UserName"];
        echo "<li>{$user['UserName']}'s email is {$user['Email']} which belongs to user {$userName}";
    }
    echo "</ul>";
    echo "success";
}
catch (Exception $e) {
    echo "<pre>";
    var_dump($e);
    echo "</pre>";
    phpinfo();
    die;
}