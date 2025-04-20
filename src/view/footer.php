</div> <!-- Close container -->

    <footer class="mt-5">
      <div class="text-center py-4">
        <div class="mb-2">
          <img src="<?php echo (strpos($_SERVER['REQUEST_URI'], 'view') !== false) ? '../assets/logo.png' : 'assets/logo.png'; ?>" alt="Future Gadget Lab" height="25" class="me-2"> Future Gadget Lab
        </div>
        <div class="small text-muted">
          Managing the future, one gadget at a time
        </div>
      </div>
      
      <!-- Sponsors Section -->
      <div class="sponsors-section py-4">
        <div class="container">
          <h5 class="text-center mb-4">Sponsored By</h5>
          <div class="d-flex justify-content-center align-items-center flex-wrap">
            <div class="sponsor-logo mx-3 mb-3">
              <img src="<?php echo (strpos($_SERVER['REQUEST_URI'], 'view') !== false) ? '../assets/logo1.jpg' : 'assets/logo1.jpg'; ?>" alt="Sponsor 1">
            </div>
            <div class="sponsor-logo mx-3 mb-3">
              <img src="<?php echo (strpos($_SERVER['REQUEST_URI'], 'view') !== false) ? '../assets/logo2.jpg' : 'assets/logo2.jpg'; ?>" alt="Sponsor 2">
            </div>
            <div class="sponsor-logo mx-3 mb-3">
              <img src="<?php echo (strpos($_SERVER['REQUEST_URI'], 'view') !== false) ? '../assets/logo3.jpg' : 'assets/logo3.jpg'; ?>" alt="Sponsor 3">
            </div>
            <div class="sponsor-logo mx-3 mb-3">
              <img src="<?php echo (strpos($_SERVER['REQUEST_URI'], 'view') !== false) ? '../assets/logo4.jpg' : 'assets/logo4.jpg'; ?>" alt="Sponsor 4">
            </div>
            <div class="sponsor-logo mx-3 mb-3">
              <img src="<?php echo (strpos($_SERVER['REQUEST_URI'], 'view') !== false) ? '../assets/logo5.png' : 'assets/logo5.png'; ?>" alt="Sponsor 5">
            </div>
          </div>
        </div>
      </div>
      
      <div class="copyright text-center py-3">
        © 2024 Future Gadget Lab | All Rights Reserved
      </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="<?php echo (strpos($_SERVER['REQUEST_URI'], 'view') !== false) ? '../scripts.js' : 'scripts.js'; ?>"></script>
</body>
</html>
