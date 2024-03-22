<!DOCTYPE html>
<?php
                require_once 'App/Database/Database.php';

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro CRUD</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Cadastro</h2>
        <!-- Formulário para adicionar registro -->
        <form id="formAdd" method="post" action="$repository->insert()">
            <div class="form-group">
                <label for="inputNome">Nome:</label>
                <input type="text" class="form-control" name="nome" id="inputNome" placeholder="Digite o nome" required>
            </div>
            <div class="form-group">
                <label for="inputEmail">Email:</label>
                <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Digite o email" required>
            </div>
            <div class="form-group">
                <label for="inputCidade">Cidade:</label>
                <input type="text" class="form-control" name="cidade" id="inputCidade" placeholder="Digite a cidade" required>
            </div>
            <div class="form-group">
                <label for="inputEstado">Estado:</label>
                <input type="text" class="form-control" name="estado" id="inputEstado" placeholder="Digite o estado" required>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar</button>
        </form>
        <hr>
        <!-- Tabela para exibir registros -->
        <h3>Registros</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <!-- Os registros serão inseridos aqui via PHP -->
                <?php
                require_once 'App/Repository/ClienteRepository.php';

                $repository = new App\Repository\ClienteRepository();
                $clientes = $repository->getAll();

                foreach ($clientes as $cliente) {
                    echo "<tr>
                            <td>{$cliente['nome']}</td>
                            <td>{$cliente['email']}</td>
                            <td>{$cliente['cidade']}</td>
                            <td>{$cliente['estado']}</td>
                            <td>
                                <button class='btn btn-sm btn-primary edit-btn' data-id='{$cliente['cliente_id']}'>Editar</button>
                                <button class='btn btn-sm btn-danger delete-btn' data-id='{$cliente['cliente_id']}'>Excluir</button>
                            </td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal para editar registro -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEdit" method="post">
                        <input type="hidden" name="editId" id="editId">
                        <div class="form-group">
                            <label for="editNome">Nome:</label>
                            <input type="text" class="form-control" name="editNome" id="editNome" required>
                        </div>
                        <div class="form-group">
                            <label for="editEmail">Email:</label>
                            <input type="email" class="form-control" name="editEmail" id="editEmail" required>
                        </div>
                        <div class="form-group">
                            <label for="editCidade">Cidade:</label>
                            <input type="text" class="form-control" name="editCidade" id="editCidade" required>
                        </div>
                        <div class="form-group">
                            <label for="editEstado">Estado:</label>
                            <input type="text" class="form-control" name="editEstado" id="editEstado" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" form="formEdit" class="btn btn-primary">Salvar Alterações</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
