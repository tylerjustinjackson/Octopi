<?php

session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/database.php";

    $sql = "SELECT * FROM user
            WHERE id =  {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="styles.css">
</head>

<?php if (isset($user)): ?>
    <body>
        <div class="padding30 form">
            <h1 id="pi" class="indexpi">Octopπ</h1>
            
            
            <h1>Hello, <?= htmlspecialchars($user["username"]) ?></h1>
            <h1>Ready to go?  <button><a href="logout.php" class="indexpi">Logout</a></button></h1>
            


            <div class="new-post">
            <form class="colorchangeid" action="upload.php" method="post" enctype="multipart/form-data">
                <div>
                <label for="alias">Alias</label>
                    <input type="name" name="name" id="">
                </div>
            
            <div>
                    <input type="file" name="imagepost" id="uploadimg">
                    <button type="submit" name="submit">Upload</button>
                </div>

                <div>
                        <label for="caption">Caption</label>
                        <input type="caption" id="password" name="caption">
                </div>
            
            
            </form>
                </div>
        </div>
    </body>
<?php else:  ?>
    <body class="signup-page" id="index">
        
        <div class="padding30">
            <h1 id="pi" class="indexpi">Octopπ</h1>
            <button><a href="login.php" class="white">Login</a></button> 
            <button><a href="signup.html" class="white">Sign Up</a></button>
            
        </div>
    </body>
<?php endif; ?> 
</html>