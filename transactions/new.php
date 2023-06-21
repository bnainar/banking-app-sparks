<?php
$mysqli = require dirname(__FILE__, 2) . "/db.php";
$sql = "SELECT * FROM customers";
$res = $mysqli->query($sql);
$list = $res->fetch_all();
$errflag = 0;
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if ($_POST["sender"] === $_POST["receiver"]) {
        $errflag = 1;
    } else {
        $balancesql = sprintf(
            "SELECT balance FROM customers WHERE id = '%s'",
            $mysqli->real_escape_string($_POST["sender"])
        );
        $balanceRes = $mysqli->query($balancesql);
        $balance = $balanceRes->fetch_all();
        if ($_POST["amount"] > $balance[0][0]) {
            $errflag = 2;
        } else {
            $mysqli->begin_transaction();
            try {
                $decSQL = sprintf(
                    "UPDATE customers SET balance = balance - '%s' WHERE id = '%s'",
                    $mysqli->real_escape_string($_POST["amount"]),
                    $mysqli->real_escape_string($_POST["sender"])
                );
                if (!$mysqli->query($decSQL)) throw new Exception("Error Decrementing balance", 1);

                $incSQL = sprintf(
                    "UPDATE customers SET balance = balance + '%s' WHERE id = '%s'",
                    $mysqli->real_escape_string($_POST["amount"]),
                    $mysqli->real_escape_string($_POST["receiver"]),
                );
                if (!$mysqli->query($incSQL)) throw new Exception("Error Incrementing balance", 1);

                $transactionSQL = sprintf(
                    "INSERT INTO transactions (sender_id, receiver_id, amount) VALUES ('%s', '%s', '%s')",
                    $mysqli->real_escape_string($_POST["sender"]),
                    $mysqli->real_escape_string($_POST["receiver"]),
                    $mysqli->real_escape_string($_POST["amount"])
                );
                if (!$mysqli->query($transactionSQL)) throw new Exception("update transaction failed", 1);

                $mysqli->commit();
                header("Location: index.php");
                exit();
            } catch (Exception $e) {
                $mysqli->rollback();
                die($mysqli->error . " " . $mysqli->errno);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Transfer</title>
    <link rel="stylesheet" href="../styles/output.css" />
</head>

<body class="bg-slate-900">
    <main class="max-w-xl m-auto p-4">
        <h2 class="text-3xl text-center text-white">Transfer Money</h2>
        <form action="new.php" method="post" class="m-auto w-full md:w-50 flex flex-col">
            <label for="sender" class="block text-slate-200" style="padding-top:1rem; padding-bottom:1rem">Choose the Sender</label>
            <select required name="sender" id="sender" class="bg-slate-600 text-slate-200 w-full rounded-md px-2 py-2 mt-2 mb-3 
        focus:border-slate-100 focus:outline-none focus:ring focus:ring-slate-100">
                <option value="" disabled selected>--Please choose an option--</option>
                <?php foreach ($list as $i) : ?>
                    <option value="<?= $i[0] ?>"><?= $i[0] . ". " . $i[1] ?></option>
                <?php endforeach ?>
            </select>
            <label for="receiver" class="block text-slate-200" style="padding-top:1rem; padding-bottom:1rem">Choose the Receiver</label>
            <select required name="receiver" id="receiver" class="bg-slate-600 text-slate-200 w-full rounded-md px-2 py-2 mt-2 mb-3 
        focus:border-slate-100 focus:outline-none focus:ring focus:ring-slate-100 <?php if ($errflag == 1) echo 'ring-4 ring-red-500' ?>">
                <option value="" disabled selected>--Please choose an option--</option>
                <?php foreach ($list as $i) : ?>
                    <option value="<?= $i[0] ?>"><?= $i[0] . ". " . $i[1] ?></option>
                <?php endforeach ?>
            </select>
            <?php if ($errflag === 1) : ?>
                <p class="text-slate-400 mt-2">Self-transfers are not allowed</p>
            <?php endif; ?>
            <label for="amount" class="block text-slate-200" style="padding-top:1rem; padding-bottom:1rem">Amount</label>
            <input required type="number" name="amount" id="" max="10000.00" class="bg-slate-600 text-slate-200 w-full rounded-md px-2 py-2 mt-2 mb-3 
        focus:border-slate-100 focus:outline-none focus:ring focus:ring-slate-100 <?php if ($errflag == 2) echo 'ring-4 ring-red-500' ?>">
            <?php if ($errflag === 2) : ?>
                <p class="text-slate-400 mt-2">Not enough balance</p>
            <?php endif; ?>
            <input type="submit" value="Transfer" class="bg-green-700 text-slate-300 px-3 py-2 mt-3 text-xl m-auto rounded-md hover:bg-green-900 cursor-pointer shadow-lg hover:shadow-xl w-2/5">
        </form>
    </main>
</body>

</html>