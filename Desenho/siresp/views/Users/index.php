<div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Lista Utilizadores</h3>
        </div>
        <div class="panel-body">
            <div class="well">
                <a href="<?php echo ROOT_PATH; ?>users/register" class="btn btn-primary ">Adicionar utilizador!</a>
                <p></p>
                <table class="table table-striped">
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                    </tr>
                    <?php foreach ($viewmodel as $item) : ?>
                        <tr>
                            <td><?php echo $item['name']; ?></td>
                            <td><?php echo $item['email']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

        </div>
    </div>
</div>
