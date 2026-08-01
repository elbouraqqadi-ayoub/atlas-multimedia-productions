<?php
// admin-quotes.php
session_start();

$dbFile = 'quotes.db';

// Handle authentication
$error = '';
if (isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($username === 'hicham' && $password === 'Hicham@2018') {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin-quotes.php");
        exit;
    } else {
        $error = "Identifiants invalides / Invalid credentials.";
    }
}

// Handle logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    unset($_SESSION['admin_logged_in']);
    session_destroy();
    header("Location: admin-quotes.php");
    exit;
}

// Handle delete
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header("Location: admin-quotes.php");
        exit;
    }
    
    $id = (int)$_GET['id'];
    try {
        $db = new PDO("sqlite:" . $dbFile);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $db->prepare("DELETE FROM quotes WHERE id = :id");
        $stmt->execute([':id' => $id]);
    } catch (PDOException $e) {
        // Silent error
    }
    header("Location: admin-quotes.php");
    exit;
}

// Handle CSV export
if (isset($_GET['action']) && $_GET['action'] === 'export') {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header("Location: admin-quotes.php");
        exit;
    }
    
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=quotes_export_' . date('Y-m-d') . '.csv');
    
    $output = fopen('php://output');
    fputcsv($output, ['ID', 'Type Projet / Project Type', 'Nom / Name', 'Email', 'Téléphone / Phone', 'Entreprise / Company', 'Description', 'Lieu / Location', 'Budget', 'Date', 'Source', 'Date Soumission / Submitted At']);
    
    try {
        $db = new PDO("sqlite:" . $dbFile);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $db->query("SELECT * FROM quotes ORDER BY id DESC");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            fputcsv($output, [
                $row['id'],
                $row['project_type'],
                $row['name'],
                $row['email'],
                $row['phone'],
                $row['company'],
                $row['description'],
                $row['location'],
                $row['budget'],
                $row['date'],
                $row['source'],
                $row['created_at']
            ]);
        }
    } catch (PDOException $e) {
        // Silent error
    }
    fclose($output);
    exit;
}

// Check auth status for page rendering
$isLoggedIn = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;

// Retrieve data if logged in
$quotes = [];
$stats = ['total' => 0, 'form' => 0, 'chatbot' => 0];
if ($isLoggedIn) {
    try {
        $db = new PDO("sqlite:" . $dbFile);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Auto-create table if user enters admin before any submissions are made
        $tableQuery = "CREATE TABLE IF NOT EXISTS quotes (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            project_type TEXT,
            name TEXT,
            email TEXT,
            phone TEXT,
            company TEXT,
            description TEXT,
            location TEXT,
            budget TEXT,
            date TEXT,
            source TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )";
        $db->exec($tableQuery);
        
        $stmt = $db->query("SELECT * FROM quotes ORDER BY id DESC");
        $quotes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $stats['total'] = count($quotes);
        foreach ($quotes as $q) {
            if ($q['source'] === 'chatbot') {
                $stats['chatbot']++;
            } else {
                $stats['form']++;
            }
        }
        
    } catch (PDOException $e) {
        $error = "Erreur de base de données / Database error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration des Devis - Atlas Multimedia Productions</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .admin-wrapper {
            max-width: 1200px;
            margin: 100px auto 40px auto;
            padding: 0 24px;
        }
        .login-card {
            max-width: 420px;
            margin: 120px auto;
            padding: 40px;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }
        .stat-card {
            background: rgba(17, 31, 53, 0.4);
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            padding: 24px;
            text-align: center;
        }
        .stat-card h3 {
            font-size: 2.2rem;
            color: var(--secondary);
            margin-bottom: 8px;
        }
        .stat-card p {
            color: var(--text-muted);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            background: rgba(10, 20, 36, 0.6);
            margin-bottom: 40px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }
        th, td {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border-color);
            font-size: 0.9rem;
        }
        th {
            background: rgba(17, 31, 53, 0.8);
            color: #fff;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }
        tr:hover {
            background: rgba(255, 255, 255, 0.02);
        }
        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        .badge-form {
            background: rgba(37, 99, 235, 0.15);
            color: var(--secondary);
        }
        .badge-chat {
            background: rgba(0, 210, 255, 0.15);
            color: #58a6ff;
        }
        .btn-sm {
            padding: 6px 12px;
            font-size: 0.8rem;
            border-radius: 4px;
        }
        .btn-danger {
            background: rgba(255, 70, 70, 0.15);
            color: rgb(255, 100, 100);
            border: 1px solid rgba(255, 70, 70, 0.3);
        }
        .btn-danger:hover {
            background: rgb(255, 70, 70);
            color: #fff;
            transform: translateY(-1px);
        }
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 16px;
        }
    </style>
