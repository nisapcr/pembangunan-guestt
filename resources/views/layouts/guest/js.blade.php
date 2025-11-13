<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Sweet Alert -->
<script src="{{ asset('assets-admin/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>

<!-- Notyf -->
<script src="{{ asset('assets-admin/vendor/notyf/notyf.min.js') }}"></script>

<!-- Volt JS -->
<script src="{{ asset('assets-admin/js/volt.js') }}"></script>

<script>
    // Auto-hide alerts setelah 5 detik
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    });

    // Smooth dropdown animation
    document.querySelectorAll('.dropdown-toggle').forEach(item => {
        item.addEventListener('click', function(e) {
            if (window.innerWidth < 992) {
                e.preventDefault();
                const dropdown = this.nextElementSibling;
                dropdown.classList.toggle('show');
            }
        });
    });
</script>
