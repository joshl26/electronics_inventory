<?php // Example 11: messages.php
require_once 'header.php';

if (!$loggedin) die("</div></body></html>");

if (isset($_GET['view'])) $view = sanitizeString($_GET['view']);
else                      $view = $user;

if (isset($_POST['description'])) {

  $part_num = sanitizeString($_POST['part_num']);
  $qty = sanitizeString($_POST['qty']);
  $cost = sanitizeString($_POST['cost']);
  $package = sanitizeString($_POST['package']);
  $location = sanitizeString($_POST['location']);
  $description = sanitizeString($_POST['description']);

  if ($part_num != "") {
    // $pm   = substr(sanitizeString($_POST['pm']), 0, 1);
    $time = time();

    queryMysql("INSERT INTO items VALUES(NULL, '$part_num', '$qty', '$cost', '$package', 
    '$location', '$description', '$user', $time, NULL)");
  }
}

if ($view != "") {
  if ($view == $user) $name1 = $name2 = "Your";
  else {
    $name1 = "<a href='members.php?view=$view&r=$randstr'>$view</a>'s";
    $name2 = "$view's";
  }

  echo <<<_END
    <form method='post' action='add_item.php'>
      <fieldset data-role="controlgroup" data-type="horizontal">
        <legend style="padding-left: 10px">Add New Inventory Item</legend>
          <div id="inv_details" class="inv_details" style="float: left; padding-left: 10px; padding-bottom: 10px;">
            <label for="part_num">Part Number</label>
            <input type="text" name="part_num" placeholder="Enter Part Number" required/>
          </div>
          <div class="inv_details" style="float: left; padding-left: 10px; padding-bottom: 10px;">
            <label for="stock_qty">Qty</label>
            <input type="number" name="qty" value='0' step="1" placeholder="0" min="0" max="10000"/>
          </div>
          <div class="inv_details" style="float: left; padding-left: 50px; padding-bottom: 10px;">
              <label for="cost">Cost ($)</label>
              <input type="number" name="cost" step="0.01" value="0.00" placeholder="0.00" min="0.00"/>
          </div>
          <div class="inv_details" style="float: left; padding-left: 10px; padding-bottom: 10px;">
            <label for="package">Package</label>
            <input type="text" name="package" value="N/A"/>
          </div>
          <div class="inv_details" style="float: left; padding-left: 10px; padding-bottom: 10px;">
            <label for="location">Location</label>
            <input type="text" name="location" value="N/A"/>
          </div>
          <div class="inv_details" style="float: left; padding-left: 25px; padding-bottom: 10px;">
            <label style="vertical-align: top;" for="description">Description</label>
            <textarea id="description" name="description" rows="2" cols="125" placeholder='TEST'> DESCRIPTION </textarea>
          </div>
          <div class="inv_details" style="float: left; padding-left: 25px; padding-bottom: 10px;">
            <label style="vertical-align: top;" for="author">Author</label>
            <input id="author" name="author" rows="1" cols="25" value='$user' readonly> 
          </div>
          <input data-transition='slide' type='submit' value='Add Item'>
      </fieldset>
    </form><br>
_END;

  date_default_timezone_set('America/Toronto');

  if (isset($_GET['erase'])) {
    $erase = sanitizeString($_GET['erase']);
    // queryMysql("DELETE FROM items WHERE id='$erase' AND author='$user'");
    queryMysql("DELETE FROM items WHERE id='$erase'");
  }

  // $query  = "SELECT * FROM items WHERE recip='$view' ORDER BY time DESC";
  $query  = "SELECT * FROM items ORDER BY time DESC";
  $result = queryMysql($query);
  $num    = $result->rowCount();
}

?>

</div><br>
</body>

</html>