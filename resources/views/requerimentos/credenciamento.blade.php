<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    .m-0 {
        margin: 0.4em;
    }

    /* body {
        background: rgb(204, 204, 204);
    }

    page {
        background: white;
        display: block;
        margin: 0 auto;
        margin-bottom: 0.5cm;
        box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
    }

    page[size="A4"] {
        width: 21cm;
        height: 29.7cm;
    }

    page[size="A4"][layout="portrait"] {
        width: 29.7cm;
        height: 21cm;
    }

    @media print {

        body,
        page {
            margin: 0;
            box-shadow: 0;
        }
    }

    .header {
        padding-top: 10px;
        text-align: center;
        border: 2px solid #ddd;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        font-size: 80%;
    }

    table th {
        background-color: #4caf50;
        color: white;
        text-align: center;
    }

    th,
    td {
        border: 1px solid #ddd;
        text-align: left;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2
    } */
</style>

<body>
    <page>
        <center>
            <img src={{ asset('img/layouts/republica.jpg') }} width="15%" />
            <b>
                <p class="m-0">MINISTERIO DA DEFESA</p>
                <p class="m-0">EXÉCITO BRASILEIRO</p>
                <p class="m-0">COMANDO DA 7ª REGIÃO MILITAR</p>
                <p class="m-0">(Gov das Armas Prov de PE/1821)</p>
                <p class="m-0">REGIÃO MATIAS DE ALBUQUERQUE</p>
                <br>
                <p class="m-0"><u>EDITAL DE CREDENCIAMENTO Nº 001/2022</u></p>
                <br>
                <p class="m-0">ANEXO “C”</p>
                <p class="m-0"><u>REQUERIMENTO PARA CREDENCIAMENTO</u></p>
            </b>
        </center>
        <br>
        <p>Ao</p>
        <p>Sr. Presidente da Comissão Especial de Credenciamento do ...</p>
        <p><b>{{ @$pipeiro->nome }}</b>, requer seu credenciamento para prestar serviços de coleta, transporte e
            distribuição de
            água potável,
            relativamente ao município de <b>{{ $municipio->nome }}</b>, atendido pelo Programa Emergencial de
            Distribuição de Água Potável no Semiárido Brasileiro – Operação Carro Pipa.
        </p>
        <p>Junta a documentação exigida para ocorrência de sua habilitação ao ora
            requerido credenciamento, ao tempo em que declara concordância com as condições estabelecidas
            no correspondente Edital de Credenciamento e em seus Anexos.
        </p>
        <p>E, por oportuno, presta as informações adicionais seguintes:</p>
        <p>
            <b>Natureza jurídica:</b>
        </p>
        <p>
            <b>Número do CPF: </b>{{ $pipeiro->cpf }}
        </p>
        <p>
            <b>Endereço: </b>{{ $endereco->logradouro }}, {{ $endereco->numero }},
            {{ $endereco->complemento }},
            {{ $endereco->cidade }}, {{ $endereco->estado }}, {{ $endereco->cep }}
        </p>
        <p>
            <b>Dados Bancários: </b> {{ $dadosbancarios->banco }} (banco), {{ $dadosbancarios->agencia }} (agência),
            {{ $dadosbancarios->conta }} (conta)
        </p>
        <p>
            <b>Identificação e Especificações Básicas do(s) Veículo(s): </b> veiculo da marca {{ $veiculo->marca }} e
            modelo {{ $veiculo->modelo }}, ano ({{ $veiculo->marca }}), placa {{ $veiculo->placa }} e chassi
            {{ $veiculo->chassi }}
        </p>
        <p style="margin-left:35px"> Nestes termos,</p>
        <p style="margin-left:35px"> Pede deferimento</p>
        <br>
        <center>
            <p>______________,____ de _____________ de ________</p>
            <p>_____________________________________________</p>
            <p>Assinatura e Nome</p>
        </center>
    </page>

</body>

</html>
