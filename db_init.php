<?php
$dbFile = __DIR__ . '/content.db';
try {
    $db = new PDO("sqlite:" . $dbFile);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create Pages table for static text
    $db->exec("CREATE TABLE IF NOT EXISTS pages (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        page_name TEXT,
        lang TEXT,
        section_key TEXT,
        content TEXT,
        UNIQUE(page_name, lang, section_key)
    )");
    
    // Create Portfolio table
    $db->exec("CREATE TABLE IF NOT EXISTS portfolio (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT,
        description TEXT,
        category TEXT,
        image_url TEXT,
        video_url TEXT,
        lang TEXT DEFAULT 'en'
    )");
    
    // Create Blog table
    $db->exec("CREATE TABLE IF NOT EXISTS blog (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT,
        excerpt TEXT,
        content TEXT,
        image_url TEXT,
        category TEXT,
        lang TEXT DEFAULT 'en',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
    
    echo "Database initialized successfully.";
} catch (PDOException $e) {
    echo "DB Error: " . $e->getMessage();
}
?>
