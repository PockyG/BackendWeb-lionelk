




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
// this code will only execute after the submit button is clicked


    // include the config file that we created before
    require "../config.php";

    // this is called a try/catch statement
	try {
        // FIRST: Connect to the database
        $connection = new PDO($dsn, $username, $password, $options);

        $currentuser = $_SESSION["username"];
        // SECOND: Create the SQL
        $sql = "SELECT * FROM tasks WHERE username='$currentuser'";
          // $sql = "SELECT * FROM works WHERE id=1";

        // THIRD: Prepare the SQL
        $statement = $connection->prepare($sql);
        $statement->execute();

        // FOURTH: Put it into a $result object that we can access in the page
        $result = $statement->fetchAll();
	} catch(PDOException $error) {
        // if there is an error, tell us what it is
		echo $sql . "<br>" . $error->getMessage();
	}

?>


<?php include 'template/header.php'; ?>

<h2><?php echo htmlspecialchars($_SESSION["username"]); ?>'s Todo List</h2>
<?php
        //if there are some results
        if ($result && $statement->rowCount() > 0) { ?>





<?php
                // This is a loop, which will loop through each result in the array
                foreach($result as $row) {
            ?>
            <div class="card" style="width: 18rem; background:transparent url('assets/notelines.jpg'); ">
              <div class="card-body">
                <h5 class="card-title"><?php echo $row["name"]; ?> </h5>
                <h6 class="card-subtitle mb-2 text-muted"><?php echo $row["created_at"]; ?></h6>
                <p class="card-text"><?php echo $row["description"]; ?></p>


  <button class="btn-trash"  onclick="location.href='deletetask.php?id=<?php echo $row['id']; ?>'"><i class="fa fa-trash"></i></button>
  <button class="btn-edit" onclick="location.href='updatetask.php?id=<?php echo $row['id']; ?>'"><i class="fa fa-edit"></i></button>
              </div>
            </div>

<!-- <p>
    ID:
    <?php echo $row["id"]; ?><br> Artist Name:
    <?php echo $row['artistname']; ?><br> Work Title:
    <?php echo $row['worktitle']; ?><br> Work Date:
    <?php echo $row['workdate']; ?><br> Work type:
    <?php echo $row['worktype']; ?><br>
</p> -->
<?php
            // this willoutput all the data from the array
            //echo '<pre>'; var_dump($row);
        ?>

<hr>
<?php }; //close the foreach
        };

?>


<a href="createtask.php" class="btn btn-success">Create Todo</a>
<a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>


<?php include 'template/footer.php'; ?>
