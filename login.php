<?php

include "header.php";

if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    if($username != "" && $password != "") {
        $user = $db->query("SELECT * FROM users WHERE username = \"".$username."\"");
        if ($user->rowCount() > 0) {
            $password_db = $user->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $password_db['password'])) {
                $_SESSION["session_id"] = session_id();
                header('Location: index.php');
            } else {
                echo '<p class="bg-danger" style="margin: 10px; padding: 10px;">Username or password incorrect.</p>';
            }
        } else {
            echo '<p class="bg-danger" style="margin: 10px; padding: 10px;">User not found</p>';
        }
    }
}
?>

<br>
<form method="post">
    <div class="form-group">
        <input type="text" class="form-control" required="required" name="username" placeholder="username">
    </div>
    <div class="form-group">
        <input type="password" class="form-control" required="required" name="password" placeholder="password">
    </div>
    <button type="submit" class="btn btn-default">Login</button>
</form>