<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Directory where files will be uploaded
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($_FILES['fileToUpload']['name']);

    // Check if the directory exists, if not, create it
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Validate file size (e.g., max 2MB)
    if ($_FILES['fileToUpload']['size'] > 2 * 1024 * 1024) {
        echo "Error: File size exceeds 2MB.";
        exit;
    }

    // Allow only specific file types (e.g., images)
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($_FILES['fileToUpload']['type'], $allowedTypes)) {
        echo "Error: Only JPG, PNG, and GIF files are allowed.";
        exit;
    }

    // Attempt to move the uploaded file to the target directory
    if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploadFile)) {
        echo "File successfully uploaded: " . htmlspecialchars(basename($_FILES['fileToUpload']['name']));
    } else {
        echo "Error: File upload failed.";
    }
}
?>
