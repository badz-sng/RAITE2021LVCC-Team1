<?php
    session_start();
    include('config.php');
    if (isset($_POST['login'])) {
        $userName = $_POST['userName'];
        $passWord = $_POST['passWord'];
        $query = $connection->prepare("SELECT * FROM account WHERE userName=:userName");
        $query->bindParam("userName", $userName, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $hash_password = password_hash($result['passWord'],PASSWORD_DEFAULT);
        if (!$result) {
            echo '<p class="error">Username password combination is wrong!11</p>';
        } else {
            if (password_verify($passWord, $hash_password)) {
                $_SESSION['user_id'] = $result['id'];
                include 'dashboard.html';
            } else {
                echo '<p class="error">Username password combination is wrong!22</p>';
            }
        }
    }
?>