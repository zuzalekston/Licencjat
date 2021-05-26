
    <?php
include "includes/config.php";
if (isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
} else {
    header("Location: register.php");
}

if (isset($_GET['id_image'])) {
    $query = 'DELETE FROM images WHERE id=' . $_GET['id_image'] . ';';
    $result = mysqli_query($con, $query);

    echo '<meta http-equiv="refresh" content="0; url=user.php?username=' . $userLoggedIn . '"/>';

}

if (isset($_GET['id_comment'])) {
    $query2 = 'DELETE FROM comments WHERE id=' . $_GET['id_comment'] . ';';
    $result2 = mysqli_query($con, $query2);
    echo '<meta http-equiv="refresh" content="0; url=obserwowane.php"/>';
}

?>

