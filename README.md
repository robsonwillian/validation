# Validator

O Validator é baseado em PHP 7 que permite validar vários tipos de dados.

Aplicado padrão da PSR-12.

Possui Validates com assuntos específicos, onde pode validar isoladamente alguns itens que desejar.

Classe de Formatação, onde contempla opções de formatação para seus dados.

# Instalação

via composer.json

```
"brunoconte3/validation": "4.12.0"
```

via composer.

```
$ composer require brunoconte3/validation
```

# Exemplo de Validação dos dados

`Dados`

```php
$datas = [
   'nome'  => 'brunoconte3',
   'email' => 'brunoconte3@gmail.com',
   'validarPassandoJson' => '@&451',
];
```

`Regras`

```php
$rules = [
   'nome'  => 'required|regex:/^[a-zA-Z\s]+$/',
   'email' => 'required|email|max:50',
   'validarPassandoJson' => '{"required":"true","type":"alpha"}',
];
```

`Validando os dados de acordo com as regras`

```php
  $validator = new brunoconte3\Validation\Validator();

  $validator->set($datas, $rules);

  //Verificando a validação
  if(!$validator->getErros()){
       echo 'Dados válidados com sucesso!';
   } else {
       var_dump($validator->getErros());
   }
```

# Usando

```php
<?php

require 'vendor/autoload.php';

use brunoconte3\Validation\Validator;

 $datas = [
    'sexo' => '',
    'telefone' => '44999696',
    'cpf' => '12547845874',
    'nome' => 'a',
    'numero' => 12345678,
    'email' => 'bruno.com',
    'msgCustom' => 'abc',
    'validarPassandoJson' => '@&451',
    'tratandoTipoInt' => '12',
    'tratandoTipoFloat' => '9.63',
    'tratandoTipoBoolean' => 'true',
    'tratandoTipoNumeric' => '11',
    'validarValores' => 'SA',
    'validaJson' => '{
        "nome": "Bruno"
    }'
];

$rules = [
    'sexo' => 'required',
    'telefone' => 'required|phone',
    'cpf' => 'required|identifier',
    'nome' => 'required|min:2',
    'numero' => 'max:5',
    'email' => 'email',
    'msgCustom' => 'required|min:5, Mensagem customizada aqui|max:20',
    'validarPassandoJson' => '{"required":"true","type":"alpha"}',
    'tratandoTipoInt' => 'convert|int',
    'tratandoTipoFloat' => 'float|convert',
    'tratandoTipoBoolean' => 'convert|bool',
    'tratandoTipoNumeric' => 'numeric|convert',
    'validarValores' => 'arrayValues:S-N-T',  //Opções aceitas [S,N,T]
    'validaJson' => 'type:json'
];

$validator = new Validator();
Format::convertTypes($datas, $rules);
$validator->set($datas, $rules);

if (!$validator->getErros()) {
    echo 'Dados válidados com sucesso!';
} else {
    echo '<pre>';
    print_r($validator->getErros());
}
```

# Tipos de validação (validators)

- required: `Define o campo como obrigatório.`
- min: `Define o tamanho mínimo do valor.`
- max: `Define o tamanho máximo do valor.`
- alpha: `Verifica se o campo contém somentes caracteres alfabéticos.`
- alphaNoSpecial: `Verifica se o campo contém caracteres texto regular, não pode ter ascentos.`
- alphaNum: `Verifica se o campo contém caracteres alfanuméricos.`
- alphaNumNoSpecial: `Verifica se o campo contém letras sem ascentos, números, não pode carácter especial.`
- array: `Verifica se a variável é um array.`
- arrayValues: `Verifica se a variável possui uma das opções do array especificado.`
- bool: `Valores do tipo lógico.` `Ex: true ou false, 1 ou 0, yes ou no.`
- companyIdentification: `Valida se o CNPJ é válido, passando CNPJ com ou sem mascara`
- dateBrazil `Valida se a data brasileira é valida.`
- dateAmerican `Valida se a data americana é valida.`
- email: `Verifica se é um email válido.`
- float: `Verifica se o valor é do tipo flutuante(valor real).`
- identifier: `Valida se o CPF é válido, passando CPF com ou sem mascara`
- hour `Valida se a hora é valida.`
- int: `Verifica se o valor é do tipo inteiro.`
- ip: `Verifica se o valor é um endereço de IP válido.`
- json `Verifica se o valor é um json válido.`
- lower: `Verifica se todos os caracteres são minúsculos.`
- mac: `Verifica se o valor é um endereço de MAC válido.`
- noWeekend `Verifica se a data (Brasileira ou Americada não é um Final de Semana).`
- numeric: `Verifica se o valor contém apenas valores numéricos (Aceita zero a esquerda).`
- numMonth `Verifica se o valor é um mês válido (1 a 12).`
- notSpace: `Verifica se a string contém espaços.`
- optional: `Se inserido, só valida se o valor vier diferente de vazio, null ou false.`
- phone: `Verifica se o valor corresponde a um telefone válido. (DDD + NÚMEROS) 10 ou 11 dígitos`
- plate: `Verifica se o valor corresponde ao formato de uma placa de carro.`
- regex: `Define uma regra para o valor através de uma expressão regular.`
- upper: `Verifica se todos os caracteres são maiúsculas.`
- url: `Verifica se o valor é um endereço de URL válida.`
- zip_code: `Verifica se o valor corresponde ao formato de um CEP.`

# Definindo mensagem personalizada

