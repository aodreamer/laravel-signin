<!-- resources/views/upload.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Upload PDF</title>
</head>
<body>
    <form action="{{ route('verify.cert') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="pdf_file">
        <button type="submit">Upload</button>
    </form>
</body>
</html>
