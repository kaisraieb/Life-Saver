<?php 
require_once "config.php";

try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collection Centers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .section-title {
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
        }
        
        .section-title:after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 10px auto;
            border-radius: 2px;
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            overflow: hidden;
            height: 100%;
        }
        
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.15);
        }
        
        .card-img-top {
            height: 180px;
            object-fit: cover;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .card-img-top i {
            font-size: 4rem;
            color: white;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        .card-title {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .card-text {
            color: #7f8c8d;
            font-size: 0.9rem;
        }
        
        .location-icon {
            color: #e74c3c;
            margin-right: 5px;
        }
        
        .no-centers {
            padding: 3rem 1rem;
            text-align: center;
            color: #7f8c8d;
        }
        
        .no-centers i {
            font-size: 4rem;
            margin-bottom: 1rem;
            color: #bdc3c7;
        }
    </style>
</head>
<body>
    <?php include "/includes/header.php"; ?>
    
    <div class="container py-5">
        <h1 class="section-title">Collection Centers</h1>
        
        <div class="row">
            <?php 
            try {
                $stmt = $pdo->prepare("SELECT * FROM `centres_collecte`"); 
                $stmt->execute();
                $centres = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                if (count($centres) > 0) {
                    foreach ($centres as $centre) {
                        echo "
                        <div class='col-lg-3 col-md-6 mb-4'>
                            <div class='card'>
                                <div class='card-img-top'>
                                    <i class='fas fa-hospital'></i>
                                </div>
                                <div class='card-body'>
                                    <h5 class='card-title'>" . htmlspecialchars($centre['nom_centre']) . "</h5>
                                    <p class='card-text'>
                                        <i class='fas fa-map-marker-alt location-icon'></i>
                                        " . htmlspecialchars($centre['ville']) . "
                                    </p>
                                </div>
                            </div>
                        </div>";
                    }
                } else {
                    echo "
                    <div class='col-12'>
                        <div class='no-centers'>
                            <i class='fas fa-search'></i>
                            <h3>No Centers Found</h3>
                            <p>There are currently no collection centers available.</p>
                        </div>
                    </div>";
                }
            } catch (PDOException $e) {
                error_log("Database error: " . $e->getMessage());
                echo "
                <div class='col-12'>
                    <div class='alert alert-danger text-center'>
                        <i class='fas fa-exclamation-triangle'></i>
                        <h4>Unable to Load Centers</h4>
                        <p>Please try again later.</p>
                    </div>
                </div>";
            }
            ?>
        </div>
    </div>
    
    <?php include "/includes/footer.php"; ?> 
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>