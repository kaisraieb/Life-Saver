<?php
// sidebar.php - Responsive Sidebar Component
?>

<!-- Mobile Toggle Button -->
<button class="navbar-toggler mobile-toggle position-fixed m-3" type="button" id="sidebarToggle" style="z-index: 1001; background: white;">
    <span class="navbar-toggler-icon"></span>
</button>

<!-- Overlay for Mobile -->
<div class="overlay" id="overlay"></div>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="p-3">
        <h5 class="text-center mb-4">Menu</h5>
        <ul class="nav flex-column">
            <?php
            // Get current page name
            $currentPage = basename($_SERVER['PHP_SELF']);
            
            // Define menu items
            $menuItems = [
                'index.php' => 'Tableau de Bord',
                'dons.php' => 'Dons', 
                'tests.php' => 'Tests'
            ];
            
            // Generate menu items
            foreach ($menuItems as $page => $title) {
                $isActive = ($currentPage === $page) ? 'active' : '';
                echo "<li class='nav-item'><a href='$page' class='nav-link $isActive'>$title</a></li>";
            }
            ?>
        </ul>
    </div>
</div>

<style>
.sidebar {
    background-color: #343a40;
    color: white;
    min-height: 100vh;
    transition: all 0.3s;
    box-shadow: 3px 0 10px rgba(0, 0, 0, 0.1);
    width: 220px;
}

.sidebar .nav-link {
    color: rgba(255, 255, 255, 0.8);
    padding: 12px 20px;
    border-radius: 5px;
    margin-bottom: 5px;
    transition: all 0.2s;
}

.sidebar .nav-link:hover {
    background-color: rgba(255, 255, 255, 0.1);
    color: white;
}

.sidebar .nav-link.active {
    background-color: #0d6efd;
    color: white;
}

.navbar-toggler {
    border: none;
    font-size: 1.5rem;
}

.navbar-toggler:focus {
    box-shadow: none;
}

/* Mobile styles */
@media (max-width: 768px) {
    .sidebar {
        position: fixed;
        top: 0;
        left: -250px;
        width: 250px;
        z-index: 1000;
    }
    
    .sidebar.show {
        left: 0;
    }
    
    .overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }
    
    .overlay.show {
        display: block;
    }
    
    .mobile-toggle {
        display: block !important;
    }
}

/* Desktop styles */
@media (min-width: 769px) {
    .mobile-toggle {
        display: none !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const overlay = document.getElementById('overlay');
    
    // Toggle sidebar on mobile
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        });
    }
    
    // Close sidebar when clicking on overlay
    if (overlay) {
        overlay.addEventListener('click', function() {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });
    }
    
    // Close sidebar when clicking on a link (mobile)
    const navLinks = document.querySelectorAll('.sidebar .nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (window.innerWidth < 769) {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            }
        });
    });
    
    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 769) {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        }
    });
});
</script>