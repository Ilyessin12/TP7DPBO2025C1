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
