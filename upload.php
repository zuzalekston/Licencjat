<html>
    <head>
        <title>Grafi</title>
        <link href="bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="index.css">
        <link rel="shortcut icon" href="arbuz.png">

    </head>
<body>
<?php
include "includes/config.php";
if (isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
} else {
    header("Location: register.php");
}

echo "<h2>Gdy ładowanie zostanie zakończone, wyświetli się stosowny komunikat.</h2>";
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
&& $imageFileType != "gif" && $imageFileType != ".JPG" ) {
alert("Przepraszamy, Twój obrazek musi mieć rozszerzenie JPG, JPEG, PNG lub GIF.");
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
    $isPublic = $_POST['isPublic'];
    if ($isPublic != 1) {
        $isPublic = 0;
    }
    //echo $isPublic;

    $imgContent = addslashes(file_get_contents($image));

    if ($hex_string == '') {
        alert("Wystąpił błąd. Obraz nie został dodany.");
    } else {
        $query = "INSERT INTO images VALUES (NULL, (SELECT id FROM users WHERE username='$username'),'$title', '$text', '$hex_string', '$type', $isPublic, 0);";
        //echo $query;
        //$result = mysqli_query($con, $query);

        if ($con->query($query) === false) {
            echo "Error: " . $query . "<br>" . $con->error;
            alert("Wystąpił błąd. Obraz nie został dodany.");
        } else {
            alert("Obraz został dodany.");
        }
    }

}

?>
   <a id="wrocText" href="addImage.php"><p id="wroc">Wróć</p></a>
</body>
</html>