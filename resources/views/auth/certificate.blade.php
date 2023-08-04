@extends('auth.dashboard')

@section('content')

<!DOCTYPE html>
<meta name="csrf-token" content="{{ csrf_token() }}">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">

<style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: #333;
            justify-content: center;
            align-items: center;
            font-family: consolas;
        }

        .container {
            width: 100%;
            position: center;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }

        .container .card {
            position: relative;
            cursor: pointer;
        }

        .container .card .face {
            width: 300px;
            height: 200px;
            transition: 0.5s;
        }

        .container .card .face.face1 {
            position: relative;
            background: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1;
            transform: translateY(100px);
        }

        .container .card:hover .face.face1 {
            background: #ff0057;
            transform: translateY(0);
        }

        .container .card .face.face1 .content {
            opacity: 0.2;
            transition: 0.5s;
        }

        .container .card:hover .face.face1 .content {
            opacity: 1;
        }

        .container .card .face.face1 .content img {
            max-width: 100px;
        }

        .container .card .face.face1 .content h3 {
            margin: 10px 0 0;
            padding: 0;
            color: #fff;
            text-align: center;
            font-size: 1.5em;
        }

        .container .card .face.face2 {
            position: relative;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            box-sizing: border-box;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.8);
            transform: translateY(-100px);
        }

        .container .card:hover .face.face2 {
            transform: translateY(0);
        }

        .container .card .face.face2 .content p {
            margin: 0;
            padding: 0;
        }

        .container .card .face.face2 .content a {
            margin: 15px 0 0;
            display: inline-block;
            text-decoration: none;
            font-weight: 900;
            color: #333;
            padding: 5px;
            border: 1px solid #333;
        }

        .container .card .face.face2 .content a:hover {
            background: #333;
            color: #fff;
        }

        .container .table-responsive {
            margin: 0 auto; /* Center the table */
            width: 100%; /* Ensure it takes the full width */
        }

        .container .table-striped thead {
            color: #fff; /* Set the text color of table header to white */
            border-color: white; /* Set the border color of table header to white */
        }

        .container .table-striped tbody tr {
            color: #fff; /* Set the text color of table rows to white */
        }

        .container .table-striped tbody tr td {
            border-color: white; /* Set the border color of table cells to white */
        }
        .container .table-responsive h2 {
            color: #fff; /* Set the text color of the heading to white */
        }

        .container .table-striped thead th {
            color: #fff; /* Set the text color of the table header to white */
            border-top: 1px solid #fff; /* Set the top border of the table header to white */
            border-bottom: 1px solid #fff; /* Set the bottom border of the table header to white */
        }

        .container .table-striped tbody td {
            color: #fff; /* Set the text color of the table data cells to white */
            border-top: 1px solid #fff; /* Set the top border of the table data cells to white */
            border-bottom: 1px solid #fff; /* Set the bottom border of the table data cells to white */
        }

        .container .table-responsive h2 {
            color: #fff; /* Set the text color to white */
        }

    </style>
    </head>


<body>
    <div class="container mt-5">
        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @elseif($certificate==null)
            <h1>Test</h1>
        @else
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="face face1">
                        <div class="content">
                            <img src="https://github.com/Jhonierpc/WebDevelopment/blob/master/CSS%20Card%20Hover%20Effects/img/design_128.png?raw=true">
                            <h3>Download</h3>
                        </div>
                    </div>
                    <div class="face face2">
                        <div class="content">
                            <button class="btn btn-primary btn-lg btn-block" onclick="showCertificate()">Download Sertifikat</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="face face1">
                        <div class="content">
                            <img src="https://github.com/Jhonierpc/WebDevelopment/blob/master/CSS%20Card%20Hover%20Effects/img/code_128.png?raw=true">
                            <h3>Show</h3>
                        </div>
                    </div>
                    <div class="face face2">
                        <div class="content">
                            <button class="btn btn-primary btn-lg btn-block" onclick="showPasswordPopup()">Lihat Password P12</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="face face1">
                        <div class="content">
                            <img src="https://github.com/Jhonierpc/WebDevelopment/blob/master/CSS%20Card%20Hover%20Effects/img/launch_128.png?raw=true">
                            <h3>Request</h3>
                        </div>
                    </div>
                    <div class="face face2">
                        <div class="content">
                            <button class="btn btn-primary btn-lg btn-block" onclick="showSubmitRequestPopup()">Ajukan Perubahan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
    <div class="col-md-12 d-flex justify-content-center">
        <h2 style="color: white;">History Pengajuan</h2>
    </div>
</div>
        @if($requests->isEmpty())
        <p>Anda belum melakukan pengajuan perubahan sertifikat.</p>
        @else
        <div class="table-responsive w-100">
            <div class="table-wrapper">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tanggal Pengajuan</th>
                            <th>Alasan Pengajuan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requests as $request)
                        <tr>
                            <td>{{ $request->created_at }}</td>
                            <td>{{ $request->reason }}</td>
                            <td>{{ $request->status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>

@endif
    </div>


        <!-- SweetAlert2 Library -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- JavaScript Code for SweetAlert2 Pop-ups -->
<script>
    function showCertificate() {
        const certificateName = "{{ isset($certificate->p12_name) ? $certificate->p12_name : 'tidak ada sertifikat' }}";
        Swal.fire({
            title: 'Download Sertifikat',
            html: `Nama Sertifikat: ${certificateName}<br>Are you sure you want to download the certificate?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, download it!',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('cert.download') }}";
            }
        });
    }

    function showPasswordPopup() {
        Swal.fire({
            title: 'Enter Password',
            html: '@csrf <input type="password" id="p12Password" class="swal2-input" required>',
            confirmButtonText: 'Check',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                const password = document.getElementById('p12Password').value;
                if (password == "") {
                    return "Password kosong";
                }
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                return fetch(`http://127.0.0.1:8000/showP12Password`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        password: password,
                        _token: csrfToken
                    }),
                }).then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText);
                    }
                    return response.text();
                }).catch(error => {
                    Swal.showValidationMessage(`Request failed: ${error}`);
                });
            },
            allowOutsideClick: () => !Swal.isLoading(),
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Pass Sertifikat',
                    text: result.value,
                    icon: 'success',
                });
            }
        });
    }

    function showSubmitRequestPopup() {
        Swal.fire({
            title: 'Pengajuan Perubahan Sertifikat',
            html: '@csrf <form method="POST" action="{{ route('cert.request') }}">{{ csrf_field() }}<div class="form-group"><label for="reason">Alasan Pengajuan</label><textarea class="form-control" id="reason" name="reason" rows="3" required></textarea></div></form>',
            showCancelButton: true,
            confirmButtonText: 'Yes, submit it!',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                const formData = new FormData();
                formData.append('reason', document.getElementById('reason').value);
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                formData.append('_token', csrfToken);

                return fetch(`http://127.0.0.1:8000/showP12Password`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: formData,
                }).then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText);
                    }
                    return response.text();
                }).catch(error => {
                    Swal.showValidationMessage(`Request failed: ${error}`);
                });
            },
            allowOutsideClick: () => !Swal.isLoading(),
        }).then((result) => {
            if (result.isConfirmed) {
                document.querySelector("form").submit();
            }
        });
    }
</script>

</body>

</html>
@endsection