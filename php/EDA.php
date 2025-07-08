<?php
session_start();
if (!isset($_SESSION['user_name'])) {
  header("Location: login.php");
  exit();
}
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EDA - Direct Recast</title>
  <link rel="stylesheet" href="../css/Style-EDA.css" />
</head>
<body>
  <!-- Top Navigation -->
  <header class="topbar">
    <div class="brand">
      <span class="brand-direct">Direct</span> <span class="brand-recast">Recast</span>
    </div>
    <nav class="top-nav">
      <a href="Home.php" class="<?php echo $currentPage == 'Home.php' ? 'active' : ''; ?>">
        <img src="../images/Home.jpg" alt="Home" class="nav-icon"/> Home
      </a>
      <a href="Upload_Data.php" class="<?php echo $currentPage == 'Upload_Data.php' ? 'active' : ''; ?>">
        <img src="../images/Upload Data.jpg" alt="Upload Data" class="nav-icon"/> Upload Data
      </a>
      <a href="EDA.php" class="<?php echo $currentPage == 'EDA.php' ? 'active' : ''; ?>">
        <img src="../images/EDA.jpg" alt="EDA" class="nav-icon"/> EDA
      </a>
      <a href="Forecasting.php" class="<?php echo $currentPage == 'Forecasting.php' ? 'active' : ''; ?>">
        <img src="../images/Forecasting.jpg" alt="Forecasting" class="nav-icon"/> Forecasting
      </a>

    <div class="user-section" id="userSection">
      <div class="user-icon" aria-label="User profile" id="userIcon" onclick="toggleDropdown()">👤</div>
      <div class="dropdown-menu" id="dropdownMenu">
        <button class="signout-btn" onclick="confirmSignOut()">Sign Out</button>
      </div>
    </div>
  </header>

  <!-- Main Content -->
<main class="main-content-centered">
  <div class="centered-iframe">
    <div class="dashboard-desc">
      This page shows the Pre-EDA Dashboard, allowing you to explore weekly revenue trends and filter data before further analysis.
    </div>
    <iframe
      id="dashboardFrame"
      width="1024"
      height="604"
      class="dashboard-iframe"
      src="https://app.powerbi.com/view?r=eyJrIjoiYjllY2I5ZWUtYTUwNC00NGI3LWJmMjYtNGJiZmFiZmExZGIwIiwidCI6IjUzN2MyYmUxLWZjZDQtNDVhOS04M2IzLTY2NTNlYWNjNTA3MCIsImMiOjEwfQ%3D%3D&pageName=25d3281e4c23821b657d"
      allowFullScreen="true"
    ></iframe>
  </div>
  <div class="right-tabs">
    <button onclick="showPreEDA()" id="preBtn" class="tab-btn active">Pre-EDA</button>
    <button onclick="showPostEDA()" id="postBtn" class="tab-btn">Post-EDA</button>
  </div>
</main>

<script>
function showPreEDA() {
  document.getElementById('dashboardFrame').src =
    "https://app.powerbi.com/view?r=eyJrIjoiMTc4YzE4M2EtMGI4Mi00NmQ0LWFjYWYtMWE4NGIwYTEzZjEyIiwidCI6IjUzN2MyYmUxLWZjZDQtNDVhOS04M2IzLTY2NTNlYWNjNTA3MCIsImMiOjEwfQ%3D%3D&pageName=1947f08750768d92489d";
  document.getElementById('preBtn').classList.add('active');
  document.getElementById('postBtn').classList.remove('active');
}
function showPostEDA() {
  document.getElementById('dashboardFrame').src =
    "https://app.powerbi.com/view?r=eyJrIjoiYjllY2I5ZWUtYTUwNC00NGI3LWJmMjYtNGJiZmFiZmExZGIwIiwidCI6IjUzN2MyYmUxLWZjZDQtNDVhOS04M2IzLTY2NTNlYWNjNTA3MCIsImMiOjEwfQ%3D%3D&pageName=25d3281e4c23821b657d";
  document.getElementById('postBtn').classList.add('active');
  document.getElementById('preBtn').classList.remove('active');
}

    function toggleDropdown() {
      const dropdown = document.getElementById('dropdownMenu');
      dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    }

    function confirmSignOut() {
      window.location.href = 'logout.php';
      document.getElementById('dropdownMenu').style.display = 'none';
    }

    document.addEventListener('click', function(event) {
      const userSection = document.getElementById('userSection');
      const dropdown = document.getElementById('dropdownMenu');
      if (!userSection.contains(event.target)) {
        dropdown.style.display = 'none';
      }
    });
  </script>

</body>
</html>
