<?php
// Check if MySQLi extension is enabled
if (extension_loaded('mysqli')) {
    echo "MySQLi is enabled";
    phpinfo();
} else {
    echo "MySQLi is not enabled";
}