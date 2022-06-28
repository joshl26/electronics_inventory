<?php

$id = $_GET['id'];

if ($_FILES['image']['size'][0] == TRUE) {

    $cn = mysqli_connect("localhost", "root", "mysql", "electronics_inventory") or die("Could not Connect My Sql");
    $output_dir = "upload/";/* Path for file upload */
    $RandomNum   = time();
    $ImageName      = str_replace(' ', '-', strtolower($_FILES['image']['name'][0]));
    $ImageType      = $_FILES['image']['type'][0];

    $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
    $ImageExt       = str_replace('.', '', $ImageExt);
    $ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
    $NewImageName = $ImageName . '-' . $RandomNum . '.' . $ImageExt;
    $ret[$NewImageName] = $output_dir . $NewImageName;

    /* Try to create the directory if it does not exist */
    if (!file_exists($output_dir)) {
        @mkdir($output_dir, 0777);
    }
    move_uploaded_file($_FILES["image"]["tmp_name"][0], $output_dir . "/" . $NewImageName);

    $ImageLocation =  $output_dir . $NewImageName;

    $time = time();

    $sql = "INSERT INTO image VALUES ($time,'$ImageLocation', $id)";
    if (mysqli_query($cn, $sql)) {
        //echo "successfully !";
        header("Location: edit_item.php?" . "id=" . $id);
        die();
    } else {
        echo "Error: " . $sql . "" . mysqli_error($cn);
    }
} else {
    header("Location: edit_item.php?" . "id=" . $id);
    die();
}
