<form id="my-form-change" class="">
  <input type="hidden" class="form-control" id="User_id" name="User_id" value=null>
  <input type="hidden" class="form-control" id="update_at" name="update_at" value=null>
  <div class="form-floating mb-3">
    <input type="password" class="form-control " id="User_password" name="User_password" placeholder="Password" required>
    <label for="User_password">Password </label>
  </div>
  <div class="form-floating mb-3">
    <input type="password" class="form-control " id="Repeat_password" name="Repeat_password" placeholder="Repeat Password" required>
    <label for="Repeat_password">Repeat Password </label>
  </div> 
  <button type="submit" form="my-form-change" id="btnSubmit" class="btn btn-primary w-100">Sign In</button>
</form>