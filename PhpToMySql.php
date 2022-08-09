<!DOCTYPE html>

<html >
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Get integer number from sensor</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CssShape.css">

</head>
<body>

    <div class="container">
      
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname="mission3";

        //---------------------------------------------------------------
        // STEP 1 Create connection if you alerady have database
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        //---------------------------------------------------------------
        /* Step 2 create table if you don't have
        $sql = "CREATE TABLE sensor (
          SensorValue INT(8) 
          )";
          if ($conn->query($sql) === TRUE) {
            echo "Table Sensor created successfully";
          } else {
            echo "Error creating table: " . $conn->error;
          }*/

        //---------------------------------------------------------------
        //   Step 3 call the input action from the html 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          // collect value of input field
          $value = $_POST['value'];
          if (empty($value)) {
            echo "Value is empty";
            exit(0);
          } else {
            echo "The Sensor value: ".$value." has been add to the database successfully"."<br>";
          }
        }

        //---------------------------------------------------------------
        //  Step 4 insert the number in the database
        $sql1 = "INSERT INTO sensor VALUES ('$value')";
        $conn->query($sql1);

        //---------------------------------------------------------------
        //Step 5 show all the number in the database
        $sql = "SELECT SensorValue FROM sensor";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          // output data of each row
          $count=1;
          while($row = $result->fetch_assoc()) {
            echo "<br>"."Sensor Value ID: ".$count." is " . $row["SensorValue"];
            $count=$count+1;
          }
        } else {
          echo "0 results";
        }

        //---------------------------------------------------------------
        $conn->close();
        ?>
</div>

</body>
</html>