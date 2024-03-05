<?php
session_start();
$_SESSION = array();
session_destroy();
echo "<script>setTimeout(\"location.href = './index.php';\",0);</script>";
