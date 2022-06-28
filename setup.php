<!DOCTYPE html> <!-- Example 03: setup.php -->
<html>

<head>
  <title>Setting up database</title>
</head>

<body>
  <h3>Setting up...</h3>

  <?php

  // cd C:\Program Files\Ampps\mysql\bin

  // mysql -u root -pmysql

  // CREATE DATABASE electronics_inventory;

  // USE electronics_inventory;

  // SHOW databases;

  // DESCRIBE table; //VIEW SPECIFIC TABLE 

  // CREATE USER 'electronics_inventory'@'localhost' IDENTIFIED BY 'password';
  // GRANT ALL PRIVILEGES ON electronics_inventory.* TO 'electronics_inventory'@'localhost';

  require_once 'functions.php';

  createTable(
    'members',
    'user VARCHAR(16),
              pass VARCHAR(16),
              INDEX(user(6))'
  );

  createTable(
    'items',
    'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
              part_num VARCHAR(128),
              qty VARCHAR(6),
              cost VARCHAR(10),
              package VARCHAR(16),
              location VARCHAR(16),              
              description VARCHAR(4096),
              author VARCHAR(16),
              time INT UNSIGNED,
              INDEX(part_num(128)),
              INDEX(qty(6)),
              INDEX(cost(10)),
              INDEX(package(16)),
              INDEX(location(16)),
              INDEX(author(16))
    '
  );

  createTable(
    'friends',
    'user VARCHAR(16),
              friend VARCHAR(16),
              INDEX(user(6)),
              INDEX(friend(6))'
  );

  createTable(
    'profiles',
    'user VARCHAR(16),
              text VARCHAR(4096),
              INDEX(user(6))'
  );
  ?>

  <br>...done.
</body>

</html>