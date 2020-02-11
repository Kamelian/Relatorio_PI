<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Edit Novidade!</h3>
        Database_ID = <?php echo $viewmodel[0]['id'];?>
    </div>
    <div class="panel-body">
        <form action="<?php echo ROOT_PATH; ?>novidades/editsave/<?php echo $viewmodel[0]['id']; ?>" method="post">

            <div class="form-group">
                <label for="">Titulo Novidade</label>
                <input type="text" name="title" class="form-control" value=<?php echo $viewmodel[0]['title'];?> />
            </div>
            <div class="form-group">
                <label for="">Texto</label>
                <textarea name="body" class="form-control" value=""><?php echo $viewmodel[0]['body'];?></textarea>
            </div>
            <div class="form-group">
                <label for="">Link</label>
                <input type="text" name="link" class="form-control"  value="<?php echo $viewmodel[0]['link'];?>"/>
            </div>

            <input type="submit" name='submit' value='Submit' class="btn btn-primary">
            <a href="<?php echo ROOT_PATH; ?>novidades" class="btn btn-danger">Cancel</a>

            <a href="<?php echo ROOT_PATH; ?>novidades/delete/<?php echo $viewmodel[0]['id']; ?>" class="btn btn-danger" onclick="return confirm('Tem a certeza que deseja apagar?')">Apagar</a>

        </form>
    </div>
</div>