<?php 
include "includes/database.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin Demo - Register</title>

  <!-- Custom fonts for this template-->
  <link href="public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="public/css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form id="userRegister" method="POST" class="user">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="firstName" id="exampleFirstName" placeholder="First Name">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="lastName" id="exampleLastName" placeholder="Last Name">
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" name="userEmail" id="exampleInputEmail" placeholder="Email Address">
                </div>

                <div class="form-group row">
                  <div class="col-sm-4">
                    <select class="mdb-select md-form" id="country" searchable="Search here..">
                      <option value="" disabled selected>Choose your country</option>
                      <?php
                        $country = mysqli_query($conn, 'SELECT * FROM tbl_countries');
                        while($row=mysqli_fetch_assoc($country)) {
                          echo "<option value='$row[id]'>".$row['name']."</option>";
                        }
                      ?>
                    </select>                 
                  </div>
                  <div class="col-sm-4">
                    <select class="mdb-select md-form" id="state" searchable="Search here..">
                      
                    </select>
                  </div>
                  <div class="col-sm-4">
                   <select class="mdb-select md-form" id="city" name="city_id" searchable="Search here..">
                      
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" name="userPassword" id="userPassword" placeholder="Password">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" name="confirmPassword" placeholder="Repeat Password">
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">Register Account</button> 
                </a>
                <hr>
               <!--  <a href="index.html" class="btn btn-google btn-user btn-block">
                  <i class="fab fa-google fa-fw"></i> Register with Google
                </a>
                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                  <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                </a> -->
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="forgot-password.html">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="login.html">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="public/vendor/jquery/jquery.min.js"></script>
  <script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="public/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="public/js/sb-admin-2.js"></script>
  <script src="public/js/jquery.validate.min.js"></script>
  <script type="text/javascript">
   $(document).ready(function() {
      $('#country').on('change', function() {
          var country_id = this.value;
          $.ajax({
            url: "actions/get_state.php",
            type: "POST",
            data: {
              country_id: country_id
            },
            cache: false,
            success: function(dataResult){
              $("#state").html(dataResult);
            }
          });        
      });
      $('#state').on('change', function() {
          var state_id = this.value;
          $.ajax({
            url: "actions/get_city.php",
            type: "POST",
            data: {
              state_id: state_id
            },
            cache: false,
            success: function(dataResult){
              $("#city").html(dataResult);
            }
          });        
      });

      //validatons
      $("#userRegister").validate({
        rules: {
         firstName: "required",
         lastName: "required",

         userEmail: {
          required: true,
          email: true,
          remote: {
                    url: "actions/check_email.php",
                    type: "post"
                 }
         },
         userPassword: "required",
         confirmPassword:{
          equalTo: "#userPassword"
         }

       },

       messages: {
        firstName: "Please enter your firstname",
        lastName: "Please enter your lastName",
        userEmail: {
          required: "Please enter your Email",
          email: "Please Enter valid Email",
          remote: "Email Already Register",
        },
        userPassword: "Password is required",
        confirmPassword:{
          equalTo: "Password Not Match"
        }
       },
       // submitHandler: function(form) {
       //   return false;
       // // form.submit();
       // }
      });
      $('#userRegister').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'actions/register_actions.php',
            data: $('form').serialize(),
            success: function (dataResult) {
              if(dataResult==1){
                window.location.href = 'login.php';
              }
              else{
                alert("Something Went Wrong");
              }
            }
          });

      });

      
  });

  </script>
</body>

</html>
