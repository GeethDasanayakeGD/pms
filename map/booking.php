<?php include '../db_conn.php';session_start();if (!isset($_SESSION["id"])) {if (isset($_COOKIE["remember_token"])) {$token = $_COOKIE["remember_token"];$sql = "SELECT id, username FROM `user` WHERE remember_token='$token'";$result = $conn->query($sql);if ($result === false) {die("Error in SQL query: " . $conn->error);}if ($result->num_rows > 0) {$row = $result->fetch_assoc();$_SESSION["id"] = $row["id"];$_SESSION["username"] = $row["username"];$newToken = bin2hex(random_bytes(32));$updateTokenSql = "UPDATE `user` SET remember_token='$newToken' WHERE id={$row['id']}";$conn->query($updateTokenSql);setcookie("remember_token", $newToken, time() + (86400 * 7), "/");header('Location: ../map/');exit();} else {header('Location: ../');exit();}
    } else {header('Location: ../');exit();}}if (isset($_GET['id'])) {$userId = $_GET['id'];$sql = "SELECT * FROM `user` WHERE id = $userId";$result = $conn->query($sql);if ($result === false) {die("Error in SQL query: " . $conn->error);}if ($result->num_rows > 0) {$userDetails = $result->fetch_assoc();}}?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Details</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,700|Roboto:400,700&display=swap" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet" />
  <link href="../css/responsive.css" rel="stylesheet" />
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f8f9fa;
      color: #495057;
      margin: 0;
      padding: 0;
    }
    .sec{
      max-width: 700px;
      margin: 50px auto;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
      border-radius: 5px;
    }

    h1 {
      color: #007bff;
    }

    p {
      margin-bottom: 10px;
    }

    a {
      color: #007bff;
    }
    .top-section {
      text-align: center;
    }

    .top-section img {
      max-width: 100%;
      height: 400px;
      border-radius: 5px;
      margin-bottom: 20px;
    }
     .user-details {
      background-color: #f8f9fa;
      padding: 15px;
      border-radius: 5px;
    }

    .user-details p {
      margin-bottom: 5px;
    }

    .user-details strong {
      font-weight: bold;
    }

    .not-found {
      text-align: center;
      color: #dc3545;
    }
    .overlay {
     display: none;
     position: fixed;
     top: 0;
     left: 0;
     width: 100%;
     height: 100%;
     background-color: rgba(1, 1, 0, 0.8); 
     z-index: 999; 
   }
   .custom-dialog {
     display: none;
     width: 40%;
     position: fixed;
     top: 11%;
     left: 50%;
     transform: translate(-50%, -50%);
     background-color: #fff;
     border: 1px solid #ccc;
     box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
     padding: 30px;
     border-radius: 5px;
     z-index: 1000;
   }
  .custom-dialog p {
    margin: 0;
   }
  .custom-dialog-buttons {
    margin-top: 20px;
    text-align: right;
   }
  .custom-dialog-buttons button {
    margin-left: 10px;
    padding: 8px 15px;
    cursor: pointer;
    border: none;
    border-radius: 3px;
  }
  .confirm-btn {
    background-color: #f55959;
    color: #fff;
  }
  .cancel-btn {
    background-color: #ccc;
    color: #000;
  }

  @media only screen and (max-width: 600px) {
    .custom-dialog {
        width: 90%;
        padding: 20px; 
    }
    
    .custom-dialog-buttons {
        margin-top: 15px; 
    }

    .custom-dialog-buttons button {
        margin-left: 5px; 
        padding: 8px 14px; 
    }
}
</style>
</head>
<body>
<header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="../">
            <span>
              PARKme.
            </span>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse ml-auto" id="navbarSupportedContent">
            <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
              <ul class="navbar-nav  ">
                <li class="nav-item">
                  <a class="nav-link" href="../">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../about.html"> About Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../feature.html"> Features </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../service.html"> Services </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="../contact.html">Contact us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="confirmLogout()">Log Out</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </header>
<div class="overlay" id="overlay"></div>
<section class="sec">
    <div class="top-section">
      <img src="images/park.jpg" alt="Location Image">
      <h3>Test Parking Spot</h3>
      <p class="mb-3">Address: 99/A Silva Road.</p>
    </div>
    <?php
    if (isset($userDetails)) {
        // echo "<p><strong>ID:</strong> " . $userDetails['id'] . "</p>";
        echo "<p><strong>Name:</strong> " . $userDetails['username'] . "</p>";
        // echo "<p><strong>Gender:</strong> " . $userDetails['gender'] . "</p>";
        echo "<p><strong>Vehicle Type:</strong> " . $userDetails['VehicleType'] . "</p>";
        echo "<p><strong>Vehicle Number:</strong> " . $userDetails['vehicleNumber'] . "</p>";
        echo "<p><strong>NIC:</strong> " . $userDetails['nic'] . "</p>";
        echo "<p><strong>Phone Number:</strong> " . $userDetails['phonenumber'] . "</p>";
        echo "<p><strong>Email:</strong> " . $userDetails['email'] . "</p>";
        // Add more details as needed
    } else {
        echo "<p>User not found</p>";
    }
    ?>
<div class="custom-dialog" id="customDialog">
    <p id="customDialogText">Are you sure you want to book this slot?</p>
    <div class="custom-dialog-buttons">
        <button class="cancel-btn" onclick="closeDialog()">No</button>
        <button class="confirm-btn" onclick="confirmBooking()">Yes</button>
    </div>
