<?php
require_once "config/database.php";

// Nomor WhatsApp toko (samakan dengan yang ada di index.php)
$wa_number = "6281234567890";

// Ambil id dari URL, ubah ke angka supaya aman
$id = isset($_GET['id'])
    ? (int)$_GET['id']
    : 0;

$query = mysqli_query(
    $conn,
    "SELECT * FROM produk
     WHERE id = $id"
);

$produk = mysqli_fetch_assoc($query);

$page_title = $produk
    ? $produk['nama'] . " — Tere Liye Books"
    : "Buku tidak ditemukan — Tere Liye Books";

include "includes/header.php";
?>

<section class="menu catalog detail">

<?php if (!$produk): ?>

  <div class="menu-header">
    <h2>Buku <span>Tidak Ditemukan</span></h2>
    <p>Buku yang kamu cari tidak ada atau sudah dihapus.</p>
  </div>
  <a href="produk.php" class="btn-primary">← Kembali ke Katalog</a>

<?php else: ?>

  <?php
    $pesan   = "Halo, saya ingin memesan novel " . $produk['nama'];
    $wa_link = "https://wa.me/" . $wa_number . "?text=" . urlencode($pesan);
  ?>

  <div class="detail-container">

    <!-- GAMBAR -->
    <div class="detail-img">
      <?php if (!empty($produk['gambar'])): ?>
      <img src="uploads/produk/<?= htmlspecialchars($produk['gambar']); ?>"
           alt="<?= htmlspecialchars($produk['nama']); ?>">
      <?php else: ?>
      <div class="detail-noimg">Gambar belum tersedia</div>
      <?php endif; ?>
    </div>

    <!-- INFORMASI -->
    <div class="detail-info">

      <span class="section-eyebrow">
        <?= htmlspecialchars($produk['kategori']); ?>
      </span>

      <h1><?= htmlspecialchars($produk['nama']); ?></h1>

      <p class="detail-price">
        Rp <?= number_format($produk['harga'], 0, ',', '.'); ?>
      </p>

      <p class="detail-desc">
        <?php if (!empty($produk['deskripsi'])): ?>
          <?= nl2br(htmlspecialchars($produk['deskripsi'])); ?>
        <?php else: ?>
          Deskripsi belum tersedia.
        <?php endif; ?>
      </p>

      <ul class="detail-meta">
        <li>
          <span>Kategori</span>
          <?= htmlspecialchars($produk['kategori']); ?>
        </li>

        <?php if (!empty($produk['tahun_terbit'])): ?>
        <li>
          <span>Tahun Terbit</span>
          <?= (int)$produk['tahun_terbit']; ?>
        </li>
        <?php endif; ?>

        <?php if (!empty($produk['bahasa'])): ?>
        <li>
          <span>Bahasa</span>
          <?= htmlspecialchars($produk['bahasa']); ?>
        </li>
        <?php endif; ?>

        <li>
          <span>Stok</span>
          <?= $produk['stok'] > 0
                ? (int)$produk['stok'] . ' buku tersedia'
                : 'Stok habis'; ?>
        </li>
      </ul>

      <div class="detail-actions">
        <?php if ($produk['stok'] > 0): ?>
        <a href="<?= $wa_link; ?>" target="_blank" class="btn-primary">
          Pesan via WhatsApp
        </a>
        <?php endif; ?>
        <a href="produk.php" class="btn-secondary">← Kembali</a>
      </div>

    </div>

  </div>

<?php endif; ?>

</section>

<?php include "includes/footer.php"; ?>