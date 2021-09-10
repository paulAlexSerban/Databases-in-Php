<?php include "./db_connection.php";
      include './functions.php';
      include "./head.php";
      setDatabaseConnection(); ?>


  <div class='container'>
    <div class="col-sm-6">
      <form action="login.php" method="post">
        <div class="form-group">
          <label class="form-label" for="username">Username</label>
          <input type="text" class="form-control" name="username">
        </div>
        <div class="form-group">
          <label class="form-label" for="password">Password</label>
          <input type="password" class="form-control" name="password">
        </div>
        <br>
        <input class="btn btn-primary" type="submit" value="Submit" name="submit">
      </form>
    </div>
  </div>
  <br>
  <hr>
  <div class="container">
    <div class="col-sm-6">
      <?php

        if(isset($_POST['submit'])) {
          $sub_username = $_POST['username'];
          $sub_password = $_POST['password'];

          if($sub_username && $sub_password) {
            echo "<p>" . $sub_username . " your password is " . $sub_password . "</p>";
            echo '<hr>';

            addUser($sub_username, $sub_password, $connection);
          } else {
            echo '<p>NO field should be left blank</p>';
          }
        }

        getUsers($connection);

      ?>
    </div>
  </div>
</body>

</html>