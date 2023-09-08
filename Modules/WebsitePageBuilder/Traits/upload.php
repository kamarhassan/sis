<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_FILES['file']['tmp_name'])) {
       die('No file uploaded');
      }
     
    // Generate an ID for the template, something like: "615720f9d13e7"
    $id = uniqid();
    $tmpzip = __DIR__ . "/tmp/uploaded";
    $name = __DIR__ . "/templates/custom/" . $id ."/";

    // Upload and extract to a templates/customer/615720f9d13e7/ folder
    move_uploaded_file($_FILES['file']['tmp_name'], $tmpzip);

    $zip = new ZipArchive();
    if ($zip->open($tmpzip) !== true) {
        die ("An error occurred reading your ZIP file.");
    }
    $zip->extractTo($name);
    $zip->close();

    if (!file_exists($name."index.html")) {
        die ("Cannot find an 'index.html' file in the root folder of your ZIP package");
    }

    // Redirect to the builder
    header("Location: design.php?id={$id}&type=custom");
}
?>

<!DOCTYPE html>
<html>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
<p>Upload a .zip package of your template. Make sure there is an index.html file included</p>
<p><input type="file" name="file"></p>

<p>
<input type="submit" value="Upload" name="submit ">
</p>
</form>

</body>
</html>


