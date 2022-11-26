<?php
class ArrayList
{
    private static $inst;

    public static $estados = array(
        'AC' => 'Acre',
        'AL' => 'Alagoas',
        'AP' => 'Amapá',
        'AM' => 'Amazonas',
        'BA' => 'Bahia',
        'CE' => 'Ceará',
        'DF' => 'Distrito Federal',
        'ES' => 'Espírito Santo',
        'GO' => 'Goiás',
        'MA' => 'Maranhão',
        'MT' => 'Mato Grosso',
        'MS' => 'Mato Grosso do Sul',
        'MG' => 'Minas Gerais',
        'PA' => 'Pará',
        'PB' => 'Paraíba',
        'PR' => 'Paraná',
        'PE' => 'Pernambuco',
        'PI' => 'Piauí',
        'RJ' => 'Rio de Janeiro',
        'RN' => 'Rio Grande do Norte',
        'RS' => 'Rio Grande do Sul',
        'RO' => 'Rondônia',
        'RR' => 'Roraima',
        'SC' => 'Santa Catarina',
        'SP' => 'São Paulo',
        'SE' => 'Sergipe',
        'TO' => 'Tocantins',
        'EX' => 'Estrangeiro'
    );
    public static $categorias = array(
        'Promoções',
        'Kit Upgrade',
        'Cabos e Acessórios',
        'PC Gamer',
        'Hardware',
        'Periféricos',
        'Gabinetes',
        'Refrigeração',
        'Diversos',
        'Processador',
        'Placa de Vídeo'
    );
    public static $payStatus = array(
        'pendente',
        'pago',
        'cancelado'
    );
}

?>