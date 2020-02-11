<div class="panel panel-default">
    <div class="panel-body">
        <form action="<?php echo ROOT_PATH; ?>piquetes/searchresult/" method="post">

            <div class="form-group">
                <label for="">Pesquisar</label>
                <input type="text" name='search' class='form-control' />
            </div>
            <input type="submit" name='submit' value='Submit' class="btn btn-primary">
            <a href="<?php echo ROOT_PATH; ?>piquetes" class="btn btn-danger">Cancel</a>

        </form>
    </div>
</div>