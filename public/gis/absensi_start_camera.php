<!DOCTYPE html>
<html>
<head>
    <title>Activate Camera</title>
</head>
<body>
    <h1>Activate Camera</h1>
    
    <!-- <video id="camera-preview" autoplay></video>
    <button id="start-camera">Start Camera</button>
    
    <script>
        const startCameraButton = document.getElementById('start-camera');
        const cameraPreview = document.getElementById('camera-preview');
        
        startCameraButton.addEventListener('click', async () => {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ video: true });
                cameraPreview.srcObject = stream;
            } catch (error) {
                console.error('Error accessing camera:', error);
            }
        });
    </script> -->

    <video id="camera-preview" autoplay></video>
    <button id="start-camera">Start Camera</button>
    <form id="video-form" action="proses_absensi_start_camera.php" method="POST">
        <input type="hidden" id="video-data" name="video-data">
        <button type="submit">Submit Video</button>
    </form>

    <script>
        const startCameraButton = document.getElementById('start-camera');
        const cameraPreview = document.getElementById('camera-preview');
        const videoForm = document.getElementById('video-form');
        const videoDataInput = document.getElementById('video-data');

        startCameraButton.addEventListener('click', async () => {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ video: true });
                cameraPreview.srcObject = stream;
            } catch (error) {
                console.error('Error accessing camera:', error);
            }
        });

    // When the form is submitted, capture the video stream and attach it to the form data
    videoForm.addEventListener('submit', async (e) => {
        e.preventDefault(); // Prevent the default form submission behavior

        // Check if a video stream is available
        if (cameraPreview.srcObject) {
            const mediaRecorder = new MediaRecorder(cameraPreview.srcObject);
            const chunks = [];

            mediaRecorder.ondataavailable = (event) => {
                if (event.data.size > 0) {
                    chunks.push(event.data);
                }
            };

            mediaRecorder.onstop = () => {
                const blob = new Blob(chunks, { type: 'video/webm' });
                const videoUrl = URL.createObjectURL(blob);
                videoDataInput.value = videoUrl;
                videoForm.submit(); // Submit the form with the captured video data
            };

            mediaRecorder.start();

            setTimeout(() => {
                mediaRecorder.stop();
                cameraPreview.srcObject.getTracks().forEach((track) => track.stop());
            }, 5000); // Capture video for 5 seconds (adjust as needed)
        }
    });
</script>
</body>
</html>