<!DOCTYPE html>
<html>
<head>
  <title>Add Codeigniter 4 </title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <style>
    .container {
      max-width: 500px;
    }
    .error {
      display: block;
      padding-top: 5px;
      font-size: 14px;
      color: red;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <form method="post" id="add_create" name="add_create" 
    action="<?= site_url('/submit-form') ?>">
      <div class="form-group">
        <label>Name</label>
        <input type="text" name="Profile_name"  id="Profile_name" class="form-control">
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" name="Profile_email" id="Profile_email" class="form-control">
      </div>
      <div class="form-group">
        <label>Photo</label>
        <input type="text" name="Profile_photo" id="Profile_photo"class="form-control">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block">Add Profile </button>
      </div>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
  <script>
    if ($("#add_create").length > 0) {
      $("#add_create").validate({
        rules: {
          name: {
            required: true,
          },
          email: {
            required: true,
            maxlength: 60,
            email: true,
          },
          photo: {
            required: true,
            maxlength: 100,
            required: true,
          },
        },
        messages: {
          name: {
            required: "Name is required.",
          },
          email: {
            required: "Email is required.",
            email: "It does not seem to be a valid email.",
            maxlength: "The email should be or equal to 60 chars.",
          },
          photo: {
            required: "Email is required.",
            maxlength: "The email should be or equal to 100 chars.",
          },
        },
      })
    }
  </script>
</body>
</html>