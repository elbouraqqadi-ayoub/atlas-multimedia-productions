<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: ../admin-quotes.php"); exit; }

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
    <title>Manage Pages - CMS</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .admin-wrapper { max-width: 1200px; margin: 100px auto; padding: 24px; }
        .page-group { background: rgba(17, 31, 53, 0.4); border: 1px solid var(--border-color); border-radius: 8px; padding: 20px; margin-bottom: 20px; }
        .form-group label { color: var(--secondary); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.5px; }
        .add-box { background: rgba(0, 245, 155, 0.05); border: 1px dashed var(--primary); padding: 20px; border-radius: 8px; margin-bottom: 30px; }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <a href="index.php" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Back to Dashboard</a>
            <a href="../index.php" target="_blank" class="btn btn-secondary"><i class="fa-solid fa-globe"></i> View Public Site</a>
        </div>
        <h2>Manage Website Page Text</h2>
        <p style="color: var(--text-muted); margin-bottom: 30px;">Edit titles, descriptions, and text content across Home, About, Services, and Contact pages in all languages.</p>
        
        <?php if ($message): ?>
            <div style="background: rgba(0, 245, 155, 0.15); border: 1px solid var(--primary); color: var(--primary); padding: 15px; border-radius: 6px; margin-bottom: 20px;">
                <i class="fa-solid fa-check-circle"></i> <?= $message ?>
            </div>
        <?php endif; ?>

        <!-- Add Custom Field Form -->
        <div class="add-box">
            <h4 style="margin-bottom: 12px; color: var(--primary);"><i class="fa-solid fa-plus"></i> Add New Custom Text Block</h4>
            <form method="POST" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px; align-items: end;">
                <input type="hidden" name="add_new_field" value="1">
                <div>
                    <label style="font-size: 0.8rem; color: var(--text-muted);">Page Name:</label>
                    <select name="new_page_name" class="form-control" style="padding: 8px;">
                        <option value="home">Home</option>
                        <option value="about">About</option>
                        <option value="services">Services</option>
                        <option value="contact">Contact</option>
                    </select>
                </div>
                <div>
                    <label style="font-size: 0.8rem; color: var(--text-muted);">Language:</label>
                    <select name="new_lang" class="form-control" style="padding: 8px;">
                        <option value="en">English (EN)</option>
                        <option value="fr">Français (FR)</option>
                        <option value="ar">العربية (AR)</option>
                    </select>
                </div>
                <div>
                    <label style="font-size: 0.8rem; color: var(--text-muted);">Field Name Key:</label>
                    <input type="text" name="new_section_key" placeholder="e.g. hero_heading" class="form-control" style="padding: 8px;" required>
                </div>
                <div>
                    <label style="font-size: 0.8rem; color: var(--text-muted);">Text Content:</label>
                    <input type="text" name="new_content" placeholder="Content text" class="form-control" style="padding: 8px;" required>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" style="padding: 8px 16px; width: 100%;"><i class="fa-solid fa-plus"></i> Add Field</button>
                </div>
            </form>
        </div>

        <?php if (empty($grouped)): ?>
            <div class="page-group">
                <p>No text fields found. Use the form above to add text fields!</p>
            </div>
        <?php else: ?>
            <form method="POST">
                <?php foreach ($grouped as $pageName => $fields): ?>
                    <div class="page-group">
                        <h3 style="margin-bottom: 20px; border-bottom: 1px solid var(--border-color); padding-bottom: 10px; text-transform: uppercase;">
                            <?= htmlspecialchars($pageName) ?> Page
                        </h3>
                        <?php foreach ($fields as $f): ?>
                            <div class="form-group" style="margin-bottom: 15px;">
                                <label><?= htmlspecialchars($f['section_key']) ?> <span style="color: var(--text-muted); font-size: 0.75rem;">[<?= strtoupper($f['lang']) ?>]</span></label>
                                <textarea name="content[<?= $f['id'] ?>]" class="form-control" style="min-height: 80px; width: 100%;"><?= htmlspecialchars($f['content']) ?></textarea>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 15px; font-size: 1.1rem; sticky; bottom: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.5);"><i class="fa-solid fa-floppy-disk"></i> Save All Changes</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
