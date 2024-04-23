{{-- <!-- resources/views/content/preview.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Preview</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf_viewer.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
</head>
<body>
    <h1>Document Preview</h1>
    
    <div id="preview"></div>

    <script>
        const documentUrl = "{{ asset('storage/'.$content->file_path) }}";    

        // Render PDF viewer using PDF.js
        function renderPDFViewer(documentUrl) {
            const loadingTask = pdfjsLib.getDocument(documentUrl);
            loadingTask.promise.then(pdf => {
                for (let pageNumber = 1; pageNumber <= pdf.numPages; pageNumber++) {
                    pdf.getPage(pageNumber).then(page => {
                        const scale = 1.5;
                        const viewport = page.getViewport({ scale });
                        const canvas = document.createElement("canvas");
                        const context = canvas.getContext("2d");
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;
                        const renderContext = {
                            canvasContext: context,
                            viewport: viewport
                        };
                        page.render(renderContext).promise.then(() => {
                            document.getElementById("preview").appendChild(canvas);
                        });
                    });
                }
            }).catch(() => {
                showErrorMessage('Error loading PDF.');
            });
        }
        renderPDFViewer(documentUrl)
        // initializeViewer(documentUrl, extension);
    </script>
</body>
</html>
 --}}

 {{-- <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>PDF Preview</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.8.335/pdf_viewer.css">
 </head>
 <body>
     <div class="pdfViewer"></div> <!-- Make sure this element exists -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.8.335/pdf.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.8.335/pdf_viewer.js"></script>
     <script>
         document.addEventListener('DOMContentLoaded', function () {
             const documentUrl = "{{ asset('storage/'.$content->file_path) }}"; // Dynamic URL
             
             const loadingTask = pdfjsLib.getDocument(documentUrl);
             loadingTask.promise.then(function(pdf) {
                 const pdfViewer = new pdfjsViewer.PDFViewer({
                     container: document.querySelector('.pdfViewer'),
                 });
                 pdfViewer.setDocument(pdf);
             }, function(reason) {
                 console.error('Error: ' + reason);
             });
         });
     </script>
 </body>
 </html> --}}



 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Preview</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }
        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
        body {
            -webkit-user-select: none;  /* Chrome all / Safari all */
            -moz-user-select: none;     /* Firefox all */
            -ms-user-select: none;      /* IE 10+ */
            -o-user-select: none;
            user-select: none;
}
    </style>
</head>
<body oncontextmenu="return false" onselectstart="return false" ondragstart="return false" >
    <!-- Embed the PDF file in an iframe -->
    
    <iframe src="{{ asset('storage/'.$content->file_path.'#toolbar=0') }}" id="pdfViewer" oncontextmenu="return false"></iframe>
    
    <script type='text/javascript'> 
        //<![CDATA[ 
        var message="NoRightClicking is allowed in our website"; 
        function arpianDisableClick() { 
        if (document.all) { 
        alert(message); //Remove this line if you don't want alert message 
        return false; 
        } 
        } 
        function arpianNoRightClick(e) { 
        if (document.layers||(document.getElementById&&!document.all)) { 
        if (e.which==2||e.which==3) { 
        alert(message); //Remove this line if you don't want alert message 
        return false;} 
        } 
        } 
        if (document.layers) { 
        document.captureEvents(Event.MOUSEDOWN); 
        document.onmousedown=arpianNoRightClick; 
        } else{ 
        document.onmouseup=arpianNoRightClick; 
        document.oncontextmenu=arpianDisableClick; 
        } 
        document.oncontextmenu=new Function("return false") 
        //]]></script>
</body>
</html>


 
 
