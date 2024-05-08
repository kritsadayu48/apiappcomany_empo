<?php
// Assuming you receive POST data with Base64-encoded image
$data = json_decode(file_get_contents('php://input'), true);
$imageData = $data['image'];

// Decode the Base64 string to binary data
$imageData = base64_decode($imageData);

// Set a path where image will be saved
$target_dir = "uploads/"; // Make sure this directory exists and is writable
$imageName = uniqid() . '.jpg';
$target_file = $target_dir . $imageName;

// Save the image in the directory
if (file_put_contents($target_file, $imageData)) {
    $fullUrl = 'https://s6319410013.sautechnology.com/myworkapi/' . $target_file;
    echo json_encode(array('imageUrl' => $fullUrl));
} else {
    http_response_code(500);
    echo json_encode(array('error' => 'Failed to save image'));
}
?>
