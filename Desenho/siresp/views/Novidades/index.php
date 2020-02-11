<div>
    <h3>Novidades</h3>
    <?php if (isset($_SESSION['is_logged_in'])) : ?>
        <p></p>
        <a href="<?php echo ROOT_PATH; ?>novidades/add" class="btn btn-success btn-share">Adicionar novidade!</a>
        <p></p>
    <?php endif; ?>

    <?php foreach ($viewmodel as $item) : ?>

        <div class="well">
            <h3><?php echo $item['title']; ?></h3>
            <small><?php echo $item['create_date']; ?></small>
            <p></p><p> database_id = <?php echo $item['id']; ?></p>
            <hr>
            <p><?php echo $item['body']; ?></p>
            <br>
            <a href='https://<?php echo $item['link']; ?>' class="btn btn-default" target="_top">Hiperligação</a>

            <?php if (isset($_SESSION['is_logged_in'])) : ?>
                <a href="<?php echo ROOT_PATH; ?>novidades/edit/<?php echo $item['id']; ?>" class="btn btn-default"">Editar</a>
            <?php else : ?>
            <?php endif; ?>

        </div>
    <?php endforeach; ?>
</div>
