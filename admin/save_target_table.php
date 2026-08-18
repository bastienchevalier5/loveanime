<?php
session_start();
if (isset($_POST['index'], $_POST['table']) && isset($_SESSION['migration_wip']['saisons'][$_POST['index']])) {
    $idx = (int)$_POST['index'];
    $_SESSION['migration_wip']['saisons'][$idx]['chosen_table'] = $_POST['table'];
    echo "saved";
}