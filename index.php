<?php
require_once "config/database.php";

// Nomor WhatsApp toko (format 62..., tanpa tanda + dan tanpa 0 di depan)
$wa_number = "6281234567890";

// Ambil 4 buku Fiksi Ilmiah (Seri Bumi) dari database
$query = mysqli_query(
    $conn,
    "SELECT * FROM produk
     WHERE kategori = 'Fiksi Ilmiah'
     ORDER BY id ASC
     LIMIT 4"
);

include "includes/header.php";
?>

<!-- HERO -->
<section class="hero">
  <div class="hero-content">
    <div class="hero-eyebrow">Tere Liye Books</div>
    <h1>Dunia <em>Fantasi</em><br>yang Tak<br>Terlupakan</h1>
    <p>Jelajahi seri novel Bumi karya Tere Liye — perjalanan epik Raib, Seli, dan Ali ke dunia-dunia yang menakjubkan.</p>
    <div class="hero-btn">
      <a href="#koleksi" class="btn-primary">Lihat Koleksi</a>
      <a href="#booking" class="btn-secondary">Kunjungi Toko</a>
    </div>
  </div>

  <div class="hero-meta">
    <div class="hero-meta-item">
      <span class="number">13+</span>
      <span class="label">Seri Novel</span>
    </div>
    <div class="hero-meta-divider"></div>
    <div class="hero-meta-item">
      <span class="number">4</span>
      <span class="label">Karakter Utama</span>
    </div>
    <div class="hero-meta-divider"></div>
    <div class="hero-meta-item">
      <span class="number">∞</span>
      <span class="label">Dunia Paralel</span>
    </div>
  </div>
</section>

<!-- ABOUT -->
<section class="about" id="tentang">
  <div class="about-left">
    <span class="section-eyebrow">Tentang Seri</span>
    <h2>Kisah <em>Petualangan</em><br>Lintas Dimensi</h2>
    <p>Seri Bumi adalah dunia fiksi ilmiah dan fantasi yang diciptakan oleh Tere Liye — mengisahkan tiga remaja dengan kemampuan luar biasa yang menjelajahi dimensi-dimensi paralel yang menakjubkan.</p>
    <a href="#koleksi" class="btn-secondary">Telusuri Koleksi</a>
  </div>

  <div class="about-right">
    <p>Raib bisa menghilang, Seli bisa mengeluarkan petir, dan Ali si jenius eksentrik. Bersama mereka, kamu akan melewati Klan Bulan, Klan Matahari, Klan Bintang, dan masih banyak lagi dunia ajaib yang belum pernah terbayangkan sebelumnya.</p>
    <blockquote class="about-quote">
      "Dunia ini sungguh luas, Raib. Jauh lebih luas dari yang kamu bayangkan."<br>
      <small style="font-size:14px; opacity:0.7; margin-top:8px; display:block;">— Tere Liye, Bumi</small>
    </blockquote>
  </div>
</section>

<!-- MENU / KOLEKSI -->
<section class="menu" id="koleksi">
  <div class="menu-header">
    <span class="section-eyebrow">Koleksi Pilihan</span>
    <h2>Novel <span>Seri Bumi</span></h2>
    <p>Empat novel pembuka yang akan membawamu masuk ke dalam dunia paralel yang luar biasa</p>
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