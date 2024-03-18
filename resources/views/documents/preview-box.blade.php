{{-- resources/views/documents/preview-box.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Preview</title>
</head>
<body>
    <h1>Document Preview</h1>
    <div id="preview-container" style="width: 100%; height: 500px;"></div>

    <script src="https://cdn01.boxcdn.net/platform/preview/2.63.0/en-US/preview.js"></script>
    <script>
        var preview = new Box.Preview();
        preview.show('{{ $documentUrl }}', '', {
            container: '#preview-container',
            showDownload: false,
        });
    </script>
</body>
</html>
