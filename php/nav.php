<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit();
}
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<header class="topbar">
    <div class="brand">
        <span class="brand-direct">Direct</span><span class="brand-recast">Recast</span>
    </div>
    <nav class="top-nav">
        <a href="Home.php" class="<?php echo $currentPage == 'Home.php' ? 'active' : ''; ?>">
            <i class="bi bi-columns-gap"></i>Home
        </a>
        <a href="Upload_Data.php" class="<?php echo $currentPage == 'Upload_Data.php' ? 'active' : ''; ?>">
            <i class="bi bi-cloud-upload"></i>Upload Data
        </a>
        <a href="EDA.php" class="<?php echo $currentPage == 'EDA.php' ? 'active' : ''; ?>">
            <i class="bi bi-apple"></i> EDA
        </a>
        <a href="Forecasting.php" class="<?php echo $currentPage == 'Forecasting.php' ? 'active' : ''; ?>">
            <i class="bi bi-bank"></i>Forecasting
        </a>
    </nav>

    <div class="user-section" id="userSection">
        <div class="user-icon" aria-label="User profile" id="userIcon" onclick="toggleDropdown()"><i class="bi bi-person-fill"></i></div>
        <div class="dropdown-menu" id="dropdownMenu">
            <button class="signout-btn" onclick="confirmSignOut()">Sign Out</button>
        </div>
    </div>
</header>

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