<?php
include 'services/koneksi.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $photo = $_FILES['photo']['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];

    if ($photo) {
        move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/' . $photo);
        $photo_path = 'uploads/' . $photo;
    } else {
        $photo_path = $user['photo'];
    }

    $stmt = $pdo->prepare("UPDATE users SET photo = :photo, username = :username, email = :email, phone_number = :phone_number, address = :address WHERE id = :id");
    $stmt->execute([
        'photo' => $photo_path,
        'username' => $username,
        'email' => $email,
        'phone_number' => $phone_number,
        'address' => $address,
        'id' => $id
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
    <title>Edit Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-xl mx-auto bg-white p-8 border border-gray-300 rounded-lg">
        <h2 class="text-2xl font-bold mb-5">Edit Pengguna</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="photo" class="block text-sm font-medium text-gray-700">Foto:</label>
                <input type="file" name="photo" id="photo" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username:</label>
                <input type="text" name="username" id="username" value="<?php echo $user['username']; ?>" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>
            <div class="mb-4">
                <label for="phone_number" class="block text-sm font-medium text-gray-700">Nomor Telepon:</label>
                <input type="text" name="phone_number" id="phone_number" value="<?php echo $user['phone_number']; ?>" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>
            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-700">Alamat:</label>
                <textarea name="address" id="address" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"><?php echo $user['address']; ?></textarea>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded">Update</button>
        </form>
    </div>
</body>
</html>
