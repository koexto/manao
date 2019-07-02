<?php include 'loggedIn.php'; ?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Untitled</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous">
    </script>
    <script src="js/handlerForm.js"></script>
</head>
<body>

<?php
if ($_SESSION['loggedIn'] === true){
    echo '<h2>Hello ' . $_COOKIE['name'] . '</h2>';
}
?>

<?php
if ($_SESSION['loggedIn'] !== true){
    include 'tpl/forms.tpl.php';
}
?>

</body>
</html>
