<!-- resources/views/content/preview.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Preview</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.0/viewer.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.0/viewer.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
</head>
<body>
    <h1>Document Preview</h1>
    
    <div id="preview"></div>

    <script>
        const documentUrl = "{{ asset('storage/'.$content->file_path) }}";
        const extension = documentUrl.split('.').pop().toLowerCase();
        
        // Initialize viewer based on file extension
        function initializeViewer(documentUrl, extension) {
            switch (extension) {
                case 'pdf':
                    renderPDFViewer(documentUrl);
                    break;
                case 'doc':
                case 'docx':
                    renderWordViewer(documentUrl);
                    break;
                case 'ppt':
                case 'pptx':
                    renderPowerPointViewer(documentUrl);
                    break;
                default:
                    showErrorMessage('Document preview not available for this file type.');
                    break;
            }
        }

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

        // Render Word viewer using Microsoft Office Online Viewer
        function renderWordViewer(documentUrl) {
            const iframe = document.createElement('iframe');
            iframe.src = `https://view.officeapps.live.com/op/embed.aspx?src=${encodeURIComponent(documentUrl)}`;
            iframe.width = '100%';
            iframe.height = '600';
            iframe.frameBorder = '0';
            document.getElementById('preview').appendChild(iframe);
        }

        // Render PowerPoint viewer using Google Docs Viewer
        function renderPowerPointViewer(documentUrl) {
            const iframe = document.createElement('iframe');
            iframe.src = `https://docs.google.com/viewer?url=${encodeURIComponent(documentUrl)}&embedded=true`;
            iframe.width = '100%';
            iframe.height = '600';
            iframe.frameBorder = '0';
            document.getElementById('preview').appendChild(iframe);
        }

        // Display error message
        function showErrorMessage(message) {
            document.getElementById('preview').innerHTML = message;
        }

        // Call initializeViewer function
        initializeViewer(documentUrl, extension);
    </script>
</body>
</html>

