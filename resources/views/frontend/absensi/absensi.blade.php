@extends('frontend.master')
@section('home')
<!-- <script src="{{ asset('assets/html5-qrcode/html5-qrcode.min.js') }}"></script> -->
<script src="{{ asset('frontend/js/html5-qrcode.min.js') }}"></script>

<section class="contact-area section--padding position-relative">
    <span class="ring-shape ring-shape-1"></span>
    <span class="ring-shape ring-shape-2"></span>
    <span class="ring-shape ring-shape-3"></span>
    <span class="ring-shape ring-shape-4"></span>
    <span class="ring-shape ring-shape-5"></span>
    <span class="ring-shape ring-shape-6"></span>
    <span class="ring-shape ring-shape-7"></span>
    <div class="container">
        <div class="row">
            <div class="mx-auto col-lg-7">
                <div class="card card-item">
                    <div class="card-body">
                        <h3 class="pb-4 text-center card-title fs-24 lh-35">SCAN BARCODE</h3>
                        <div class="section-block"></div>
                        <div id="reader">
                            <form class="pt-4" method="POST" action="">
                                @csrf
                                
                            </form>
                        </div>
                        
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col-lg-7 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end contact-area -->


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
@endsection