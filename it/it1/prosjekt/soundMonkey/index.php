<!DOCTYPE html>
<html lang="en">
<head>
    <title>Log in</title>
    <link type="text/css" rel="stylesheet" href="style.css">
    <style>
        body {
            margin: auto;
            min-height: 100%;
            align-content: center;
            justify-content: center;
            display: flex;
        }
        div {
            position: absolute;
            width: 100%;
            min-height: 100%;
            background-image: linear-gradient(to right top, #137b34, #007057, #006268, #005266, #2e4254, #384159, #45405a, #533d58, #793e67, #a43967, #cb3358, #e83b3b);
            opacity: 0;
            z-index: 1;
        }
        form {
            z-index: 2;
            margin: 0;
        }
        button:hover {
            background-color: var(--secondary-color);
            transition: 0.5s;
        }
    </style>
    <script rel="script" src="javascript.js"></script>
</head>

<body>
<?php

echo "<div></div>";
echo "<form action='passwordCheck.php' method='post'>";
echo "<input type='text' id='password' name='password' required onfocus='togglePassword()' value='Password'>";
echo "<input type='submit' id='logInButton' value='Log in' onmouseover='onHoverThird()' onmouseout='onNotHover()'>";
echo "</form>";

?>
</body>
</html>


