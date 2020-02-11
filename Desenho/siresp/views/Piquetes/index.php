<div>
    <!-- (`id`, `board_id`, `nome`, `numero`, `texto`) -->
    <h3>Piquetes</h3>
    <a href="<?php echo ROOT_PATH; ?>piquetes/add" class="btn btn-success">Adicionar piquete.</a>
    <a href="<?php echo ROOT_PATH; ?>piquetes/search" class="btn btn-success">Procurar.</a>
    <p></p>
    <?php foreach ($viewmodel as $item) : ?>
        <div class="well">
            <p>database ID: <?php echo $item['id']; ?></p>
            <p>Zona: <?php echo $item['zona']; ?> </p>
            <p>Nome: <?php echo $item['nome']; ?> </p>
            <p>Email: <?php echo $item['mail']; ?> </p>
            <p>Numero: <?php echo $item['numero']; ?> </p>
            <p>Notas: <?php echo $item['texto']; ?></p>
            <a href="<?php echo ROOT_PATH; ?>piquetes/edit/<?php echo $item['id']; ?>" class="btn btn-primary"">Editar</a>
        </div>
    <?php endforeach; ?>
</div>
