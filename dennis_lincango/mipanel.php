<?php
session_start(); # Debe estar escrito al inicio 

if (isset($_POST["nombre"]) && isset($_POST["clave"])) {
    $_SESSION["s_nombre"] = $_POST["nombre"];
    $_SESSION["s_clave"] = $_POST["clave"];
}

if (!(isset($_SESSION["s_nombre"]) && (isset($_SESSION["s_clave"])))) {
    header("Location: index.php");
}

$guardarPreferencias = (isset($_POST["chkpreferencias"])) ? $_POST["chkpreferencias"] : "";
if ($guardarPreferencias != "") {
    setcookie("c_nombre", $_POST["nombre"], 0);
    setcookie("c_clave", $_POST["clave"], 0);
    setcookie("c_preferencias", $guardarPreferencias, 0);
}

$idiomaSelecionado = "";
if (isset($_COOKIE["idioma"])) {
    $idiomaSelecionado = $_COOKIE["idioma"];
} else {
    $idiomaSelecionado = "es";
}
?>

<html>

<head></head>

<body>
    <h1> PANEL PRINCIPAL </h1>
    <h2> Bienvenido Usuario:
        <?php echo $_SESSION["s_nombre"]; ?>
    </h2>

    <a href="idiomacookies.php?idioma=es"> ES (Español)</a>::<a href="idiomacookies.php?idioma=en"> EN (English)</a>
    <br>
    <p><a href="cerrarsesion.php?borrar=0"> Cerrar Sesión</a></p>
    <h1> Product List </h1>

    <?php
    $fp = fopen("categorias_$idiomaSelecionado.txt", "r"); # Abrimos el fichero
    #leemos el fichero utilizando un bucle. Usamos feof para comprobar si el puntero a un archivo está al final del archivo. 
    #Si feof ==TRUE significa que el puntero está al final del archivo
    while (!feof($fp)) {
        #fgets permite obtener una línea desde el puntero a un fichero
        $linea = fgets($fp);
        #imprimimos la línea
        echo $linea . "<br>";
    }
    ?>
</body>

</html>