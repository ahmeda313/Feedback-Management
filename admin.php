
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Admin Log-in</title>
</head>
<body>
    <header class="head">
        <nav class="head__nav">
        <ul class="list"><a href="student.php" class="nav_a">Home</a></ul>
    </nav></header>
    <hr>
    <h1>Admin log-in</h1>
    <main class="main">
        <div class="section">
            <form action="admin.php" method="POST">
                <table>
                <tr><td><label for="idnum" class="label">ID</label></td><td> <input type="text" id="idnum" name="id"><br></td></tr>
                <tr><td><label for="email" class="label">Email</label></td><td> <input type="email" id="email" name="email"><br></td></tr>
                <tr><td><label for="password" class="label">Password</label></td><td><input type="password" id="password" name="password"><br></td></tr>
            </table> 
                <div class="sub">
                    <input type="submit" value="login" name="submit" class="btn">
                </div>
            </form>
        </div>
    </main>
    <footer class="foot"></footer>
</body>
</html>
<?php
$con=mysqli_connect("localhost","root","root","review_system");
if(!$con){
    echo"Something went wrong";
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_POST["email"]) || empty($_POST["password"])){
        echo"please enter your details";
    }
    else{
        $id="{$_POST["id"]}";
        $email="{$_POST["email"]}";
        $password="{$_POST["password"]}";
        $query1="SELECT * FROM admin_details WHERE id ='$id'";
        $result=mysqli_query($con,$query1);
        if(mysqli_num_rows($result)>0){
            $row=mysqli_fetch_assoc($result);
                 if($row["email"]!=$email)echo"you have entered wrong email OR password";
                 elseif($row["password"]!=$password)echo"you have entered wrong email OR password";
                else{
                    $_SESSION["id"]=$id;
                    header("Location: adminportal.php");
                }
       
                }
        else{
            echo"user doesnt exist";
        }

    }
    }


?>