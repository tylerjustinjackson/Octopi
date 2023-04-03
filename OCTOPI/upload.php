<?php 

if (isset($_POST['submit']) && isset($_FILES['imagepost'])) {
	require "databaseposts.php";
    $db = mysqli_connect($sname, $uname, $password, $db_name);

	echo "<pre>";
	print_r($_FILES['imagepost']);
	echo "</pre>";

	$img_name = $_FILES['imagepost']['name'];
	$img_size = $_FILES['imagepost']['size'];
	$tmp_name = $_FILES['imagepost']['tmp_name'];
	$error = $_FILES['imagepost']['error'];
    $caption = $_POST['caption'];
    $name = $_POST['name'];

	if ($error === 0) {
		if ($img_size > 125000) {
			$em = "Sorry, your file is too large.";
		    header("Location: index.php?error=$em");
		}else {
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_exs = array("jpg", "jpeg", "png"); 
            
			if (in_array($img_ex_lc, $allowed_exs)) {
				$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
				$img_upload_path = 'uploads/'.$new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);

				// Insert into Database
                $user=$user["username"];
				$sql = "INSERT INTO posts(username, picture, caption) 
				        VALUES('$name','$new_img_name','$caption')";
				mysqli_query($db, $sql);
			}else {
				$em = "You can't upload files of this type";
		        header("Location: index.php?error=$em");
			}
		}
	}else {
		$em = "unknown error occurred!";
		header("Location: index.php?error=$em");
	}

}else {
	header("Location: index.php");
}