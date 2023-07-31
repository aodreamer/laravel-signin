<!DOCTYPE html>
<html>
<head>
    <title>Upload PDF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Upload PDF</h2>
        <!-- resources/views/certificate_form.blade.php -->
<form method="post" action="{{ route('verify.check.form') }}">
    @csrf
    <div class="form-group">
        <label for="pdf_file">Pilih File PDF:</label>
        <input type="file" name="pdf_file" id="pdf_file">
    </div>
    <button type="submit" class="btn btn-primary">Check</button>
</form>

    </div>
   
</body>
</html>
