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
echo "<script> if(confirm( '请选择跳转页面，是跳转到yes.html  否跳转到no.html？ '))  
    location.href='test.php';else location.href='Report.php'; </script>";
?>
</body>
</html>