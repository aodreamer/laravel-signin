<!-- resources/views/result.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Result</title>
</head>
<body>
    @if(isset($data))
        <pre>{{ json_encode($data, JSON_PRETTY_PRINT) }}</pre>
    @endif
</body>
</html>
