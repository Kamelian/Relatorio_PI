<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Edit piquete</h3>
        Database_ID = <?php echo $viewmodel[0]['id'];?>
    </div>
    <div class="panel-body">
        <form action="<?php echo ROOT_PATH; ?>piquetes/editsave/<?php echo $viewmodel[0]['id']; ?>" method="post">
            <div class="form-group">
                <label for="">Zona</label>
                <input type="text" name="zona" class="form-control" value=<?php echo $viewmodel[0]['zona'];?> />
            </div>
            <div class="form-group">
                <label for="">Nome</label>
                <input type="text" name="nome" class="form-control" value=<?php echo $viewmodel[0]['nome'];?> />
            </div>
            <div class="form-group">
                <label for="">EMail</label>
                <input type="text" name="mail" class="form-control" value=<?php echo $viewmodel[0]['mail'];?> />
            </div>
            <div class="form-group">
                <label for="">Numero</label>
                <input type="text" name="numero" class="form-control" value=<?php echo $viewmodel[0]['numero'];?> />
            </div>
            <div class="form-group">
                <label for="">Notas</label>
                <textarea name="texto" class="form-control" value=""><?php echo $viewmodel[0]['texto'];?></textarea>
            </div>
            <input type="submit" name='submit' value='Submit' class="btn btn-primary">
            <a href="<?php echo ROOT_PATH; ?>piquetes" class="btn btn-danger">Cancel</a>

            <a href="<?php echo ROOT_PATH; ?>piquetes/delete/<?php echo $viewmodel[0]['id']; ?>" class="btn btn-danger" onclick="return confirm('Tem a certeza que deseja apagar?')">Apagar</a>

        </form>
    </div>
</div>