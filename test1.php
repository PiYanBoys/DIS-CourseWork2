<html>
<body>
<form method="post">
    <select name="customers">
        <option value="APPLE">Apple Computer, Inc.</option>
        <option value="BAIDU ">BAIDU, Inc</option>
        <option value="Canon">Canon USA, Inc.</option>
        <option value="Google">Google, Inc.</option>
        <option value="Nokia">Nokia Corporation</option>
        <option value="SONY">Sony Corporation of America</option>
    </select>
    <input type="submit" value="submit">
</form>
<?php
echo $_POST['customers'];
?>
</body>
</html>