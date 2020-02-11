<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Adicionar Novidades!</h3>
  </div>
  <div class="panel-body">
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method='post'>
      <div class="form-group">
        <label for="">Titulo</label>
        <input type="text" name='title' class='form-control' />
      </div>
      <div class="form-group">
        <label for="">Mensagem</label>
        <textarea name='body' class='form-control'></textarea>
      </div>
      <div class="form-group">
        <label for="">Link Externo</label>
        <input type="text" name='link' class='form-control' />
      </div>
      <input type="submit" name='submit' value='Submit' class="btn btn-primary">
      <a href="<?php echo ROOT_PATH; ?>novidades" class="btn btn-danger">Cancel</a>
    </form>
  </div>
</div>
