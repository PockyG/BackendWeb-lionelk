


<?php
// this code will only execute after the submit button is clicked


// include the config file
require "../config.php";
require "common.php";

// This code will only run if the delete button is clicked
if (isset($_GET["id"])) {
  // this is called a try/catch statement
    try {
        // define database connection
        $connection = new PDO($dsn, $username, $password, $options);

        // set id variable
        $id = $_GET["id"];

        // Create the SQL
        $sql = "DELETE FROM tasks WHERE id = :id";

        // Prepare the SQL
        $statement = $connection->prepare($sql);

        // bind the id to the PDO
        $statement->bindValue(':id', $id);

        // execute the statement
        $statement->execute();

        // Success message
        $success = "Work successfully deleted";

    } catch(PDOException $error) {
        // if there is an error, tell us what it is
        echo $sql . "<br>" . $error->getMessage();
    }

};

header("location: listview.php");

?>
