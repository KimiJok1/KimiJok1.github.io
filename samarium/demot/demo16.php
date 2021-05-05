<h1>Kertolasku</h1>
<form action="">
    Luku 1:
    <input type="text" id="luku1" name="luku1" onkeyup="laskeTulos()"><br />
    Luku 2:
    <input type="text" id="luku2" name="luku2" onkeyup="laskeTulos()"><br />
</form>
<h4>Tulos</h4>

<p><span id="txtTulos"></span></p>

<script>
    function laskeTulos() {
        let luku1 = document.getElementById("luku1").value;
        let luku2 = document.getElementById("luku2").value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "../demot/demo16b.php?luku1=" + luku1 + "&luku2=" + luku2, true);
        xmlhttp.onload = function () {
            document.getElementById("txtTulos").innerHTML = this.responseText;
        };
        xmlhttp.send();
    }
</script>