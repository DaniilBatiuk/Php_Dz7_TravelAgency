<?
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <?
    if (isset($_GET["page"]))
        $page = $_GET["page"];
    else
        $page = 1;
    include_once("pages/menu.php");
    ?>
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <?
                    // if (isset($_GET["page"])) {
                    //     $page = $_GET["page"];
                        switch ($page) {
                            case 1:
                                include_once("pages/tours.php");
                                break;
                            case 2:
                                include_once("pages/comments.php");
                                break;
                            case 3:
                                include_once("pages/admin.php");
                                break;
                            case 4:
                                include_once("pages/registration.php");
                                break;
                            default:
                                echo "<h2>Page not found!</h2>";
                        }
                    // } 
                    // else
                    //     include_once("pages/tours.php");
                    ?>
                </div>
            </div>
        </div>
    </section>
    <footer>
        My Travel Agenc
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>