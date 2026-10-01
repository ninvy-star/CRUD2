<?php
require_once "config/database.php";

// Nomor WhatsApp toko (format 62..., tanpa tanda + dan tanpa 0 di depan)
$wa_number = "6281234567890";

// Statistik untuk hero
$stat_buku = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM produk")
);
$stat_kategori = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(DISTINCT kategori) AS total FROM produk")
);

// Ambil 4 buku Fiksi Ilmiah (Seri Bumi) dari database
$query = mysqli_query(
    $conn,
    "SELECT * FROM produk
     ORDER BY id DESC
     LIMIT 4"
);

include "includes/header.php";
?>

<!-- HERO -->
<section class="hero">
  <div class="hero-content">
    <div class="hero-eyebrow">Tere Liye Books</div>
    <h1>Temukan <em>Cerita</em><br>yang Tak<br>Terlupakan</h1>
<p>Dari petualangan fiksi ilmiah, kisah romantis, sejarah, hingga perjalanan penuh makna. Jelajahi koleksi novel Tere Liye di satu tempat.</p>
    <div class="hero-btn">
      <a href="#koleksi" class="btn-primary">Lihat Koleksi</a>
      <a href="#booking" class="btn-secondary">Kunjungi Toko</a>
    </div>
  </div>

  <div class="hero-meta">
    <div class="hero-meta-item">
      <span class="number"><?= $stat_buku['total']; ?>+</span>
      <span class="label">Buku</span>
    </div>
    <div class="hero-meta-divider"></div>
    <div class="hero-meta-item">
      <span class="number"><?= $stat_kategori['total']; ?></span>
      <span class="label">Kategori</span>
    </div>
    <div class="hero-meta-divider"></div>
    <div class="hero-meta-item">
      <span class="number">∞</span>
      <span class="label">Cerita Menanti</span>
    </div>
  </div>
</section>

<!-- ABOUT -->
<section class="about" id="tentang">
  <div class="about-left">
    <span class="section-eyebrow">Tentang Kami</span>
    <h2>Teman <em>Membaca</em><br>Sepanjang Waktu</h2>
    <p>Tere Liye Books menghadirkan koleksi novel Tere Liye dalam satu tempat, dari fiksi ilmiah dan petualangan, romansa, sampai sejarah dan kisah perjalanan.</p>
    <a href="#koleksi" class="btn-secondary">Lihat Katalog</a>
  </div>

  <div class="about-right">
    <p>Setiap buku mudah dicari berdasarkan judul atau kategori. Lihat detailnya, lalu pesan langsung lewat WhatsApp tanpa perlu ribet.</p>
    <blockquote class="about-quote">
    Setiap buku adalah pintu menuju dunia yang baru.
  </blockquote>
  </div>
</section>

<!-- MENU / KOLEKSI -->
<section class="menu" id="koleksi">
  <div class="menu-header">
    <span class="section-eyebrow">Koleksi Pilihan</span>
    <h2>Novel <span></span>Terbaru</h2>
    <p>Empat novel Terbaru yang baru saja hadir di toko kami</p>
  </div>

  <?php if (mysqli_num_rows($query) > 0): ?>
  <div class="grid">
    <?php while ($row = mysqli_fetch_assoc($query)): ?>
    <?php
      $stok_label = ($row['stok'] > 0) ? 'Tersedia' : 'Stok Habis';
    ?>
    <div class="card">
      <div class="card-img">
        <span class="card-badge"><?= $stok_label; ?></span>
        <?php if (!empty($row['gambar'])): ?>
        <img src="uploads/produk/<?= htmlspecialchars($row['gambar']); ?>"
             alt="<?= htmlspecialchars($row['nama']); ?>">
        <?php endif; ?>
      </div>
      <div class="card-body">
        <span class="card-series"><?= htmlspecialchars($row['kategori']); ?></span>
        <h3><?= htmlspecialchars($row['nama']); ?></h3>
        <p class="desc"><?= htmlspecialchars($row['deskripsi'] ?? ''); ?></p>
        <p class="price">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></p>
        <a href="detail.php?id=<?= (int)$row['id']; ?>" class="card-cta">Lihat Detail →</a>
      </div>
    </div>
    <?php endwhile; ?>
  </div>
  <?php else: ?>
  <p style="text-align:center;">Belum ada buku yang ditampilkan.</p>
  <?php endif; ?>

  <div class="menu-cta-wrap">
    <a href="produk.php" class="btn-secondary">Lihat Seluruh Koleksi →</a>
  </div>
</section>

<!-- BOOKING / RESERVASI -->
<section class="booking" id="booking">
  <div class="booking-container">
    <div class="booking-text">
      <span class="section-eyebrow">Kunjungi Kami</span>
      <h2>Pesan <em>Novel</em><br>Favoritmu</h2>
      <p>Tidak menemukan novel yang kamu cari? Kunjungi toko kami atau hubungi lewat WhatsApp. Kami siap membantu kamu menemukan koleksi lengkap Tere Liye.</p>
    </div>

    <div class="booking-form">
      <p>Hubungi kami langsung lewat WhatsApp, sebutkan judul novel dan jumlah yang kamu inginkan.</p>
      <a href="https://wa.me/<?= $wa_number; ?>?text=<?= urlencode('Halo, saya ingin memesan novel Tere Liye.'); ?>"
         target="_blank" class="btn-primary">Chat via WhatsApp</a>
    </div>
  </div>
</section>

<?php include "includes/footer.php"; ?>