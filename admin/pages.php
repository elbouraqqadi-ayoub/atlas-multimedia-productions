<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: ../admin-quotes.php"); exit; }

$dbFile = __DIR__ . '/../content.db';
$db = new PDO("sqlite:" . $dbFile);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST['content'] as $id => $val) {
        $stmt = $db->prepare("UPDATE pages SET content = ? WHERE id = ?");
        $stmt->execute([$val, $id]);
    }
    $message = "Content updated successfully!";
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
    <meta charset="UTF-8"><title>Manage Pages - CMS</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .admin-wrapper { max-width: 1200px; margin: 100px auto; padding: 24px; }
        .page-group { background: rgba(17, 31, 53, 0.4); border: 1px solid var(--border-color); border-radius: 8px; padding: 20px; margin-bottom: 20px; }
        .form-group label { color: var(--secondary); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.5px; }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <a href="index.php" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Back to Dashboard</a>
        <h2 style="margin-top: 20px;">Manage Static Pages</h2>
        <p style="color: var(--text-muted); margin-bottom: 30px;">Edit the text blocks discovered across the website. Refresh the public website to discover new fields.</p>
        
        <?php if ($message): ?>
            <div style="background: rgba(0, 210, 255, 0.15); border: 1px solid #58a6ff; color: #58a6ff; padding: 15px; border-radius: 6px; margin-bottom: 20px;">
                <?= $message ?>
            </div>
        <?php endif; ?>

        <?php if (empty($grouped)): ?>
            <div class="page-group">
                <p>No text fields discovered yet! Visit the public website to automatically discover them.</p>
            </div>
        <?php else: ?>
            <form method="POST">
                <?php foreach ($grouped as $pageName => $fields): ?>
                    <div class="page-group">
                        <h3 style="margin-bottom: 20px; border-bottom: 1px solid var(--border-color); padding-bottom: 10px;">
                            <?= htmlspecialchars(ucfirst($pageName)) ?> Page
                        </h3>
                        <?php foreach ($fields as $f): ?>
                            <div class="form-group" style="margin-bottom: 15px;">
                                <label><?= htmlspecialchars($f['section_key']) ?> <span style="color: var(--text-muted); font-size: 0.75rem;">[<?= strtoupper($f['lang']) ?>]</span></label>
                                <textarea name="content[<?= $f['id'] ?>]" class="form-control" style="min-height: 80px;"><?= htmlspecialchars($f['content']) ?></textarea>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 15px; font-size: 1.1rem; position: sticky; bottom: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">Save All Changes</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
