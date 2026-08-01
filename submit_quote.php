<?php
// submit_quote.php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");

// Read raw POST data
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

// If raw input is empty, fallback to standard $_POST
if (empty($input)) {
    $input = $_POST;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Method Not Allowed"]);
    exit;
}

// Basic validation
if (empty($input['name']) || empty($input['email'])) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Name and Email are required fields."]);
    exit;
}

$project_type = filter_var($input['project_type'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
$name = filter_var($input['name'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_var($input['email'] ?? '', FILTER_VALIDATE_EMAIL);
$phone = filter_var($input['phone'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
$company = filter_var($input['company'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
$description = filter_var($input['description'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
$location = filter_var($input['location'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
$budget = filter_var($input['budget'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
$date = filter_var($input['date'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
$source = filter_var($input['source'] ?? 'form', FILTER_SANITIZE_SPECIAL_CHARS);

if (!$email) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Invalid Email address."]);
    exit;
}

// Initialize SQLite database
$dbFile = 'quotes.db';
try {
    $db = new PDO("sqlite:" . $dbFile);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create table if not exists
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
    
    // Insert quote
    $insertQuery = "INSERT INTO quotes (project_type, name, email, phone, company, description, location, budget, date, source) 
                    VALUES (:project_type, :name, :email, :phone, :company, :description, :location, :budget, :date, :source)";
    
    $stmt = $db->prepare($insertQuery);
    $stmt->execute([
        ':project_type' => $project_type,
        ':name' => $name,
        ':email' => $email,
        ':phone' => $phone,
        ':company' => $company,
        ':description' => $description,
        ':location' => $location,
        ':budget' => $budget,
        ':date' => $date,
        ':source' => $source
    ]);
    
    $lastId = $db->lastInsertId();
    $refId = "AMP-" . date("Ymd") . "-" . str_pad($lastId, 4, "0", STR_PAD_LEFT);
    
    // Simulate sending email to aelbouraqqadi@gmail.com
    $to = "aelbouraqqadi@gmail.com";
    $subject = "New Quote Request: $refId";
    $emailBody = "Reference ID: $refId\nSource: $source\nName: $name\nEmail: $email\nPhone: $phone\nCompany: $company\nProject Type: $project_type\nLocation: $location\nBudget: $budget\nDate: $date\nDescription: $description\n";
    $headers = "From: webmaster@atlas-multimedia.com\r\nReply-To: $email";
    @mail($to, $subject, $emailBody, $headers);
    
    echo json_encode([
        "status" => "success",
        "refId" => $refId,
        "message" => "Quote request registered successfully."
    ]);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
}
?>
