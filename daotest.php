<?php
require_once "/handlers/Dao.php";
try {
    $dao = new Dao();
    $users = $dao->getUsers();
    var_dump($users);
    /*echo "<ul>";
    foreach ($users as $user) {
        echo "<li>$user</li>";
    }
    echo "</ul>";*/
    echo "success";
}
catch (Exception $e) {
    echo "<pre>";
    var_dump($e);
    echo "</pre>";
    phpinfo();
    die;
}