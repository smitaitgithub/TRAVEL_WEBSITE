<?php
// Check if the form was submitted by verifying if 'name' is set in POST request
if (isset($_POST['name'])) {

    // Define database connection variables
    $server = "localhost";       // Database server, typically "localhost" for local development
    $username = "root";          // Database username, "root" for local server by default
    $password = "";              // Database password, empty by default for local server
    $database = "trip";          // Database name

    // Create a connection to the MySQL server and select the database
    $con = mysqli_connect($server, $username, $password, $database);

    // Check if the connection was successful
    if (!$con) {
        // Display an error message and stop the script if the connection failed
        die("Connection to this database failed due to " . mysqli_connect_error());
    }

    // Collect form data from POST request and store them in variables
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $desc = $_POST['desc'];

    // SQL query to insert form data into the 'trip' table
    $sql = "INSERT INTO `trip` (`name`, `age`, `gender`, `email`, `phone`, `other`, `dt`) 
            VALUES ('$name', '$age', '$gender', '$email', '$phone', '$desc', current_timestamp());";

    // Execute the SQL query and check if the insertion was successful
    if ($con->query($sql) === true) {
        // Display a success message
        echo "<h2>Successfully Inserted</h2>";
        echo "<p>Thank you, $name! Your details have been submitted.</p>";
        // Provide a link for the user to go back to the form
        echo "<p><a href='index.php'>Go back to the form</a></p>";
    } else {
        // Display an error message if the query failed
        echo "ERROR: $sql <br> $con->error";
    }

    // Close the database connection to free resources
    $con->close();

} else {  // Display the form if it hasn't been submitted

    // The HTML structure and form for user input
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome To Travel Form</title>
        <link rel="stylesheet" href="style.css"> <!-- Link to external CSS file -->
    </head>
    <body>
        <img class="bg" src="vincentiu-solomon-Z4wF0h47fy8-unsplash.jpg" alt="Nature"> <!-- Background image -->
        <div class="container">
            <h1>Welcome to GCET Greater Noida US Trip Form</h1>
            <p>Enter your details and submit this form to confirm your participation in the trip</p>
            <!-- Form that submits user input data to the same PHP file (index.php) using POST method -->
            <form action="index.php" method="post">
                <!-- Input fields for user details with placeholders and required validation -->
                <input type="text" name="name" id="name" placeholder="Enter your name" required>
                <input type="text" name="age" id="age" placeholder="Enter your age" required>
                <input type="text" name="gender" id="gender" placeholder="Enter your gender" required>
                <input type="email" name="email" id="email" placeholder="Enter your email" required>
                <input type="tel" name="phone" id="phone" placeholder="Enter your phone" required>
                <textarea name="desc" id="desc" cols="30" rows="10" placeholder="Enter any other information here"></textarea>
                <!-- Submit button to submit the form -->
                <button class="btn">Submit</button>
            </form>    
        </div>
        <!-- Link to an external JavaScript file, if needed -->
        <script src="index.js"></script>  
    </body>
    </html>
    <?php
}
?>
