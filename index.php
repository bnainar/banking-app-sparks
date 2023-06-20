<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Welcome to Banking app</title>
  <link rel="stylesheet" href="./styles/output.css" />
</head>

<body>

  <div class="pt-24 p-10 m-auto hero h-50 md:px-24 md:py-32">
    <h1 class="text-5xl font-extrabold text-slate-100">Welcome to Banking app</h1>
    <p class="my-8 text-lg text-slate-200 max-w-lg">Safely send and receive money between customers with our user-friendly banking app. No login required for seamless transactions!</p>
    <a href="#services" class="block py-2 px-5 text-lg rounded-md font-semibold shadow-lg hover:shadow-xl w-56 text-center bg-purple-600 text-slate-200 hover:bg-purple-800">Checkout our services</a>
  </div>


  <main class="h-50 px-10 py-14 m-auto bg-slate-300 pb-10">
    <h2 id="services" class="text-5xl font-bold mb-10 md:ml-16 text-slate-700">Services</h2>
    <div class="flex md:flex-row flex-col gap-4 md:justify-around">
      <div class="ring-1 ring-slate-500 p-5 md:p-10 shadow-lg rounded-lg w-full md:w-2/5 mb-14">
        <span class="text-3xl font-semibold">Customers</span>
        <p class="py-3 text-lg">View all of the customers details like email, name, etc</p>
        <a class="block py-2 px-3 bg-sky-600 hover:bg-sky-900 text-white text-center text-lg font-medium w-52 rounded-md shadow-lg hover:shadow-xl" href="customers/">View all customers</a>
      </div>

      <div class="ring-1 ring-slate-500 p-5 md:p-10 shadow-lg rounded-lg w-full md:w-2/5 mb-14">
        <span class="text-3xl font-semibold">Transactions</span>
        <p class="py-3 mb-2 text-lg">Transfer money between customers effortlessly!</p>
        <a class="py-2 px-5 my-8 mr-8 bg-sky-600 hover:bg-sky-900 text-white text-center text-lg font-medium w-44 rounded-md shadow-lg hover:shadow-xl" href="transactions/new.php">Transfer Money</a>
        <a class="block md:inline py-2 px-5 my-3 bg-slate-300 border-2 border-solid border-slate-500 hover:bg-slate-400 text-slate-700 text-center text-lg font-medium w-52 md:w-44 rounded-md shadow-lg hover:shadow-xl" href="transactions/">Transaction History</a>
      </div>
    </div>
  </main>
  <div class="flex flex-row w-full mx-0 h-24 px-4 pt-8 bg-gray-800 justify-around align-middle">
    <a href="https://github.com/bnainar/banking-app-sparks" class="text-white text-lg underline">GitHub link</a>
    <a href="https://www.linkedin.com/in/bnainar/" class="text-white text-lg underline">LinkedIn</a>
  </div>
  </div>
</body>

</html>