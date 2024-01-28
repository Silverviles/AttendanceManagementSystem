<?php
    session_start(); // Start the session

    // Destroy the session
    session_destroy();
        
    // Redirect to login.php
    header("Location: index.php");
    exit(); // Make sure no other code is executed after redirection