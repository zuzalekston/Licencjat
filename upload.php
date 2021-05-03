<html>
    <head>
        <title>Grafi</title>
        <link href="bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="index.css">

    </head>
<body>
<?php
include "includes/config.php";
//$target_dir = "uploads/";
//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
//$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        alert("Plik nie jest obrazem");
        $uploadOk = 0;
    }
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    alert("Obraz jest za duży. Dozwolony rozmiar to 5MB");
    $uploadOk = 0;
}
//set global max_allowed_packet=16777216  zmiana dozwolonego rozmiaru w bazie

// Allow certain file formats
/*if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
$uploadOk = 0;
}*/

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    alert("Przepraszamy, Twój obrazek nie został załadowany");
// if everything is ok, try to upload file
} else {
    //if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    //    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    // } else {
    //    echo "Sorry, there was an error uploading your file.";
    //}

    $bin_string = file_get_contents($_FILES["fileToUpload"]["tmp_name"]);
    $hex_string = base64_encode($bin_string);
    //echo $hex_string;

    $image = $_FILES['image']['tmp_name'];
    $title = $_POST['title'];
    $text = $_POST['text'];
    $username = $_SESSION['userLoggedIn'];
    $type = $_FILES["fileToUpload"]["type"];

    $imgContent = addslashes(file_get_contents($image));

    $query = "INSERT INTO Images VALUES (NULL, (SELECT id FROM Users WHERE username='$username'),'$title', '$text', '$hex_string', '$type', 0, 0);";

    $result = mysqli_query($con, $query);
    if($result == false) {
        alert("Wystąpił błąd. Obraz nie został dodany.");
    }



}

?>
    <p class="menu"><a class="menuText" href="addImage.php">Wróć</a></p>
</body>
</html>