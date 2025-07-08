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
  <title>Forecasting - Direct Recast</title>
  <link rel="stylesheet" href="../css/Style-Forecasting.css" />
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
    </nav>

    <div class="user-section" id="userSection">
      <div class="user-icon" aria-label="User profile" id="userIcon" onclick="toggleDropdown()">👤</div>
      <div class="dropdown-menu" id="dropdownMenu">
        <button class="signout-btn" onclick="confirmSignOut()">Sign Out</button>
      </div>
    </div>

  </header>

  <!-- Main Content -->
  <main class="main-content">
 <centre><iframe src= "../css/testing.html" height="700" width="1000" ><iframe></centre>
  </main>

  <script>
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
