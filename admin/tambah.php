<?php

session_start();

require_once "../includes/auth.php";

?>

<!DOCTYPE html>
<html>

<head>

    <title>Tambah Produk</title>

    <link rel="stylesheet" href="../assets/admin.css">

</head>

<body>

<div class="navbar">

    <div class="container">

        <a href="index.php">Dashboard</a>
        <a href="produk.php">Produk</a>

    </div>

</div>

<div class="container">

    <div class="card">

        <h1>Tambah Produk</h1>

        <form
            action="proses_produk.php"
            method="POST"
            enctype="multipart/form-data"
        >

            <input
                type="hidden"
                name="aksi"
                value="tambah"
            >

            <label>Nama Produk</label>

            <input
                type="text"
                name="nama"
                required
            >

            <label>Kategori</label>

            <select name="kategori" required>

                <option value="">
                    Pilih kategori
                </option>

                <option value="Fiksi Ilmiah">
                    Fiksi Ilmiah
                </option>

                <option value="Romance">
                    Romance
                </option>

                <option value="Sejarah">
                    Sejarah
                </option>

                <option value="Petualangan">
                    Petualangan
                </option>

            </select>

            <label>Deskripsi</label>

            <textarea
                name="deskripsi"
                rows="5"
                required
            ></textarea>

            <label>Harga</label>

            <input
                type="number"
                name="harga"
                min="0"
                required
            >

            <label>Stok</label>

            <input
                type="number"
                name="stok"
                min="0"
                required
            >

            <label>Gambar Produk</label>

            <input
                type="file"
                name="gambar"
                accept=".jpg,.jpeg,.png,.webp"
            >

            <br>

            <button
                type="submit"
                class="btn"
            >
                Simpan Produk
            </button>

            <a
                href="produk.php"
                class="btn"
            >
                Kembali
            </a>

        </form>

    </div>

</div>

</body>
</html>