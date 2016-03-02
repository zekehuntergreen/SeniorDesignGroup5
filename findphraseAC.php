<html>
<head>
<script data-cfasync="false" type="text/javascript">

var myAjax = ajax();
function ajax() {
        var ajax = null;
        if (window.XMLHttpRequest) {
                try {
                        ajax = new XMLHttpRequest();
                }
                catch(e) {}
        }
        else if (window.ActiveXObject) {
                try {
                        ajax = new ActiveXObject("Msxm12.XMLHTTP");
                }
                catch (e){
                        try{
                                ajax = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                        catch (e) {}
                }
        }
        return ajax;
}
function request(str) {
	//Don't forget to modify the path according to your theme
        myAjax.open("POST", "findphrase.php");
        myAjax.onreadystatechange = result;
        myAjax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        myAjax.send("search="+str);
}
function result() {
        if (myAjax.readyState == 4) {
                var liste = myAjax.responseText;
                var cible = document.getElementById('tag_update').innerHTML = liste;
               // document.getElementById('tag_update').style.display = "block";
        }
}
function selected(choice){
        var cible = document.getElementById('s');
        cible.value = choice;
        document.getElementById('tag_update').style.display = "none";
}
</script>
<style type="text/css">
#tag_update {
        display: block;
        border-left: 1px solid #373737;
        border-right: 1px solid #373737;
        border-bottom: 1px solid #373737;
        position:absolute;
        z-index:1;
}
#tag_update ul {
        margin: 0;
        padding: 0;
        list-style: none;
}
#tag_update li{
        display:block;
        clear:both;
}
#tag_update a {
        width:134px;
        display: block;
        padding: .2em .3em;
        text-decoration: none;
        color: #fff;
        background-color: #1B1B1C;
        text-align: left;
}
#tag_update a:hover{
        color: #fff;
        background-color: #373737;
        background-image: none;
}
</style>
<style type="text/css"></style>
</head>
<form method="get" id="searchform" action="findphrase.php">
    <div>
        <input autocomplete="off" type="text" value="" name="s" id="s" onkeyup="request(this.value);">
        <input type="submit" id="searchsubmit" value="Search" class="button">
    </div>
    <div id="tag_update"></div>
</form>
</html>