<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner</title>
    <style>
        #reader { width: 300px; height: 300px; }
        #result { margin-top: 20px; }
    </style>
</head>
<body>
    <h1>QR Code Scanner</h1>
    <div id="reader"></div>
    <div id="result">Scanned result: <span id="result-value"></span></div>
    <!-- <script src="https://unpkg.com/html5-qrcode"></script>
    <script src="script.js"></script> -->
    <script src="{{ asset('assets/html5-qrcode/html5-qrcode.min.js') }}"></script>

<script>
    // Initialize the HTML5 QR Code Scanner
    let html5QRCodeScanner = new Html5QrcodeScanner(
        // Target element with the ID "reader" and configure settings
        "reader", {
            fps: 10, // Frames per second for scanning
            qrbox: {
                width: 200, // Width of the scanning box
                height: 200, // Height of the scanning box
            },
        }
    );

    // Function executed when the scanner successfully reads a QR Code
    function onScanSuccess(decodedText, decodedResult) {
        // Redirect to the scanned QR Code link
        window.location.href = decodedText;

        // Clear the scanner area after the action is performed
        html5QRCodeScanner.clear();
    }

    // Render the QR Code scanner
    html5QRCodeScanner.render(onScanSuccess);
</script>
</body>
</html>