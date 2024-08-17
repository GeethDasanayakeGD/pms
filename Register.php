<!DOCTYPE html>
<html lang="en">
<head>
<title>Create an account | ParkMe</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/58f72b5be6.js" crossorigin="anonymous"></script>

<style type="text/css">
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family:   'Arial', sans-serif;
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
    padding: 30px;
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
  border: 3px solid #f0f0f0;
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
        /* Add some styles for password strength indicator */
#password-strength {

  font-size: 12px;
}

#strength-text {
  font-weight: bold;
}

/* Add this class to style password strength levels */
.password-weak {
  color: red;
}

.password-medium {
  color: orange;
}

.password-strong {
  color: green;
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
    background-color: white; /* Set background color to white */
}

.input-control select.form-control:focus {
    outline: 0;
    background-color: white; /* Set background color to white when focused */
}

.input-control.success select.form-control {
    border-color: #09c372;
}

.input-control.error select.form-control {
    border-color: #ff3860;
}

.input-control .error {
    color: #ff3860;
    font-size: 9px;
    height: 13px;
}
.select-arrow select {
    width: 100%;
    padding-right: 30px; /* Adjust the value based on your preference */
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background: url('https://cdn.iconscout.com/icon/free/png-256/free-keyboard-down-arrow-1780093-1518654.png') no-repeat right center;
    background-size: 20px; /* Adjust the size based on your down arrow icon size */
}

</style>


</head>
<body> 
  <form action="sql/insert.php" id="form" method="POST" enctype="multipart/form-data" class="container mt-3">
        <p>Create an account</p>

        <!-- Profile Photo Input -->
        <div class="input-control mt-4">
            <label for="profile-photo"><i class="fa fa-photo" style="font-size:20px; margin-right: 5px;"></i> Profile photo</label>
            <input id="profile-photo" name="img" type="file" style="background-color: #fff;" onchange="validateProfilePhoto()">
            <div class="error" id="profilePhotoError"></div>
        </div>



        <!-- Username Input -->
        <div class="input-control">
            <label for="username"><i class="fa-regular fa-user" style="font-size:20px; margin-right: 5px;"></i> Username</label>
            <input id="username" name="username" type="text" required>
            <div class="error"></div>
        </div>



        <div class="input-control">
            <label for="gender"><i class="fa-solid fa-venus-mars" style="font-size:18px; margin-right: 5px;"></i> Gender</label>
            <div class="select-arrow">
             <select class="form-control" name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Female">non-binary</option>
        </select>
    </div>
            <div class="error"></div>
        </div>

<div class="input-control">
    <label for="VehicleType"><i class="fa fa-car" style="font-size:16px; margin-right: 5px;"></i>Vehicle type</label>
    <div class="select-arrow">
        <select class="form-control" name="VehicleType" required>
            <option value="car">Car</option>
            <option value="van">Van</option>
            <option value="bike">Bike</option>
        </select>
    </div>
    <div class="error mt-2"></div>
</div>

<div class="input-control">
    <label for="vehicle-number"><i class="fa fa-automobile" style="font-size:16px; margin-right: 5px;"></i>Vehicle Registration Number</label>
    <input id="vehicle-number" name="vehicleNumber" type="text" required>
    <div class="error"></div>
</div>




<div class="input-control">
            <label for="nic"><i class="fa fa-id-card"></i> nic number</label>
            <input id="nic" name="nic" type="nic" required>
            <div class="error"></div>
        </div>


<div class="input-control">
    <label for="phonenumber"><i class="fa fa-phone"></i> Mobile Number</label>

    <!-- Phone Number Input with Placeholder -->
    <input id="phonenumber" name="phonenumber" type="tel" placeholder="+94" required>
    
    <!-- Error message container -->
    <div class="error-container">
        <div class="error" id="phonenumberError"></div>
    </div>

    <!-- Validation script -->
    <script>
        document.getElementById('phonenumber').addEventListener('blur', function() {
            validatePhoneNumber();
        });

        function validatePhoneNumber() {
            var phoneNumberInput = document.getElementById('phonenumber');
            var phoneNumberError = document.getElementById('phonenumberError');

            // Check if the phone number starts with '+94'
            if (!phoneNumberInput.value.startsWith('+94')) {
                phoneNumberError.innerHTML = 'Phone number must start with +94';
                phoneNumberInput.classList.add('error');
            } else {
                phoneNumberError.innerHTML = '';
                phoneNumberInput.classList.remove('error');
            }
        }
    </script>
