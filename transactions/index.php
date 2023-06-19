<?php
$mysqli = require dirname(__FILE__, 2) . "/db.php";
$sql = "SELECT * FROM transactions";
$res = $mysqli->query($sql);
$list = $res->fetch_all();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>View Transaction History</title>
    <link rel="stylesheet" href="../output.css" />
</head>

<body class="bg-slate-300">
    <main class="p-4">
        <h2 class="text-4xl m-auto text-center mb-8">Transaction History</h2>
        <table class="table-auto bg-blue-200 w-full md:w-3/4 md:m-auto">
            <thead>
                <tr class="bg-blue-500 text-slate-100">
                    <th>ID</th>
                    <th>Sender ID</th>
                    <th>Receiver ID</th>
                    <th>Amount</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list as $i) : ?>
                    <tr>
                        <td><?= $i[0] ?></td>
                        <td><?= $i[1] ?></td>
                        <td><?= $i[2] ?></td>
                        <td><?= $i[3] ?></td>
                        <td><time datetime="<?= $i[4] ?>"> <?= $i[4] ?></time></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="../transactions/new.php" class="m-auto mt-5 block w-2/3 md:w-80 text-center px-5 py-4 bg-green-700 hover:bg-green-900 text-slate-100 text-lg shadow-lg hover:shadow-xl rounded-2xl">Transfer Money</a>
    </main>
</body>

</html>