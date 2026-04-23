    </main> <!-- End Main Content Wrapper -->
</div> <!-- End d-flex wrapper -->

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/script.js"></script>

<!-- Active Link Highlight Script -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let currentLocation = window.location.pathname.split('/').pop();
        if (currentLocation === '') currentLocation = 'dashboard.php';
        
        let navLinks = document.querySelectorAll('.sidebar .nav-link');
        navLinks.forEach(link => {
            if (link.getAttribute('href') === currentLocation) {
                link.classList.add('active', 'bg-primary', 'text-white', 'shadow-sm');
            }
        });
    });
</script>
</body>
</html>
