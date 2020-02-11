<!-- (`id`, `board_id`, `nome`, `numero`, `texto`) -->
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Adicionar Piquete</h3>
  </div>
  <div class="panel-body">
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method='post'>
        <div class="form-group">
            <label for="">Zona</label>
            <input type="text" name='zona' class='form-control' />
        </div>
        <div class="form-group">
            <label for="">Nome</label>
            <input type="text" name='nome' class='form-control' />
        </div>
        <div class="form-group">
            <label for="">EMail</label>
            <input type="text" name='mail' class='form-control' />
        </div>
      <div class="form-group">
        <label for="">Numero</label>
        <input type="text" name='numero' class='form-control' />
      </div>
      <div class="form-group">
        <label for="">Notas</label>
        <textarea name='texto' class='form-control'></textarea>
      </div>
      <input type="submit" name='submit' value='Submit' class="btn btn-primary">
      <a href="<?php echo ROOT_PATH; ?>piquetes" class="btn btn-danger">Cancel</a>
    </form>
  </div>
</div>
