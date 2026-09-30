<?php
require_once "config/database.php";

/*
|--------------------------------------------------------------------------
| 1. PENCARIAN & FILTER
|--------------------------------------------------------------------------
*/
$keyword  = $_GET['keyword']  ?? '';
$kategori = $_GET['kategori'] ?? '';

$where = [];

if ($keyword != '') {
    $keyword_safe = mysqli_real_escape_string($conn, $keyword);
    $where[] = "nama LIKE '%$keyword_safe%'";
}

if ($kategori != '') {
    $kategori_safe = mysqli_real_escape_string($conn, $kategori);
    $where[] = "kategori = '$kategori_safe'";
}

$where_sql = "";

if (count($where) > 0) {
    $where_sql = "WHERE " . implode(" AND ", $where);
}

/*
|--------------------------------------------------------------------------
| 2. PAGINASI
|--------------------------------------------------------------------------
*/
$per_page = 8;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if ($page < 1) {
    $page = 1;
}

$offset = ($page - 1) * $per_page;

$count_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM produk $where_sql"
);

$count_data = mysqli_fetch_assoc($count_query);
$total_data = $count_data['total'];
$total_page = ceil($total_data / $per_page);

$query = mysqli_query(
    $conn,
    "SELECT * FROM produk
     $where_sql
     ORDER BY id ASC
     LIMIT $per_page OFFSET $offset"
);

// Daftar kategori untuk isi dropdown filter (otomatis dari database)
$kategori_query = mysqli_query(
    $conn,
    "SELECT DISTINCT kategori FROM produk ORDER BY kategori ASC"
);

// Bagian query string yang dibawa ke setiap link halaman
$qs = http_build_query([
    'keyword'  => $keyword,
    'kategori' => $kategori,
]);

$page_title = "Katalog Buku — Tere Liye Books";

include "includes/header.php";
?>

<section class="menu catalog">

  <div class="menu-header">
    <span class="section-eyebrow">Katalog</span>
    <h2>Koleksi <span>Lengkap</span></h2>
    <p>Cari novel favoritmu berdasarkan judul atau kategori</p>
  </div>

  <!-- FORM PENCARIAN & FILTER -->
  <form method="GET" action="produk.php" class="catalog-filter">

    <input type="text"
           name="keyword"
           placeholder="Cari judul buku..."
           value="<?= htmlspecialchars($keyword); ?>">

    <select name="kategori">
      <option value="">Semua Kategori</option>
      <?php while ($k = mysqli_fetch_assoc($kategori_query)): ?>
      <option value="<?= htmlspecialchars($k['kategori']); ?>"
        <?= $kategori == $k['kategori'] ? 'selected' : ''; ?>>
        <?= htmlspecialchars($k['kategori']); ?>
      </option>
      <?php endwhile; ?>
    </select>

    <button type="submit" class="btn-primary">Cari</button>

    <?php if ($keyword != '' || $kategori != ''): ?>
    <a href="produk.php" class="btn-secondary">Reset</a>
    <?php endif; ?>

  </form>

  <p class="catalog-info">
    Menampilkan <?= mysqli_num_rows($query); ?> dari <?= $total_data; ?> buku
  </p>

  <!-- DAFTAR BUKU -->
  <?php if (mysqli_num_rows($query) > 0): ?>

  <div class="grid">
    <?php while ($row = mysqli_fetch_assoc($query)): ?>
    <?php
      $stok_label = ($row['stok'] > 0) ? 'Tersedia' : 'Stok Habis';
      $deskripsi  = $row['deskripsi'] ?? '';
      if (strlen($deskripsi) > 90) {
          $deskripsi = substr($deskripsi, 0, 90) . '...';
      }
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
        <p class="desc"><?= htmlspecialchars($deskripsi); ?></p>
        <p class="price">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></p>
        <a href="detail.php?id=<?= (int)$row['id']; ?>" class="card-cta">Lihat Detail →</a>
      </div>
    </div>
    <?php endwhile; ?>
  </div>

  <!-- NAVIGASI HALAMAN -->
  <?php if ($total_page > 1): ?>
  <div class="pagination">

    <?php if ($page > 1): ?>
    <a href="produk.php?<?= $qs; ?>&page=<?= $page - 1; ?>">← Sebelumnya</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $total_page; $i++): ?>
    <a href="produk.php?<?= $qs; ?>&page=<?= $i; ?>"
       class="<?= $i == $page ? 'active' : ''; ?>">
      <?= $i; ?>
    </a>
    <?php endfor; ?>

    <?php if ($page < $total_page): ?>
    <a href="produk.php?<?= $qs; ?>&page=<?= $page + 1; ?>">Berikutnya →</a>
    <?php endif; ?>

  </div>
  <?php endif; ?>

  <?php else: ?>

  <p class="catalog-empty">Buku yang kamu cari tidak ditemukan.</p>

  <?php endif; ?>

</section>

<?php include "includes/footer.php"; ?>