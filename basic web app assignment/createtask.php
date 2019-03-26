
<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<?php
if(isset($_POST['submit'])){

  //when user clicks submit

  //load config file
  require "../config.php";

  try {
    //try connect to the DB:
    $connection = new PDO($dsn, $username, $password);
    $connection->setAttribute($options);

    $new_work = array(
      "name" => $_POST['name'],
      "description" => $_POST['description'],
      "done" => "false",
      "username" => $_SESSION["username"],
    );

    $sql = "INSERT INTO tasks (name, description, done, username)
     VALUES (:name, :description, :done, :username);";

    //write to DB
    $statement = $connection->prepare($sql);
    $statement->execute($new_work);




  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();

    }

    header("location: listview.php");

}

 ?>


 <?php include "template/header.php"; ?>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<style type="text/css">
    body{ font: 14px sans-serif; }
    .wrapper{ width: 350px; padding: 20px; }
</style>
  <div class="wrapper">
      <h2>Task Name</h2>
      <form method="post">
          <div class="form-group">
              <label>Task</label>
              <input type="text" name="name" class="form-control" id="name">
          </div>
          <div class="form-group ">
              <label>Description</label>
              <textarea class="form-control" rows="5" name="description" id="description"></textarea>
          </div>
          <div class="form-group">
              <input type="submit" class="btn btn-primary" value="Add Task" name="submit">
          </div>
      </form>
  </div>


 <?php include "template/footer.php"; ?>
