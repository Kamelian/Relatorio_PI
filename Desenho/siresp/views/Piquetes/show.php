<div>
<!-- (`id`, `board_id`, `nome`, `numero`, `texto`) -->
    <a href="<?php echo ROOT_PATH;?>ocorrencias" class="btn btn-primary text-center">Ocorrencias!</a>
    <h3>Board ID <?php echo $viewmodel[0]['board_id']; ?></h3>
    <?php foreach ($viewmodel as $item) : ?>
        <div class="well">
            <small>database ID: <?php echo $item['id']; ?></small>
            <p>Nome: <?php echo $item['nome']; ?> </p>
            <p>Numero Contacto: <?php echo $item['nome']; ?> </p>
            <p>Notas: <?php echo $item['texto']; ?> </p>
        </div>
    <?php endforeach; ?>
</div>
