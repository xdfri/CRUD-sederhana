<?php
include 'services/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $photo = $_FILES['photo']['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];

    // Pindahkan file gambar ke folder uploads dan simpan jalur di database
    $photo_path = 'uploads/' . $photo;
    move_uploaded_file($_FILES['photo']['tmp_name'], $photo_path);

    $stmt = $pdo->prepare("INSERT INTO users (photo, username, email, phone_number, address) VALUES (:photo, :username, :email, :phone_number, :address)");
    $stmt->execute([
        'photo' => $photo_path,
        'username' => $username,
        'email' => $email,
        'phone_number' => $phone_number,
        'address' => $address
    ]);

    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-xl mx-auto bg-white p-8 border border-gray-300 rounded-lg">
        <h2 class="text-2xl font-bold mb-5">Tambah Pengguna Baru</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="photo" class="block text-sm font-medium text-gray-700">Foto:</label>
                <input type="file" name="photo" id="photo" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username:</label>
                <input type="text" name="username" id="username" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                <input type="email" name="email" id="email" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>
            <div class="mb-4">
                <label for="phone_number" class="block text-sm font-medium text-gray-700">Nomor Telepon:</label>
                <input type="text" name="phone_number" id="phone_number" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>
            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-700">Alamat:</label>
                <textarea name="address" id="address" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"></textarea>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded">Tambah</button>
        </form>
    </div>
</body>
</html>
