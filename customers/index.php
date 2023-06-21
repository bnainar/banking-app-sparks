<?php
$mysqli = require dirname(__FILE__, 2) . "/db.php";
$sql = "SELECT * FROM customers";
$res = $mysqli->query($sql);
$list = $res->fetch_all();
// var_dump($list);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/output.css?" />
</head>

<body class="bg-slate-900">
    <main class="p-4">
        <h2 class="text-4xl m-auto text-center mb-8 text-white">Customer Details</h2>
        <table class="table-auto shadow-lg rounded-md text-center bg-slate-700 text-slate-100 w-full md:w-3/4 md:m-auto">
            <thead>
                <tr class="bg-slate-500 text-slate-100">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list as $i) : ?>
                    <tr class="bg-slate-700 even:bg-slate-800">
                        <td class="py-1"><?= $i[0] ?></td>
                        <td><a href="./details.php?id=<?= $i[0] ?>" class="underline font-semibold">
                                <?= $i[1] ?></a>
                        </td>
                        <td><?= $i[2] ?></td>
                        <td><?= $i[3] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="../transactions/new.php" class="m-auto mt-5 block w-2/3 md:w-80 text-center px-5 py-4 bg-green-700 hover:bg-green-900 text-slate-100 text-lg shadow-lg hover:shadow-xl rounded-2xl">Transfer Money</a>
        <a href="../transactions/" class="m-auto mt-5 block w-2/3 md:w-80 text-center px-5 py-4 bg-green-300 hover:bg-green-400 text-green-900 text-lg shadow-lg hover:shadow-xl rounded-2xl">See all Transactions</a>
    </main>
</body>

</html>