<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: ../admin-quotes.php"); exit; }

$dbFile = __DIR__ . '/../content.db';
$db = new PDO("sqlite:" . $dbFile);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$message = '';

if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $stmt = $db->prepare("DELETE FROM portfolio WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $message = "Project deleted.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $lang = $_POST['lang'];
    $desc = $_POST['description'];
    $image = $_POST['image_url'];
    
    $stmt = $db->prepare("INSERT INTO portfolio (title, category, lang, description, image_url) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$title, $category, $lang, $desc, $image]);
    $message = "Project added!";
}

$stmt = $db->query("SELECT * FROM portfolio ORDER BY id DESC");
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><title>Manage Portfolio - CMS</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body style="padding: 40px; background: var(--bg-dark); color: white; font-family: var(--font-primary);">
    <a href="index.php" class="btn btn-secondary" style="margin-bottom: 20px; display: inline-block;">Back to Dashboard</a>
    
    <?php if($message) echo "<div style='color: #00d2ff; margin-bottom: 20px;'>$message</div>"; ?>

    <div style="display: flex; gap: 40px; align-items: flex-start;">
        <div style="flex: 1; background: rgba(255,255,255,0.05); padding: 20px; border-radius: 8px;">
            <h3>Add New Project</h3>
            <form method="POST" style="margin-top: 15px;">
                <input type="text" name="title" placeholder="Project Title" required class="form-control" style="margin-bottom: 10px; width: 100%;">
                <input type="text" name="category" placeholder="Category (e.g. video, event)" required class="form-control" style="margin-bottom: 10px; width: 100%;">
                <select name="lang" class="form-control" style="margin-bottom: 10px; width: 100%;">
                    <option value="en">English</option>
                    <option value="fr">French</option>
                    <option value="ar">Arabic</option>
                </select>
                <input type="text" name="image_url" placeholder="Image URL (e.g. assets/images/portfolio/proj1.jpg)" class="form-control" style="margin-bottom: 10px; width: 100%;">
                <textarea name="description" placeholder="Description..." class="form-control" style="margin-bottom: 10px; width: 100%; min-height: 80px;"></textarea>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Add Project</button>
            </form>
        </div>
        
        <div style="flex: 2;">
            <h3>Existing Projects</h3>
            <table style="width: 100%; margin-top: 15px; border-collapse: collapse;">
                <tr style="background: rgba(255,255,255,0.1); text-align: left;">
                    <th style="padding: 10px;">ID</th><th style="padding: 10px;">Title</th><th style="padding: 10px;">Lang</th><th style="padding: 10px;">Category</th><th style="padding: 10px;">Action</th>
                </tr>
                <?php foreach($projects as $p): ?>
                <tr style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                    <td style="padding: 10px;"><?= $p['id'] ?></td>
                    <td style="padding: 10px;"><?= htmlspecialchars($p['title']) ?></td>
                    <td style="padding: 10px; text-transform: uppercase;"><?= $p['lang'] ?></td>
                    <td style="padding: 10px;"><?= htmlspecialchars($p['category']) ?></td>
                    <td style="padding: 10px;"><a href="?action=delete&id=<?= $p['id'] ?>" style="color: red;">Delete</a></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>
</html>
