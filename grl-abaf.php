<?php
require_once 'search.php';

$resultado = array();
$json = json_decode(file_get_contents('grl-abaf.json'));
$search = new Search('produtos.csv');
$resultado = $search->items($json->codigo, $json->quantidade);
$total = 0;

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
                        <th>Quantidade</th>
                        <th>Valor Total</th>
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
                        <td>R$ <?= number_format($item->preco, 2, ',', '.') ?></td>
                        <td><?= $item->quantidade ?></td>
                        <td>R$ <?= number_format($item->subtotal, 2, ',', '.') ?></td>
                    </tr>
                    <?php 
                        $total = $total + $item->subtotal;
                    ?>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">
                            <strong>TOTAL</strong>
                        </td>
                        <td>
                            <strong>
                                R$ <?= number_format($total, 2, ',', '.') ?>
                            </strong>
                        </td>
                    </tr>
                </tfoot>
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