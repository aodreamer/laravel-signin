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
        <style>
            /* Center the table within the popup */
            .center-table {
                margin: auto;
            }

            /* Add some spacing between cells */
            table {
                border-collapse: collapse;
            }

            td {
                padding: 5px;
            }
        </style>
        <script>
            // Function to convert the JSON data into a nested table format
            function jsonToTable(jsonData) {
                let table = '<table border="1" class="center-table">';
                for (let key in jsonData) {
                    if (jsonData.hasOwnProperty(key)) {
                        let value = jsonData[key];
                        if (typeof value === 'object') {
                            table += '<tr><td>' + key + '</td><td>' + jsonToTable(value) + '</td></tr>';
                        } else {
                            table += '<tr><td>' + key + '</td><td>' + JSON.stringify(value) + '</td></tr>';
                        }
                    }
                }
                table += '</table>';
                return table;
            }

            // Show the pop-up alert with JSON data in a nested table format
            Swal.fire({
                title: 'JSON Data',
                html: jsonToTable(@json($data)),
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
