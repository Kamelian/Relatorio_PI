<!--(`id`, `board_id`, `lat`, `lng`, `sensor1`, `sensor2`, `sensor3`, `estado`, `reg_time`)-->

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Registo Incidente!</h3>
  </div>
  <div class="panel-body">
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method='post'>
        <div class="form-group">
            <label for="">Board ID</label>
            <input type="text" name='board_id' class='form-control' />
        </div>
        <div class="form-group">
            <label for="">Zona</label>
            <input type="text" name='zona' class='form-control' />
        </div>
        <div class="form-group">
            <label for="">Latitude</label>
            <input type="text" name='lat' class='form-control' />
        </div>
        <div class="form-group">
            <label for="">Longitude</label>
            <input type="text" name='lng' class='form-control' />
        </div>
        <div class="form-group">
            <label for="">Sensor1: (botao)</label>
            <input type="text" name='sensor1' class='form-control' />
        </div>
        <div class="form-group">
            <label for="">Sensor2: (queda)</label>
            <input type="text" name='sensor2' class='form-control' />
        </div>
        <div class="form-group">
            <label for="">Sensor3: (tensão bateria)</label>
            <input type="text" name='sensor3' class='form-control' />
        </div>
        <div class="form-group">
            <label for="">Estado: (1 Não Resolvido / 2 - Resolvido)</label>
            <input type="text" name='estado' class='form-control' />
        </div>
        <div class="form-group">
            <label for="">Contacto(s): numero1, nome1; numero2, nome2; ...</label>
            <input type="text" name='contacto' class='form-control' />
        </div>

      <input type="submit" name='submit' value='Submit' class="btn btn-primary">
      <a href="<?php echo ROOT_PATH; ?>ocorrencias" class="btn btn-danger">Cancel</a>
    </form>
  </div>
</div>
