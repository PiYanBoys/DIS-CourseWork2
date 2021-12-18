<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Report an incident</h1>
<form method="POST" class="yellow">
    Driver's License: &nbsp;<input type="text" name="licence"><br>
    Vehicle's Licence: <input type="text" name="plate"><br>
    Report: <input type="text" name="plate"><br>
    Date: <input id="date" type="date" name="date"><br>
    Type of Offence: <select name="offence">
        <option value="1">Speeding</option>
        <option value="2">Speeding on a motorway</option>
        <option value="3">Seat belt offence</option>
        <option value="4">Illegal parking</option>
        <option value="5">Drink driving</option>
        <option value="6">Driving without a licence</option>
        <option value="8">Traffic light offences</option>
        <option value="9">Cycling on pavement</option>
        <option value="10">Failure to have control of vehicle</option>
        <option value="11">Dangerous driving</option>
        <option value="12">Careless driving</option>
        <option value="13">Dangerous cycling</option>
    </select>
    <input type="submit" value="Submit">
</form>
<?php

?>
</body>
</html>
