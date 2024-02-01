<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Sign Up</title>
</head>
<body>
<div class="px-5 py-5 p-lg-0">
  <div class="d-flex justify-content-center">
    <div class="col-12 col-md-9 col-lg-7 min-h-lg-screen d-flex flex-column justify-content-center py-lg-16 px-lg-20 position-relative">
      <div class="row">
        <div class="col-lg-10 col-md-9 col-xl-7 mx-auto">
          <div class="text-center mb-12">
           
            <h1 class="ls-tight font-bolder h2">
              Sign Up
            </h1>
          </div>
          <form action="/register" method="POST" enctype="multipart/form-data">
  <div class="mb-5">
    <label class="form-label" for="username">Username:</label>
    <input type="text" class="form-control" name="username" id="username" placeholder="Your email address" required>
<small><?php echo form_error("Username")  ?></small>  
</div>
  <div class="mb-5">
    <label for="profile-image">Profile Image:</label>
    <input type="file" class="form-control" name="image" id="profile-image">
  </div>
  <div class="mb-5">
    <label for="Full_Name">Full Name:</label>
    <input type="text" class="form-control" name="Full_Name" id="Full_Name" required>
    <small style="color:red"><?php echo form_error("Full Name")  ?></small>  
  
</div>
  <div class="mb-5">
    <label class="form-label" for="phone">Phone number:</label>
    <input type="text" class="form-control" id="phone" name="phone" placeholder="Your phone number" required>
    <small style="color:red"><?php echo form_error("Phone Number")  ?></small>  
  
</div>
  <div class="mb-5">
    <label class="form-label" for="email">Email address:</label>
    <input type="text" class="form-control" id="email" name="email" placeholder="Your email address" required>
    <small style="color:red"><?php echo form_error("Email")  ?></small>  
  
</div>
  <div class="mb-5">
    <label class="form-label" for="password">Password:</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="current-password" required>
    <small style="color:red"><?php echo form_error("password")  ?></small>  
  
</div>
  <div>
    <button type="submit" class="btn btn-primary w-full">Sign Up</button>
  </div>
</form>
<div class="my-6">
  <small>Already have an account?</small>
  <a href="logIn" class="text-warning text-sm font-semibold">Sign In</a>
</div>

        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>








