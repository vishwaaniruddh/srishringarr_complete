<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Compression</title>
    <style>
        #progress-bar {
            width: 100%;
            background-color: #f3f3f3;
            border: 1px solid #ddd;
        }
        #progress-fill {
            width: 0%;
            height: 20px;
            background-color: #4caf50;
        }
    </style>
</head>
<body>
    <h1>Image Compression</h1>
    <button onclick="startCompression()">Start Compression</button>

    <div id="progress-bar">
        <div id="progress-fill"></div>
    </div>
    <p id="status-text"></p>

    <script>
        let currentBatch = 0;
        const sourcePath = 'yn/uploads'; // Adjust the path to match your source directory

        function startCompression() {
            currentBatch = 0;
            document.getElementById('progress-fill').style.width = '0%';
            document.getElementById('status-text').innerText = 'Starting compression...';
            compressNextBatch();
        }

        function compressNextBatch() {
            const formData = new FormData();
            formData.append('source_path', sourcePath);
            formData.append('current_batch', currentBatch);

            fetch('image_compression.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'continue') {
                    currentBatch = data.current_batch;
                    updateProgress(data.processed, data.total);

                    setTimeout(compressNextBatch, 500); // Pause briefly before next batch
                } else if (data.status === 'completed') {
                    updateProgress(data.total, data.total);
                    document.getElementById('status-text').innerText = 'Compression completed!';
                } else {
                    document.getElementById('status-text').innerText = data.message || 'An error occurred';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('status-text').innerText = 'An error occurred while processing.';
            });
        }

        function updateProgress(processed, total) {
            const progressPercent = Math.floor((processed / total) * 100);
            document.getElementById('progress-fill').style.width = progressPercent + '%';
            document.getElementById('status-text').innerText = `Processed ${processed} of ${total} images (${progressPercent}%)`;
        }
    </script>
</body>
</html>
