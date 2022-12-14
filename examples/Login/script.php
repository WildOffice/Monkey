<!-- A php document is like a html file, you can add a button, a link, a form, but inside these tags, this is php code --->
<?php
// Check if there is values to read (the isset function check if the content exists and if it's not equal to `null`)
if (isset($_POST['username']) && isset($_POST['password']))
{
    // Declare variables containing infos on the database
    $host = "localhost";
    $dbname = "myProject"; // To replace with the real db name
    $charset = "utf8";
    $username = "admin";
    $password = "";
    // Here we will connect to the database using PDO object
    $db = new PDO("mysql:host=" . $host . ";dbname=" . $dbname . ";charset=" . $charset, $username, $password, [ PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]);
    // This is a SQL request.      table     check username and password are equal to the specified by the user
    $request = $db -> prepare("SELECT id FROM users WHERE username = :username AND password = :password");
    $result = $request -> execute([ "username" => $_POST["username"], "password" => $_POST["password"] ]) -> fetchAll();
    // Check if the request contains something (if the username & password was corrects)
    if (count($result) > 0)
    {
        // All right, we redirect the user to the main page
        header("Location: ../");
    }
    else
    {
        // Something's wrong, we resend the user to the connection page
        header("Location: ./index.html");
    }
}
?>