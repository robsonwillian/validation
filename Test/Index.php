<?php

declare(strict_types=1);

namespace brunoconte3\Test;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use brunoconte3\Validation\{
    Arrays,
    Format,
    Validator
};

$datas = [
    'texto' => 'abc',
    'teste' => 'a',
    'testeInt' => '1a23',
    'testeBool' => '1e',
    'testeFloat' => '35,3',
    'testeNumeric' => '59.6a',
    'senhaAlphaNumNoSpace' => '59.6a',
    'nomeAlphaNum' => 'Bru Con 457 !@',
    'campoSomenteTexto' => 'José da Silva1',
    'textoSemAscentos' => 'Téste',
    'textoMaiusculo' => 'NOME comPLETO',
    'textoMinusculo' => 'nome Completo',
    'validarValores' => 'SA',
    'validarEspaco' => 'BRU C',
    'validaJson' => '
        "nome": "Bruno"
    }',
    'validaMes' => 13,
    'cpfOuCnpn' => '83.113.366.0001/01'
];

//Aceita divisao das regras por PIPE ou formato JSON
$rules = [
    'texto' => 'required|min:5, Mensagem customizada aqui|max:20',
    'teste' => 'array',
    'testeInt' => 'int|convert',
    'testeBool' => 'bool|convert',
    'testeFloat' => 'convert|float',
    'testeNumeric' => 'convert|numeric',
    'senhaAlphaNumNoSpace' => 'alphaNumNoSpecial',
    'nomeAlphaNum' => 'alphaNum',
    'campoSomenteTexto' => 'alpha',
    'textoSemAscentos' => 'alphaNoSpecial',
    'textoMaiusculo' => 'upper',
    'textoMinusculo' => 'lower',
    'validarValores' => 'arrayValues:S-N-T',
    'validarEspaco' => 'notSpace',
    'validaJson' => 'type:json',
    'validaMes' => 'numMonth',
    'cpfOuCnpn' => 'identifierOrCompany'
];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>brunoconte3/validation</title>

    <style>
        body {
            padding: 0px;
            margin: 0px;
            background: #F8F9FA;
        }

        .container {
            width: auto;
            max-width: 1280px;
            padding: 15px 15px;
            margin-right: auto;
            margin-left: auto;
        }

        .container>header#body-title-page>h1 {
            margin: 0px;
            text-align: center;
            color: green;
        }

        .container>header#body-title-page>small {
            display: block;
            width: 100%;
            text-align: center;
        }

        .container>section.body-section-class {
            padding: 20px;
            margin-top: 30px;
            background: #EEEEEE;
            border: 1px solid #eee;
            border-radius: .25rem;
        }

        .container>section.body-section-class>h3 {
            margin: 0px 0px 15px 0px;
        }

        .container>section.body-section-class>div.item-section-class {
            display: block;
            width: 100%;
            height: auto;
        }

        .container>section.body-section-class>div.item-section-class>p {
            margin: 30px 0px 10px 0px;
        }

        .container>section.body-section-class>div.item-section-class>ol {
            margin: 30px 0px 10px 0px;
            padding-left: 15px;
        }

        .container>section.body-section-class>div.item-section-class>ol>li {
            padding: 2px 0px;
        }

        .container>section.body-section-class>div.item-section-class>div {
            background: rgb(255, 255, 255);
            padding: 15px;
            border: 1px solid #eee;
            border-left: 4px solid #4CAF50;
            overflow-x: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <header id="body-title-page">
            <h1>Brunoconte3/Validation</h1>
            <small>Versão 4.17.2</small>
        </header>

        <!-- Validação de dados -->
        <section class="body-section-class">
            <h3># Validação de dados</h3>

            <div class="item-section-class">
                <p>$validator->set($datas, $rules)</p>
                <div>
                    <?php
                    $validator = new Validator();
                    Format::convertTypes($datas, $rules);
                    $validator->set($datas, $rules);

                    echo 'Itens a validar: ' . count($datas) . '<hr>';
                    if (!$validator->getErros()) {
                        echo 'Dados válidados com sucesso!';
                    } else {
                        echo 'Itens Validados: ' . count($validator->getErros()) . '<hr>';
                        var_dump($validator->getErros());
                    }
                    ?>
                </div>
            </div>
        </section>
    </div>
</body>

</html>
