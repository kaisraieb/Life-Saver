<div class="container-fluid mt-4">
<h2 class="mb-4">Validation Des Testes  </h2>
<?php 
session_start();
require_once '../config.php';
require_once '../utils/connection.php'; 
if(isset($_SESSION["user_id"])){
    if($_SESSION["user_role"] == "MEDECIN") {
        if($_GET["id_don"]){
         include 'includes/header.php'; 
         include "includes/sidebar.php"; 
          $stmt = $pdo->query("SELECT * FROM dons WHERE id_don = ? ");
          $stmt->execute([$_GET['id_don']]);
          $don = $stmt->fetch(PDO::FETCH_ASSOC);
          if(count($don)>0){
            echo '<div class="form-container"><h2 class="form-title">Validation Test</h2>'.'<form method="POST" action="/handelrs/testHandler.php">
            <div class="mb-3">
                <label for="confirm" class="form-label required-field">is confirmed : </label>
                <select class="form-select" id="confirm" name="confirm" required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="note" class="form-label required-field">Doctor Note </label>
                <textarea class="form-control" id="note" name="note" rows="5"></textarea>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-danger">Submit Form</button>
            </div>
            </div>' ;
          }

         ?>
         
        
    
        </div>
        
        
         <?php include 'includes/footer.php';
        }
        else{
            header("Location:" . DOMAIN . "medecin/dons.php");
        exit; 

        }
    }
    else{
        header("Location:" . DOMAIN . "login.php?error=403");
        exit; 
    }
}
else{
        header("Location:" . DOMAIN . "login.php?error=401");
        exit; 
}