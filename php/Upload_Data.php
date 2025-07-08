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
  <title>Upload Data - Direct Recast</title>
  <!-- Use the SAME CSS as Home for consistency -->
  <link rel="stylesheet" href="../css/Style-Upload-Data.css" />
</head>

<body>
  <!-- Top Navigation -->
  <header class="topbar">
    <div class="brand">
      <span class="brand-direct">Direct</span> <span class="brand-recast">Recast</span>
    </div>
    <nav class="top-nav">
      <a href="Home.php" class="<?php echo $currentPage == 'Home.php' ? 'active' : ''; ?>">
        <img src="../images/Home.jpg" alt="Home" class="nav-icon" /> Home
      </a>
      <a href="Upload_Data.php" class="<?php echo $currentPage == 'Upload_Data.php' ? 'active' : ''; ?>">
        <img src="../images/Upload Data.jpg" alt="Upload Data" class="nav-icon" /> Upload Data
      </a>
      <a href="EDA.php" class="<?php echo $currentPage == 'EDA.php' ? 'active' : ''; ?>">
        <img src="../images/EDA.jpg" alt="EDA" class="nav-icon" /> EDA
      </a>
      <a href="Forecasting.php" class="<?php echo $currentPage == 'Forecasting.php' ? 'active' : ''; ?>">
        <img src="../images/Forecasting.jpg" alt="Forecasting" class="nav-icon" /> Forecasting
      </a>
    </nav>

    <div class="user-section" id="userSection">
      <div class="user-icon" aria-label="User profile" id="userIcon" onclick="toggleDropdown()">👤</div>
      <div class="dropdown-menu" id="dropdownMenu">
        <button class="signout-btn" onclick="confirmSignOut()">Sign Out</button>
      </div>
    </div>
  </header>


  <div id="overlay" class="overlay"></div>
  <div class="container">
    <div class="header">
      <h1>File Upload</h1>
      <p>Drag & drop files or click to browse</p>
    </div>

    <div class="dropbox" id="dropbox">
      <div class="dropbox-icon">📁</div>
      <div class="dropbox-text">Drop files here</div>
      <div class="dropbox-subtext">Supported formats: xlsx, csv (Max 60MB)</div>
      <button class="browse-btn">Browse Files</button>
      <input type="file" id="fileInput" multiple hidden><!--multi submit-->
      <!--<input type="file" id="fileInput" hidden>--><!--single submit-->
    </div>

    <div class="upload-stats" id="uploadStats">
      <div class="stats-header">
        <div class="stats-title">Upload Summary</div>
      </div>
      <div class="stats-info">
        <div class="stat-item">
          <div class="stat-value" id="fileCount">0</div>
          <div class="stat-label">Files</div>
        </div>
        <div class="stat-item">
          <div class="stat-value" id="totalSize">0 KB</div>
          <div class="stat-label">Total Size</div>
        </div>
      </div>
      <div class="progress-bar" style="margin-top: 15px;">
        <div class="progress-fill" id="progressFill"></div>
      </div>
    </div>


    <div class="empty-state" id="emptyState">
      No files uploaded yet
    </div>

    <div class="file-previews" id="filePreviews"></div>
  </div>

  <div class="upload-notification" id="notification">
    <span id="notificationText">File uploaded successfully!</span>
    <div class="notification-progress"></div>
  </div>
  </div>
  </div>




  <!-- JavaScript -->
  <script>
    const menuToggles = document.querySelectorAll("#menuToggle");
    const sidebarWrapper = document.getElementById("sidebarWrapper");
    const overlay = document.getElementById("overlay");
    const body = document.body;

    menuToggles.forEach((btn) =>
      btn.addEventListener("click", () => {
        sidebarWrapper.classList.toggle("show");
        overlay.classList.toggle("show");
        body.classList.toggle("sidebar-open");
      })
    );

    overlay.addEventListener("click", () => {
      sidebarWrapper.classList.remove("show");
      overlay.classList.remove("show");
      body.classList.remove("sidebar-open");
    });

    // Upload data 

    const dropbox = document.getElementById('dropbox');
    const fileInput = document.getElementById('fileInput');
    const filePreviews = document.getElementById('filePreviews');
    const notification = document.getElementById('notification');
    const browseBtn = document.querySelector('.browse-btn');
    const uploadStats = document.getElementById('uploadStats');
    const fileCountEl = document.getElementById('fileCount');
    const totalSizeEl = document.getElementById('totalSize');
    const progressFill = document.getElementById('progressFill');
    const emptyState = document.getElementById('emptyState');

    let fileCount = 0;
    let totalSize = 0;

    // Initialize display
    updateDisplay();

    // Prevent default behavior for drag and drop events
    dropbox.addEventListener('dragover', (e) => {
      e.preventDefault();
      dropbox.classList.add('dragover');
    });

    dropbox.addEventListener('dragleave', () => {
      dropbox.classList.remove('dragover');
    });

    // Handle file drop
    dropbox.addEventListener('drop', (e) => {
      e.preventDefault();
      dropbox.classList.remove('dragover');
      const files = e.dataTransfer.files;
      handleFiles(files);
    });

    // Handle file selection through the input
    fileInput.addEventListener('change', (e) => {
      const files = e.target.files;
      handleFiles(files);
    });

    // Trigger file input when dropbox or browse button is clicked
    dropbox.addEventListener('click', () => {
      fileInput.click();
    });

    browseBtn.addEventListener('click', (e) => {
      e.stopPropagation(); // Prevent event bubbling
      fileInput.click();
    });

    // Handle files
    function handleFiles(files) {
      const allowedTypes = [
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // .xlsx
        'text/csv' // .csv
      ];

      const maxSize = 60 * 1024 * 1024; // 60 MB

      /*Multi Upload Logic*/
      if (files.length > 0) {
        let validFiles = 0;
        let invalidFiles = 0;
        const errorDetails = [];

        Array.from(files).forEach(file => {
          if (!allowedTypes.includes(file.type)) {
            errorDetails.push({
              fileName: file.name,
              errorCode: 'INVALID_TYPE',
              errorMessage: 'File type not supported. Only .xlsx and .csv are allowed.'
            });
            showNotification(`${file.name} is not a valid file type.`, 'error');
            invalidFiles++;
            return;
          }

          if (file.size > maxSize) {
            errorDetails.push({
              fileName: file.name,
              errorCode: 'SIZE_EXCEEDED',
              errorMessage: 'File size exceeds 5 MB limit.'
            });
            showNotification(`${file.name} is too large. Maximum file size is 5 MB.`, 'error');
            invalidFiles++;
            return;
          }

          displayFilePreview(file);
          validFiles++;
        });

        if (validFiles > 0) {
          simulateUpload(validFiles);
          showNotification(`${validFiles} file${validFiles !== 1 ? 's' : ''} added successfully.`, 'success');
        }

        if (invalidFiles > 0) {
          console.log(`Invalid files detected: ${invalidFiles} file${invalidFiles !== 1 ? 's' : ''} failed validation. Details:`, errorDetails);
          showNotification(`${invalidFiles} file${invalidFiles !== 1 ? 's' : ''} not added due to errors.`, 'error');
        }
      }
      /*Single Upload Logic*/
      /*
      if (files.length > 1) {
    showNotification('Only one file can be uploaded at a time.', 'error');
    resetFileInput();
    return;
  }

  if (files.length === 0) {
    return;
  }

  const file = files[0]; // Only process the first file

  // Validate file type
  if (!allowedTypes.includes(file.type)) {
    showNotification(`${file.name} is not a valid file type. Only .xlsx and .csv are allowed.`, 'error');
    resetFileInput();
    return;
  }

  // Validate file size
  if (file.size > maxSize) {
    showNotification(`${file.name} is too large. Maximum file size is 60 MB.`, 'error');
    resetFileInput();
    return;
  }

  // Clear existing files
  filePreviews.innerHTML = '';
  fileCount = 0;
  totalSize = 0;

  // Process the new file
  displayFilePreview(file);
  simulateUpload(1);
  showNotification(`${file.name} added successfully.`, 'success');
      */
    }

    function displayFilePreview(file) {
      const reader = new FileReader();
      const fileId = `file-${Date.now()}-${Math.floor(Math.random() * 1000)}`;

      reader.onload = function(event) {
        const preview = document.createElement('div');
        preview.classList.add('file-preview');
        preview.id = fileId;

        // Format file size
        const fileSize = formatFileSize(file.size);

        // Determine if it's an image or PDF
        const isImage = file.type.startsWith('image/');

        let previewContent;
        if (isImage) {
          previewContent = `<img src="${event.target.result}" class="preview-img">`;
        } else {
          previewContent = `<div class="file-icon">📄</div>`;
        }

        preview.innerHTML = `
          <div class="preview-img-container">
            ${previewContent}
          </div>
          <div class="file-info">
            <div class="file-name">${file.name}</div>
            <div class="file-size">${fileSize}</div>
            <div class="file-actions">
              <button class="remove-btn">Remove</button>
            </div>
          </div>
        `;

        // Add remove functionality
        const removeBtn = preview.querySelector('.remove-btn');
        removeBtn.addEventListener('click', () => {
          removeFile(fileId, file.size);
        });

        filePreviews.appendChild(preview);

        // Update statistics
        fileCount++;
        totalSize += file.size;
        updateDisplay();
      };

      reader.readAsDataURL(file);
    }

    function removeFile(fileId, size) {
      const fileElement = document.getElementById(fileId);
      if (fileElement) {
        // Animate removal
        fileElement.style.opacity = '0';
        fileElement.style.transform = 'scale(0.9)';

        setTimeout(() => {
          fileElement.remove();

          // Update statistics
          fileCount--;
          totalSize -= size;
          updateDisplay();

          showNotification('File removed', 'success');
        }, 300);
      }

      resetFileInput();
    }

    function updateDisplay() {
      fileCountEl.textContent = fileCount;
      totalSizeEl.textContent = formatFileSize(totalSize);

      if (fileCount > 0) {
        uploadStats.style.display = 'block';
        emptyState.style.display = 'none';
        progressFill.style.width = '100%';
      } else {
        uploadStats.style.display = 'none';
        emptyState.style.display = 'block';
      }
    }

    function formatFileSize(bytes) {
      if (bytes === 0) return '0 Bytes';

      const k = 1024;
      const sizes = ['Bytes', 'KB', 'MB', 'GB'];
      const i = Math.floor(Math.log(bytes) / Math.log(k));

      return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    function showNotification(message, type = 'success') {
      // Clear any existing timeout
      clearTimeout(notification.timeout);

      // Hide notification if it's already showing
      notification.classList.remove('show', 'success', 'error');

      // Set content and show
      document.getElementById('notificationText').textContent = message;
      notification.classList.add('show', type);

      // Reset progress bar
      const progressBar = notification.querySelector('.notification-progress');
      progressBar.style.transition = 'none';
      progressBar.style.transform = 'scaleX(0)';

      // Force reflow to restart animation
      void notification.offsetWidth;

      // Start progress animation
      progressBar.style.transition = 'transform 3s linear';
      progressBar.style.transform = 'scaleX(1)';

      // Auto-hide after 3 seconds
      notification.timeout = setTimeout(() => {
        notification.classList.remove('show');
      }, 3000);
    }

    function simulateUpload(fileCount) {
      // This would be where you'd actually upload to a server
      // For now we're just showing the progress visually
      progressFill.style.width = '0%';

      setTimeout(() => {
        progressFill.style.width = '30%';

        setTimeout(() => {
          progressFill.style.width = '60%';

          setTimeout(() => {
            progressFill.style.width = '100%';
          }, 200);
        }, 200);
      }, 100);
    }

    // Reset the file input after a file is removed
    function resetFileInput() {
      fileInput.value = '';
    }

    // Initial UI setup
    function initUI() {
      if (fileCount === 0) {
        uploadStats.style.display = 'none';
        emptyState.style.display = 'block';
      }
    }

    // Initialize UI
    initUI();
  </script>

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