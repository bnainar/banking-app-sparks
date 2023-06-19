<?php
$mysqli = require dirname(__FILE__, 2) . "/db.php";
$sql = "SELECT * FROM customers";
$res = $mysqli->query($sql);
$list = $res->fetch_all();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Transfer</title>
    <link rel="stylesheet" href="../output.css" />
</head>

<body class="bg-slate-300">
    <main class="p-5 m-5">
        <h2 class="text-xl">Transfer Money</h2>
        <form action="new.php" method="post">
            <div class="flex flex-col md:flex-row gap-8">
                <div class="">
                    <label for="sender" class="block">Choose the Sender</label>
                    <select name="sender" id="sender" class="w-full md:w-2/3">
                        <option value="" disabled selected>--Please choose an option--</option>
                        <?php foreach ($list as $i) : ?>
                            <option value="<?= $i[0] ?>"><?= $i[0] . ". " . $i[1] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div>
                    <label for="receiver" class="block">Choose the Receiver</label>
                    <select name="receiver" id="receiver" class="w-full md:w-2/3">
                        <option value="" disabled selected>--Please choose an option--</option>
                        <?php foreach ($list as $i) : ?>
                            <option value="<?= $i[0] ?>"><?= $i[0] . ". " . $i[1] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <label for="amount" class="block">Amount</label>
            <input type="number" name="amount" id="" max="10000.00" class="w-full md:w-2/3">
        </form>
    </main>
</body>

</html>