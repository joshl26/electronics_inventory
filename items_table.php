<?php // Example 11: messages.php
require_once 'header.php';

if (!$loggedin) die("</div></body></html>");

if (isset($_GET['view'])) $view = sanitizeString($_GET['view']);
else                      $view = $user;

if ($view != "") {
  if ($view == $user) $name1 = $name2 = "Your";
  else {
    $name1 = "<a href='members.php?view=$view&r=$randstr'>$view</a>'s";
    $name2 = "$view's";
  }

  date_default_timezone_set('America/Toronto');

  $query  = "SELECT * FROM items ORDER BY time DESC";
  $result = queryMysql($query);
  $num    = $result->rowCount();

  echo "<div class='myTable'>";
  echo "<table>";
  echo "<tr>";
  echo "<th>PART NUMBER</th>";
  echo "<th>QTY</th>";
  echo "<th>COST</th>";
  echo "<th>PKG</th>";
  echo "<th>LOCATION</th>";
  echo "<th>DESCRIPTION</th>";
  echo "<th>AUTHOR</th>";
  echo "<th>TIME</th>";
  echo "</tr>";

  while ($row = $result->fetch()) {

    echo "<tr>";
    echo "<td> <a href='edit_item.php?id=$row[id]'> $row[part_num] </a> </td>";
    echo "<td> $row[qty]</td>";
    echo "<td> $row[cost]</td>";
    echo "<td> $row[package]</td>";
    echo "<td> $row[location]</td>";
    echo "<td> $row[description]</td>";
    echo "<td> $row[author]</td>";
    echo "<td> $row[time]</td>";
    echo "</tr>";
  }

  echo "</div>";
  echo "</table>";
}

if (!$num)
  echo "<br><span class='info'>No messages yet</span><br><br>";

echo "<br><a data-role='button'
        href='messages.php?view=$view&r=$randstr'>Refresh messages</a>";
?>

</div><br>

</body>

</html>