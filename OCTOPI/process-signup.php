<?php

if (empty($_POST['Username'])) {
    die("Name is required");
}

if (empty($_POST['Email'])) {
    die("email is required");
}

if ( ! filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid Email Required");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 chars");
}

if (! preg_match("/[0-9]/i",$_POST["password"])) {
    die("password must contain at least one number");
}

if (! preg_match("/[a-z]/i",$_POST["password"])) {
    die("password must contain at least one letter");
}

$password_hash=password_hash($_POST["password"], PASSWORD_DEFAULT);

require __DIR__ . "/database.php";
$sql = "INSERT INTO  user (username, email, password_hash)
    VALUES (?,?,?)";

$stmt = $mysqli->stmt_init();


// print_r($_POST);
// var_dump($password_hash);


if( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->$error);
};

$stmt->bind_param("sss",
                $_POST['Username'],
                $_POST['Email'],
                $password_hash);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;

} else {

    die("signuperror");
    
}

