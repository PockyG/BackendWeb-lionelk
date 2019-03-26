
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
require "../config.php";
require "common.php";


$id = NULL;
if (isset($_POST['submit'])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);

        $id = $_GET['id'];
        //grab elements from form and set as varaible
        $work =[
          "id"         => $id,
          "name" => $_POST['name'],
          "description"  => $_POST['description'],
        ];

        // create SQL statement
        $sql = "UPDATE `tasks`
                SET id = :id,
                    name = :name,
                    description = :description
                WHERE id = :id";
        //prepare sql statement
        $statement = $connection->prepare($sql);

        //execute sql statement
        $statement->execute($work);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

    header("location: listview.php");
}

if (isset($_GET['id'])) {
    //yes the id exists

    try {
        // standard db connection
        $connection = new PDO($dsn, $username, $password, $options);

        // set if as variable
        $id = $_GET['id'];

        //select statement to get the right data
        $sql = "SELECT * FROM tasks WHERE id = :id";

        // prepare the connection
        $statement = $connection->prepare($sql);

        //bind the id to the PDO id
        $statement->bindValue(':id', $id);

        // now execute the statement
        $statement->execute();

        // attach the sql statement to the new work variable so we can access it in the form
        $work = $statement->fetch(PDO::FETCH_ASSOC);

    } catch(PDOExcpetion $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
} else {
    // no id, show error
    echo "No id - something went wrong";
    //exit;
};

 ?>


 <?php include "template/header.php"; ?>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<style type="text/css">
    body{ font: 14px sans-serif; }
    .wrapper{ width: 350px; padding: 20px; }
</style>
  <div class="wrapper">
      <h2>Update Todo</h2>
      <form method="post">
          <div class="form-group">
              <label>Task</label>
              <input type="text" name="name" class="form-control" id="name" value="<?php echo escape($work['name']); ?>">
          </div>
          <div class="form-group ">
              <label>Description</label>
              <textarea class="form-control" rows="5" name="description" id="description"><?php echo escape($work['description']); ?></textarea>
          </div>
          <div class="form-group">
              <input type="submit" class="btn btn-primary" value="Update Task" name="submit">
          </div>
      </form>
  </div>


 <?php include "template/footer.php"; ?>
