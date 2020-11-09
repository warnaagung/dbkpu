<?php
if(isset($_POST["session_id"]))
    session_id($_POST["session_id"]);
session_start();

if(isset($_COOKIE["idpetugas"]))
    $_SESSION["idpetugas"]=$_COOKIE["idpetugas"];
else if(!isset($_POST["session_id"]))
{
    if(isset($_POST["idpetugas"]))
        $_SESSION["idpetugas"]=$_POST["idpetugas"];
    else
        die("form data POST[\"idpetugas\"] belum dikirim");
}
//die("\n" . session_id() . "\n" . $_SESSION["dataku"]);
$target_dir = "uploads/";
$ifile=-1;
$strtgl=date("ymdH");
while(isset($_FILES["i" . (++$ifile)])){
    $target_file = $target_dir . $_SESSION["idpetugas"] . basename($_FILES["i" . $ifile]["name"] . $strtgl);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["i" . $ifile]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["i" . $ifile]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
    if (move_uploaded_file($_FILES["i" . $ifile]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["i" . $ifile]["name"])). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    }
}
?>