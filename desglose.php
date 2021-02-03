<?php
// Desglose
$valor = ( empty ($_GET['dinero'] ) ? NULL : $_GET['dinero']);
$billetes = [1000, 500, 200, 100, 50, 20, 10, 5, 3, 1];
$centavos = [20, 5, 2, 1];
$desglose = array();
$desglose_quilos = array();
$i = 0;
$resto = explode(".", $valor);
$quilos = $resto[1];

if ($valor) {
    foreach($billetes as $billete) {
        if ($valor >= $billete) {
            $porcion = explode(".", $valor/$billete);
            $desglose[$i] = [$billete, $porcion[0]];
            $valor = $valor % $billete;
            $i++;
        }
    }
    $i = 0;
    foreach($centavos as $centavo) {
        if ($quilos >= $centavo) {
            $porcion = explode(".", $quilos/$centavo);
            $desglose_quilos[$i] = [$centavo, $porcion[0]];
            $quilos = $quilos % $centavo;
            $i++;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desglose de Dinero</title>
</head>
<body>
    <form action="desglose.php" method="get">
        <input type="text" name="dinero" id="dinero" value="<?php echo $_GET['dinero'] ?>" placeholder="Ejemplo: 2546.36"/>
        <button type="submit">Calcular</button>
    </form>
    <?php if($desglose) { ?>
    <table border="1">
        <thead>
        <tr>
            <th>Billete</th>
            <th>Cantidad</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($desglose as $moneda){ ?>
        <tr>
            <td>$ <?php echo $moneda[0]; ?></td>
            <td><?php echo $moneda[1]; ?></td>
        </tr>
        <?php } }?>
        </tbody>
        
        <?php if($desglose_quilos){ ?>
        <tr>
            <th>Moneda</th>
            <th>Cantidad</th>
        </tr>
        <?php foreach ($desglose_quilos as $monedas){ ?>
        <tr>
            <td><?php echo $monedas[0]; ?> ¢</td>
            <td><?php echo $monedas[1]; ?></td>
        </tr>
        <?php }} ?>
    </table>
</body>
</html>