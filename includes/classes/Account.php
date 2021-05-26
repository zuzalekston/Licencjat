<?php
class Account
{

    private $con;
    private $errorArray;

    public function __construct($con)
    {
        $this->con = $con;
        $this->errorArray = array();
    }

    public function login($un, $pw)
    {
        $pw = md5($pw);

        $query = mysqli_query($this->con, "SELECT * FROM users WHERE username='$un' AND password='$pw'");

        if (mysqli_num_rows($query) == 1) {
            return true;
        } else {
            array_push($this->errorArray, Constants::$loginFailed);
            return false;
        }

    }

    public function register($un, $fn, $ln, $em, $em2, $pw, $pw2)
    {
        $this->validateUsername($un);
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateEmails($em, $em2);
        $this->validatePasswords($pw, $pw2);

        //echo $this->errorArray;

        if (empty($this->errorArray) == true) {
            //Insert into db
            return $this->insertUserDetails($un, $fn, $ln, $em, $pw);
        } else {
            return false;
        }

    }

    public function changePassword($un, $stare, $pw, $pw2)
    {
        $encryptedPw = md5($stare);
        $query = "SELECT * FROM users WHERE username='$un' AND users.password='$encryptedPw'";
        $result = mysqli_query($this->con, $query);

        if (mysqli_num_rows($result) != 1) {
            array_push($this->errorArray, Constants::$wrongOldPassword);
            return false;
        }
        $this->validatePasswords($pw, $pw2);
        //echo end($this->errorArray);
        if (empty($this->errorArray) == true) {
            //update db
            return $this->updateUserPassword($un, $pw);
        } else {
            return false;
        }
    }

    public function getError($error)
    {
        if (!in_array($error, $this->errorArray)) {
            $error = "";
        }
        return "<span class='errorMessage'>$error</span>";
    }

    public function getLastError()
    {
        return end($this->errorArray);
    }

    private function insertUserDetails($un, $fn, $ln, $em, $pw)
    {
        $encryptedPw = md5($pw);

        $query = "INSERT INTO users VALUES (NULL, '$un', '$fn', '$ln', '$em', '$encryptedPw', NULL)";

        $result = mysqli_query($this->con, $query);

        return $result;
    }

    private function updateUserPassword($un, $pw)
    {
        $encryptedPw = md5($pw);
        $query = "UPDATE users SET `password` = '$encryptedPw' WHERE username = '$un';";
        //echo $query;
        $result = mysqli_query($this->con, $query);
        return $result;
    }

    private function validateUsername($un)
    {

        if (strlen($un) > 25 || strlen($un) < 2) {
            array_push($this->errorArray, Constants::$usernameCharacters);
            return;
        }

        $query = "SELECT username FROM users WHERE username='$un'";
        //echo $query;
        $checkUsernameQuery = mysqli_query($this->con, $query);

        if (mysqli_num_rows($checkUsernameQuery) != 0) {
            array_push($this->errorArray, Constants::$usernameTaken);
            return;
        }

    }

    private function validateFirstName($fn)
    {
        if (strlen($fn) > 25 || strlen($fn) < 2) {
            array_push($this->errorArray, Constants::$firstNameCharacters);
            return;
        }
    }

    private function validateLastName($ln)
    {
        if (strlen($ln) > 25 || strlen($ln) < 2) {
            array_push($this->errorArray, Constants::$lastNameCharacters);
            return;
        }
    }

    private function validateEmails($em, $em2)
    {
        if ($em != $em2) {
            array_push($this->errorArray, Constants::$emailsDoNotMatch);
            return;
        }

        if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emailInvalid);
            return;
        }

        $checkEmailQuery = mysqli_query($this->con, "SELECT email FROM users WHERE email='$em'");
        if (mysqli_num_rows($checkEmailQuery) != 0) {
            array_push($this->errorArray, Constants::$emailTaken);
            return;
        }

    }

    private function validatePasswords($pw, $pw2)
    {

        if ($pw != $pw2) {
            array_push($this->errorArray, Constants::$passwordsDoNoMatch);
            return;
        }

        if (preg_match('/[^A-Za-z0-9]/', $pw)) {
            array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
            return;
        }

        if (strlen($pw) > 30 || strlen($pw) < 5) {
            array_push($this->errorArray, Constants::$passwordCharacters);
            return;
        }

    }

}
