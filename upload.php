<?php
// Menangkap data gambar yang dikirimkan
$imageData = $_POST['imageData'];

// Mendapatkan nama perangkat dari string User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
preg_match('/\((.*?)\)/', $userAgent, $matches);
$deviceName = $matches[1];

// Membuat direktori jika belum ada
$directory = 'IMG/' . $deviceName;
if (!is_dir($directory)) {
  mkdir($directory, 0777, true);
}

// Mengubah data URL menjadi gambar
$imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));

// Menentukan nama file berdasarkan waktu saat ini
$fileName = 'img_' . date('YmdHis') . '.jpeg';

// Menyimpan gambar ke folder yang sesuai dengan nama perangkat
$file = fopen($directory . '/' . $fileName, 'wb');
fwrite($file, $imageData);
fclose($file);

// Mengembalikan respons sukses
echo 'Gambar berhasil diunggah dengan nama file: ' . $fileName;
?>