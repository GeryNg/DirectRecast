<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home - Direct Recast</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="../css/Style-Home.css" />
</head>

<body>
  <?php include 'nav.php'; ?>


  <div class="container">
    <div class="text-content">
      <h1>Welcome to <br/><span>Direct Recast</span></h1>
      <p class="subtitle">Smarter forecasts. Better decisions.</p>
      <p class="description">
        Turn complex data into clear strategies. With smart forecasting and sharp insights, we help
        you navigate trends and drive impactful decisions.
      </p>
      <div class="buttons">
        <a href="#" class="btn-blue">What is Direct Recast?</a>
        <a href="#" class="btn-orange">Upload Your Sales Data</a>
      </div>
    </div>
    <div class="image-content">
      <img src="../images/girl.png" alt="Direct Recast Illustration" />
    </div>
  </div>


<!--
  Main Content
  <main class="main-content">
    <section class="welcome-card" id="welcome-card">
      <h1>
        Welcome to <span class="brand-direct">Direct</span> <span class="brand-recast">Recast</span>
      </h1>
      <h3>Smarter forecasts. Better decisions.</h3>
      <p>
        Turn complex data into clear strategies. With smart forecasting and sharp insights,
        we help you navigate trends and drive impactful decisions.
      </p>
      <div class="button-group">
        <button class="info-btn" onclick="showCanva()">What is Direct Recast?</button>
        <button class="upload-btn" onclick="window.location.href='Upload_Data.php'">Upload Your Sales Data</button>
      </div>
    </section>

    <div id="canva-container" style="display: none; margin-top: 20px;">
      <iframe
        src="https://www.canva.com/design/DAGsL_AoCY4/xGb08qJXCk_uztIDZ6vzAg/view?embed"
        width="1000"
        height="563"
        style="border: none;"
        allowfullscreen="allowfullscreen"
        allow="fullscreen"></iframe>
    </div>
  </main>
  
  <script>
    function showCanva() {
      document.getElementById('welcome-card').style.display = 'none';
      document.getElementById('canva-container').style.display = 'block';
    }
  </script>
-->
</body>

</html>