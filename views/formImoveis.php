<?php

include 'templates/header.php';

?>

<div class="container">

    <div class=" card o-hidden border-0 shadow-lg">
        <div class="card-header pt-5 bg-primary ">
            <div class="text-center">
                <h1 class="h4 text-light mb-4">Registrar novo imóvel</h1>
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
                                    <input type="text" class="form-control form-control-user" name="nome" placeholder="Nome">
                                </div>
                                <div class="pb-2 col-sm-6">
                                    <input type="text" class="form-control form-control-user" name="valor" placeholder="Valor">
                                </div>
                                <div class="pb-2 col-sm-6">
                                    <input type="text" class="form-control form-control-user" name="tipo" placeholder="Tipo">
                                </div>
                                <div class="pb-2 col-sm-6">
                                    <input type="text" class="form-control form-control-user" name="locacao" placeholder="Locação">
                                </div>
                                <div class="pb-2 col-sm-6">
                                    <input type="number" class="form-control form-control-user" name="quartos" placeholder="Nº de Quartos">
                                </div>
                                <div class="pb-2 col-sm-6">
                                    <input type="number" class="form-control form-control-user" name="banheiros" placeholder="Nº de Banheiros">
                                </div>
                                <div class="pb-2 col-sm-6">
                                    <input type="number" class="form-control form-control-user" name="vagas" placeholder="Nº de Vagas">
                                </div>
                                <div class="pb-2 col-sm-6">
                                    <input type="text" class="form-control form-control-user" name="cep" placeholder="Digite o CEP" maxlength="9" onblur="pesquisacep(this.value)" value='' ;>
                                </div>
                                <div class="pb-2 col-sm-6">
                                    <input type="text" class="form-control form-control-user" name="bairro" placeholder="Bairro">
                                </div>
                                <div class="pb-2 col-sm-8">
                                    <input type="text" class="form-control form-control-user" name="rua" placeholder="Rua">
                                </div>
                                <div class="pb-2 col-sm-4">
                                    <input type="text" class="form-control form-control-user" name="numero" placeholder="Número">
                                </div>
                                <div class="pb-2 col-sm-6">
                                    <input type="text" class="form-control form-control-user" name="cidade" placeholder="Cidade">
                                </div>
                                <div class="pb-2 col-sm-6">
                                    <input type="text" class="form-control form-control-user" name="uf" placeholder="Estado">
                                </div>
                                <div class="pb-2 col-sm-6">
                                    <input type="text" class="form-control form-control-user" name="complemento" placeholder="Complemento">
                                </div>
                            </div>

                            <input type="submit" value="Cadastrar Imóvel" class=" btn btn-primary">
                            <a href = "acessado.php" class=" btn btn-danger">Cancelar</a>

                    </div>

                    <input type="hidden" name="action" value="register">

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