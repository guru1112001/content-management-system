<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Preview</title>
</head>
<body>
    <h1>PDF Preview</h1>
    <h1>{{$filePath}}</h1>
    <!-- Embed the document using the proxy URL -->
    <iframe src="{{ $filePath }}" width="600" height="780" frameborder="0"></iframe>
</body>
</html>
