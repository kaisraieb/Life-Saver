<?php
require_once '../config.php';
session_start();

if (!empty($_POST)) {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        try {
            $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->execute([$_POST['username']]);
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            
            // Verify user password and set $_SESSION
            if ($user && password_verify($_POST['password'], $user->password)) {
                $_SESSION['user_id'] = $user->ID;
                header("Location : index.php") ; 
            }
            header("Location : login.php") ; 

            
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            header("Location : login.php") ; 
        }
    }
    header("Location : login.php") ; 

}
header("Location : login.php") ;  ; 
?>