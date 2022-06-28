<?php

require_once 'functions.php';

if (isset($_GET['erase_image'])) {

    echo "TEST";

    $erase_image = sanitizeString($_GET['erase_image']);
    $file_id = sanitizeString($_GET['file_id']);
    $item_id = sanitizeString($_GET['item_id']);
    $file_location = sanitizeString($_GET['file_location']);

    queryMysql("DELETE FROM image WHERE id=$file_id");

    unlink($file_location);

    //http://localhost/electronics_inventory/image_delete.php?erase_image=yes&file_id=1652718944&item_id=30

    echo ("IMAGE DELETED...");

    // echo $file_location;

    // echo $item_id;

    header("Location: edit_item.php?" . "id=" . $item_id);
    die();
}
