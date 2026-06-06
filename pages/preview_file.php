<?php
$file = $_GET['file'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Preview</title>
</head>
<body style="margin:0;">

<iframe 
    src="../upload/<?= $file ?>" 
    width="100%" 
    height="100vh"
    style="border:none;">
</iframe>

</body>
</html>