<?php
include 'koneksi.php';

date_default_timezone_set('Asia/Jakarta');

$nik = $_POST['nik'];
$password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';
$nama = isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : '';
$kode_role = $_POST['kode_role'];
$kode_departemen = $_POST['kode_departemen'];

// Check if a profile picture was uploaded
if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
    $file_name = $_FILES['profile_picture']['name'];
    $file_temp = $_FILES['profile_picture']['tmp_name'];
    $file_size = $_FILES['profile_picture']['size'];
    $file_type = $_FILES['profile_picture']['type'];

    // Validate and sanitize the uploaded file data.
    $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
    $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    if (!in_array($file_extension, $allowed_extensions)) {
        // Handle the case when the uploaded file is not an image.
        echo "Invalid file format. Please upload a valid image.";
    } else {
        // Resize the image to 3x3 (if needed).
        $image = imagecreatefromstring(file_get_contents($file_temp));
        $new_width = 3;  // New width (3 pixels).
        $new_height = 3; // New height (3 pixels);

        $resized_image = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($resized_image, $image, 0, 0, 0, 0, $new_width, $new_height, imagesx($image), imagesy($image));

        // Save the resized image to a new file.
        $new_file_name = uniqid() . "." . $file_extension; // Generate a unique file name
        $new_file_path = 'path_to_upload_directory/' . $new_file_name; // Change 'path_to_upload_directory' to your desired directory.
        imagejpeg($resized_image, $new_file_path);

        // Insert the file information into the 'images' table.
        $insert_query = "INSERT INTO images (file_name, file_path, file_type, file_size, uploaded_at) VALUES (?, ?, ?, ?, NOW())";
        $insert_stmt = $konek->prepare($insert_query);
        $insert_stmt->bind_param("sssi", $new_file_name, $new_file_path, $file_type, $file_size);

        if ($insert_stmt->execute()) {
            // Get the ID of the inserted image.
            $id_images = $insert_stmt->insert_id;

            // Update the user's profile with the image ID.
            $update_query = "UPDATE user SET password=?, nama=?, kode_role=?, kode_departemen=?, id_images=? WHERE nik=?";
            $update_stmt = $konek->prepare($update_query);
            $update_stmt->bind_param("ssssis", $password, $nama, $kode_role, $kode_departemen, $id_images, $nik);

            if ($update_stmt->execute()) {
                // Redirect to user.php after successful update.
                header("location: profile.php");
                exit();
            } else {
                echo "Data gagal diubah!";
            }

            $update_stmt->close();
        } else {
            echo "Failed to insert image data!";
        }

        $insert_stmt->close();
    }
}

// If no profile picture was uploaded, update the user's profile without changing the image.
$update_query = "UPDATE user SET password=?, nama=?, kode_role=?, kode_departemen=? WHERE nik=?";
$update_stmt = $konek->prepare($update_query);
$update_stmt->bind_param("sssss", $password, $nama, $kode_role, $kode_departemen, $nik);

if ($update_stmt->execute()) {
    // Redirect to user.php after successful update.
    header("location: profile.php");
    exit();
} else {
    echo "Data gagal diubah!";
}

$update_stmt->close();
$konek->close();
?>
