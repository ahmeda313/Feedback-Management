<?php
session_start();
if(!isset($_SESSION["rollnum"])){
    header("Location: student.php");
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Feedback</title>
</head>
<body>
    <header class="head">
        <nav class="head__nav">
        <ul class="list"><a href="student.php" class="nav_a">Home</a></ul>
    </nav></header>
    <hr>
    <h1>Feedback page</h1>
    <main class="main">
    <form action="main.php" method="post"> 
<?php
require("db_connect.php");
$query="SELECT id,name, subject from faculty_details WHERE year='{$_SESSION["year"]}'and branch='{$_SESSION["branch"]}'and sem='{$_SESSION["sem"]}' order by id";
$result1=mysqli_query($con,$query);
// $n=mysqli_num_rows($result1);
$n;
$i=0;
while($row=mysqli_fetch_assoc($result1))
{
$n[$i]=$row["id"];
echo'
<div class="alldiv">
<div class="section">
<table>
    <thead><td colspan="2">' .$row["name"]. '</td><td class="table_head" colspan="5">'.$row["subject"].'</td></thead>
    <tr class="tr">
    <td colspan="2"> </td>
    <td class="rate_values"></td>
    <td class="rate_values">1</td>
    <td class="rate_values">2</td>
    <td class="rate_values">3</td>
    <td class="rate_values">4</td>
    <td class="rate_values">5</td></tr>
    <tr class="tr"><td colspan="2">Punctuality & Regularity</td>
    <td><input type="radio" class="hidden" name="Punctuality'.$i.'" value="0" checked></td>
    <td><input type="radio" name="Punctuality'.$i.'" value="1"></td>
    <td><input type="radio" name="Punctuality'.$i.'" value="2"></td>
    <td><input type="radio" name="Punctuality'.$i.'" value="3"></td>
    <td><input type="radio" name="Punctuality'.$i.'" value="4"></td>
    <td><input type="radio" name="Punctuality'.$i.'" value="5"></td></tr>
    <tr class="tr"><td colspan="2">Communication Skills</td>
    <td><input type="radio" class="hidden" name="communication'.$i.'" value="0" checked></td>
    <td><input type="radio" name="communication'.$i.'" value="1" ></td>
    <td><input type="radio" name="communication'.$i.'" value="2"></td>
    <td><input type="radio" name="communication'.$i.'" value="3"></td>
    <td><input type="radio" name="communication'.$i.'" value="4"></td>
    <td><input type="radio" name="communication'.$i.'" value="5"></td></tr>
    <tr class="tr"><td colspan="2">Class control & Discipline</td>
    <td><input type="radio" class="hidden" name="Discipline'.$i.'" value="0" checked></td>
    <td><input type="radio" name="Discipline'.$i.'" value="1" ></td>
    <td><input type="radio" name="Discipline'.$i.'" value="2"></td>
    <td><input type="radio" name="Discipline'.$i.'" value="3"></td>
    <td><input type="radio" name="Discipline'.$i.'" value="4"></td>
    <td><input type="radio" name="Discipline'.$i.'" value="5"></td></tr>
    <tr class="tr"><td colspan="2">Conducting the classroom discussion</td>
    <td><input type="radio" class="hidden" name="discussion'.$i.'" value="0" checked></td>
    <td><input type="radio" name="discussion'.$i.'" value="1"></td>
    <td><input type="radio" name="discussion'.$i.'" value="2"></td>
    <td><input type="radio" name="discussion'.$i.'" value="3"></td>
    <td><input type="radio" name="discussion'.$i.'" value="4"></td>
    <td><input type="radio" name="discussion'.$i.'" value="5"></td></tr>
    <tr class="tr"><td colspan="2">Skill of linking subject to industrial experience & creating interest in the subject</td>
    <td><input type="radio" class="hidden" name="industrial_experience'.$i.'" value="0" checked></td>
    <td><input type="radio" name="industrial_experience'.$i.'" value="1"></td>
    <td><input type="radio" name="industrial_experience'.$i.'" value="2"></td>
    <td><input type="radio" name="industrial_experience'.$i.'" value="3"></td>
    <td><input type="radio" name="industrial_experience'.$i.'" value="4"></td>
    <td><input type="radio" name="industrial_experience'.$i.'" value="5"></td></tr>
    <tr class="tr"><td colspan="2">Use of teaching aids Greenboard/Whiteboard/PPT</td>
    <td><input type="radio" class="hidden" name="teaching_aids'.$i.'" value="0" checked></td>
    <td><input type="radio" name="teaching_aids'.$i.'" value="1"></td>
    <td><input type="radio" name="teaching_aids'.$i.'" value="2"></td>
    <td><input type="radio" name="teaching_aids'.$i.'" value="3"></td>
    <td><input type="radio" name="teaching_aids'.$i.'" value="4"></td>
    <td><input type="radio" name="teaching_aids'.$i.'" value="5"></td></tr>
    <tr class="tr"><td colspan="2">Innovative teaching methods</td>
    <td><input type="radio" class="hidden" name="Innovative'.$i.'" value="0" checked></td>
    <td><input type="radio" name="Innovative'.$i.'" value="1"></td>
    <td><input type="radio" name="Innovative'.$i.'" value="2"></td>
    <td><input type="radio" name="Innovative'.$i.'" value="3"></td>
    <td><input type="radio" name="Innovative'.$i.'" value="4"></td>
    <td><input type="radio" name="Innovative'.$i.'" value="5"></td></tr>
    <tr class="tr"><td colspan="2">Syllabus coverage at appropriate pace</td>
    <td><input type="radio" class="hidden" name="Syllabus_coverage'.$i.'" value="0" checked></td>
    <td><input type="radio" name="Syllabus_coverage'.$i.'" value="1"></td>
    <td><input type="radio" name="Syllabus_coverage'.$i.'" value="2"></td>
    <td><input type="radio" name="Syllabus_coverage'.$i.'" value="3"></td>
    <td><input type="radio" name="Syllabus_coverage'.$i.'" value="4"></td>
    <td><input type="radio" name="Syllabus_coverage'.$i.'" value="5"></td></tr>
    </table>
    </div>
    </div>
    ';
    $i++;
}
$j=0;
if(isset($_POST["submit"])){
    while($j<$i){
    // $query2="UPDATE feedback_data set punctuality=punctuality+{$_POST["Punctuality$j"]},communication=communication+'{$_POST["communication$j"]}',discipline=discipline+'{$_POST["Discipline$j"]}',discussion=discussion+'{$_POST["discussion$j"]}',industrial_experience=industrial_experience+'{$_POST["industrial_experience$j"]}',teaching_aids=teaching_aids+'{$_POST["teaching_aids$j"]}',Innovative=Innovative+'{$_POST["Innovative$j"]}', syllabus=syllabus+'{$_POST["Syllabus_coverage$j"]}' where id='{$n["$j"]}'";
    $query3="INSERT INTO feedback_data values ('{$n["$j"]}','{$_SESSION["rollnum"]}',{$_POST["Punctuality$j"]},{$_POST["communication$j"]},{$_POST["Discipline$j"]},{$_POST["discussion$j"]},{$_POST["industrial_experience$j"]},{$_POST["teaching_aids$j"]},{$_POST["Innovative$j"]},{$_POST["Syllabus_coverage$j"]})";
    $result2=mysqli_query($con,$query3);
    $j++;
}
mysqli_query($con,"update student_details set submit=false  where rollnum='{$_SESSION["rollnum"]}'; ");
session_unset();
session_destroy();
// header("Location: thank.php");
echo"<script> window.location.href='thank.php'</script>";
}
// print_r($n);
?>
<div class="alldiv">
    <div class="sub">
<!-- <input type="submit" value="logout" name="logout" class="btn"> -->
<input type="submit" value="submit" name="submit" class="btn">
</div>
</div>

</form>

</main>
<footer class="foot"></footer>
    
</body>
</html>

<!-- // if(isset($_POST["submit"])){
//     header("Location: thank.php");
// }
// if(isset($_POST["logout"])){
//     session_unset();
//     session_destroy();
//     header("Location: student.php");
// } -->

