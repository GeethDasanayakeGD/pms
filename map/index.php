<?php include '../db_conn.php';session_start();if (!isset($_SESSION["id"])) {if (isset($_COOKIE["remember_token"])) {$token = $_COOKIE["remember_token"];$sql = "SELECT id, username FROM `user` WHERE remember_token='$token'";$result = $conn->query($sql);if ($result === false) {die("Error in SQL query: " . $conn->error);}if ($result->num_rows > 0) {$row = $result->fetch_assoc();$_SESSION["id"] = $row["id"];$_SESSION["username"] = $row["username"];$newToken = bin2hex(random_bytes(32));$updateTokenSql = "UPDATE `user` SET remember_token='$newToken' WHERE id={$row['id']}";$conn->query($updateTokenSql);setcookie("remember_token", $newToken, time() + (86400 * 7), "/");header('Location: ../map/');exit();} else {header('Location: ../');exit();}} else {header('Location: ../');exit();}}?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Parking Map</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <style>body, html {height: 100%;margin: 0;padding: 0;}#map {height: calc(100vh - 56px); }.modal {overflow-y: auto;}</style>
  <link href="https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.css" rel="stylesheet">
  <script src="https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,700|Roboto:400,700&display=swap" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet" />
  <link href="../css/responsive.css" rel="stylesheet" />
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
                  <a class="nav-link" href="../contact.html">Contact us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#" data-toggle="modal" data-target="#locationModal">Select Location</a>
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
 <div class="container-fluid mt-1">
    <div id="map"></div>
  </div>
 <div class="modal mt-5" id="locationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Select Location</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="locationForm">
            <div class="form-group">
              <label for="locationSelect">Choose a location:</label>
              <select class="form-control" id="locationSelect">
                <option value="colombo">Colombo</option>
                <option value="kandy">Kandy</option>
                <option value="galle">Galle</option>
                <option value="ampara">Ampara</option>
                <option value="anuradhapura">Anuradhapura</option>
                <option value="badulla">Badulla</option>
                <option value="batticaloa">Batticaloa</option>
                <option value="gampaha">Gampaha</option>
                <option value="hambantota">Hambantota</option>
                <option value="jaffna">Jaffna</option>
                <option value="kalutara">Kalutara</option>
                <option value="kagalle">Kurunegala</option>
                <option value="kilinochchi">Kilinochchi</option>
                <option value="kurunegala">Kurunegala</option>
                <option value="mannar">Mannar</option>
                <option value="matale">Matale</option>
                <option value="matara">Matara</option>
                <option value="monaragala">Monaragala</option>
                <option value="mullaitivu">Mullaitivu</option>
                <option value="nuwaraeliya">Nuwara Eliya</option>
                <option value="polonnaruwa">Polonnaruwa</option>
                <option value="puttalam">Puttalam</option>
                <option value="rathnapura">Ratnapura</option>
                <option value="trincomalee">Trincomalee</option>
                <option value="vavuniya">Vavuniya</option>
              </select>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="updateMap()">Update Map</button>
        </div>
      </div>
    </div>
  </div>