</head>
<body>

    <!-- Header Navigation -->
    <header>
        <div class="container nav-container">
            <div class="logo-wrapper">
                <img src="assets/logos/Logo (AMP).png" alt="AMP Logo" class="logo-img" onerror="this.style.display='none';">
                <div class="logo-text">ATLAS<span>MULTIMEDIA</span></div>
            </div>
            <?php if ($isLoggedIn): ?>
                <nav>
                    <ul>
                        <li><a href="admin-quotes.php?action=logout" class="btn btn-secondary" style="padding: 8px 16px; font-size: 0.85rem;"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </header>

    <?php if (!$isLoggedIn): ?>
        <!-- LOGIN SCREEN -->
        <div class="container">
            <div class="glass-card login-card">
                <div class="text-center" style="margin-bottom: 30px;">
                    <div style="font-size: 3rem; color: var(--primary); margin-bottom: 12px;"><i class="fa-solid fa-lock"></i></div>
                    <h3>AMP Admin Login</h3>
                    <p style="color: var(--text-muted); font-size: 0.85rem; margin-top: 8px;">Access quotes submissions database</p>
                </div>
                
                <?php if ($error): ?>
                    <div style="background: rgba(255,70,70,0.1); border: 1px solid rgba(255,70,70,0.3); padding: 12px; border-radius: 6px; margin-bottom: 20px; font-size: 0.85rem; color: rgb(255,100,100); text-align: center;">
                        <?= $error ?>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="admin-quotes.php">
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label for="username">Username / Identifiant</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="hicham" required autocomplete="username">
                    </div>
                    <div class="form-group" style="margin-bottom: 30px;">
                        <label for="password">Password / Mot de passe</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required autocomplete="current-password">
                    </div>
                    <button type="submit" name="login" class="btn btn-primary" style="width: 100%;">Log In</button>
                </form>
            </div>
        </div>
    <?php else: ?>
        <!-- DASHBOARD -->
        <div class="admin-wrapper">
            <div class="dashboard-header">
                <div>
                    <span class="section-subtitle">Admin Dashboard</span>
                    <h2>Quote Submissions Repository</h2>
                </div>
                <div style="display: flex; gap: 12px;">
                    <a href="admin-quotes.php?action=export" class="btn btn-primary"><i class="fa-solid fa-file-csv"></i> Download CSV</a>
                </div>
            </div>

            <!-- Stats grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <h3><?= $stats['total'] ?></h3>
                    <p>Total Quotes</p>
                </div>
                <div class="stat-card">
                    <h3><?= $stats['form'] ?></h3>
                    <p>Form Submissions</p>
                </div>
                <div class="stat-card">
                    <h3><?= $stats['chatbot'] ?></h3>
                    <p>Chatbot Submissions</p>
                </div>
            </div>

            <!-- Table -->
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($quotes)): ?>
                            <tr>
                                <td colspan="7" class="text-center" style="color: var(--text-muted); padding: 40px 0;">
                                    Aucune demande pour le moment. / No submissions found.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($quotes as $q): ?>
                                <?php 
                                $refId = "AMP-" . date("Ymd", strtotime($q['created_at'])) . "-" . str_pad($q['id'], 4, "0", STR_PAD_LEFT);
                                ?>
                                <tr>
                                    <td style="font-weight: 700; color: #fff;"><?= $refId ?></td>
                                    <td style="white-space: nowrap;"><?= date("d/m/Y H:i", strtotime($q['created_at'])) ?></td>
                                    <td>
                                        <strong><?= htmlspecialchars($q['name']) ?></strong><br>
                                        <span style="font-size: 0.8rem; color: var(--text-muted);"><?= htmlspecialchars($q['email']) ?></span><br>
                                        <?php if ($q['phone']): ?>
                                            <span style="font-size: 0.8rem; color: var(--text-muted);"><?= htmlspecialchars($q['phone']) ?></span>
                                        <?php endif; ?>
                                        <?php if ($q['company']): ?>
                                            <br><span style="font-size: 0.8rem; color: var(--secondary); font-style: italic;"><?= htmlspecialchars($q['company']) ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span style="display: inline-block; background: rgba(255,255,255,0.05); padding: 2px 6px; border-radius: 4px; font-size: 0.75rem; font-weight: 600; margin-bottom: 6px; color: #fff;"><?= htmlspecialchars($q['project_type']) ?></span><br>
                                        <p style="font-size: 0.85rem; max-width: 320px; word-break: break-word; color: var(--text-muted);"><?= htmlspecialchars($q['description']) ?></p>
                                    </td>
                                    <td>
                                        <span style="font-weight: 600; color: var(--secondary);"><?= htmlspecialchars($q['budget']) ?></span><br>
                                        <span style="font-size: 0.8rem; color: var(--text-muted);"><i class="fa-solid fa-map-pin"></i> <?= htmlspecialchars($q['location']) ?></span>
                                        <?php if ($q['date']): ?>
                                            <br><span style="font-size: 0.8rem; color: var(--text-muted);"><i class="fa-regular fa-calendar"></i> <?= htmlspecialchars($q['date']) ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge badge-<?= $q['source'] === 'chatbot' ? 'chat' : 'form' ?>">
                                            <?= $q['source'] ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="admin-quotes.php?action=delete&id=<?= $q['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression de cette demande / Are you sure you want to delete this?');"><i class="fa-solid fa-trash"></i></a>
                                    </td>
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
