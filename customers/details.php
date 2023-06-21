<?php
if ($_SERVER["REQUEST_METHOD"] === "GET" && !empty($_GET["id"])) {
    $mysqli = require dirname(__FILE__, 2) . "/db.php";

    $csql = sprintf(
        "SELECT * FROM `customers` WHERE id = '%s'",
        $mysqli->real_escape_string($_GET["id"])
    );
    $cres = $mysqli->query($csql);
    if ($cres->num_rows === 0) {
        die("Enter a valid customer ID");
    }

    $customer = $cres->fetch_all();

    $tsql = sprintf(
        "SELECT * FROM `transactions` WHERE sender_id = '%s' OR receiver_id = '%s'",
        $mysqli->real_escape_string($_GET["id"]),
        $mysqli->real_escape_string($_GET["id"])
    );
    $tres = $mysqli->query($tsql);
    $transactions = $tres->fetch_all();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Customer Details</title>
    <link rel="stylesheet" href="../styles/output.css?">
</head>

<body class="bg-slate-900">
    <main class="p-4">
        <h2 class="text-3xl m-auto text-center mb-8 text-slate-300">Customer Details</h2>
        <div class=" m-auto text-center mb-8 text-white">
            <span class="text-4xl underline font-bold"><?= $customer[0][1] ?></span>
            <span class="text-3xl text-slate-300 font-mono"> (<?= $customer[0][2] ?>)</span>
        </div>
        <h2 class="text-2xl m-auto text-center mb-8 text-white font-semibold">Balance: $<?= $customer[0][3] ?></h2>


        <h2 class="text-3xl m-auto text-center mb-8 text-slate-300">Account Summary</h2>
        <?php if ($tres->num_rows > 0) : ?>
            <table class="table-auto bg-slate-800 text-slate-100 w-full md:w-3/4 md:m-auto">
                <thead>
                    <tr class="bg-slate-500 text-gray-100">
                        <th class="text-left ml-2 pl-8">ID</th>
                        <th class="text-left ml-2">Type</th>
                        <th class="text-left ml-2">Amount</th>
                        <th class="text-left ml-2">Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transactions as $i) : ?>
                        <tr class="bg-slate-700 even:bg-slate-800">
                            <td class="py-1 pl-8"><?= $i[0] ?></td>

                            <?php if ($i[1] == $_GET["id"]) : ?>
                                <td>Debit</td>
                                <td class="text-red-400 font-semibold">$<?= $i[3] ?></td>
                            <?php else : ?>
                                <td>Credit</td>
                                <td class="text-green-400 font-semibold">$<?= $i[3] ?></td>
                            <?php endif; ?>

                            <td><time datetime=" <?= $i[4] ?>"> <?= $i[4] ?></time></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <h3 class="text-white text-xl text-center m-auto">There are no transactions! Click button below to begin your first one</h3>
        <?php endif; ?>
        <a href="../transactions/new.php" class="m-auto mt-5 block w-2/3 md:w-80 text-center px-5 py-4 bg-green-700 hover:bg-green-900 text-slate-100 text-lg shadow-lg hover:shadow-xl rounded-2xl">Transfer Money</a>
        <a href="../" class="m-auto mt-5 block w-2/3 md:w-80 text-center px-5 py-4 bg-slate-600 hover:bg-slate-500 text-slate-200 text-lg shadow-lg hover:shadow-xl rounded-2xl">Home</a>
    </main>
</body>

</html>