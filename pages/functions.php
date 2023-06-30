<?
function connect_to_db($host, $username, $passwrd, $dbname, $port)
{
    $link = mysqli_connect($host, $username, $passwrd, $dbname, $port)
        or die("Could not establish connection with server");
    mysqli_query($link, "set names 'utf8'");
    return $link;
}



function register($login, $password, $confirmPassword, $email)
{
    if ($password !== $confirmPassword) {
        return "<div class='alert alert-warning' role='alert'>Error: passwords must be the same </div>";
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $link = connect_to_db("localhost", "root", "", "agencydb", 3306);

    $queryText = "INSERT INTO users (Login, Email, Passwrd, RoleId) VALUES ('$login', '$email', '$hashedPassword', 2)";

    try{
    $ins = mysqli_query($link, $queryText);
    }
    catch(Exception $e){
        $errorCode = mysqli_errno($link);
        $errorMessage = mysqli_error($link);
        return "<div class='alert alert-warning' role='alert'>Error [$errorCode]: $errorMessage </div>";
    }
    if ($ins) {
        return "<div class='alert alert-success' role='alert'>Product successfully inserted!</div>";
    }
}