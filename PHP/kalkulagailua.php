<?php
$resultado = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero1 = $_POST["numero1"];
    $numero2 = $_POST["numero2"];
    $operacion = $_POST["operacion"];

    function calcular($num1, $num2, $operacion) {
        switch ($operacion) {
            case "suma":
                return $num1 + $num2;
            case "resta":
                return $num1 - $num2;
            case "multiplicacion":
                return $num1 * $num2;
            case "division":
                if ($num2 == 0) {
                    return "Error: División por cero";
                } else {
                    return $num1 / $num2;
                }
            default:
                return "Operación no válida";
        }
    }
    $resultado = calcular($numero1, $numero2, $operacion);
    echo "Resultado: " . $resultado;
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Calculadora PHP</title>
</head>

<br>
<br>
<br>

<body>
    <form action="./kalkulagailua.php" method="post">
        <input type="number" name="numero1" required>
        <input type="number" name="numero2" required>
        <select name="operacion">
            <option value="suma">Suma</option>
            <option value="resta">Resta</option>
            <option value="multiplicacion">Multiplicación</option>
            <option value="division">División</option>
        </select>
        <input type="submit" value="Calcular">
    </form>
</body>
</html>
