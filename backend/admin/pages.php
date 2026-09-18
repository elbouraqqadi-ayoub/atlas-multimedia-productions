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

// Handle add new custom field
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_new_field'])) {
    $page_name = strtolower(trim($_POST['new_page_name']));
    $lang = strtolower(trim($_POST['new_lang']));
    $section_key = strtolower(trim($_POST['new_section_key']));
    $content = trim($_POST['new_content']);
    
    if (!empty($page_name) && !empty($section_key)) {
        try {
            $stmt = $db->prepare("INSERT OR REPLACE INTO pages (page_name, lang, section_key, content) VALUES (?, ?, ?, ?)");
            $stmt->execute([$page_name, $lang, $section_key, $content]);
            $message = "New text field '$section_key' added successfully!";
        } catch (Exception $e) {
            $message = "Error adding field: " . $e->getMessage();
        }
    }
}

// Handle bulk content updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content'])) {
    foreach ($_POST['content'] as $id => $val) {
        $stmt = $db->prepare("UPDATE pages SET content = ? WHERE id = ?");
        $stmt->execute([$val, $id]);
    }
    $message = "All website content updated successfully!";
}

$stmt = $db->query("SELECT * FROM pages ORDER BY page_name, lang, section_key");
$pages = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Group by page name
$grouped = [];
foreach ($pages as $p) {
    $grouped[$p['page_name']][] = $p;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Website Pages - CMS</title>
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
            background: rgba(16, 185, 129, 0.15);
            color: var(--primary, #10b981);
            border: 1px solid rgba(16, 185, 129, 0.3);
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
            background: rgba(16, 185, 129, 0.15);
            border-color: var(--primary, #10b981);
        }

        .nav-link-btn.btn-logout {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border-color: rgba(239, 68, 68, 0.3);
        }

        .admin-wrapper {
            max-width: 1200px;
            margin: 110px auto 60px auto;
            padding: 0 24px;
        }

        .page-group {
            background: rgba(15, 23, 42, 0.75);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 28px;
            margin-bottom: 24px;
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
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary, #10b981);
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 15px rgba(16, 185, 129, 0.25);
        }

        .add-box {
            background: rgba(16, 185, 129, 0.06);
            border: 1px dashed rgba(16, 185, 129, 0.4);
            padding: 24px;
            border-radius: 16px;
            margin-bottom: 30px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #10b981, #059669);
            color: #020617;
            font-weight: 700;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.35);
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
                    <span class="brand-badge">CMS</span>
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
        <div style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div>
                <h1 style="font-size: 2.2rem; color: #ffffff; font-family: 'Outfit', sans-serif;">Manage Static Page Texts</h1>
                <p style="color: var(--text-muted, #94a3b8); font-size: 0.95rem; margin-top: 4px;">Edit titles, descriptions, and custom text blocks across all site pages.</p>
            </div>
        </div>

        <?php if ($message): ?>
            <div style="background: rgba(16, 185, 129, 0.15); border: 1px solid #10b981; color: #34d399; padding: 16px 20px; border-radius: 12px; margin-bottom: 24px;">
                <i class="fa-solid fa-circle-check" style="margin-right: 8px;"></i> <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <!-- Add Custom Field Form -->
        <div class="add-box">
            <h3 style="margin-bottom: 16px; color: var(--primary, #10b981); display: flex; align-items: center; gap: 10px;">
                <i class="fa-solid fa-circle-plus"></i> Add New Custom Text Field
            </h3>
            <form method="POST" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; align-items: end;">
                <input type="hidden" name="add_new_field" value="1">
                <div>
                    <label style="font-size: 0.8rem; color: #94a3b8; display: block; margin-bottom: 6px;">Target Page</label>
                    <select name="new_page_name" class="form-control">
                        <option value="home">Home Page</option>
                        <option value="about">About Page</option>
                        <option value="services">Services Page</option>
                        <option value="contact">Contact Page</option>
                    </select>
                </div>
                <div>
                    <label style="font-size: 0.8rem; color: #94a3b8; display: block; margin-bottom: 6px;">Language</label>
                    <select name="new_lang" class="form-control">
                        <option value="en">English (EN)</option>
                        <option value="fr">Français (FR)</option>
                        <option value="ar">العربية (AR)</option>
                    </select>
                </div>
                <div>
                    <label style="font-size: 0.8rem; color: #94a3b8; display: block; margin-bottom: 6px;">Field Key Name</label>
                    <input type="text" name="new_section_key" placeholder="e.g. hero_heading" class="form-control" required>
                </div>
                <div>
                    <label style="font-size: 0.8rem; color: #94a3b8; display: block; margin-bottom: 6px;">Text Value</label>
                    <input type="text" name="new_content" placeholder="Enter text content..." class="form-control" required>
                </div>
                <div>
                    <button type="submit" class="btn-primary" style="padding: 13px 20px; width: 100%;">
                        <i class="fa-solid fa-plus"></i> Add Field
                    </button>
                </div>
            </form>
        </div>

        <?php if (empty($grouped)): ?>
            <div class="page-group" style="text-align: center; padding: 50px 20px;">
                <i class="fa-solid fa-file-circle-plus" style="font-size: 3rem; color: #94a3b8; margin-bottom: 16px; opacity: 0.5;"></i>
                <p style="color: #94a3b8; font-size: 1.1rem;">No text fields stored yet. Use the form above to initialize custom text blocks!</p>
            </div>
        <?php else: ?>
            <form method="POST">
                <?php foreach ($grouped as $pageName => $fields): ?>
                    <div class="page-group">
                        <h3 style="margin-bottom: 20px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 12px; text-transform: uppercase; color: var(--primary, #10b981); letter-spacing: 1px;">
                            <i class="fa-solid fa-folder-open" style="margin-right: 8px;"></i> <?= htmlspecialchars($pageName) ?> Page
                        </h3>
                        <?php foreach ($fields as $f): ?>
                            <div style="margin-bottom: 18px;">
                                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #e2e8f0; font-size: 0.9rem;">
                                    <?= htmlspecialchars($f['section_key']) ?> 
                                    <span style="color: #a78bfa; font-size: 0.75rem; background: rgba(139,92,246,0.15); padding: 2px 8px; border-radius: 4px; margin-left: 6px;">
                                        <?= strtoupper(htmlspecialchars($f['lang'])) ?>
                                    </span>
                                </label>
                                <textarea name="content[<?= $f['id'] ?>]" class="form-control" style="min-height: 80px; font-family: inherit; line-height: 1.5;"><?= htmlspecialchars($f['content']) ?></textarea>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
                
                <div style="position: sticky; bottom: 20px; z-index: 100;">
                    <button type="submit" class="btn-primary" style="width: 100%; padding: 18px; font-size: 1.1rem; box-shadow: 0 10px 30px rgba(0,0,0,0.6); border-radius: 14px;">
                        <i class="fa-solid fa-floppy-disk"></i> Save All Changes
                    </button>
                </div>
            </form>
        <?php endif; ?>
    </div>

</body>
</html>
