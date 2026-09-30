<?php

session_start();

require_once "../includes/auth.php";

require_once "../config/database.php";

$keyword = $_GET['keyword'] ?? '';
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
| PAGINATION
|--------------------------------------------------------------------------
*/

$per_page = 5;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if ($page < 1) {
    $page = 1;
}

$offset = ($page - 1) * $per_page;

$count_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total 
     FROM produk
     $where_sql"
);

$count_data = mysqli_fetch_assoc($count_query);

$total_data = $count_data['total'];

$total_page = ceil($total_data / $per_page);

$query = mysqli_query(
    $conn,
    "SELECT * FROM produk
     $where_sql
     ORDER BY id DESC
     LIMIT $per_page OFFSET $offset"
);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Kelola Produk</title>

    <link rel="stylesheet" href="../assets/admin.css">

</head>

<body>

<div class="navbar">

    <div class="container">

        <a href="index.php">Dashboard</a>

        <a href="produk.php">Produk</a>

        <a href="../index.php">Website</a>

    </div>

</div>

<div class="container">

    <h1>Kelola Produk</h1>

    <?php include "../includes/flash.php"; ?>

    <a href="tambah.php" class="btn">
        + Tambah Produk
    </a>

    <br><br>

    <!-- SEARCH & FILTER -->

    <div class="card">

        <form method="GET">

            <label>
                Cari Produk
            </label>

            <input
                type="text"
                name="keyword"
                placeholder="Masukkan nama produk"
                value="<?= htmlspecialchars($keyword); ?>"
            >

            <label>
                Kategori
            </label>

            <select name="kategori">

                <option value="">
                    Semua Kategori
                </option>

                <option value="Fiksi Ilmiah"
                    <?= $kategori == 'Fiksi Ilmiah' ? 'selected' : ''; ?>>
                    Fiksi Ilmiah
                </option>

                <option value="Romance"
                    <?= $kategori == 'Romance' ? 'selected' : ''; ?>>
                    Romance
                </option>

                <option value="Sejarah"
                    <?= $kategori == 'Sejarah' ? 'selected' : ''; ?>>
                    Sejarah
                </option>

                <option value="Petualangan"
                    <?= $kategori == 'Petualangan' ? 'selected' : ''; ?>>
                    Petualangan
                </option>

            </select>

            <button type="submit" class="btn">
                Cari
            </button>

            <a href="produk.php" class="btn">
                Reset
            </a>

        </form>

    </div>

    <div class="card">

        <table>

            <tr>

                <th>No</th>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>

            </tr>

            <?php

            $no = $offset + 1;

            while ($row = mysqli_fetch_assoc($query)):

            ?>

            <tr>

                <td><?= $no++; ?></td>

                <td>

                    <?php if ($row['gambar']): ?>

                        <img
                            src="../uploads/produk/<?= htmlspecialchars($row['gambar']); ?>"
                            width="80"
                        >

                    <?php else: ?>

                        Tidak ada

                    <?php endif; ?>

                </td>

                <td>
                    <?= htmlspecialchars($row['nama']); ?>
                </td>

                <td>
                    <?= htmlspecialchars($row['kategori']); ?>
                </td>

                <td>
                    Rp <?= number_format($row['harga'], 0, ',', '.'); ?>
                </td>

                <td>
                    <?= $row['stok']; ?>
                </td>

                <td>

                    <a
                        href="edit.php?id=<?= $row['id']; ?>"
                        class="btn btn-warning"
                    >
                        Edit
                    </a>

                    <a
                        href="hapus.php?id=<?= $row['id']; ?>"
                        class="btn btn-danger"
                        onclick="return confirm('Yakin ingin menghapus produk?')"
                    >
                        Hapus
                    </a>

                </td>

            </tr>

            <?php endwhile; ?>

        </table>

    </div>

    <!-- PAGINATION -->

    <div class="pagination">

        <?php for ($i = 1; $i <= $total_page; $i++): ?>

            <a
                href="?page=<?= $i; ?>&keyword=<?= urlencode($keyword); ?>&kategori=<?= urlencode($kategori); ?>"
            >
                <?= $i; ?>
            </a>

        <?php endfor; ?>

    </div>

</div>

</body>
</html>