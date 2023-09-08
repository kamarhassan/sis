<?php

// Get the Template ID posted to the server
// Template ID and type are configured in your BuilderJS initialization code
$templateID = $_POST['template_id'];
$templateslug = $_POST['slug'];
$templateurl_storage = $_POST['url_storage'];
$type = $_POST['type'];
 
// Get the directory path of the specified template on the hosting server
// Path may look like this: /storage/templates/{type}/{ID}/
$path = dirname(__FILE__) . "/templates/" . $type . "/" . $templateID . "/";

if ($_POST['assetType'] == 'upload') {
    // Get uploaded file name
    $filename = $_FILES['file']['name'];
    
    // Escape sensitive characters in file name
    $filename = preg_replace('/[^a-z0-9\._\-]+/i', '_', $filename);

    // Storage path of the uploaded asset:
    // For example: /storage/templates/{type}/{ID}/Uploaded-Image.PNG
    $filepath = "{$path}/{$filename}";

    // Process uploaded file
    move_uploaded_file($_FILES['file']['tmp_name'], 'storage/app/WebsitePageBuilder/'.$templateslug);
} elseif ($_POST['assetType'] == 'url') {
    // upload file by upload image
    $filename = uniqid();

    // Storage path of the uploaded asset:
    // For example: /storage/templates/{type}/{ID}/604ce5e36d0fa
    $filepath = "{$path}/{$filename}";

    // Download the file's content
    $content = file_get_contents($_POST['url']);

    // Store it:
    file_put_contents($filepath, $content);
} elseif ($_POST['assetType'] == 'base64') {
    // upload file by upload image
    $filename = uniqid();

    // Storage path of the uploaded asset:
    // For example: /storage/templates/{type}/{ID}/604ce5e36d0fa
    $filepath = "{$path}/{$filename}";

    // Store it
    file_put_contents($filepath, file_get_contents($_POST['url_base64']));
}

// Return the relative URL of the asset
// Set up HTTP header for response
header('Content-Type: application/json');
header("HTTP/1.1 200");
echo json_encode([ 'url' => $filename ]);
