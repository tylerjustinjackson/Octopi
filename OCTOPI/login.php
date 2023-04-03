<?php

$is_invalid = false;
if($_SERVER["REQUEST_METHOD"] === "POST") {

    $mysqli = require __DIR__ . "/database.php";

    $sql =  sprintf("SELECT * FROM user
            WHERE username = '%s'",
            $mysqli->real_escape_string($_POST["Username"]));

    $result = $mysqli ->query($sql);
    $user = $result->fetch_assoc();

    if($user) {
       if( password_verify($_POST["password"], $user["password_hash"])) {
        
        session_start();
        session_regenerate_id();

        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];

        header("Location: index.php");
        exit;
       }
    }
    $is_invalid=true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    

    
    <?php if($is_invalid): ?>
        <em>Invalid Login</em>
    <?php endif; ?>
    <div class="form">
    <h1 id="pi">Login</h1>
        <form method="post" class="colorchangeid">

                <label for="Username">Username</label>
                <input type="Username" id="Username" name="Username" value="<?= htmlspecialchars($_POST["Username"] ?? "") ?>">


                <label for="password">Password</label>
                <input type="password" id="password" name="password">

            <button>Log in</button>
        </form>
    </div>
</body>