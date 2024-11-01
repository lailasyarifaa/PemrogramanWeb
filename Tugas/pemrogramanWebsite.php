<?php
class CetakBilangan {
    // Method untuk mencetak bilangan sesuai ketentuan
    public function cetak($n) {
        // Membuka elemen <pre> untuk menjaga format teks
        echo "<pre>";
        for ($i = 1; $i <= $n; $i++) {
            if ($i % 4 == 0 && $i % 6 == 0) {
                echo "Pemrograman Website 2024\n"; // Output untuk kelipatan 12
            } elseif ($i % 5 == 0) {
                echo "2024\n"; // Output untuk kelipatan 5
            } elseif ($i % 4 == 0) {
                echo "Pemrograman\n"; // Output untuk kelipatan 4
            } elseif ($i % 6 == 0) {
                echo "Website\n"; // Output untuk kelipatan 6
            } else {
                echo $i . "\n"; // Output untuk bilangan biasa
            }
        }
        // Menutup elemen <pre>
        echo "</pre>";
    }
}

// Membuat objek dari class CetakBilangan
$cetakBilangan = new CetakBilangan();

// Memanggil method cetak dengan nilai n yang diinginkan
$cetakBilangan->cetak(24); // Sesuaikan dengan batas nilai yang diinginkan
?>
