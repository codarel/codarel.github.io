<?php
class Uploader
{

    public static function upload($file)
    {
        // hitung jumlah file
        $count = count($file['name']);

        for ($i = 0; $i < $count; $i++) {
            $namaFile = $file['name'][$i];
            $ukuranFile = $file['size'][$i];
            $error = $file['error'][$i];
            $tmpName = $file['tmp_name'][$i];

            // cek apakah tidak ada gambar yang diupload
            if ($error === 4) {
                Flasher::setFlash('Anda belum', 'memilih gambar', 'danger');
                return false;
            }

            // cek apakah yang diupload adalah gambar
            $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
            $ekstensiGambar = explode('.', $namaFile);
            $ekstensiGambar = strtolower(end($ekstensiGambar));

            if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
                Flasher::setFlash('Yang Anda', 'upload bukan gambar', 'danger');
                return false;
            }

            // cek jika ukuranya terlalu besar
            if ($ukuranFile > 1000000) {
                Flasher::setFlash('Ukuran gambar', 'terlalu bersar', 'danger');
                return false;
            }

            $namaFileBaru[] = uniqid() . "." . $ekstensiGambar;
            $path = 'img/' . $namaFileBaru[$i];
            // move_uploaded_file($tmpName, $path);
        }
        return $namaFileBaru;
    }
}
