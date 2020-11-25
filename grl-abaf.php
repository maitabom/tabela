<?php
require_once 'search.php';

$resultado = array();
$json = json_decode(file_get_contents('grl-abaf.json'));
$search = new Search('produtos.csv');
$resultado = $search->items($json->codigo);

?>
<!doctype html>
<html>

<head>
    <title>Mario Loucas - Consulta na pagina</title>
</head>

<body>
    <font face=Arial>
        <form method="post" action="index.php">

        </form>

        <h2>Consulta de Preços na Página com QR Code</h2>
        <?php if (!empty($resultado)): ?>
        <font size=2>
            <table border="1">
                <thead>
                    <tr>
                        <th>
                            <font color=red>Código</font>
                        </th>
                        <th>Nome</th>
                        <th>Fabricante</th>
                        <th>Medida</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultado as $item): ?>
                    <tr>
                        <td>
                            <font color=red><b><?= $item->codigo ?></b></font>
                        </td>
                        <td><?= $item->nome ?></td>
                        <td><?= $item->fabricante ?></td>
                        <td><?= $item->medida ?></td>
                        <td>R$ <?= $item->preco ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </font>
        <?php else: ?>
        <p>
        <h3><b>
                <font color=red>Código não encontrado</font>
            </b></h3>
        </p>
        <?php endif; ?>
    </font>
</body>

</html>