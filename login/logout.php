<?php
session_start();
error_reporting(0);

unset($_SESSION['userid']);
unset($_SESSION['username']);
unset($_SESSION['usernick']);

echo ("
    <script>
    window.alert('BYE :o');
        location.href='../lib/newindex.php';
    </script>
");

?>
