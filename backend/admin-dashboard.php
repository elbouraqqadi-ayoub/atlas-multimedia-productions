<?php
session_start();

// Handle login
$password_hash = password_hash('admin123', PASSWORD_DEFAULT); // Default password: admin123

if (isset($_POST['login'])) {
    $password = $_POST['password'] ?? '';
    if (password_verify($password, $password_hash)) {
        $_SESSION['admin_logged_in'] = true;
    } else {
        $error = "Invalid password.";
    }
}

// Handle logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header("Location: admin-dashboard.php");
    exit;
}

$loggedIn = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;

// Initialize databases
$quotes = [];
$readers = [];

if ($loggedIn) {
    try {
        if (file_exists('quotes.db')) {
            $dbQuotes = new PDO("sqlite:quotes.db");
            $dbQuotes->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbQuotes->query("SELECT * FROM quotes ORDER BY created_at DESC");
            $quotes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        if (file_exists('readers.db')) {
            $dbReaders = new PDO("sqlite:readers.db");
            $dbReaders->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbReaders->query("SELECT * FROM readers ORDER BY created_at DESC");
            $readers = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Admin Dashboard - Atlas Multimedia</title>
    <link rel="stylesheet" href="../frontend/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .admin-wrapper { max-width: 1400px; margin: 100px auto 40px auto; padding: 0 24px; }
        .login-card { max-width: 420px; margin: 120px auto; padding: 40px; }
        
        .section-header {
            margin-top: 60px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--border-color);
        }
        
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(12px);
            margin-bottom: 40px;
        }
        
        table { width: 100%; border-collapse: collapse; text-align: left; }
        th, td { padding: 16px 20px; border-bottom: 1px solid var(--border-color); font-size: 0.9rem; }
        th { background: rgba(17, 31, 53, 0.8); color: #fff; font-weight: 600; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; }
        tr:hover { background: rgba(255, 255, 255, 0.05); }
        
        .badge { display: inline-block; padding: 4px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; }
        .badge-company { background: rgba(139, 92, 246, 0.2); color: var(--secondary); }
        .badge-individual { background: rgba(16, 185, 129, 0.2); color: var(--primary); }
    </style>
</head>
<body>
    <header>
        <div class="container nav-container">
            <a href="../frontend/index.html" class="logo-wrapper">
                <img src="assets/logos/Logo (AMP).png" alt="Atlas Multimedia Productions" class="logo-img">
                <div class="logo-text">ATLAS<span>MULTIMEDIA</span></div>
            </a>
            <nav>
                <ul>
                    <?php if ($loggedIn): ?>
                        <li><a href="admin/index.php">CMS Dashboard</a></li>
                        <li><a href="?action=logout" class="btn" style="background: rgba(255,255,255,0.1);">Logout</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <?php if (!$loggedIn): ?>
        <div class="login-card glass-card">
            <h2 style="margin-bottom: 20px; text-align: center; color: white;">Admin Login</h2>
            <?php if (isset($error)) echo "<p style='color: #ff6b6b; text-align: center; margin-bottom: 15px;'>$error</p>"; ?>
            <form method="POST">
                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px;">Password</label>
                    <input type="password" name="password" style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid var(--border-color); color: #fff; border-radius: 8px;" required>
                </div>
                <button type="submit" name="login" class="btn" style="width: 100%; background: var(--primary); color: #020617;">Log In</button>
            </form>
        </div>
    <?php else: ?>
        <div class="admin-wrapper">
            <h1 style="color: var(--primary);">Master Dashboard</h1>
            
            <!-- Blog Access Section -->
            <div class="section-header">
                <h2><i class="fa-solid fa-book-open"></i> Blog Access (Readers)</h2>
                <p style="color: var(--text-muted);">Users who filled out the form to unlock blog articles.</p>
            </div>
            
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Contact Info</th>
                            <th>Details (Age/Profession/Company)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($readers)): ?>
                            <tr><td colspan="5" style="text-align: center; color: var(--text-muted); padding: 40px 0;">No readers registered yet.</td></tr>
                        <?php else: ?>
                            <?php foreach ($readers as $r): 
                                $data = json_decode($r['data'], true);
                                $isCompany = $r['type'] === 'company';
                            ?>
                                <tr>
                                    <td style="color: var(--text-muted);">#<?= $r['id'] ?></td>
                                    <td><?= date("d/m/Y H:i", strtotime($r['created_at'])) ?></td>
                                    <td><span class="badge badge-<?= $isCompany ? 'company' : 'individual' ?>"><?= $isCompany ? 'Company' : 'Individual' ?></span></td>
                                    <td>
                                        <strong><?= htmlspecialchars(($data['firstName'] ?? '') . ' ' . ($data['lastName'] ?? '')) ?></strong><br>
                                        <span style="font-size: 0.8rem; color: var(--text-muted);"><?= htmlspecialchars($data['email'] ?? '') ?></span>
                                    </td>
                                    <td>
                                        <?php if ($isCompany): ?>
                                            <span style="color: var(--secondary);">Company: <?= htmlspecialchars($data['companyName'] ?? 'N/A') ?></span><br>
                                            <span style="font-size: 0.8rem; color: var(--text-muted);">Website: <?= htmlspecialchars($data['website'] ?? 'N/A') ?></span><br>
                                            <span style="font-size: 0.8rem; color: var(--text-muted);">Activity: <?= htmlspecialchars($data['activity'] ?? 'N/A') ?> | Loc: <?= htmlspecialchars($data['locationCompany'] ?? 'N/A') ?></span>
                                        <?php else: ?>
                                            <span style="color: var(--primary);">Profession: <?= htmlspecialchars($data['profession'] ?? 'N/A') ?></span><br>
                                            <span style="font-size: 0.8rem; color: var(--text-muted);">Age: <?= htmlspecialchars($data['age'] ?? 'N/A') ?> | Education: <?= htmlspecialchars($data['education'] ?? 'N/A') ?></span><br>
                                            <span style="font-size: 0.8rem; color: var(--text-muted);">Interests: <?= htmlspecialchars($data['interests'] ?? 'N/A') ?> | Loc: <?= htmlspecialchars($data['location'] ?? 'N/A') ?></span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Quotes Info Section -->
            <div class="section-header">
                <h2><i class="fa-solid fa-envelope"></i> Quotes Info</h2>
                <p style="color: var(--text-muted);">Inquiries submitted via the Contact form or Chatbot.</p>
            </div>
            
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Ref</th>
                            <th>Date</th>
                            <th>Contact</th>
                            <th>Project Details</th>
                            <th>Budget / Loc</th>
                            <th>Source</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($quotes)): ?>
                            <tr><td colspan="6" style="text-align: center; color: var(--text-muted); padding: 40px 0;">No quotes submitted yet.</td></tr>
                        <?php else: ?>
                            <?php foreach ($quotes as $q): ?>
                                <tr>
                                    <td style="color: var(--text-muted);">#<?= $q['id'] ?></td>
                                    <td><?= date("d/m/Y H:i", strtotime($q['created_at'])) ?></td>
                                    <td>
                                        <strong><?= htmlspecialchars($q['name']) ?></strong><br>
                                        <span style="font-size: 0.8rem; color: var(--text-muted);"><?= htmlspecialchars($q['email']) ?></span><br>
                                        <span style="font-size: 0.8rem; color: var(--text-muted);"><?= htmlspecialchars($q['phone']) ?></span>
                                    </td>
                                    <td>
                                        <span class="badge badge-individual" style="margin-bottom: 4px;"><?= htmlspecialchars($q['project_type']) ?></span><br>
                                        <p style="font-size: 0.85rem; color: var(--text-muted);"><?= htmlspecialchars($q['description']) ?></p>
                                    </td>
                                    <td>
                                        <span style="color: var(--secondary); font-weight: bold;"><?= htmlspecialchars($q['budget']) ?></span><br>
                                        <span style="font-size: 0.8rem; color: var(--text-muted);"><?= htmlspecialchars($q['location']) ?></span>
                                    </td>
                                    <td><span class="badge" style="background: rgba(255,255,255,0.1);"><?= htmlspecialchars($q['source']) ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</body>
</html>
