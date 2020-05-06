<?php if(isset($hash)): ?>
<script type="text/javascript"> 
 localStorage.setItem('access-token',"<?php echo $hash; ?>" );
 console.log(localStorage.getItem('access-token'));
</script>

<?php endif; ?>
<form action="login" method="POST">
  <div class="form-group">
    <label for="nombreusuario">Email address</label>
    <input name="nombreusuario" type="text" class="form-control" id="nombreusuario" aria-describedby="emailHelp">
  </div>
  <div class="form-group">
    <label for="passwordd">Password</label>
    <input name="passwordd" type="password" class="form-control" id="passwordd">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
