<?php

include 'templates/header.php';

$imovel = new controllerImoveis();

$result = $imovel->getImovel($_GET['id_imovel']);

?>

<div class="container">

    <div class="card o-hidden border-0 shadow-lg">
        <div class="card-header pt-5 bg-primary">
            <div class="text-center">
                <h1 class="h4 text-light mb-4">Editar imóvel</h1>
            </div>
        </div>
        <div class="card-body p-0">

            <!-- Nested Row within Card Body -->
            <div class="row">

                <div class="col-lg-12">
                    <div class="p-5">

                        <form method="post" action="../Controllers/Imoveis.php">
                            <div class="row pb-3">
                                <div class="pb-2 col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" name="nome" placeholder="Nome" value="<?= $result['nome'] ?>">
                                </div>
                                <div class="pb-2 col-sm-6">
                                    <input type="text" class="form-control form-control-user" name="valor" placeholder="Valor " value="<?= $result['valor'] ?>">
                                </div>
                                <div class="pb-2 col-sm-6">
                                    <input type="text" class="form-control form-control-user" name="tipo" placeholder="Tipo" value="<?= $result['tipo'] ?>">
                                </div>
                                <div class="pb-2 col-sm-6">
                                    <input type="text" class="form-control form-control-user" name="locacao" placeholder="Locação" value="<?= $result['locacao'] ?>">
                                </div>
                                <div class="pb-2 col-sm-6">
                                    <input type="number" class="form-control form-control-user" name="quartos" placeholder="Nº de Quartos" value="<?= $result['quartos'] ?>">
                                </div>
                                <div class="pb-2 col-sm-6">
                                    <input type="number" class="form-control form-control-user" name="banheiros" placeholder="Nº de Banheiros" value="<?= $result['banheiros'] ?>">
                                </div>
                                <div class="pb-2 col-sm-6">
                                    <input type="number" class="form-control form-control-user" name="vagas" placeholder="Nº de Vagas" value="<?= $result['vagas'] ?>">
                                </div>
                                <div class="pb-2 col-sm-6">
                                    <input type="text" class="form-control form-control-user" name="cep" placeholder="Digite o CEP" maxlength="9" onblur="pesquisacep(this.value)" value="<?= $result['cep'] ?> ">
                                </div>
                                <div class="pb-2 col-sm-6">
                                    <input type="text" class="form-control form-control-user" name="bairro" placeholder="Bairro" value="<?= $result['bairro'] ?>">
                                </div>
                                <div class="pb-2 col-sm-8">
                                    <input type="text" class="form-control form-control-user" name="rua" placeholder="Rua" value="<?= $result['rua'] ?>">
                                </div>
                                <div class="pb-2 col-sm-4">
                                    <input type="text" class="form-control form-control-user" name="numero" placeholder="Número" value="<?= $result['numero'] ?>">
                                </div>
                                <div class="pb-2 col-sm-6">
                                    <input type="text" class="form-control form-control-user" name="cidade" placeholder="Cidade" value="<?= $result['cidade'] ?>">
                                </div>
                                <div class="pb-2 col-sm-6">
                                    <input type="text" class="form-control form-control-user" name="uf" placeholder="Estado" value="<?= $result['uf'] ?>">
                                </div>
                                <div class="pb-2 col-sm-6">
                                    <input type="text" class="form-control form-control-user" name="complemento" placeholder="Complemento" value="<?= $result['complemento'] ?>">
                                </div>
                            </div>

                            <input type="submit" value="Editar Imóvel" class=" btn btn-primary">
                            <a href = "acessado.php" class=" btn btn-danger">Cancelar</a>

                    </div>

                    <input type="hidden" name="action" value="updateData" class=" btn btn-primary">
                    <input type="hidden" name="id_imovel" value="<?= $result['id_imovel'] ?>">

                    </form>

                </div>
            </div>
        </div>
    </div>
    <?php
    if (isset($_SESSION['return'])) {
    ?>
        <div class="<?= $_SESSION['return']['class'] ?> alerta text-light">
            <?=
            $_SESSION['return']['msg'];
            ?>

        </div>

    <?php

        unset($_SESSION['return']);
    }
    ?>
</div>

</div>

<script>
    function limpa_formulário_cep() {
        //Limpa valores do formulário de cep.
        document.getElementsByName('rua')[0].value = ("");
        document.getElementsByName('bairro')[0].value = ("");
        document.getElementsByName('cidade')[0].value = ("");
        document.getElementsByName('uf')[0].value = ("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementsByName('rua')[0].value = (conteudo.logradouro);
            document.getElementsByName('bairro')[0].value = (conteudo.bairro);
            document.getElementsByName('cidade')[0].value = (conteudo.localidade);
            document.getElementsByName('uf')[0].value = (conteudo.uf);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }

    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementsByName('rua')[0].value = "...";
                document.getElementsByName('bairro')[0].value = "...";
                document.getElementsByName('cidade')[0].value = "...";
                document.getElementsByName('uf')[0].value = "...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };
</script>