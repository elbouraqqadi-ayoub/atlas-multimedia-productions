<?php
// cms_helper.php
$dbFile = __DIR__ . '/content.db';
try {
    $db = new PDO("sqlite:" . $dbFile);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("CMS DB Error: " . $e->getMessage());
}

/**
 * Auto-Discovery CMS Text Function
 * If the key doesn't exist, it inserts the default text into the DB.
 */
function cms_text($page_name, $lang, $section_key, $default_content) {
    global $db;
    
    // Check if it exists
    $stmt = $db->prepare("SELECT content FROM pages WHERE page_name = ? AND lang = ? AND section_key = ?");
    $stmt->execute([$page_name, $lang, $section_key]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($row) {
        return htmlspecialchars($row['content'], ENT_QUOTES, 'UTF-8');
    } else {
        // Insert it
        $insert = $db->prepare("INSERT INTO pages (page_name, lang, section_key, content) VALUES (?, ?, ?, ?)");
        try {
            $insert->execute([$page_name, $lang, $section_key, $default_content]);
        } catch (Exception $e) {
            // Ignore unique constraint errors
        }
        return htmlspecialchars($default_content, ENT_QUOTES, 'UTF-8');
    }
}

/**
 * Fetch Portfolio Items
 */
function cms_portfolio($lang = 'en') {
    global $db;
    $stmt = $db->prepare("SELECT * FROM portfolio WHERE lang = ? ORDER BY id DESC");
    $stmt->execute([$lang]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Fetch Blog Items
 */
function cms_blog($lang = 'en') {
    global $db;
    $stmt = $db->prepare("SELECT * FROM blog WHERE lang = ? ORDER BY id DESC");
    $stmt->execute([$lang]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
