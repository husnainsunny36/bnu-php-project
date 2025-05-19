<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Login</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="bg-gray-100 text-gray-900 flex items-center justify-center min-h-screen">

<div class="w-full max-w-md bg-white shadow-md rounded px-8 py-10">
    <h2 class="text-2xl font-bold text-center mb-6">Student Login</h2>

    <?php if (!empty($message)) : ?>
        <div class="mb-4 p-3 bg-red-100 border border-red-300 text-red-700 rounded">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <form name="frmLogin" action="authenticate.php" method="post" class="space-y-5">
        <div>
            <label class="block text-sm font-medium">Student ID</label>
            <input name="txtid" type="text" required
                   class="w-full mt-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-sm font-medium">Password</label>
            <input name="txtpwd" type="password" required
                   class="w-full mt-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="text-center">
            <input type="submit" value="Login" name="btnlogin"
                   class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 transition duration-200">
        </div>
    </form>
</div>

</body>
</html>
