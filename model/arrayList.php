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
    public static function getAccountInfo(UsuariosDTO $user)
    {
        // require_once '../model/dto/UsuariosDTO.php';

        $arrayList = array(
            // ':nome' => filter_var($user->getNome(), FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            // ':email' => filter_var($user->getEmail(), FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            // ':senha' => filter_var($user->getSenha(), FILTER_SANITIZE_FULL_SPECIAL_CHARS),

            // ':salario' => filter_var($user->getSalario(), FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            // ':admissao' => filter_var($user->getAdmissao(), FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            // ':demissao' => filter_var($user->getDemissao(), FILTER_SANITIZE_FULL_SPECIAL_CHARS),

            ':telefone' => filter_var($user->getTelefone(), FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            ':cpf' => filter_var($user->getCpf(), FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            ':rg' => filter_var($user->getRg(), FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            ':cnpj' => filter_var($user->getCnpj(), FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            ':ie' => filter_var($user->getIe(), FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            ':cep' => filter_var($user->getCep(), FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            ':estado' => filter_var($user->getEstado(), FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            ':cidade' => filter_var($user->getCidade(), FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            ':endereco' => filter_var($user->getEndereco(), FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            ':numero' => filter_var($user->getNumero(), FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            ':complemento' => filter_var($user->getComplemento(), FILTER_SANITIZE_FULL_SPECIAL_CHARS)
        );
        return $arrayList;
    }
}

?>