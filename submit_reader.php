<?php
// submit_reader.php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");

// Read raw POST data
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

if (empty($input)) {
    $input = $_POST;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Method Not Allowed"]);
    exit;
}

$type = filter_var($input['type'] ?? 'individual', FILTER_SANITIZE_SPECIAL_CHARS);

// Common fields (just for email clarity, we'll store all dynamically)
$firstName = filter_var($input['firstName'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
$lastName = filter_var($input['lastName'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
$companyName = filter_var($input['companyName'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);

// Initialize SQLite database
$dbFile = 'readers.db';
try {
    $db = new PDO("sqlite:" . $dbFile);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create table if not exists
    $tableQuery = "CREATE TABLE IF NOT EXISTS readers (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        type TEXT,
        data TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )";
    $db->exec($tableQuery);
    
    // Insert reader
    $dataJson = json_encode($input);
    $insertQuery = "INSERT INTO readers (type, data) VALUES (:type, :data)";
    
    $stmt = $db->prepare($insertQuery);
    $stmt->execute([
        ':type' => $type,
        ':data' => $dataJson
    ]);
    
    // Simulate sending email to aelbouraqqadi@gmail.com
    $to = "aelbouraqqadi@gmail.com";
    $subject = "New Blog Reader Registered";
    $emailBody = "A new reader has registered to unlock a blog article.\n\nType: $type\n\nDetails:\n";
    foreach ($input as $key => $val) {
        $emailBody .= ucfirst($key) . ": $val\n";
    }
    
    $headers = "From: webmaster@atlas-multimedia.com\r\n";
    @mail($to, $subject, $emailBody, $headers);
    
    echo json_encode([
        "status" => "success",
        "message" => "Reader registered successfully."
    ]);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
}
?>
