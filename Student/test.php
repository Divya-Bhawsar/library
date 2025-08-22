<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadDir = '/Applications/XAMPP/xamppfiles/htdocs/library/Student/images/';
    $tmpFile = $_FILES['file']['tmp_name'];
    $newFile = $uploadDir . uniqid() . '_' . basename($_FILES['file']['name']);

    echo "Temp file: $tmpFile<br>";
    echo "Destination: $newFile<br>";
    echo "File exists: " . (file_exists($tmpFile) ? "Yes" : "No") . "<br>";
    echo "Is uploaded file: " . (is_uploaded_file($tmpFile) ? "Yes" : "No") . "<br>";

    if (move_uploaded_file($tmpFile, $newFile)) {
        echo "✅ Upload successful!";
    } else {
        echo "❌ move_uploaded_file failed.";
        print_r(error_get_last());
    }
}
?>

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="file">
    <button type="submit">Upload</button>
</form>
