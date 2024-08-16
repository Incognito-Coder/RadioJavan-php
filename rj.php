<?php
include 'Main.php';

if (isset($_GET['url'])) {
    echo prettier(fetch($_GET['url']));
}
