<?php
$mysqli = require dirname(__FILE__, 2) . "/db.php";
$sql = "SELECT
t.id,
CONCAT(t.sender_id, ' - ', u1.name) AS sender,
CONCAT(t.receiver_id, ' - ', u2.name) AS receiver,
amount,
timestamp
FROM
transactions t
INNER JOIN customers u1 ON t.sender_id = u1.id
INNER JOIN customers u2 ON t.receiver_id = u2.id;
";
$res = $mysqli->query($sql);
$list = $res->fetch_all();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>View Transaction History</title>
    <link rel="stylesheet" href="../styles/output.css" />
</head>

<body class="bg-slate-900">
    <main class="p-4">
        <h2 class="text-4xl m-auto text-center mb-8 text-white">Transaction History</h2>
        <table class="table-auto bg-slate-800 text-slate-100 w-full md:w-3/4 md:m-auto">
            <thead>
                <tr class="bg-slate-500 text-gray-100">
                    <th class="text-left ml-2 pl-8">ID</th>
                    <th class="text-left ml-2">Sender ID</th>
                    <th class="text-left ml-2">Receiver ID</th>
                    <th class="text-left ml-2">Amount</th>
                    <th class="text-left ml-2">Time</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list as $i) : ?>
                    <tr class="bg-slate-700 even:bg-slate-800">
                        <td class="py-1 pl-8"><?= $i[0] ?></td>
                        <td><?= $i[1] ?></td>
                        <td><?= $i[2] ?></td>
                        <td>$ <?= $i[3] ?></td>
                        <td><time datetime=" <?= $i[4] ?>"> <?= $i[4] ?></time></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="../transactions/new.php" class="m-auto mt-5 block w-2/3 md:w-80 text-center px-5 py-4 bg-green-700 hover:bg-green-900 text-slate-100 text-lg shadow-lg hover:shadow-xl rounded-2xl">Transfer Money</a>
        <a href="../" class="m-auto mt-5 block w-2/3 md:w-80 text-center px-5 py-4 bg-slate-600 hover:bg-slate-500 text-slate-200 text-lg shadow-lg hover:shadow-xl rounded-2xl">Home</a>
    </main>
</body>

</html>