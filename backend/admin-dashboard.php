<?php
session_start();

// Handle login
$password_hash = password_hash('barakat-admin', PASSWORD_DEFAULT); // Admin password: barakat-admin

if (isset($_POST['login'])) {
    $password = $_POST['password'] ?? '';
    if (password_verify($password, $password_hash)) {
        $_SESSION['admin_logged_in'] = true;
    } else {
        $error = "Invalid password. Please try again.";
    }
}

// Handle logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header("Location: admin-dashboard.php");
    exit;
}

$loggedIn = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;

// Initialize databases & statistics
$quotes = [];
$readers = [];
$portfolioCount = 0;
$blogCount = 0;

if ($loggedIn) {
    try {
        if (file_exists(__DIR__ . '/quotes.db')) {
            $dbQuotes = new PDO("sqlite:" . __DIR__ . '/quotes.db');
            $dbQuotes->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbQuotes->query("SELECT * FROM quotes ORDER BY id DESC");
            $quotes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        if (file_exists(__DIR__ . '/readers.db')) {
            $dbReaders = new PDO("sqlite:" . __DIR__ . '/readers.db');
            $dbReaders->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbReaders->query("SELECT * FROM readers ORDER BY id DESC");
            $readers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        if (file_exists(__DIR__ . '/content.db')) {
            $dbContent = new PDO("sqlite:" . __DIR__ . '/content.db');
            $dbContent->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $portfolioCount = $dbContent->query("SELECT COUNT(*) FROM portfolio")->fetchColumn() ?: 0;
            $blogCount = $dbContent->query("SELECT COUNT(*) FROM blog")->fetchColumn() ?: 0;
        }
    } catch (Exception $e) {
        $error = "Database Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Admin Dashboard - Atlas Multimedia Productions</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/assets/logos/Logo (AMP).png">
    <!-- Main Theme CSS -->
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="../style.css">
    <!-- FontAwesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --admin-card-bg: rgba(15, 23, 42, 0.75);
            --admin-card-border: rgba(255, 255, 255, 0.1);
        }
        
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

        .nav-link-btn.btn-logout:hover {
            background: rgba(239, 68, 68, 0.25);
            color: #ffffff;
            border-color: #ef4444;
        }

        .admin-wrapper {
            max-width: 1400px;
            margin: 110px auto 60px auto;
            padding: 0 24px;
        }

        /* Metrics / Stats Cards Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: var(--admin-card-bg);
            border: 1px solid var(--admin-card-border);
            border-radius: 16px;
            padding: 24px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            border-color: var(--primary, #10b981);
            box-shadow: 0 15px 35px rgba(16, 185, 129, 0.15);
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .stat-icon.quotes { background: rgba(16, 185, 129, 0.15); color: #10b981; }
        .stat-icon.readers { background: rgba(139, 92, 246, 0.15); color: #a78bfa; }
        .stat-icon.portfolio { background: rgba(59, 130, 246, 0.15); color: #60a5fa; }
        .stat-icon.blog { background: rgba(245, 158, 11, 0.15); color: #fbbf24; }

        .stat-info h4 {
            font-size: 0.85rem;
            color: var(--text-muted, #94a3b8);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .stat-number {
            font-size: 1.8rem;
            font-weight: 800;
            color: #ffffff;
            font-family: 'Outfit', sans-serif;
        }

        /* Login Card */
        .login-card {
            max-width: 440px;
            margin: 140px auto;
            background: rgba(15, 23, 42, 0.85);
            border: 1px solid var(--border-color, rgba(255, 255, 255, 0.1));
            border-radius: 20px;
            padding: 40px;
            backdrop-filter: blur(20px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header img {
            height: 60px;
            margin-bottom: 16px;
        }

        .login-header h2 {
            font-size: 1.75rem;
            color: #ffffff;
        }

        .form-control {
            width: 100%;
            padding: 14px 18px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 12px;
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

        .btn-primary-action {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #10b981, #059669);
            color: #020617;
            font-weight: 700;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-primary-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.4);
            filter: brightness(1.1);
        }

        /* Section Cards & Tables */
        .section-box {
            background: var(--admin-card-bg);
            border: 1px solid var(--admin-card-border);
            border-radius: 20px;
            padding: 28px;
            margin-bottom: 40px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        }

        .section-header-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .section-title {
            font-size: 1.35rem;
            color: #ffffff;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .section-title i {
            color: var(--primary, #10b981);
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

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: rgba(255, 255, 255, 0.03);
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-company { background: rgba(139, 92, 246, 0.2); color: #c084fc; border: 1px solid rgba(139, 92, 246, 0.3); }
        .badge-individual { background: rgba(16, 185, 129, 0.2); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.3); }
        .badge-source { background: rgba(255, 255, 255, 0.08); color: #cbd5e1; border: 1px solid rgba(255, 255, 255, 0.15); }
    </style>
</head>
<body>

    <!-- Admin Header Navbar -->
    <header class="admin-header">
        <div class="admin-nav">
            <a href="/index.html" class="brand-link" title="View Public Website">
                <img src="/assets/logos/Logo (AMP).png" alt="Atlas Multimedia" class="brand-logo-img" onerror="this.onerror=null; this.src='../assets/logos/Logo (AMP).png';">
                <div class="brand-title">
                    ATLAS<span>MULTIMEDIA</span>
                    <span class="brand-badge">ADMIN</span>
                </div>
            </a>
            <nav>
                <ul class="nav-links">
                    <li><a href="/index.html" class="nav-link-btn" target="_blank"><i class="fa-solid fa-globe"></i> View Site</a></li>
                    <?php if ($loggedIn): ?>
                        <li><a href="admin-dashboard.php" class="nav-link-btn active"><i class="fa-solid fa-gauge-high"></i> Master Dashboard</a></li>
                        <li><a href="admin/index.php" class="nav-link-btn"><i class="fa-solid fa-sliders"></i> CMS Content</a></li>
                        <li><a href="?action=logout" class="nav-link-btn btn-logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <?php if (!$loggedIn): ?>
        <!-- Login Form -->
        <div class="login-card">
            <div class="login-header">
                <img src="/assets/logos/Logo (AMP).png" alt="Atlas Multimedia" onerror="this.onerror=null; this.src='../assets/logos/Logo (AMP).png';">
                <h2>Admin Login</h2>
                <p style="color: var(--text-muted, #94a3b8); font-size: 0.9rem; margin-top: 6px;">Atlas Multimedia Productions Management Portal</p>
            </div>

            <?php if (isset($error)): ?>
                <div style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3); color: #f87171; padding: 12px 16px; border-radius: 10px; text-align: center; margin-bottom: 20px; font-size: 0.9rem;">
                    <i class="fa-solid fa-triangle-exclamation"></i> <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div style="margin-bottom: 24px;">
                    <label style="display: block; margin-bottom: 8px; font-size: 0.85rem; font-weight: 500; color: #cbd5e1;">Enter Admin Password</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required autofocus>
                </div>
                <button type="submit" name="login" class="btn-primary-action">
                    <i class="fa-solid fa-lock-open"></i> Log In to Dashboard
                </button>
            </form>
        </div>

    <?php else: ?>
        <!-- Authenticated Master Dashboard -->
        <div class="admin-wrapper">
            <div style="margin-bottom: 30px;">
                <h1 style="font-size: 2.2rem; color: #ffffff; font-family: 'Outfit', sans-serif;">Master Control Dashboard</h1>
                <p style="color: var(--text-muted, #94a3b8); font-size: 1rem;">Manage quotes, client inquiries, blog reader registrations, and CMS static content.</p>
            </div>

            <!-- Stats Overview Bar -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon quotes"><i class="fa-solid fa-file-invoice-dollar"></i></div>
                    <div class="stat-info">
                        <h4>Quotes Requested</h4>
                        <div class="stat-number"><?= count($quotes) ?></div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon readers"><i class="fa-solid fa-users"></i></div>
                    <div class="stat-info">
                        <h4>Registered Readers</h4>
                        <div class="stat-number"><?= count($readers) ?></div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon portfolio"><i class="fa-solid fa-photo-film"></i></div>
                    <div class="stat-info">
                        <h4>Portfolio Projects</h4>
                        <div class="stat-number"><?= $portfolioCount ?></div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon blog"><i class="fa-solid fa-newspaper"></i></div>
                    <div class="stat-info">
                        <h4>Blog Articles</h4>
                        <div class="stat-number"><?= $blogCount ?></div>
                    </div>
                </div>
            </div>

            <!-- Section 1: Quotes Info -->
            <div class="section-box">
                <div class="section-header-flex">
                    <div>
                        <h2 class="section-title"><i class="fa-solid fa-envelope-open-text"></i> Submitted Quote Requests</h2>
                        <p style="color: var(--text-muted, #94a3b8); font-size: 0.9rem; margin-top: 4px;">Inquiries received from the multi-step quote form and AI Chatbot.</p>
                    </div>
                    <div>
                        <a href="admin/index.php" class="nav-link-btn active"><i class="fa-solid fa-sliders"></i> Go to CMS Portal</a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Ref ID</th>
                                <th>Date & Time</th>
                                <th>Client Info</th>
                                <th>Project & Requirement</th>
                                <th>Budget & Location</th>
                                <th>Source</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($quotes)): ?>
                                <tr>
                                    <td colspan="6" style="text-align: center; color: var(--text-muted, #94a3b8); padding: 50px 0;">
                                        <i class="fa-solid fa-inbox" style="font-size: 2.5rem; margin-bottom: 12px; display: block; opacity: 0.5;"></i>
                                        No quote requests submitted yet.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($quotes as $q): ?>
                                    <tr>
                                        <td>
                                            <strong style="color: var(--primary, #10b981); font-family: monospace;">#<?= htmlspecialchars($q['id']) ?></strong>
                                        </td>
                                        <td style="color: var(--text-muted, #94a3b8); font-size: 0.85rem;">
                                            <i class="fa-regular fa-clock" style="margin-right: 4px;"></i>
                                            <?= date("d/m/Y H:i", strtotime($q['created_at'])) ?>
                                        </td>
                                        <td>
                                            <strong style="color: #ffffff; font-size: 0.95rem;"><?= htmlspecialchars($q['name']) ?></strong><br>
                                            <a href="mailto:<?= htmlspecialchars($q['email']) ?>" style="color: var(--primary, #10b981); text-decoration: none; font-size: 0.85rem;">
                                                <i class="fa-regular fa-envelope"></i> <?= htmlspecialchars($q['email']) ?>
                                            </a>
                                            <?php if (!empty($q['phone'])): ?>
                                                <br><span style="font-size: 0.8rem; color: var(--text-muted);"><i class="fa-solid fa-phone"></i> <?= htmlspecialchars($q['phone']) ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="badge badge-individual" style="margin-bottom: 6px;">
                                                <i class="fa-solid fa-clapperboard"></i> <?= htmlspecialchars($q['project_type']) ?>
                                            </span>
                                            <p style="font-size: 0.85rem; color: #cbd5e1; margin-top: 4px; line-height: 1.4; max-width: 320px;">
                                                <?= htmlspecialchars($q['description']) ?>
                                            </p>
                                        </td>
                                        <td>
                                            <span style="color: #a78bfa; font-weight: 700; font-size: 0.95rem;">
                                                <?= htmlspecialchars($q['budget']) ?>
                                            </span><br>
                                            <span style="font-size: 0.8rem; color: var(--text-muted);">
                                                <i class="fa-solid fa-location-dot"></i> <?= htmlspecialchars($q['location']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-source"><?= htmlspecialchars($q['source'] ?? 'FORM') ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Section 2: Blog Access Readers -->
            <div class="section-box">
                <div class="section-header-flex">
                    <div>
                        <h2 class="section-title"><i class="fa-solid fa-user-lock"></i> Blog Unlock Readers</h2>
                        <p style="color: var(--text-muted, #94a3b8); font-size: 0.9rem; margin-top: 4px;">Registered readers who submitted their information to read blog articles.</p>
                    </div>
                </div>

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Registration Date</th>
                                <th>Account Type</th>
                                <th>Name & Email</th>
                                <th>Detailed Profile Info</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($readers)): ?>
                                <tr>
                                    <td colspan="5" style="text-align: center; color: var(--text-muted, #94a3b8); padding: 50px 0;">
                                        <i class="fa-solid fa-users-slash" style="font-size: 2.5rem; margin-bottom: 12px; display: block; opacity: 0.5;"></i>
                                        No blog readers registered yet.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($readers as $r): 
                                    $data = json_decode($r['data'], true) ?? [];
                                    $isCompany = ($r['type'] ?? '') === 'company';
                                ?>
                                    <tr>
                                        <td style="color: var(--text-muted, #94a3b8); font-family: monospace;">#<?= $r['id'] ?></td>
                                        <td style="color: var(--text-muted, #94a3b8); font-size: 0.85rem;">
                                            <i class="fa-regular fa-clock" style="margin-right: 4px;"></i>
                                            <?= date("d/m/Y H:i", strtotime($r['created_at'])) ?>
                                        </td>
                                        <td>
                                            <span class="badge badge-<?= $isCompany ? 'company' : 'individual' ?>">
                                                <i class="fa-solid <?= $isCompany ? 'fa-building' : 'fa-user' ?>"></i>
                                                <?= $isCompany ? 'Company' : 'Individual' ?>
                                            </span>
                                        </td>
                                        <td>
                                            <strong style="color: #ffffff; font-size: 0.95rem;">
                                                <?= htmlspecialchars(($data['firstName'] ?? '') . ' ' . ($data['lastName'] ?? 'User')) ?>
                                            </strong><br>
                                            <a href="mailto:<?= htmlspecialchars($data['email'] ?? '') ?>" style="color: var(--primary, #10b981); text-decoration: none; font-size: 0.85rem;">
                                                <?= htmlspecialchars($data['email'] ?? 'N/A') ?>
                                            </a>
                                        </td>
                                        <td>
                                            <?php if ($isCompany): ?>
                                                <span style="color: #c084fc; font-weight: 600;">Company: <?= htmlspecialchars($data['companyName'] ?? 'N/A') ?></span><br>
                                                <span style="font-size: 0.8rem; color: var(--text-muted);">
                                                    Website: <?= htmlspecialchars($data['website'] ?? 'N/A') ?> | Activity: <?= htmlspecialchars($data['activity'] ?? 'N/A') ?>
                                                </span>
                                            <?php else: ?>
                                                <span style="color: #34d399; font-weight: 600;">Profession: <?= htmlspecialchars($data['profession'] ?? 'N/A') ?></span><br>
                                                <span style="font-size: 0.8rem; color: var(--text-muted);">
                                                    Age: <?= htmlspecialchars($data['age'] ?? 'N/A') ?> | Education: <?= htmlspecialchars($data['education'] ?? 'N/A') ?> | Loc: <?= htmlspecialchars($data['location'] ?? 'N/A') ?>
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>

</body>
</html>