Após definir algumas de nossas regras aos dados você também pode adicionar uma mensagem personalizada usando o delimitador ',' em alguma regra específica ou usar a mensagem padrão.

`Exemplo:`

```php
<?php

    $validator->set($datas, [
        'nome'  => 'required, O campo nome não pode ser vazio.',
        'email' => 'email, O campo email esta incorreto.|max:50',
        'senha' => 'min:8, no mínimo 8 caracteres.|max:12, no máximo 12 caracteres.',
    ]);
```

# Formatação Exemplos

```php
<?php

require 'vendor/autoload.php';

use brunoconte3\Validation\Format;

echo Format::telephone('44999998888') . '<br>';  //Formata Telefone ==> (44) 99999-8888
echo Format::identifier('73381209000') . '<br>';  //Formata CPF ==>  733.812.090-00
echo Format::companyIdentification('39678379000129') . '<br>'; //Formata CNPJ ==> 39.678.379/0001-29
echo Format::zipCode('87030585') . '<br>'; //Formata CEP ==>  87030-585
echo Format::dateBrazil('2020-05-12') . '<br>'; //Formata Data ==>  12/05/2020
echo Format::dateAmerican('12-05-2020') . '<br>'; //Formata Data ==>  2020-05-12
echo Format::currency('1123.45') . '<br>'; //Formata Moeda ==>  1.123,45
echo Format::pointOnlyValue('1.350,45') . '<br>'; //Formata moeda para gravação no BD ==>  1350.45
echo Format::onlyNumbers('548Abc87@') . '<br>'; //Retorna apenas números => 54887;
echo Format::onlyLettersNumbers('548Abc87@') . '<br>'; //Retorna apenas letras e números => 548Abc87;
//[Aplicar qualquer tipo de Mascara, aceita espaço, pontos e outros]
echo Format::mask('#### #### #### ####', '1234567890123456') . '<br>'; //1234 5678 9012 3456

//Os format abaixo, o segundo parametro escolhe o charset, UTF-8 default
echo Format::lower('CArrO') . '<br>'; //Minusculo,  ==> carro
echo Format::upper('Moto') . '<br>'; //Mauiusculo ==> MOTO
echo Format::ucwordsCharset('aÇafrÃo maCaRRão') . '<br>'; //Primeira letra maiuscula ==> Açafrão Macarrão
echo Format::reverse('Abacaxi') . '<br>'; //Retorna string invertida ==> ixacabA

Format::convertTypes($datas, $rules); //Converte o valor para o tipo correto dele ['bool', 'float', 'int', 'numeric',]

$array = [
    0 => '1',
    1 => '123',
    'a' => '222',
    'b' => 333,
    'c' => '',
];

$arrayComNull = Format::emptyToNull($array); //Converte vazio para null
[
  0 => 1,
  1 => 123,
  'a' => 222,
  'b' => 333,
  'c' => null,
]

//$value = Format::arrayToInt($array); ==> Opção para sem ser por Referencia
Format::arrayToIntReference($array); //Formata valores do array em inteiro ==>
[
  0 => 1,
  1 => 123,
  'a' => 222,
  'b' => 333,
  'c' => 0,
]
```

# Comparações Exemplos

```php
<?php

require 'vendor/autoload.php';

use brunoconte3\Validation\Compare;

// Retorna +30 (+30 dias de diferença)
echo Compare::daysDifferenceBetweenData('31/05/2020', '30/06/2020') . '<br>'; //Aceita data Americana também

// Compara se a data inicial é menor que a data final => Retorna [bool]
echo Compare::startDateLessThanEnd('30/07/2020', '30/06/2020') . '<br>'; //Aceita data Americana também

//Diferença entre horas ==> 01:36:28 [Horas exibe negativo e positivo a diferença]
echo Compare::differenceBetweenHours('10:41:55', '12:18:23') . '<br>';

// Compara se a hora inicial é menor que a hora final (3º parâmetro, aceita mensagem customizada)
echo Compare::startHourLessThanEnd('12:05:01', '10:20:01') . '<br>';

//Compada a data com a data atual, e retorna a idade da pessoa
echo Compare::calculateAgeInYears('20/05/1989');

//echo 'Compara igualdade dos campos, retorna booleano <br>';
//terceiro parametro opcional, false para não comparar caseSensitive, default true
var_dump(Compare::checkDataEquality('AçaFrão', 'Açafrão'));

```

# Manipular Arrays

```php
<?php

require 'vendor/autoload.php';

use brunoconte3\Validation\Array;

echo '<br><br>Manipular Arrays<hr>';

$array = ['primeiro' => 15, 'segundo' => 25];
var_dump(Arrays::searchKey($array, 'primeiro'));   // Procura chave no array, e retorna a posição ==> returns 0
var_dump(Arrays::searchKey($array, 'segundo'));    // Procura chave no array, e retorna a posição ==> returns 1
var_dump(Arrays::searchKey($array, 'nao-existe')); // Procura chave no array, e retorna a posição ==> returns null

$array = ['primeiro' => 10, 'segundo' => 20];
Arrays::renameKey($array, 'primeiro', 'novoNome');
var_dump($array); //Renomeia a chave do array ==> ['renamed' => 10, 'second' => 20];

```

# Arquivo com exemplos de Testes

`Execute o arquivo que está no caminho /test/Test.php preparamos para facilitar seu entendimento!`

# Licença

O validator é uma aplicação open-source licenciado sob a [licença MIT](https://opensource.org/licenses/MIT).

`Créditos a mammoth-php/validation que foi fork de lá`
