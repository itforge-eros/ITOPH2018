<?php require APPROOT . '/views/inc/header.php';?>

<div class="row">
    <div class="container">
        <?php flash('page_message'); ?>
        <section class="admin">
            <div class="row">
                <div class="col-lg-12">
                    <h1>ระบบลงทะเบียนหน้างาน</h1>
                </div>
            </div>
            <div class="row">
                
                    <div id="loadingMessage">🎥 ไม่พบกล้อง หากใช้ iOS ให้ใช้ Safari (กดอนุญาตให้ใช้กล้องด้วย)</div>
                    <canvas id="canvas" hidden></canvas>
                    <div id="output" hidden>
                        <div id="outputMessage">ไม่เจอ QR Code</div>
                        <div hidden>กำลังโหลด... (<span id="outputData"></span>)</div>
                    </div>
                    <script src="<?php echo URLROOT;?>/assets/js/qr/jsQR.js"></script>
                    <script>
                        var video = document.createElement("video");
                        var canvasElement = document.getElementById("canvas");
                        var canvas = canvasElement.getContext("2d");
                        var loadingMessage = document.getElementById("loadingMessage");
                        var outputContainer = document.getElementById("output");
                        var outputMessage = document.getElementById("outputMessage");
                        var outputData = document.getElementById("outputData");

                        function drawLine(begin, end, color) {
                        canvas.beginPath();
                        canvas.moveTo(begin.x, begin.y);
                        canvas.lineTo(end.x, end.y);
                        canvas.lineWidth = 4;
                        canvas.strokeStyle = color;
                        canvas.stroke();
                        }

                        // Use facingMode: environment to attemt to get the front camera on phones
                        navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } }).then(function(stream) {
                        video.srcObject = stream;
                        video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
                        video.play();
                        requestAnimationFrame(tick);
                        });

                        function tick() {
                        loadingMessage.innerText = "⌛ Loading video..."
                        if (video.readyState === video.HAVE_ENOUGH_DATA) {
                            loadingMessage.hidden = true;
                            canvasElement.hidden = false;
                            outputContainer.hidden = false;

                            canvasElement.height = video.videoHeight;
                            canvasElement.width = video.videoWidth;
                            canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
                            var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
                            var code = jsQR(imageData.data, imageData.width, imageData.height, {
                            inversionAttempts: "dontInvert",
                            });
                            if (code) {
                            drawLine(code.location.topLeftCorner, code.location.topRightCorner, "#FF3B58");
                            drawLine(code.location.topRightCorner, code.location.bottomRightCorner, "#FF3B58");
                            drawLine(code.location.bottomRightCorner, code.location.bottomLeftCorner, "#FF3B58");
                            drawLine(code.location.bottomLeftCorner, code.location.topLeftCorner, "#FF3B58");
                            outputMessage.hidden = true;
                            outputData.parentElement.hidden = false;

                            idFromQR = code.data
                            idFromQR = idFromQR.split("//")[1];
                            outputData.innerText = idFromQR;
                            window.location = "<?php echo URLROOT; ?>/admin/checkin/" + idFromQR;
                            } else {
                            outputMessage.hidden = false;
                            outputData.parentElement.hidden = true;
                            requestAnimationFrame(tick);
                            }
                        } else {
                            requestAnimationFrame(tick);
                        }
                        }
                    </script>
                
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="button-wrapper">
                        <a href="<?php echo URLROOT; ?>/admin/normalregistration/" class="btn btn-primary btn-lg active">ลงทะเบียนกรณีไม่มี QR Code</a>
                    </div>
                </div>
            </div>
        </section>
            
        
    </div>

</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>