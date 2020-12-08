<?php
move_uploaded_file($_FILES['image']['tmp_name'], "image.jpg");
header("Location: index.php");