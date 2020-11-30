<?php

/**
 * Class Search
 */
class Search
{
    /**
     * @var string
     */
    private $content;

    /**
     * @param Integer $codigo
     * @return array
     */
    public function item($codigo, $quantidade)
    {
        $matches = null;
        preg_match("/^{$codigo};.*/im", $this->content, $matches);
        return empty($matches) ? array() : array($this->hydrate($matches[0], $quantidade));
    }

    /**
     * @param Array $codigos
     * @param Array $quantidades
     */
    public function items($codigos, $quantidades)
    {
        $max = count($codigos);
        $resultado = array();

        for($i = 0; $i < $max; $i++)
        {
            $codigo = $codigos[$i];
            $quantidade = $quantidades[$i];

            $pivot = $this->item($codigo, $quantidade);

            if(!empty($pivot))
            {
                $resultado[] = $pivot[0];
            }
        }

        return $resultado;
    }

    /**
     * Search constructor.
     * @param String $database
     */
    public function __construct($database)
    {
        $this->content = file_get_contents($database);
    }

    private function hydrate($line, $quantidade)
    {
        $data = explode(";", $line);

        $item = new stdClass();
        $item->codigo = $data[0];
        $item->nome = $data[1];
        $item->medida = $data[2];
        $item->preco = floatval($data[3]);
        $item->fabricante = $data[4];
        $item->quantidade = $quantidade;
        $item->subtotal = floatval($data[3]) * intval($quantidade);

        return $item;
    }
}