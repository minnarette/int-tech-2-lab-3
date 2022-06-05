<?php
include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab3</title>
    <script>
        var ajax = new XMLHttpRequest();

        function form1() {
            ajax.onreadystatechange = function() {
                if (ajax.readyState === 4) {
                    if (ajax.status === 200) {
                        console.dir(ajax.responseText);
                        document.getElementById("res").innerHTML = ajax.response;
                    }
                }
            }
            var group = document.getElementById("group").value;
            ajax.open("get", "1.php?group=" + group);
            ajax.send();
        }

        function form2() {
            ajax.onreadystatechange = function() {
                if (ajax.readyState === 4) {
                    if (ajax.status === 200) {

                        console.dir(ajax);
                        let rows = ajax.responseXML.firstChild.children;
                        let result = "Вывод запроса №2";
                        result += "<table border ='1'>";
                        result += "<tr><th>Teacher</th><th>Day</th><th>Number</th><th>Auditorium</th><th>Disciple</th><th>Type</th></tr>";
                        for (var i = 0; i < rows.length; i++) {
                            result += "<tr>";
                            result += "<td>" + rows[i].children[0].firstChild.nodeValue + "</td>";
                            result += "<td>" + rows[i].children[1].firstChild.nodeValue + "</td>";
                            result += "<td>" + rows[i].children[2].firstChild.nodeValue + "</td>";
                            result += "<td>" + rows[i].children[3].firstChild.nodeValue + "</td>";
                            result += "<td>" + rows[i].children[4].firstChild.nodeValue + "</td>";
                            result += "<td>" + rows[i].children[5].firstChild.nodeValue + "</td>";
                            result += "</tr>";
                        }
                        result += "</table>";
                        document.getElementById("res").innerHTML = result;
                    }
                }
            }
            var teacher = document.getElementById("teacher").value;
            ajax.open("get", "2.php?teacher=" + teacher);
            ajax.send();
        }

        

        function form3() {
            ajax.onreadystatechange = function() {
            console.dir(ajax);
            let rows = JSON.parse(ajax.responseText);
            console.dir(rows);
            if (ajax.readyState === 4) {
                if (ajax.status === 200) {
                    console.dir(ajax);
                    
                    let result = "Вывод запроса №3";
                    
                    result += "<table border ='1'>";
                    result += "<tr><th>Auditorium</th><th>Day</th><th>Number</th><th>Disciple</th><th>Type</th></tr>";
                    for (var i = 0; i < rows.length; i++) {
                        result += "<tr>";
                        result += "<td>" + rows[i].auditorium + "</td>";
                        result += "<td>" + rows[i].week_day + "</td>";
                        result += "<td>" + rows[i].lesson_number + "</td>";
                        result += "<td>" + rows[i].disciple + "</td>";
                        result += "<td>" + rows[i].type + "</td>";
                        result += "</tr>";
                    }
                    document.getElementById("res").innerHTML = result;
                }
            }
        };
            var auditorium = document.getElementById("auditorium").value;
            ajax.open("get", "3.php?auditorium=" + auditorium);
            ajax.send();
        }
    </script>
</head>

<body>
<p><strong>Мирошниченко Алина, КИУКИу-20-2, Лабораторная №3, Вариант 1<strong>
<p>
<!-- Вывод первого запроса -->
<p><strong> Вывести расписание занятий для группы </strong>
    <select name="group" id="group">
        <option>Группа</option>
        <?php
        $sql = "Select distinct groups.title from $db.groups";
        $sql = $dbh->query($sql);
        foreach ($sql as $cell) {
            echo "<option> $cell[0] </option>";
        }
        ?>
    </select>
    <button onclick="form1()">ОК</button>
</p>
<!-- Вывод второго запроса -->
<p><strong> Вывести расписание занятий для преподавателя </strong>
    <select name="teacher" id="teacher">
        <option>Преподаватель</option>
        <?php
        $sql = "Select distinct teacher.name from $db.teacher";
        $sql = $dbh->query($sql);
        foreach ($sql as $cell) {
            echo "<option> $cell[0] </option>";
        }
        ?>
    </select>
    <button onclick="form2()">ОК</button>
</p>

<!-- Вывод третьего запроса -->
<p><strong> Вывести расписание занятий для аудитории </strong>
    <select name="auditorium" id="auditorium">
        <option>Аудитория</option>
        <?php
        $sql = "Select distinct lesson.auditorium from $db.lesson";
        $sql = $dbh->query($sql);
        foreach ($sql as $cell) {
            echo "<option> $cell[0] </option>";
        }
        ?>
    </select>
    <button onclick="form3()">ОК</button>
</p>
<div id="res"></div>
</body>

</html>