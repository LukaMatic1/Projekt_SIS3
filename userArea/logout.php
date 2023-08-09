<?php
    session_start();
    session_unset();
    session_destroy();
    echo "<script>window.open('../Index.php','_self')</script>";
?>