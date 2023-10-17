<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="head">
        <nav class="head__nav">
        <ul class="list"><a href="#" class="nav_a">Home</a></ul>
    </nav></header>
    <hr>
    <h1>Select below options to view report</h1>
<main class="main">
        <div class="section adminportal">
            <form action="report.php" method="post">
            <b>Give Details to view feedback </b>
                <table>
                <tr><td><label for="branch" class="label">Branch</label></td><td>
                <select name="branch" id="branch" class="select">
                    <option value="cse">CSE</option>
                    <option value="ece">ECE</option>
                    <option value="eee">EEE</option>
                    <option value="mec">MEC</option>
                    <option value="civil">CIVIL</option>
                    <option value="it">IT</option>
                    <option value="ecm">ECM</option>
                  </select></td></tr>
                  <tr><td><label for="year" class="label">Year</label></td><td>
                    <select name="year" id="year" class="select">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                      </select></td></tr>
                      <tr><td><label for="sem" class="label">semester</label></td><td>
                    <select name="sem" id="sem" class="select">
                        <option value="1">1</option>
                        <option value="2">2</option>
                      </select></td></tr></table>
                <div class="sub">
                    <input type="submit" value="Get" name="get" class="btn">
                </div>
            </form>
            </div>
            <div class="section" >
            <b>Upload Details to Create feedback form</b>
            <form action="adminportal.php" method="POST" enctype="multipart/form-data">
            <table>
                <tr><td><label for="branch" class="label">Branch</label></td><td>
                <select name="branch" id="branch" class="select">
                    <option value="cse">CSE</option>
                    <option value="ece">ECE</option>
                    <option value="eee">EEE</option>
                    <option value="mec">MEC</option>
                    <option value="civil">CIVIL</option>
                    <option value="it">IT</option>
                    <option value="ecm">ECM</option>
                  </select></td></tr>
                  <tr><td><label for="year" class="label">Year</label></td><td>
                    <select name="year" id="year" class="select">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                      </select></td></tr>
                      <tr><td><label for="sem" class="label">semester</label></td><td>
                    <select name="sem" id="sem" class="select">
                        <option value="1">1</option>
                        <option value="2">2</option>
                      </select></td></tr></table>
            <input type="file" name="file" required>
            <input type="submit" value="upload" name="upload" class="btn" >
            </form>
            <sub>file must only contain faculty id, faculty name, subject</sub>

        </div>
    </main>
    <table>

<?php
require("db_connect.php");
// upload csv file and update faculty details table
if(isset($_POST["upload"])){
    $file=$_FILES["file"]["tmp_name"];
    $h=fopen("$file","r");
    while($w=fgetcsv($h,100,",")){
        // echo"<tr>
        // <td>{$w[0]}</td>
        // <td>{$w[1]}</td>
        // <td>{$w[2]}</td>
        // <td>{$w[3]}</td>
        // <td>{$w[4]}</td>
        // <td>{$w[5]}</td>
        // </tr>";
        try{
        $query="INSERT INTO faculty_details values('{$w[0]}','{$w[1]}','{$w[2]}','{$_POST["year"]}','{$_POST["branch"]}','{$_POST["sem"]}')";
        $res=mysqli_query($con,$query);
        }
        catch(Exception){
            echo"Something went wrong";
            die();
        }
    } 
          
}
echo"</table><table border='0.1'>";
$query2="SELECT * FROM faculty_details where year='{$_POST["year"]}' and branch='{$_POST["branch"]}' and sem='{$_POST["sem"]}'";
$res2=mysqli_query($con,$query2);
while($row=mysqli_fetch_assoc($res2)){
        echo"<tr>
        <td>{$row["id"]}</td>
        <td>{$row["name"]}</td>
        <td>{$row["subject"]}</td>
        <td>{$row["year"]}</td>
        <td>{$row["branch"]}</td>
        <td>{$row["sem"]}</td>
        <td><input type='button' value='edit' name='edit'></td>
        <td><input type='button' value='delete' name='delete'></td>
        </tr>";
}

?>
</table>
</body>
</html>