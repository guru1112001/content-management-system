<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Preview</title>
    <!-- Add CSS for PDF.js -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.12.313/pdf_viewer.css" />

<!-- Add the PDF.js viewer container -->
<div id="pdfViewer" style="height: 600px;"></div>
<h1>{{$filePath}}</h1>

<!-- Add PDF.js library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.12.313/pdf_viewer.js"></script>

<!-- Add your custom JavaScript -->
<script>
    // Display PDF using PDF.js
    const pdfViewer = new pdfjsViewer.PDFViewer({
        container: document.getElementById('pdfViewer')
    });
    const loadingTask = pdfjsLib.getDocument(@json($filepath));
    console.log(@json($filepath))

    loadingTask.promise.then(function(pdf) {
        pdfViewer.setDocument(pdf);
    });
</script>

</head>
<body>
    <h1>PDF </h1>
    <h1>{{$filePath}}</h1>
    <!-- Embed the document using the proxy URL -->
    <iframe src="{{ $filePath }}" width="600" height="780" frameborder="0"></iframe>
    <iframe
   className="doc"
   {{-- src={`https://docs.google.com/gview?url=${{$filePath}}&embedded=true`} --}}
 />
</body>
</html>
