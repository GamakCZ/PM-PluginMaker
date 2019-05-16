<?php
// data handling
if(empty($_POST) || !isset($_POST["id"])) {
    return;
}

switch ($id = $_POST["id"]) {
    case "0001":
        array_shift($_POST);
        $description = $_POST;
        // creating new project
        include "src/vixikhd/pluginmaker/DataChecker.php";

        $valid = \vixikhd\pluginmaker\DataChecker::checkPluginDescription($description);
        setcookie("pm-valid", $valid);
        setcookie("pm-description", serialize($description));
        break;
    case "0002":
        var_dump($_SESSION);
        break;
}
?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>PocketMine Plugin maker</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Actor">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/Footer-Dark.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <?php
    // nav
    include "navbar.php";
    echo getNavbar(ADVANCED_NAVBAR);

    // other
    if($_COOKIE["pm-valid"] != true) {
        echo "<h4>Error 501 - Invalid description</h4>";
        return;
    }

    $description = unserialize($_COOKIE["pm-description"]);
    file_put_contents(($path = getcwd() . DIRECTORY_SEPARATOR . "projects" . DIRECTORY_SEPARATOR . "json" . time()), json_encode([
        "description" => $description
    ]));

    session_create_id("test");
    var_dump($_SESSION);
    echo file_get_contents(getcwd() . DIRECTORY_SEPARATOR . "type-select.html");
    ?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>