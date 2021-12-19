function loadDoc(path)
{
    var xmlhttp;
    if (window.XMLHttpRequest)
    {
        // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
        xmlhttp=new XMLHttpRequest();
    }
    else
    {
        // IE6, IE5 浏览器执行代码
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("POST",path,true);
    xmlhttp.send();
}

function loadDoc1(path)
{
    var xmlhttp;
    if (window.XMLHttpRequest)
    {
        // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
        xmlhttp=new XMLHttpRequest();
    }
    else
    {
        // IE6, IE5 浏览器执行代码
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("myDiv1").innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("POST",path,true);
    xmlhttp.send();
}

function openfile(file)
{
    window.location.href=file;
}

function alertHome()
{
    alert("Information updated. Return to home page");
    window.location.href="HomePage.html";
}

function alertLogin()
{
    alert("Login succeeded!");
    window.location.href="HomePage.html";
}

function alertChange()
{
    alert("Password Changed!");
    window.location.href="HomePage.html";
}