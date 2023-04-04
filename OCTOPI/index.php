<?php

session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/database.php";

    $sql = "SELECT * FROM user
            WHERE id =  {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();




    require "databaseposts.php";
    $db = mysqli_connect($sname, $uname, $password, $db_name);

    $postsquery=mysqli_query($db, "SELECT * 
                            FROM posts 
                            ORDER BY `id` DESC 
                            LIMIT 8" );

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
        <img src="logo.PNG" class="banner" alt="">
        <div class="padding30 form">
            <h1 id="pi" class="indexpi pibanner" style="margin-left:575px;">Octopπ</h1>
            
            
            

            <div class="introstatement form">
                <h1 class="whitecolor bigger-text">Welcome, <?= htmlspecialchars($user["username"]) ?></h1>
            <h2 style="padding-right: 85px; text-align:justify; text-justify: auto;">Welcome to Octopπ, a new, social media platform! The premise is quite simple - post anonymous math related memes and 
                we'll show you the last eight posts made on our site! Hints: the name is "Octo-Pi!" !</h2>

            <!-- <h4 style="padding-right: 85px; text-align:justify; text-justify: auto;"class="whitecolor">We're not saying you should leave...but if you want to swim out in the ocean...  </h2><button><a href="logout.php" class="indexpi">Logout</a></button> -->
            </div>


            <div class="new-post">
                <form class="colorchangeid" action="upload.php" method="post" enctype="multipart/form-data" style="
    margin-bottom: 140px;">
                    
                
                    <div>
                    <label for="uploadimg">
                        <input class="label" type="file" name="imagepost" id="uploadimg">Click To Select Photo
                        </label>
                        
                    </div>
                
                
                    <div>
                        <input type="name" name="name" id="" placeholder="Alias">
                    </div>


                    <div>
                        <input type="caption" id="password" name="caption" placeholder="Caption">
                    </div>
                
                    <button type="submit" name="submit">Upload</button>


                    

                
                </form class="paddingfull">
                </div>


                <div>
                    
                <?php 
                
                        while($reslt = mysqli_fetch_array($postsquery)){ $img="uploads/".$reslt['picture'];?>
                            
                            <!-- echo($reslt['caption']); -->
                            <form id="divcontainer" class="plainfont">
                                <h1 class="white plainfont" >posted by: </h1>
                                <h1 style="color: #e9e9e9; "class="whitesmall plainfont"><?= htmlspecialchars($reslt["username"])?></h1>
                                <p><img src="<?PHP print($img)?>" alt="" class="square"></p>
                                <h1 class="caption">caption: <?= htmlspecialchars($reslt["caption"])?></h1>
                            </form>
                            

                        <?PHP } ?>
                        <button><a href="logout.php" class="indexpi">Logout</a></button>
</div>
                    </div>
        
        
        
    </body>
<?php else:  ?>
    <body class="signup-page" id="index" style="padding-top: 30px;">
        <h1 id="pi" class="indexpi">‏‏‎ ‎‏‏‎ ‎‏‏‎ ‎Octopπ</h1>
        <div class="padding30">
            
            <button><a href="login.php" class="white">Login</a></button> 
            <button><a href="signup.html" class="white">Sign Up</a></button>
            
        </div>
        
    </body>
<?php endif; ?> 

</html>