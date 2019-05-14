<!DOCTYPE html>
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
    include "navbar.php";
    echo getNavbar(DEFAULT_NAVBAR);
    ?>
    <div>
        <form action="editor.php" method="get" class="description-form" style="margin-right: 20%;margin-top: 53px;margin-left: 20%;padding-bottom: 0;">
            <h4 style="font-family: Actor, sans-serif;font-size: 21px;padding-bottom: 6px;">Plugin description</h4>
            <input name="name" class="form-control" type="text" placeholder="PluginName" style="margin-bottom: 5px;">
            <input name="version" class="form-control" type="text" placeholder="Version" style="margin-bottom: 5px;">
            <input name="author" class="form-control" type="text" placeholder="Author" value="VixikHD" readonly="" style="margin-bottom: 5px;">
            <input name="description" class="form-control" type="text" placeholder="Description" style="margin-bottom: 5px;">
            <input name="api" class="form-control" type="text" placeholder="Api" value="3.0.0" style="margin-bottom: 5px;">
            <button class="btn btn-primary" type="submit">Next step</button>
        </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>