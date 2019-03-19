

<?php
echo '<script>console.log("Your stuff here")</script>';
if(isset($_POST['submit'])){

   echo '<script>console.log("Your stuff here")</script>';

  //when user clicks submit

  //load config file
  require "../config.php";

  try {
    //try connect to the DB:
    $connection = new PDO($dsn, $username, $password);
    $connection->setAttribute($options);

    $new_work = array(
      "artistname" => $_POST['artistname'],
      "worktitle" => $_POST['worktitle'],
      "workdate" => $_POST['workdate'],
      "worktype" => $_POST['worktype'],
    );

    $sql = "INSERT INTO works (artistname, worktitle, workdate, worktype)
     VALUES (:artistname, :worktitle, :workdate, :worktype);";

    //write to DB
    $statement = $connection->prepare($sql);
    $statement->execute($new_work);



  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();

    }

}

 ?>


 <?php include "template/header.php"; ?>

<form method="post">
  <label for="artistname">artistname</label>
  <input type="text" name="artistname" id="artistname">

  <label for="worktitle">worktitle</label>
  <input type="text" name="worktitle" id="worktitle">

  <label for="workdate"workdate>workdate</label>
  <input type="text" name="workdate" id="workdate">

  <label for="worktype">worktype</label>
  <input type="text" name="worktype" id="worktype">

  <input type="submit" name="submit" value="submit">

</form>

 <?php include "template/footer.php"; ?>
