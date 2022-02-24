<?php

include 'templates/header.php';

?>
        <div class="container-fluid">

            <h1 class="h3 mb-2 text-gray-800">Listagem de imóveis</h1>
           
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row justify-content-between">
                        <div class="col-4">
                            <h3 class="m-0 font-weight-bold text-primary">Imóveis </h3>
                        </div>
                        <div class="col-2">
                            <a href="../views/formImoveis.php" class="btn btn-success"><i class="fas fa-plus text-light "></i> Adicionar</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Valor</th>
                                    <th>Tipo</th>
                                    <th>Locação</th>
                                    <th>Quartos</th>
                                    <th>Banheiros</th>
                                    <th>Vagas</th>
                                    <th>Cidade/UF</th>
                                    <th class="text-center" style="width: 105px">Ações</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nome</th>
                                    <th>Valor</th>
                                    <th>Tipo</th>
                                    <th>Locação</th>
                                    <th>Quartos</th>
                                    <th>Banheiros</th>
                                    <th>Vagas</th>
                                    <th>Cidade/UF</th>
                                    <th class="text-center" style="width: 105px">Ações</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php

                                $imoveis = new controllerImoveis();
                                $consulta = $imoveis->show();
                                if (!empty($consulta)) {
                                    foreach ($consulta as $key => $linha) {
                                        echo '<tr><td>' . $linha['nome'] . '</td>';
                                        echo '<td>R$ ' . $linha['valor'] . '</td>';
                                        echo '<td>' . $linha['tipo'] . '</td>';
                                        echo '<td>' . $linha['locacao'] . '</td>';
                                        echo '<td>' . $linha['quartos'] . '</td>';
                                        echo '<td>' . $linha['banheiros'] . '</td>';
                                        echo '<td>' . $linha['vagas'] . '</td>';
                                        echo '<td>' . $linha['cidade'] . '/' .$linha['uf'] . '</td>';
                                    
                                        echo '<td class = "text-center"><div class="row"><div class="col-6"><form action="../Controllers/Imoveis.php" method="post"><input type="hidden" name="id_imovel" value="'.$linha['id_imovel'].'"><input type="hidden" name="action" value="update"><button type="submit" class="btn"><i class="fas fa-edit"></i></button></form></div>';
                                        echo '<div class="col-6"><a href="#" data-toggle="modal" data-target="#deleteModal" onclick="setadado(' . $linha['id_imovel'] . ');" class="btn"><i class="fas fa-trash"></i></a></div></div></td></tr>';                                        
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                if (isset($_SESSION['return'])) {
                ?>
                <div class="<?= $_SESSION['return']['class'] ?> alerta text-light">
                    <?=
                    $_SESSION['return']['msg'];
                    ?>
                <?php
                unset($_SESSION['return']);
                }
                ?>
            </div>

        </div>
    </div>
    <?php
    include '../views/templates/footer.php';
    ?>
</div>

</div>