</div>
    </div>
        <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Slot</th>
                    <th></th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM slots";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $row["slotId"]; ?></td>
                        <td class="slot-status-<?php echo $row["slotId"]; ?>">
                            <?php echo ($row["status"] == 1) ? '<span class="text-success">Available</span>' : '<span class="text-danger">Unavailable</span>'; ?></td>
                        <td>
                            <form method="POST" action="booking.php">

                                <input type="hidden" name="slotId" value="<?php echo $row["slotId"]; ?>">
                                <input type="hidden" name="nic" value="<?php echo $userDetails["nic"]; ?>">
                                <input type="hidden" name="username" value="<?php echo $_SESSION["username"]; ?>">
                                <input type="hidden" name="id" value="<?php echo $_SESSION["id"]; ?>">

                                <?php
                                if ($row["status"] == 1) {
                                    echo '<button type="button" class="btn btn-sm book-btn" onclick="bookSlot(' . $row["slotId"] . ')" style="background-color: #f55959; color: #FFF; font-size: 12px;">Book Now</button>';
                                } else {
                                    echo '<button type="button" class="btn btn-sm" style="background-color: #ddd; color: #888; font-size: 12px;" disabled>Unavailable</button>';
                                }
                                ?>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<a href="../map/" style="color: #fff;"><button type="button" class="btn btn-secondary btn-sm">Go back</button></a>
</section>
<script>
function bookSlot(slotId) {
    document.getElementById('customDialogText').innerText = 'Are you sure you want to book slot number ' + slotId;
    document.getElementById('customDialog').setAttribute('data-slotId', slotId);
    showCustomDialog();
}
function showCustomDialog() {
        document.getElementById('customDialog').style.display = 'block';
    }
    function closeDialog() {
        document.getElementById('customDialog').style.display = 'none';
    }
    function confirmBooking() {
    const slotId = document.getElementById('customDialog').getAttribute('data-slotId');
    fetch('update_slot_status.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            'slotId': slotId,
        }),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            showAlert('Slot ' + slotId + ' booked successfully!', 'success');
            document.forms[0].submit(); 
        } else {
            showAlert('Failed to book slot. Please try again.', 'danger');
        }
        closeDialog();
    })
    .catch(error => {
        showAlert('Error: ' + error.message, 'danger');
        closeDialog();
    });
}
function showCustomDialog() {
    document.getElementById('customDialog').style.display = 'block';
    document.getElementById('overlay').style.display = 'block';
}
function closeDialog() {
    document.getElementById('customDialog').style.display = 'none';
    document.getElementById('overlay').style.display = 'none';
}
function showAlert(message, type) {
        var alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-' + type + ' alert-dismissible fade show';
        alertDiv.role = 'alert';
        alertDiv.innerHTML = message +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
            '<span aria-hidden="true">&times;</span>' +
            '</button>';
        document.body.appendChild(alertDiv);
    }
    function confirmLogout() {
    var isConfirmed = confirm("Are you sure you want to log out?");
    if (isConfirmed) {
        window.location.href = "logout.php";
    }
}
</script>

<section class="info_section mt-3">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <h6>
            Subscribe Now
          </h6>
          <p>
            There are many variations of passages of Lorem Ipsum available,
          </p>
          <form action="subscribe.php">
            <input type="text" placeholder="Enter your email">
            <div class="d-flex justify-content-end">
              <button>
                subscribe
              </button>
            </div>
          </form>
        </div>
        <div class="col-lg-2">
          <h6>
            Information
          </h6>
          <ul>
            <li>
              <a href="">
                There are many
              </a>
            </li>
            <li>
              <a href="">
                variations of
              </a>
            </li>
            <li>
              <a href="">
                passages of Lorem
              </a>
            </li>
            <li>
              <a href="">
                Ipsum available,
              </a>
            </li>
            <li>
              <a href="">
                but the majority
              </a>
            </li>
          </ul>
        </div>
        <div class="col-lg-2">
          <h6>
            Helpful Links
          </h6>
          <ul>
            <li>
              <a href="">
                There are many
              </a>
            </li>
            <li>
              <a href="">
                variations of
              </a>
            </li>
            <li>
              <a href="">
                passages of Lorem
              </a>
            </li>
            <li>
              <a href="">
                Ipsum available,
              </a>
            </li>
            <li>
              <a href="">
                but the majority
              </a>
            </li>
          </ul>
        </div>
        <div class="col-lg-2">
          <h6>
            Invesments
          </h6>
          <ul>
            <li>
              <a href="">
                There are many
              </a>
            </li>
            <li>
              <a href="">
                variations of
              </a>
            </li>
            <li>
              <a href="">
                passages of Lorem
              </a>
            </li>
            <li>
              <a href="">
                Ipsum available,
              </a>
            </li>
            <li>
              <a href="">
                but the majority
              </a>
            </li>
          </ul>
        </div>
        <div class="col-lg-2">
          <h6>
            Contact Us
          </h6>
          <div class="info_link-box">
            <a href="">
              <img src="images/location.png" alt="">
              <span> Location</span>
            </a>
            <a href="">
              <img src="images/call.png" alt="">
              <span>+01 12345678901</span>
            </a>
            <a href="">
              <img src="images/envelope.png" alt="">
              <span> demo123@gmail.com</span>
            </a>
          </div>
          <div class="info_social">
            <div>
              <a href="">
                <img src="images/fb.png" alt="">
              </a>
            </div>
            <div>
              <a href="">
                <img src="images/twitter.png" alt="">
              </a>
            </div>
            <div>
              <a href="">
                <img src="images/linkedin.png" alt="">
              </a>
            </div>
            <div>
              <a href="">
                <img src="images/insta.png" alt="">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  <section class="container-fluid footer_section">
    <p>
      Parking Management Sustem by Group 39 &copy; <span id="displayYear"></span> 
    </p>
  </section>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
