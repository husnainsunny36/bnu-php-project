<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BNU Student Web Application</title>

    <!-- ✅ Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="bg-gray-100 text-gray-900 font-sans leading-relaxed">

<!-- Navigation Bar -->
<nav class="bg-blue-700 text-white p-4 shadow">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <div class="font-bold text-lg">
            <a href="students.php" class="hover:underline">Student Portal</a>
        </div>
        <div class="space-x-4">
            <a href="addstudent.php" class="hover:underline">Add Student</a>
            <a href="modules.php" class="hover:underline">My Modules</a>
            <a href="assignmodule.php" class="hover:underline">Assign Module</a>
            <a href="details.php" class="hover:underline">My Details</a>
            <a href="logout.php" class="hover:underline">Logout</a>
        </div>
    </div>
</nav>
<main class="max-w-7xl mx-auto px-4 py-6">
