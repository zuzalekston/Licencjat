<?php
if (isset($_POST['loginButton'])) {
    //Login button was pressed
    $username = $_POST['loginUsername'];
    $password = $_POST['loginPassword'];

    $result = $account->login($username, $password);

    if ($result == true) {
        $_SESSION['userLoggedIn'] = $username;
        $query = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $_SESSION['userId'] = $row['id'];
        }

        header("Location: index.php");
    }

}
