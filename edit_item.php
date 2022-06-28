<?php // Example 11: messages.php

require_once 'header.php';

if (!$loggedin) die("</div></body></html>");

if (isset($_GET['view'])) $view = sanitizeString($_GET['view']);
else                      $view = $user;

if (isset($_GET['id'])) {

  $id = sanitizeString($_GET['id']);
}



if (isset($_POST['description'])) {

  $part_num = sanitizeString($_POST['part_num']);
  $qty = sanitizeString($_POST['qty']);
  $cost = sanitizeString($_POST['cost']);
  $package = sanitizeString($_POST['package']);
  $location = sanitizeString($_POST['location']);
  $description = sanitizeString($_POST['description']);

  if ($part_num != "") {
    $time = time();

    queryMysql("UPDATE items SET part_num ='$part_num', qty='$qty', cost='$cost',
     package='$package', location='$location', description='$description', edit_time='$time' WHERE id='$id'");
  }
}

if ($view != "") {
  if ($view == $user) $name1 = $name2 = "Your";
  else {
    $name1 = "<a href='members.php?view=$view&r=$randstr'>$view</a>'s";
    $name2 = "$view's";
  }

  date_default_timezone_set('America/Toronto');

  // if (isset($_GET['erase'])) {
  //   $erase = sanitizeString($_GET['erase']);
  //   // queryMysql("DELETE FROM items WHERE id='$erase' AND author='$user'");
  //   queryMysql("DELETE FROM items WHERE id='$erase'");
  // }

  $query  = "SELECT * FROM items WHERE id='$id'";
  $result = queryMysql($query);
  $num    = $result->rowCount();

  $query1  = "SELECT * FROM image WHERE item_id='$id'";
  $result1 = queryMysql($query1);
  $num1    = $result->rowCount();

  while ($row = $result->fetch()) {

    $part_num = $row['part_num'];
    $qty = $row['qty'];
    $cost = $row['cost'];
    $package = $row['package'];
    $location = $row['location'];
    $description = $row['description'];
    $author = $row['author'];
    $time = $row['time'];
  }

  echo <<<_END
  <form method='post' action='edit_item.php?id=$id'>
    <fieldset data-role="controlgroup" data-type="horizontal">
      <legend style="padding-left: 10px">Edit Existing Inventory Item</legend>
        <div id="inv_details" class="inv_details" style="float: left; padding-left: 10px; padding-bottom: 10px;">
          <label for="part_num">Part Number</label>
          <input type="text" name="part_num" value="$part_num" required/>
        </div>
        <div class="inv_details" style="float: left; padding-left: 10px; padding-bottom: 10px;">
          <label for="stock_qty">Qty</label>
          <input type="number" name="qty" step="1" min="0" max="10000" value="$qty"/>
        </div>
        <div class="inv_details" style="float: left; padding-left: 50px; padding-bottom: 10px;">
            <label for="cost">Cost ($)</label>
            <input type="number" name="cost" step="0.01" min="0.00" value="$cost"/>
        </div>
        <div class="inv_details" style="float: left; padding-left: 10px; padding-bottom: 10px;">
          <label for="package">Package</label>
          <input type="text" name="package" value="$package"/>
        </div>
        <div class="inv_details" style="float: left; padding-left: 10px; padding-bottom: 10px;">
          <label for="location">Location</label>
          <input type="text" name="location" value="$location"/>
        </div>
        <div class="inv_details" style="float: left; padding-left: 25px; padding-bottom: 10px;">
          <label style="vertical-align: top;" for="description">Description</label>
          <textarea id="description" name="description" rows="2" cols="100">$description</textarea>
        </div>
        <div class="inv_details" style="float: left; padding-left: 25px; padding-bottom: 10px;">
          <label style="vertical-align: top;" for="author">Author</label>
          <input id="author" name="author" rows="1" cols="25" value="$user" readonly> 
        </div>
        <div style="float: left; padding-left: 25px; padding-bottom: 10px;">
        <br><input data-transition='slide' type='submit' value='Save Item Edits'>
        </div>
    </fieldset>
  </form><br>
  <br>
  <legend style="padding-left: 10px">Edit Item Attachments</legend>
  <form action="image_upload.php?id=$id" method="post" enctype="multipart/form-data">
        <input type="file" name="image[]" />
        <button type="submit">Upload Image</button>
    </form>
  </div>
  _END;


  echo "<br>";
  echo "<div class='myTable' style='float: left; padding-left: 10px; padding-bottom: 10px;'>";
  echo "<table>";
  echo "<tr>";
  echo "<th>FILE ID</th>";
  echo "<th>FILE</th>";
  echo "<th>DELETE FILE</th>";
  echo "</tr>";


  while ($row1 = $result1->fetch()) {

    $file_id = $row1['id'];
    $file_location = $row1['image'];
    $item_id = $row1['item_id'];

    // echo "<a href='$file_location'> $file_location </a>";
    // echo "<br>";

    //   echo "[<a href='messages.php?view=$view" .
    //     "&erase=" . $row['id'] . "&r=$randstr'>erase</a>]";

    echo "<tr>";
    // echo "<td> <a href='edit_item.php?id=$row[id]'> $row[image] </a> </td>";
    echo "<td> $row1[id]</td>";
    echo "<td> <a href='$row1[image]'>$row1[image]</a> </td>";
    echo "<td> <a href='image_delete.php?" . "erase_image=yes" . "&file_id=" . $row1['id'] . "&item_id=" . $row1['item_id'] . "&file_location=" . $row1['image'] . "'>erase</a> </td>";
    echo "</tr>";
  }

  echo "</div>";
  echo "</table>";
}

?>

</div><br>

</body>

</html>