<?php
// cms_helper.php
$dbFile = __DIR__ . '/content.db';
$db = null;

try {
    if (extension_loaded('pdo_sqlite')) {
        $db = new PDO("sqlite:" . $dbFile);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
} catch (Exception $e) {
    $db = null;
}

/**
 * Auto-Discovery CMS Text Function
 * If DB is unavailable or key doesn't exist, returns default_content.
 */
function cms_text($page_name, $lang, $section_key, $default_content) {
    global $db;
    
    if (!$db) {
        return htmlspecialchars($default_content, ENT_QUOTES, 'UTF-8');
    }
    
    try {
        // Check if it exists
        $stmt = $db->prepare("SELECT content FROM pages WHERE page_name = ? AND lang = ? AND section_key = ?");
        $stmt->execute([$page_name, $lang, $section_key]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return htmlspecialchars($row['content'], ENT_QUOTES, 'UTF-8');
        } else {
            // Insert it
            $insert = $db->prepare("INSERT INTO pages (page_name, lang, section_key, content) VALUES (?, ?, ?, ?)");
            $insert->execute([$page_name, $lang, $section_key, $default_content]);
            return htmlspecialchars($default_content, ENT_QUOTES, 'UTF-8');
        }
    } catch (Exception $e) {
        return htmlspecialchars($default_content, ENT_QUOTES, 'UTF-8');
    }
}

/**
 * Fetch Portfolio Items
 */
function cms_portfolio($lang = 'en') {
    global $db;
    if (!$db) return [];
    try {
        $stmt = $db->prepare("SELECT * FROM portfolio WHERE lang = ? ORDER BY id DESC");
        $stmt->execute([$lang]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        return [];
    }
}

/**
 * Fetch Blog Items
 */
function cms_blog($lang = 'en') {
    global $db;
    if (!$db) return [];
    try {
        $stmt = $db->prepare("SELECT * FROM blog WHERE lang = ? ORDER BY id DESC");
        $stmt->execute([$lang]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        return [];
    }
}
?>
