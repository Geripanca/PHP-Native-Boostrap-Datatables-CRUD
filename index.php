<?php

require 'koneksi.php';
$connect = connectToDatabase(); // Pastikan fungsi ini ada di koneksi.php

$sql = "SELECT * FROM users";
$result = mysqli_query($connect, $sql);

if (!$result) {
    die("Error dalam query: " . mysqli_error($connect));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> 
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>

    <style>
        /* Mengubah warna latar belakang untuk input pencarian */
        .dataTables_wrapper .dataTables_filter input {
            background-color: #343a40; 
            color: white; 
            border: 1px solid #495057; 
            padding: 0.5rem; 
            margin : 1rem 0;
        }

        /* Mengubah warna latar belakang untuk pagination */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            background-color: #495057; 
            color: white; 
        }

        /* Mengubah warna saat hover pada tombol pagination */
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #007bff; 
            color: white; 
        }

        /* Mengubah warna untuk tombol aktif */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #007bff; 
            color: white; 
        }

        /* Mengubah warna latar belakang untuk tabel */
        table.dataTable {
            background-color: #212529; 
        }
    </style>

</head>
<body class="bg-dark text-light p-3">
    <div class="container">
        <h1 class="my-4">Daftar Users</h1>
        <a href="create.php" class="btn btn-primary mb-3">Tambah Users</a>
        <table id="userTable" class="table table-bordered table-dark">
            <thead>
                <tr>
                    <th class="p-2">ID</th>
                    <th class="p-2">Nama</th>
                    <th class="p-2">Email</th>
                    <th class="p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td>
                            <a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>    
            </tbody>
        </table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#userTable').DataTable({
                dom: 'Bfrtip', // Menampilkan tombol di atas tabel
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print' // Menambahkan tombol export
                ],
                "paging": true,    // Enable pagination
                "searching": true, // Enable search
                "ordering": true,  // Enable ordering
            }); 
        });
    </script>
</body>
</html>
