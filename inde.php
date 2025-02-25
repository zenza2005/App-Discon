<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Pengurangan Diskon</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- Tambahkan Logo -->
        <img src="logo.png" alt="Logo" class="logo">
        
        <h1>Kalkulator Pengurangan Diskon</h1>

        <?php
        $hargaAsli = $diskon = $potongan = $hargaDiskon = 0;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $hargaAsli = (int) str_replace('.', '', $_POST["harga"]);
            $diskon = floatval($_POST["diskon"]); // Pastikan diskon dalam format desimal
            
            $potongan = ($hargaAsli * $diskon) / 100;
            $hargaDiskon = $hargaAsli - $potongan;
        }
        ?>

        <form method="post">
            <label for="harga">Harga Asli (Rp):</label>
            <input type="text" id="harga" name="harga" placeholder="Masukkan harga" required oninput="formatRupiah(this)">

            <label for="diskon">Persentase Diskon (%):</label>
            <input type="number" id="diskon" name="diskon" placeholder="Masukkan diskon" min="0" max="100" step="0.01" required>

            <button type="submit">Hitung</button>
            <button type="button" onclick="resetForm()">Reset</button>
        </form>

        <h2>Hasil Perhitungan:</h2>
        <p>Harga Asli: <strong id="hasilHarga">Rp <?= number_format($hargaAsli, 0, ',', '.') ?></strong></p>
        <p>Potongan Harga: <strong id="hasilPotongan">Rp <?= number_format($potongan, 0, ',', '.') ?></strong></p>
        <p>Harga Setelah Diskon: <strong id="hasilDiskon">Rp <?= number_format($hargaDiskon, 0, ',', '.') ?></strong></p>
    </div>

    <script>
        function formatRupiah(input) {
            let value = input.value.replace(/[^0-9]/g, '');
            let formatted = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            input.value = formatted;
        }

        function resetForm() {
            document.querySelector("form").reset();
            document.getElementById("hasilHarga").innerText = "Rp 0";
            document.getElementById("hasilPotongan").innerText = "Rp 0";
            document.getElementById("hasilDiskon").innerText = "Rp 0";
        }
    </script>
</body>
</html>
