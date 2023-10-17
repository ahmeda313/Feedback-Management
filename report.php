<?php
session_start();
require("db_connect.php");
$query="SELECT id,name, subject from faculty_details WHERE year='{$_POST["year"]}'and branch='{$_POST["branch"]}'and sem='{$_POST["sem"]}'";
$result=mysqli_query($con,$query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Report</title>
</head>
<body>
<header class="head">
    <nav class="head__nav">
    <ul class="list"><a href="#" class="nav_a">Home</a></ul>
    </nav></header>
    <hr>
    <h1>REPORT</h1>
    <main class="main">
<?php
    $i=0;
    while($row=mysqli_fetch_assoc($result)){
        $id=$row["id"];
        $num=mysqli_query($con,"SELECT COUNT(id)as count FROM feedback_data where id='$id'");
        $r=mysqli_fetch_assoc($num);
        $c=$r["count"];
        $sum_res=mysqli_query($con,"SELECT SUM(punctuality) as pun,  SUM(communication) as com, SUM(discipline) as discipline,SUM(discussion) as discussion,SUM(industrial_experience) as ind,SUM(teaching_aids) as tea, SUM(innovative) as ino, SUM(syllabus) as syl FROM feedback_data  where id='$id'");
        $sum=mysqli_fetch_assoc($sum_res);
        $pun[$i][]=$row["name"];
        $pun[$i][]=$row["subject"];
        $pun[$i][]=($sum["pun"]/(5*$c))*100;
        $pun[$i][]=($sum["com"]/(5*$c))*100;
        $pun[$i][]=($sum["discipline"]/(5*$c))*100;
        $pun[$i][]=($sum["discussion"]/(5*$c))*100;
        $pun[$i][]=($sum["ind"]/(5*$c))*100;
        $pun[$i][]=($sum["tea"]/(5*$c))*100;
        $pun[$i][]=($sum["ino"]/(5*$c))*100;
        $pun[$i][]=($sum["syl"]/(5*$c))*100;
        $i++;

 echo '
    <div class="alldiv">
    <div class="section">
    <table>
    <thead><td colspan="2">'.$row["name"].'</td><td class="table_head" colspan="5">'.$row["subject"].'</td></thead>
    <tr class="tr"><td colspan="2">Punctuality & Regularity</td>
    <td class="td">'.($sum["pun"]/(5*$c))*100 .'%</td></tr>
    <tr class="tr"><td colspan="2">Communication Skills</td>
    <td class="td">'.($sum["com"]/(5*$c))*100  .'%</td></tr>
    <tr class="tr"><td colspan="2">Class control & Discipline</td>
    <td class="td">'.($sum["discipline"]/(5*$c))*100 .'%</td></tr>
    <tr class="tr"><td colspan="2">Conducting the classroom discussion</td>
    <td class="td">'.($sum["discussion"]/(5*$c))*100 .'%</td></tr>
    <tr class="tr"><td colspan="2">Skill of linking subject to industrial experience & creating interest in the subject</td>
    <td class="td">'.($sum["ind"]/(5*$c))*100 .'%</td></tr>
    <tr class="tr"><td colspan="2">Use of teaching aids Greenboard/Whiteboard/PPT</td>
    <td class="td">'.($sum["tea"]/(5*$c))*100 .'%</td></tr>
<tr class="tr"><td colspan="2">Innovative teaching methods</td>
<td class="td">'.($sum["ino"]/(5*$c))*100 .'%</td>
</tr>
<tr class="tr"><td colspan="2">Syllabus coverage at appropriate pace</td>
<td class="td">'.($sum["syl"]/(5*$c))*100 .'%</td></tr>
</table>
</div>
</div>';
echo"<br/>";
        }
$_SESSION["som"]=$pun;
?>
<form action="download.php" method="POST">
<div class="alldiv">
    <!-- <div class="section"> -->
    <div class="sub">
        <!-- <input type="hidden" name="som" value="{$pun}"> -->
    <input type="submit" value="download" name="download" class="btn">
    <input type="submit" value="logout" name="logout" class="btn">
    </div>
    <!-- </div> -->
    </div>
    </form>

</main>
</body>
</html>
