<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) { 
    header("Location: ../admin-dashboard.php"); 
    exit; 
}

$dbFile = __DIR__ . '/../content.db';
$db = new PDO("sqlite:" . $dbFile);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$message = '';

if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $stmt = $db->prepare("DELETE FROM portfolio WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $message = "Project deleted successfully.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $lang = $_POST['lang'];
    $desc = $_POST['description'];
    $image = $_POST['image_url'];
    
    $stmt = $db->prepare("INSERT INTO portfolio (title, category, lang, description, image_url) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$title, $category, $lang, $desc, $image]);
    $message = "New portfolio project added successfully!";
}

$stmt = $db->query("SELECT * FROM portfolio ORDER BY id DESC");
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Portfolio - CMS</title>
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
            background: rgba(59, 130, 246, 0.15);
            color: #60a5fa;
            border: 1px solid rgba(59, 130, 246, 0.3);
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

        .nav-link-btn.btn-logout {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border-color: rgba(239, 68, 68, 0.3);
        }

        .admin-wrapper {
            max-width: 1400px;
            margin: 110px auto 60px auto;
            padding: 0 24px;
        }

        .card-box {
            background: rgba(15, 23, 42, 0.75);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 10px;
            color: #ffffff;
            font-size: 0.95rem;
            margin-bottom: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #60a5fa;
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 15px rgba(96, 165, 250, 0.25);
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: #ffffff;
            font-weight: 700;
            border: none;
            border-radius: 10px;
            padding: 14px;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.35);
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            background: rgba(30, 41, 59, 0.9);
            color: #cbd5e1;
            padding: 16px 20px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        td {
            padding: 16px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 0.9rem;
            vertical-align: middle;
        }

        tr:last-child td { border-bottom: none; }
        tr:hover td { background: rgba(255, 255, 255, 0.03); }

        .btn-delete {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
            padding: 6px 12px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-delete:hover {
            background: #ef4444;
            color: #ffffff;
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
                    <span class="brand-badge">PORTFOLIO</span>
                </div>
            </a>
            <nav>
                <ul class="nav-links">
                    <li><a href="index.php" class="nav-link-btn"><i class="fa-solid fa-arrow-left"></i> CMS Hub</a></li>
                    <li><a href="../admin-dashboard.php" class="nav-link-btn"><i class="fa-solid fa-gauge-high"></i> Master Dashboard</a></li>
                    <li><a href="/index.html" class="nav-link-btn" target="_blank"><i class="fa-solid fa-globe"></i> View Site</a></li>
                    <li><a href="../admin-dashboard.php?action=logout" class="nav-link-btn btn-logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="admin-wrapper">
        <div style="margin-bottom: 30px;">
            <h1 style="font-size: 2.2rem; color: #ffffff; font-family: 'Outfit', sans-serif;">Manage Portfolio Showcase</h1>
            <p style="color: var(--text-muted, #94a3b8); font-size: 0.95rem; margin-top: 4px;">Add new project videos, photography campaigns, and manage existing portfolio entries.</p>
        </div>

        <?php if ($message): ?>
            <div style="background: rgba(59, 130, 246, 0.15); border: 1px solid #3b82f6; color: #60a5fa; padding: 16px 20px; border-radius: 12px; margin-bottom: 24px;">
                <i class="fa-solid fa-circle-check" style="margin-right: 8px;"></i> <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 28px; align-items: start;">
            <!-- Form Card -->
            <div class="card-box">
                <h3 style="margin-bottom: 18px; color: #60a5fa; font-family: 'Outfit', sans-serif;">
                    <i class="fa-solid fa-plus-circle"></i> Add New Project
                </h3>
                <form method="POST">
                    <div>
                        <label style="font-size: 0.8rem; color: #94a3b8; display: block; margin-bottom: 4px;">Project Title</label>
                        <input type="text" name="title" placeholder="e.g. Green Hydrogen Documentary" required class="form-control">
                    </div>
                    <div>
                        <label style="font-size: 0.8rem; color: #94a3b8; display: block; margin-bottom: 4px;">Category Tag</label>
                        <input type="text" name="category" placeholder="e.g. Campaign, Event, Live Broadcast" required class="form-control">
                    </div>
                    <div>
                        <label style="font-size: 0.8rem; color: #94a3b8; display: block; margin-bottom: 4px;">Language</label>
                        <select name="lang" class="form-control">
                            <option value="en">English (EN)</option>
                            <option value="fr">French (FR)</option>
                            <option value="ar">Arabic (AR)</option>
                        </select>
                    </div>
                    <div>
                        <label style="font-size: 0.8rem; color: #94a3b8; display: block; margin-bottom: 4px;">Image / Thumbnail URL</label>
                        <input type="text" name="image_url" placeholder="assets/images/portfolio/proj1.jpg" class="form-control">
                    </div>
                    <div>
                        <label style="font-size: 0.8rem; color: #94a3b8; display: block; margin-bottom: 4px;">Description</label>
                        <textarea name="description" placeholder="Short description of the work done..." class="form-control" style="min-height: 90px;"></textarea>
                    </div>
                    <button type="submit" class="btn-primary">
                        <i class="fa-solid fa-cloud-arrow-up"></i> Add Project
                    </button>
                </form>
            </div>

            <!-- Table Card -->
            <div class="card-box">
                <h3 style="margin-bottom: 18px; color: #ffffff; font-family: 'Outfit', sans-serif;">
                    <i class="fa-solid fa-layer-group"></i> Existing Portfolio Projects (<?= count($projects) ?>)
                </h3>
                
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Project Details</th>
                                <th>Lang</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($projects)): ?>
                                <tr>
                                    <td colspan="5" style="text-align: center; color: #94a3b8; padding: 40px 0;">
                                        No projects found in database. Add your first project using the form.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($projects as $p): ?>
                                    <tr>
                                        <td style="color: #94a3b8; font-family: monospace;">#<?= $p['id'] ?></td>
                                        <td>
                                            <strong style="color: #ffffff; font-size: 0.95rem;"><?= htmlspecialchars($p['title']) ?></strong>
                                            <?php if (!empty($p['description'])): ?>
                                                <p style="font-size: 0.8rem; color: #94a3b8; margin-top: 4px; line-height: 1.4;"><?= htmlspecialchars($p['description']) ?></p>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span style="background: rgba(139, 92, 246, 0.15); color: #a78bfa; padding: 3px 8px; border-radius: 4px; font-size: 0.75rem; text-transform: uppercase;">
                                                <?= htmlspecialchars($p['lang'] ?? 'en') ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span style="background: rgba(59, 130, 246, 0.15); color: #60a5fa; padding: 3px 8px; border-radius: 4px; font-size: 0.75rem;">
                                                <?= htmlspecialchars($p['category']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="?action=delete&id=<?= $p['id'] ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this project?');">
                                                <i class="fa-solid fa-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
