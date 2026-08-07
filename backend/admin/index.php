<?php
session_start();
// Use the same login as quotes
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../admin-dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS Dashboard - Atlas Multimedia Productions</title>
    <link rel="stylesheet" href="../../frontend/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .admin-wrapper { max-width: 1200px; margin: 100px auto 40px auto; padding: 0 24px; }
        .dashboard-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; }
        .dash-card { background: rgba(17, 31, 53, 0.4); border: 1px solid var(--border-color); border-radius: var(--border-radius); padding: 30px; text-align: center; text-decoration: none; color: white; transition: all 0.3s; }
        .dash-card:hover { background: rgba(17, 31, 53, 0.8); border-color: var(--primary); transform: translateY(-3px); }
        .dash-card i { font-size: 3rem; color: var(--primary); margin-bottom: 15px; }
        .dash-card h3 { font-size: 1.5rem; margin-bottom: 10px; }
    </style>
</head>
<body>
    <header>
        <div class="container nav-container">
            <div class="logo-wrapper">
                <div class="logo-text">ATLAS<span>MULTIMEDIA</span> CMS</div>
            </div>
            <nav>
                <ul>
                    <li><a href="../../frontend/index.html">View Site</a></li>
                    <li><a href="../admin-dashboard.php?action=logout" class="btn btn-secondary"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="admin-wrapper">
        <div style="margin-bottom: 40px;">
            <h2>Content Management System</h2>
            <p style="color: var(--text-muted);">Manage your website content, portfolio, and blog from here.</p>
        </div>

        <div class="dashboard-grid">
            <a href="pages.php" class="dash-card">
                <i class="fa-solid fa-file-lines"></i>
                <h3>Static Pages</h3>
                <p>Edit text for Home, About, Services, etc.</p>
            </a>
            <a href="portfolio.php" class="dash-card">
                <i class="fa-solid fa-images"></i>
                <h3>Portfolio</h3>
                <p>Manage your projects and videos.</p>
            </a>
            <a href="blog.php" class="dash-card">
                <i class="fa-solid fa-newspaper"></i>
                <h3>Blog Articles</h3>
                <p>Write and publish new insights.</p>
            </a>
            <a href="../admin-dashboard.php" class="dash-card">
                <i class="fa-solid fa-envelope"></i>
                <h3>Quotes & Inquiries</h3>
                <p>View submitted forms and quotes.</p>
            </a>
        </div>
    </div>
</body>
</html>
