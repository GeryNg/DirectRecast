<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EDA - Direct Recast</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="../css/Style-EDA.css" />
</head>

<body>
  <?php include 'nav.php'; ?>

  <!-- Main Content -->
  <main class="main-content-centered">
    <div class="dashboard-header">
      <h2 class="dashboard-title" id="dashboardDesc">
        Explore weekly revenue trends and filter data <br/>before further analysis.
      </h2>
    </div>
    <br/>
    <br/>
    <div class="dashboard-container">
      <div class="dashboard-iframe-wrapper">
        <div class="left-tabs">
          <button onclick="showPreEDA()" id="preBtn" class="tab-btn active">Pre-EDA</button>
          <button onclick="showPostEDA()" id="postBtn" class="tab-btn">Post-EDA</button>
        </div>
        <iframe
          id="dashboardFrame"
          width="1024"
          height="604"
          class="dashboard-iframe"
          src="https://app.powerbi.com/view?r=eyJrIjoiYjllY2I5ZWUtYTUwNC00NGI3LWJmMjYtNGJiZmFiZmExZGIwIiwidCI6IjUzN2MyYmUxLWZjZDQtNDVhOS04M2IzLTY2NTNlYWNjNTA3MCIsImMiOjEwfQ%3D%3D&pageName=25d3281e4c23821b657d"
          allowFullScreen="true"></iframe>
      </div>
    </div>
  </main>

  <script>
    function showPreEDA() {
      document.getElementById('dashboardFrame').src =
        "https://app.powerbi.com/view?r=eyJrIjoiMTc4YzE4M2EtMGI4Mi00NmQ0LWFjYWYtMWE4NGIwYTEzZjEyIiwidCI6IjUzN2MyYmUxLWZjZDQtNDVhOS04M2IzLTY2NTNlYWNjNTA3MCIsImMiOjEwfQ%3D%3D&pageName=1947f08750768d92489d";
      document.getElementById('preBtn').classList.add('active');
      document.getElementById('postBtn').classList.remove('active');
      document.getElementById('dashboardDesc').textContent =
        "Explore weekly revenue trends and filter data before further analysis.";
    }

    function showPostEDA() {
      document.getElementById('dashboardFrame').src =
        "https://app.powerbi.com/view?r=eyJrIjoiYjllY2I5ZWUtYTUwNC00NGI3LWJmMjYtNGJiZmFiZmExZGIwIiwidCI6IjUzN2MyYmUxLWZjZDQtNDVhOS04M2IzLTY2NTNlYWNjNTA3MCIsImMiOjEwfQ%3D%3D&pageName=25d3281e4c23821b657d";
      document.getElementById('postBtn').classList.add('active');
      document.getElementById('preBtn').classList.remove('active');
      document.getElementById('dashboardDesc').textContent =
        "Presenting cleaned and analyzed weekly revenue data for deeper insights.";
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