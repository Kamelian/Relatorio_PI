<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Register new user</h3>
  </div>
  <div class="panel-body">
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method='post'>
      <div class="form-group">
        <label for="">Name</label>
        <input type="text" name='name' class='form-control' />
      </div>
      <div class="form-group">
        <label for="">Email</label>
        <input type="email" name='email' class='form-control' />
      </div>
      <div class="form-group">
        <label for="">Password</label>
        <input type="password" name='password' class='form-control' />
      </div>
      <input type="submit" name='submit' value='Submit' class="btn btn-primary">
    </form>
  </div>
</div>
