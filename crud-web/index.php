<?php
include 'services/koneksi.php';

$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Sederhana</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-2xl font-bold mb-5">Daftar Pengguna</h2>
        <a href="create.php" class="inline-block bg-blue-500 text-white py-2 px-4 rounded mb-5">Tambah Pengguna Baru</a>
        <table class="min-w-full bg-white border border-gray-300 rounded-lg">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-3 px-4 text-left">ID</th>
                    <th class="py-3 px-4 text-left">Foto</th>
                    <th class="py-3 px-4 text-left">Username</th>
                    <th class="py-3 px-4 text-left">Email</th>
                    <th class="py-3 px-4 text-left">Nomor Telepon</th>
                    <th class="py-3 px-4 text-left">Alamat</th>
                    <th class="py-3 px-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr class="border-t border-gray-300">
                    <td class="py-3 px-4"><?php echo $user['id']; ?></td>
                    <td class="py-3 px-4">
                        <img src="<?php echo $user['photo']; ?>" alt="User Photo" class="w-16 h-16 object-cover rounded-full">
                    </td>
                    <td class="py-3 px-4"><?php echo $user['username']; ?></td>
                    <td class="py-3 px-4"><?php echo $user['email']; ?></td>
                    <td class="py-3 px-4"><?php echo $user['phone_number']; ?></td>
                    <td class="py-3 px-4"><?php echo $user['address']; ?></td>
                    <td class="py-3 px-4">
                        <a href="edit.php?id=<?php echo $user['id']; ?>" class="text-blue-500 hover:underline">Edit</a> | 
                        <a href="delete.php?id=<?php echo $user['id']; ?>" class="text-red-500 hover:underline" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