<script>
  mapboxgl.accessToken = 'pk.eyJ1IjoiZHVuYWwiLCJhIjoiY2xydzRiaWYxMHZjMzJrcGJvdXFhMGptOSJ9.DD-BWpTw2uiuN6wS07r3Fw';
 var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v11',
    center: [79.8612, 6.9271],
    zoom: 7.82
  });

  var colomboLocation = [79.8612, 6.9271];
  var colomboMarker = new mapboxgl.Marker().setLngLat(colomboLocation);
  colomboMarker.getElement().addEventListener('click', function () {
    openModal('Colombo Parking Spot', 'Colombo Parking Address');
  });
  colomboMarker.addTo(map);

  var esoftPiliyandalaLocation = [79.91871665972059, 6.801193433163439];
  var esoftPiliyandalaMarker = new mapboxgl.Marker().setLngLat(esoftPiliyandalaLocation);
  esoftPiliyandalaMarker.getElement().addEventListener('click', function () {
    openModal('ESOFT Metro Campus Piliyandala Parking Spot', 'Address: 92 C Moratuwa - Piliyandala Rd, Piliyandala 10300');
  });
  esoftPiliyandalaMarker.addTo(map);

  var kandyLocation = [80.6350, 7.2906];
  var kandyMarker = new mapboxgl.Marker().setLngLat(kandyLocation);
  kandyMarker.getElement().addEventListener('click', function () {
    openModal('Kandy Parking Spot', 'Kandy Parking Address');
  });
  kandyMarker.addTo(map);

  var galleLocation = [80.2170, 6.0535];
  var galleMarker = new mapboxgl.Marker().setLngLat(galleLocation);
  galleMarker.getElement().addEventListener('click', function () {
    openModal('Galle Parking Spot', 'Galle Parking Address');
  });
  galleMarker.addTo(map);
 
 function updateMap() {
  var locationSelect = document.getElementById('locationSelect');
  var selectedLocation = locationSelect.options[locationSelect.selectedIndex].value;

  switch (selectedLocation) {
    case 'colombo':
      map.flyTo({ center: [79.8612, 6.9271], zoom: 9.8 });
      break;
    case 'kandy':
      map.flyTo({ center: [80.6350, 7.2906], zoom: 9.8 });
      break;
    case 'galle':
      map.flyTo({ center: [80.2170, 6.0535], zoom: 9.8 });
      break;
    case 'ampara':
      map.flyTo({ center: [81.6718, 7.2964], zoom: 9.8 });
      break;
    case 'anuradhapura':
      map.flyTo({ center: [80.3920, 8.3149], zoom: 9.8 });
      break;
    case 'badulla':
      map.flyTo({ center: [81.0587, 6.9934], zoom: 9.8 });
      break;
    case 'batticaloa':
      map.flyTo({ center: [81.6966, 7.7186], zoom: 9.8 });
      break;
    case 'gampaha':
      map.flyTo({ center: [79.9937, 7.0916], zoom: 9.8 });
      break;
    case 'hambantota':
      map.flyTo({ center: [81.1185, 6.1240], zoom: 9.8 });
      break;
    case 'jaffna':
      map.flyTo({ center: [80.0056, 9.6612], zoom: 9.8 });
      break;
    case 'kalutara':
      map.flyTo({ center: [79.9590, 6.5838], zoom: 9.8 });
      break;
    case 'kagalle':
      map.flyTo({ center: [80.3459, 7.4675], zoom: 9.8 });
      break;
    case 'kilinochchi':
      map.flyTo({ center: [80.4098, 9.3810], zoom: 9.8 });
      break;
    case 'kurunegala':
      map.flyTo({ center: [80.4036, 7.4872], zoom: 9.8 });
      break;
    case 'mannar':
      map.flyTo({ center: [79.9340, 8.9772], zoom: 9.8 });
      break;
    case 'matale':
      map.flyTo({ center: [80.6248, 7.4675], zoom: 9.8 });
      break;
    case 'matara':
      map.flyTo({ center: [80.5354, 5.9549], zoom: 9.8 });
      break;
    case 'monaragala':
      map.flyTo({ center: [81.0014, 6.8847], zoom: 9.8 });
      break;
    case 'mullaitivu':
      map.flyTo({ center: [80.6882, 9.2670], zoom: 9.8 });
      break;
    case 'nuwaraeliya':
      map.flyTo({ center: [80.7821, 6.9558], zoom: 9.8 });
      break;
    case 'polonnaruwa':
      map.flyTo({ center: [81.0666, 7.9403], zoom: 9.8 });
      break;
    case 'puttalam':
      map.flyTo({ center: [79.8284, 8.0332], zoom: 9.8 });
      break;
    case 'rathnapura':
      map.flyTo({ center: [80.4642, 6.6958], zoom: 9.8 });
      break;
    case 'trincomalee':
      map.flyTo({ center: [81.2353, 8.5879], zoom: 9.8 });
      break;
    case 'vavuniya':
      map.flyTo({ center: [80.5000, 8.7500], zoom: 9.8 });
      break;
  }

  $('#locationModal').modal('hide');
}
function openModal(locationName, address) {
    var modalContent = `
<div class="modal fade" id="parkingDetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">${locationName}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><strong>Location:</strong> ${locationName}</p>
        <p><strong>Address:</strong> ${address}</p>
        <p><strong>Available Slots:</strong> 10</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="bookNow()">Book Now</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
`;
    $('#parkingDetailsModal').remove();

    $('body').append(modalContent);

    $('#parkingDetailsModal').modal('show');
  }
</script>
<script>
function bookNow() {
  var userId = <?php echo $_SESSION['id']; ?>;
  window.location.href = 'booking.php?id=' + userId;
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
          <form action="">
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
  </section>
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
