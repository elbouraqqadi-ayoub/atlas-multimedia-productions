<?php
session_start();

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
    <title>CMS Portal - Atlas Multimedia Productions</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/assets/logos/Logo (AMP).png">
    <!-- Main Theme CSS -->
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="../../style.css">
    <!-- FontAwesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: var(--bg-main, #020617);
            color: var(--text-main, #f8fafc);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
        }

        header.admin-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 80px;
            background: rgba(2, 6, 23, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border-color, rgba(255, 255, 255, 0.08));
            z-index: 1000;
        }

        .admin-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .brand-link {
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
        }

        .brand-logo-img {
            height: 44px;
            width: auto;
            object-fit: contain;
            filter: drop-shadow(0 0 10px rgba(16, 185, 129, 0.3));
        }

        .brand-title {
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            font-size: 1.25rem;
            color: #ffffff;
            letter-spacing: 0.5px;
        }

        .brand-title span {
            color: var(--primary, #10b981);
        }

        .brand-badge {
            background: rgba(139, 92, 246, 0.15);
            color: #a78bfa;
            border: 1px solid rgba(139, 92, 246, 0.3);
            font-size: 0.7rem;
            padding: 3px 8px;
            border-radius: 6px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-left: 8px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 16px;
            list-style: none;
        }

        .nav-link-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            color: var(--text-muted, #94a3b8);
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: all 0.3s ease;
        }

        .nav-link-btn:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .nav-link-btn.active {
            color: #ffffff;
            background: rgba(139, 92, 246, 0.15);
            border-color: #8b5cf6;
        }

        .nav-link-btn.btn-logout {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border-color: rgba(239, 68, 68, 0.3);
        }

        .nav-link-btn.btn-logout:hover {
            background: rgba(239, 68, 68, 0.25);
            color: #ffffff;
            border-color: #ef4444;
        }

        .admin-wrapper {
            max-width: 1200px;
            margin: 120px auto 60px auto;
            padding: 0 24px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 24px;
        }

        .dash-card {
            background: rgba(15, 23, 42, 0.75);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 36px 28px;
            text-align: center;
            text-decoration: none;
            color: white;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .dash-card:hover {
            background: rgba(15, 23, 42, 0.95);
            border-color: var(--primary, #10b981);
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(16, 185, 129, 0.15);
        }

        .dash-card .card-icon-box {
            width: 70px;
            height: 70px;
            border-radius: 18px;
            background: rgba(16, 185, 129, 0.1);
            color: var(--primary, #10b981);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .dash-card:hover .card-icon-box {
            transform: scale(1.1);
            background: rgba(16, 185, 129, 0.2);
        }

        .dash-card.purple .card-icon-box {
            background: rgba(139, 92, 246, 0.1);
            color: #a78bfa;
        }

        .dash-card.blue .card-icon-box {
            background: rgba(59, 130, 246, 0.1);
            color: #60a5fa;
        }

        .dash-card.amber .card-icon-box {
            background: rgba(245, 158, 11, 0.1);
            color: #fbbf24;
        }

        .dash-card h3 {
            font-size: 1.4rem;
            margin-bottom: 8px;
            color: #ffffff;
            font-family: 'Outfit', sans-serif;
        }

        .dash-card p {
            color: var(--text-muted, #94a3b8);
            font-size: 0.9rem;
            line-height: 1.5;
        }
    </style>
</head>
<body>

    <!-- Header Navbar -->
    <header class="admin-header">
        <div class="admin-nav">
            <a href="/index.html" class="brand-link" title="View Public Website">
                <img src="/assets/logos/Logo (AMP).png" alt="Atlas Multimedia" class="brand-logo-img" onerror="this.onerror=null; this.src='../../assets/logos/Logo (AMP).png';">
                <div class="brand-title">
                    ATLAS<span>MULTIMEDIA</span>
                    <span class="brand-badge">CMS PORTAL</span>
                </div>
            </a>
            <nav>
                <ul class="nav-links">
                    <li><a href="/index.html" class="nav-link-btn" target="_blank"><i class="fa-solid fa-globe"></i> View Site</a></li>
                    <li><a href="../admin-dashboard.php" class="nav-link-btn"><i class="fa-solid fa-gauge-high"></i> Master Dashboard</a></li>
                    <li><a href="index.php" class="nav-link-btn active"><i class="fa-solid fa-sliders"></i> CMS Content</a></li>
                    <li><a href="../admin-dashboard.php?action=logout" class="nav-link-btn btn-logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="admin-wrapper">
        <div style="margin-bottom: 40px; text-align: center;">
            <h1 style="font-size: 2.2rem; color: #ffffff; font-family: 'Outfit', sans-serif; margin-bottom: 10px;">Content Management Portal</h1>
            <p style="color: var(--text-muted, #94a3b8); font-size: 1rem; max-width: 600px; margin: 0 auto;">Select a module below to edit website texts, manage your portfolio showcase, publish blog articles, or view inquiries.</p>
        </div>

        <div class="dashboard-grid">
            <a href="pages.php" class="dash-card">
                <div class="card-icon-box">
                    <i class="fa-solid fa-file-lines"></i>
                </div>
                <h3>Static Pages Text</h3>
                <p>Edit headings, section descriptions, and texts for Home, About, Services, and Contact in EN, FR, and AR.</p>
            </a>

            <a href="portfolio.php" class="dash-card blue">
                <div class="card-icon-box">
                    <i class="fa-solid fa-photo-film"></i>
                </div>
                <h3>Portfolio Projects</h3>
                <p>Add new audiovisual projects, videos, case studies, and categories to showcase work.</p>
            </a>

            <a href="blog.php" class="dash-card amber">
                <div class="card-icon-box">
                    <i class="fa-solid fa-newspaper"></i>
                </div>
                <h3>Blog Articles</h3>
                <p>Write, format, and publish news, sustainability insights, and tech articles.</p>
            </a>

            <a href="../admin-dashboard.php" class="dash-card purple">
                <div class="card-icon-box">
                    <i class="fa-solid fa-inbox"></i>
                </div>
                <h3>Quotes & Readers</h3>
                <p>Return to Master Dashboard to view client quote submissions and registered blog readers.</p>
            </a>
        </div>
    </div>

</body>
</html>
