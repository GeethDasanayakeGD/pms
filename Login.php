<!DOCTYPE html>
<html lang="en">
<head>
<title>Login | ParkMe</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/58f72b5be6.js" crossorigin="anonymous"></script>
<style type="text/css">


*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family:  'Arial', sans-serif;
}

body{
    background: #1a233a;
}

 a{
    text-decoration: none;
}

#form {
    width: 50%;
    margin: 5vh auto 0 auto;
    padding: 60px;
    background-color: #fff;
    font-size: 13px;
    font-weight: normal;

}

#form p {
    font-size: 20px;
    color: #0f2027;
    text-align: center;
}

#form button {
    padding: 10px;
    margin-top: 10px;
    width: 50%;
    color: white;
    background-color: rgb(41, 57, 194);
    border: none;
    border-radius: 4px;
}

.input-control {
    display: flex;
    flex-direction: column;
}

.input-control input {
    border: 2px solid #f0f0f0;
  border-radius: 4px;
  display: block;
  font-size: 15px;
  padding: 10px;
  width: 100%;
}

.input-control input:focus {
    outline: 0;
}

.input-control.success input {
    border-color: #09c372;
}

.input-control.error input {
    border-color: #ff3860;
}

.input-control .error {
    color: #ff3860;
    font-size: 9px;
    height: 13px;
}
.error {
        color: red;
        font-size: 18px;
    }
 .password-toggle {
            position: relative;
        }

        .password-toggle i {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
#password-strength {

  font-size: 12px;
}

#strength-text {
  font-weight: bold;
}


@media screen and (max-width:865px){
   #form{width: 100%}

}

.select-arrow {
    position: relative;
    width: 100%;
}

.input-control select.form-control {
    border: 2px solid #f0f0f0;
    border-radius: 4px;
    display: block;
    font-size: 15px;
    padding: 10px;
    width: 100%;
    background-color: white; 
}

.input-control select.form-control:focus {
    outline: 0;
    background-color: white; 
}

.input-control.success select.form-control {
    border-color: #09c372;
}

.input-control.error select.form-control {
    border-color: #ff3860;
}
</style>
</head>
<body> 
  <form action="sql/login.php" id="form" method="POST" enctype="multipart/form-data" class="container mt-3">
        <p>Login</p>
        <div class="input-control">
            <label for="username"><i class="fa-regular fa-user"  style="font-size:20px; margin-right: 5px;"></i> Username or Email</label>
            <input id="username" name="username" type="text" required>
            <div class="error"></div>
        </div>
        <div class="input-control">
            <label for="password"><i class="fa fa-lock"></i>Password</label>
            <div class="password-toggle">
                <input id="password" name="password" type="password" required pattern=".{8,}" title="Password must be at least 8 characters long" oninput="checkPasswordStrength()">
                <i class="fa fa-eye-slash" id="eye-icon" onclick="togglePasswordVisibility('password')"></i>
            </div>
            <div class="error"></div>
        </div>
        <div class="form-check py-2">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember Me</label>
            </div>
        <div class="row">
            <div class="col-lg-6">
                <button type="submit" class="w-100" style="background-color:#6c56f5; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='#4a3daa'" onmouseout="this.style.backgroundColor='#6c56f5'">Login</button>
            </div>
            <div class="col-lg-6">
                <p class="mt-4 border-bottom" style="font-size: 15px;">Dont Have an account?<span><a href="Register.php"> Register here</a></span></p>
            </div>
        </div>


    </form>
<script>
 function togglePasswordVisibility(inputId) {
        var input = document.getElementById(inputId);
        var eyeIcon = document.getElementById('eye-icon');

        if (input.type === "password") {
            input.type = "text";
            eyeIcon.className = "fa fa-eye";
        } else {
            input.type = "password";
            eyeIcon.className = "fa fa-eye-slash";
        }
    }

    function setInitialEyeIconState(inputId, eyeIconId) {
        var input = document.getElementById(inputId);
        var eyeIcon = document.getElementById(eyeIconId);

        if (input.type === "password") {
            eyeIcon.className = "fa fa-eye-slash";
        } else {
            eyeIcon.className = "fa fa-eye";
        }
    }
</script>




<footer>
    <!-- footer -->
</footer>

</body>
</html>