</div>


        <!-- Email Input -->
        <div class="input-control">
            <label for="email"><i class="fa">&#xf0e0;</i> Email</label>
            <input id="email" name="email" type="email" required>
            <div class="error"></div>
        </div>

        <!-- Password Input -->
        <div class="input-control">
            <label for="password"><i class="fa fa-lock"></i> Password</label>
            <div class="password-toggle">
                <input id="password" name="password" type="password" required pattern=".{8,}" title="Password must be at least 8 characters long" oninput="checkPasswordStrength()">
                <i class="fa fa-eye-slash" id="eye-icon" onclick="togglePasswordVisibility('password')"></i>
            </div>
            <div class="error"></div>
        </div>
        
        <!-- Password Strength Indicator -->
        <div class="password-strength py-2" id="password-strength">
            Password Strength: <span id="strength-text"></span>
        </div>

        <!-- Confirm Password Input -->
       

        <!-- Error Message for Password Match -->

        <!-- Registration Button and Login Link -->
        <div class="row">
            <div class="col-lg-6">
                <button type="submit" style="background-color:#6c56f5; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='#4a3daa'" onmouseout="this.style.backgroundColor='#6c56f5'">Register</button>
            </div>
            <div class="col-lg-6">
                <p class="mt-4 border-bottom" style="font-size: 15px;">Have an account?<span><a href="Login.php"> Login here</a></span></p>
            </div>
        </div>

        <!-- Terms of Service Link -->
        <p style="font-size: 12px;" class="text-start mt-3">By creating an account, you're accepting our<a href="../Terms/"> Terms of Service</a></p>
    </form>
<script>
    function validateProfilePhoto() {
        var profilePhotoInput = document.getElementById("profile-photo");
        var profilePhotoError = document.getElementById("profilePhotoError");

        if (profilePhotoInput.files.length === 0) {
            profilePhotoError.innerHTML = "Please select a profile photo";
            profilePhotoInput.classList.add("error");
            return false;
        }

        var allowedTypes = ["image/jpeg", "image/png", "image/gif"];
        if (!allowedTypes.includes(profilePhotoInput.files[0].type)) {
            profilePhotoError.innerHTML = "Invalid file type. Please select a valid image file.";
            profilePhotoInput.classList.add("error");
            return false;
        }

        var maxSize = 5 * 1024 * 1024; // 5 MB
        if (profilePhotoInput.files[0].size > maxSize) {
            profilePhotoError.innerHTML = "File size exceeds the allowed limit (5 MB). Please select a smaller file.";
            profilePhotoInput.classList.add("error");
            return false;
        }

        profilePhotoError.innerHTML = "";
        profilePhotoInput.classList.remove("error");

        return true;
    }

    function validateForm() {
        var isProfilePhotoValid = validateProfilePhoto();

        return isProfilePhotoValid;
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Set the initial state of the eye icon based on the input type
        setInitialEyeIconState('password', 'eye-icon');
    });

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

    function checkPasswordStrength() {
        var password = document.getElementById("password").value;
        var strengthText = document.getElementById("strength-text");

        // Define password strength criteria
        var passwordRegex = /^(?=.*[a-zA-Z\d@$!%*?&]).{8,}$/;

        if (password.length >= 14) {
            strengthText.innerHTML = "Strong";
            strengthText.className = "password-strong";
        } else if (password.length >= 8) {
            strengthText.innerHTML = "Medium";
            strengthText.className = "password-medium";
        } else {
            strengthText.innerHTML = "Weak";
            strengthText.className = "password-weak";
        }
    }
</script>




<footer>
    <!-- footer -->
</footer>

</body>
</html>
