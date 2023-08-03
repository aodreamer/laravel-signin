<!DOCTYPE html>
<html>
<head>
    <title>Result</title>
    <!-- Include SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
</head>
<body>
    @if(isset($data) && !empty($data))
        <!-- Include SweetAlert2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
        <script>
            // Show the pop-up alert with JSON data
            Swal.fire({
=               html: '<pre>' + JSON.stringify(@json($data), null, 2) + '</pre>',
                icon: 'info',
                confirmButtonText: 'OK'
            });
        </script>
    @else
        <!-- Include SweetAlert2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
        <script>
            // Show the pop-up alert when there is no data
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Tidak ada sertifikat!',
            });
        </script>
    @endif
</body>
</html>
