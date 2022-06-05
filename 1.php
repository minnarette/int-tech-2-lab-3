<?php
include "connection.php";
if (isset($_REQUEST["group"])) {
    try{
    $group = $_REQUEST["group"];
    $statement = $dbh->prepare(
        "SELECT * from $db.groups 
        join $db.lesson_groups on $db.groups.ID_Groups = $db.lesson_groups.FID_Groups 
        join $db.lesson 
        on $db.lesson_groups.FID_Lesson2=$db.lesson.ID_Lesson 
        where $db.groups.title = :groups"
    );
    $statement->execute(array('groups'=>$group));
    echo "Вывод запроса №1";
    echo "<table border ='1'>";
    echo "<tr><th>Group</th><th>Day</th><th>Number</th><th>Auditorium</th><th>Disciple</th><th>Type</th></tr>";
    while($cell=$statement->fetch(PDO::FETCH_BOTH)){
        $day = $cell[5];
        $number = $cell[6];
        $auditorium = $cell[7];
        $disciple = $cell[8];
        $type = $cell[9];
        echo "<tr><td>$group</td><td>$day</td><td>$number</td><td>$auditorium</td><td>$disciple</td><td>$type</td></tr>"; 
    }
    echo "</table>";
    }catch(PDOException $e){
        echo "Ошибка " . $e->getMessage();

    }
}
?>