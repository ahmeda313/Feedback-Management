<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Student Log-in</title>
</head>
<body>
    <header class="head">
        <nav class="head__nav">
        <ul class="list"><a href="#" class="nav_a">Home</a></ul>
        <ul class="list"><a href="admin.php" class="nav_a">Admin Log-in</a></ul>
    </nav></header>
    <hr>
    <h1>Student log-in</h1>
    <main class="main">
        <div class="section">
            <form action="student.php" method="post">
                <table>
                    <tr><td><label for="rollnum" class="label">Roll number</label> </td><td><input type="text" id="rollnum" name="rollnum"><br></td></tr>
                    <tr><td><label for="password" class="label">Password</label></td><td><input type="password" id="password" name="password"><br></td></tr>
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
                      <tr><td><label for="sem" class="label">Semester</label></td><td>
                    <select name="sem" id="sem" class="select">
                        <option value="1">1</option>
                        <option value="2">2</option>
                      </select></td></tr></table>
                <div class="sub">
                    <input type="submit" value="login" name="login" class="btn">
                </div>
            </form>
        </div>
    </main>
    <footer class="foot"></footer>
</body>
</html>
<?php 
require("db_connect.php");
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["rollnum"]) || empty($_POST["password"])){
        echo"please enter all details";
    } 
    else{
    $sql="SELECT * FROM student_details WHERE rollnum ='{$_POST["rollnum"]}'";
    $result=mysqli_query($con,$sql);
    // if(mysqli_num_rows($result)==0)echo"user doesn't exist";
    if(mysqli_num_rows($result)==1){
        $row=mysqli_fetch_assoc($result);
        if($row["submit"]==true) die("you have already submitted the feedback");
        if($row["password"]!=$_POST["password"])echo"you have entered wrong details";
        elseif($row["branch"]!=$_POST["branch"])echo"you have entered wrong details";
        elseif($row["year"]!=$_POST["year"])echo"you have entered wrong details";
        elseif($row["sem"]!=$_POST["sem"])echo"you have entered wrong details";
        else{
            $_SESSION["rollnum"]=$_POST["rollnum"];
            $_SESSION["year"]=$_POST["year"];
            $_SESSION["branch"]=$_POST["branch"];
            $_SESSION["sem"]=$_POST["sem"];
            header("Location: main.php");
        }
    }
    else{
        echo"user doesn't exist";
    }
    }
}
?>