<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signature Pad</title>
    <style>
        #signature-pad {
            position: relative;
            border: 1px solid #ccc;
            width: 300px;
            height: 150px;
            margin: 20px;
            cursor: crosshair;
        }

        #signature-pad canvas {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
    <!-- Add a hidden input field to hold the signature data -->
        <form action="process_form.php" method="post">
            <div id="signature-pad">
                <canvas id="signature-canvas"></canvas>
                <input type="hidden" name="signatureData" id="signatureData" />
            </div>
                <!-- <button type="button" onclick="saveSignature()">Save as PNG</button> -->
                <button type="submit"  onclick="saveSignature()">Submit</button>
        </form>

        <!-- <button onclick="saveSignature()">Save as PNG</button> -->

    <script>
        var canvas = document.getElementById('signature-canvas');
        var ctx = canvas.getContext('2d');
        var drawing = false;
        ctx.lineWidth = 2;
        ctx.lineJoin = 'round';
        ctx.lineCap = 'round';
        ctx.strokeStyle = '#000';

        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('touchstart', startDrawing);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('touchmove', draw);
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('touchend', stopDrawing);

        function startDrawing(e) {
            drawing = true;
            draw(e);
        }

        function draw(e) {
            if (!drawing) return;

            var x, y;
            if (e.type.startsWith('mouse')) {
                x = e.clientX - canvas.getBoundingClientRect().left;
                y = e.clientY - canvas.getBoundingClientRect().top;
            } else if (e.type.startsWith('touch')) {
                x = e.touches[0].clientX - canvas.getBoundingClientRect().left;
                y = e.touches[0].clientY - canvas.getBoundingClientRect().top;
            }

            ctx.lineTo(x, y);
            ctx.stroke();
            ctx.beginPath();
            ctx.moveTo(x, y);
        }

        function stopDrawing() {
            drawing = false;
            ctx.beginPath();
        }

        function saveSignature() {
            var dataUrl = canvas.toDataURL('image/png');
            var signatureDataInput = document.getElementById('signatureData');
            signatureDataInput.value = dataUrl;
            // Optional: Display a message or indication that the signature has been saved
        }

    </script>
</body>
</html>
