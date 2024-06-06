<?php
session_start();
session_unset();
session_destroy();
echo "Redirecting to index.html"; // Debugging line
header('Location: ../index.html');
exit;
?>