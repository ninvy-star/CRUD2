<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $page_title ?? 'Tere Liye Books — Toko Buku Novel Tere Liye'; ?></title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=Cormorant+Garamond:wght@300;400;500&family=Josefin+Sans:wght@300;400;600&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- Main CSS -->
  <?php
    // Deteksi base path otomatis — works apapun nama folder projectnya
    $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
    $assetBase = $base . '/assets';
  ?>
  <link rel="stylesheet" href="<?= $assetBase ?>/css/style.css">

  <!-- Inject CSS variables untuk background images -->
  <style>
    :root {
      --bg-hero:    url('<?= $assetBase ?>/images/bg2.png');
      --bg-booking: url('<?= $assetBase ?>/images/bg1.png');
    }
  </style>
</head>
<body>

<!-- NAVBAR -->
<?php $halaman = basename($_SERVER['SCRIPT_NAME']); ?>

<nav class="navbar">
  <a href="index.php" class="navbar-brand">Tere Liye <span>Books</span></a>
  <ul class="navbar-nav">
    <li><a href="index.php">Beranda</a></li>
    <li><a href="index.php#koleksi">Koleksi</a></li>
    <li><a href="produk.php">Katalog</a></li>
    <li><a href="index.php#tentang">Tentang</a></li>
    <li><a href="#kontak">Kontak</a></li>

    <?php if ($halaman == 'index.php'): ?>
    <li><a href="#booking" class="nav-cta">Pesan Sekarang</a></li>
    <?php endif; ?>
  </ul>
</nav>