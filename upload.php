<?php
// Check if a file was uploaded
if (isset($_FILES['fileToUpload'])) {
    $file = $_FILES['fileToUpload'];
    
    // Check if there was an error during upload
    if ($file['error'] === UPLOAD_ERR_OK) {
        $uploadDirectory = 'uploads/'; // Make sure this directory exists and is writable
        $uploadFile = $uploadDirectory . basename($file['name']);

        // Check if file already exists
        if (file_exists($uploadFile)) {
            echo "Sorry, file already exists.";
        } else {
            // Check file extension
            $fileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
            if (in_array($fileType, $allowedTypes)) {
                // Move the file to the upload directory
                if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
                    echo "The file " . htmlspecialchars(basename($file['name'])) . " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            } else {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }
        }
    } else {
        echo "Sorry, your file was not uploaded.";
    }
} else {
    echo "No file was uploaded.";
}
?>
