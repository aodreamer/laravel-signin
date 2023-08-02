@extends('auth.dashboard')

@section('content')
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
        background: #333;
    }
</style>

<div class="container mt-5">
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if ($certificate)
        <button class="btn btn-primary" onclick="showCertificate()">Download Sertifikat</button>
    @else
        <p>Anda tidak memiliki sertifikat.</p>
    @endif
</div>

@if ($certificate)
<div class="container mt-5">
    @if(session('password'))
    <div class="alert alert-success">
        Pass Sertifikat: {{ session('password') }}
    </div>
    @endif
    <button class="btn btn-primary" onclick="showPasswordPopup()">Lihat Password P12</button>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <button class="btn btn-primary mb-2" data-toggle="collapse" href="#pengajuanCollapse" onclick="togglePengajuan()">Show/Hide Pengajuan Perubahan Sertifikat</button>
            <div class="collapse" id="pengajuanCollapse">
                <h2>Pengajuan Perubahan Sertifikat</h2>
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <form method="POST" action="{{ route('cert.request') }}">
                    @csrf
                    <div class="form-group">
                        <label for="reason">Alasan Pengajuan</label>
                        <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="submitRequest()">Ajukan Perubahan</button>
                </form>
            </div>
        </div>

        <div class="col-md-6">
            <button class="btn btn-primary mb-2" data-toggle="collapse" href="#historyPengajuanTable" onclick="toggleHistory()">Show/Hide History Pengajuan</button>
            <div class="collapse" id="historyPengajuanTable">
                @if ($requests->isEmpty())
                    <p>Anda belum melakukan pengajuan perubahan sertifikat.</p>
                @else
                    <div class="table-responsive">
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
                @endif
            </div>
        </div>
    </div>
</div>
@endif

<!-- SweetAlert2 Library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- JavaScript Code for SweetAlert2 Pop-ups and Bootstrap Collapse -->
<script>
  function showCertificate() {
    Swal.fire({
      title: 'Download Sertifikat',
      text: 'Are you sure you want to download the certificate?',
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
      html: '<input type="password" id="p12Password" class="swal2-input">',
      confirmButtonText: 'Submit',
      showLoaderOnConfirm: true,
      preConfirm: () => {
        const password = document.getElementById('p12Password').value;
        return fetch(`{{ route('showP12Password') }}`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include the CSRF token in the request headers
          },
          body: JSON.stringify({ password: password })
        })
          .then(response => {
            if (!response.ok) {
              throw new Error(response.statusText)
            }
            return response.json()
          })
          .catch(error => {
            Swal.showValidationMessage(
              `Request failed: ${error}`
            )
          })
      },
      allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: 'Pass Sertifikat',
          text: result.value.password,
          icon: 'success'
        });
      }
    });
  }

  function submitRequest() {
    Swal.fire({
      title: 'Pengajuan Perubahan Sertifikat',
      text: 'Are you sure you want to submit the request?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Yes, submit it!',
      cancelButtonText: 'Cancel',
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
    }).then((result) => {
      if (result.isConfirmed) {
        document.querySelector("form").submit();
      }
    });
  }

  // JavaScript Code for Bootstrap Collapse
  const historyPengajuanTable = document.getElementById('historyPengajuanTable');

  function togglePengajuan() {
        const pengajuanCollapse = document.getElementById('pengajuanCollapse');
        if (pengajuanCollapse.classList.contains('show')) {
            pengajuanCollapse.classList.remove('show');
        } else {
            pengajuanCollapse.classList.add('show');
        }
    }

    function toggleHistory() {
        const historyPengajuanTable = document.getElementById('historyPengajuanTable');
        if (historyPengajuanTable.classList.contains('show')) {
            historyPengajuanTable.classList.remove('show');
        } else {
            historyPengajuanTable.classList.add('show');
        }
    }

  document.querySelector("[data-toggle='collapse']").addEventListener('click', toggleHistoryTable);
</script>
@endsection
