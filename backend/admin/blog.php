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
    $stmt = $db->prepare("DELETE FROM blog WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $message = "Blog article deleted successfully.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $lang = $_POST['lang'];
    $excerpt = $_POST['excerpt'];
    $image = $_POST['image_url'];
    $content = $_POST['content'];
    
    $stmt = $db->prepare("INSERT INTO blog (title, category, lang, excerpt, image_url, content) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$title, $category, $lang, $excerpt, $image, $content]);
    $message = "New blog article published successfully!";
}

$stmt = $db->query("SELECT * FROM blog ORDER BY id DESC");
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Blog Articles - CMS</title>
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
            background: rgba(245, 158, 11, 0.15);
            color: #fbbf24;
            border: 1px solid rgba(245, 158, 11, 0.3);
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
            border-color: #fbbf24;
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 15px rgba(251, 191, 36, 0.25);
        }

        .btn-primary {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: #020617;
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
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.35);
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
                    <span class="brand-badge">BLOG CMS</span>
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
            <h1 style="font-size: 2.2rem; color: #ffffff; font-family: 'Outfit', sans-serif;">Manage Blog Articles</h1>
            <p style="color: var(--text-muted, #94a3b8); font-size: 0.95rem; margin-top: 4px;">Publish news, green transition insights, and technological updates.</p>
        </div>

        <?php if ($message): ?>
            <div style="background: rgba(245, 158, 11, 0.15); border: 1px solid #f59e0b; color: #fbbf24; padding: 16px 20px; border-radius: 12px; margin-bottom: 24px;">
                <i class="fa-solid fa-circle-check" style="margin-right: 8px;"></i> <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 28px; align-items: start;">
            <!-- Form Card -->
            <div class="card-box">
                <h3 style="margin-bottom: 18px; color: #fbbf24; font-family: 'Outfit', sans-serif;">
                    <i class="fa-solid fa-pen-nib"></i> Publish New Article
                </h3>
                <form method="POST">
                    <div>
                        <label style="font-size: 0.8rem; color: #94a3b8; display: block; margin-bottom: 4px;">Article Title</label>
                        <input type="text" name="title" placeholder="e.g. Energy Transition in Morocco 2026" required class="form-control">
                    </div>
                    <div>
                        <label style="font-size: 0.8rem; color: #94a3b8; display: block; margin-bottom: 4px;">Category</label>
                        <input type="text" name="category" placeholder="e.g. Green Tech, Corporate, AV Production" required class="form-control">
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
                        <label style="font-size: 0.8rem; color: #94a3b8; display: block; margin-bottom: 4px;">Cover Image URL</label>
                        <input type="text" name="image_url" placeholder="assets/images/blog1.jpg" class="form-control">
                    </div>
                    <div>
                        <label style="font-size: 0.8rem; color: #94a3b8; display: block; margin-bottom: 4px;">Short Excerpt</label>
                        <textarea name="excerpt" placeholder="Summary of the article for blog preview card..." class="form-control" style="min-height: 70px;"></textarea>
                    </div>
                    <div>
                        <label style="font-size: 0.8rem; color: #94a3b8; display: block; margin-bottom: 4px;">Full Article Content (HTML formatting allowed)</label>
                        <textarea name="content" placeholder="Write full article body content..." class="form-control" style="min-height: 140px; font-family: monospace;"></textarea>
                    </div>
                    <button type="submit" class="btn-primary">
                        <i class="fa-solid fa-paper-plane"></i> Publish Article
                    </button>
                </form>
            </div>

            <!-- Table Card -->
            <div class="card-box">
                <h3 style="margin-bottom: 18px; color: #ffffff; font-family: 'Outfit', sans-serif;">
                    <i class="fa-solid fa-newspaper"></i> Published Blog Articles (<?= count($articles) ?>)
                </h3>
                
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Article Title</th>
                                <th>Lang</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($articles)): ?>
                                <tr>
                                    <td colspan="6" style="text-align: center; color: #94a3b8; padding: 40px 0;">
                                        No blog articles published yet. Create your first article using the form.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($articles as $a): ?>
                                    <tr>
                                        <td style="color: #94a3b8; font-family: monospace;">#<?= $a['id'] ?></td>
                                        <td>
                                            <strong style="color: #ffffff; font-size: 0.95rem;"><?= htmlspecialchars($a['title']) ?></strong>
                                            <?php if (!empty($a['excerpt'])): ?>
                                                <p style="font-size: 0.8rem; color: #94a3b8; margin-top: 4px; line-height: 1.4; max-width: 280px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">
                                                    <?= htmlspecialchars($a['excerpt']) ?>
                                                </p>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span style="background: rgba(139, 92, 246, 0.15); color: #a78bfa; padding: 3px 8px; border-radius: 4px; font-size: 0.75rem; text-transform: uppercase;">
                                                <?= htmlspecialchars($a['lang'] ?? 'en') ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span style="background: rgba(245, 158, 11, 0.15); color: #fbbf24; padding: 3px 8px; border-radius: 4px; font-size: 0.75rem;">
                                                <?= htmlspecialchars($a['category']) ?>
                                            </span>
                                        </td>
                                        <td style="color: #94a3b8; font-size: 0.8rem;">
                                            <?= date('d/m/Y', strtotime($a['created_at'])) ?>
                                        </td>
                                        <td>
                                            <a href="?action=delete&id=<?= $a['id'] ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this article?');">
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
