<?php
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

echo template("templates/partials/header.php");


$error = "";
$success = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // File upload handling
    $imageFileName = null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $maxFileSize = 2 * 1024 * 1024; // 2MB limit

        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileSize = $_FILES['image']['size'];
        $fileName = $_FILES['image']['name'];
        $fileMimeType = mime_content_type($fileTmpPath);
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if ($fileSize > $maxFileSize) {
            $error = "Image size must be less than 2MB.";
        } elseif (!in_array($fileMimeType, $allowedMimeTypes) || !in_array($fileExtension, $allowedExtensions)) {
            $error = "Invalid image type. Only JPG, PNG, and GIF files are allowed.";
        } elseif (!getimagesize($fileTmpPath)) {
            $error = "Uploaded file is not a valid image.";
        } else {
            $uploadDir = "uploads/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $imageFileName = uniqid("img_") . "." . $fileExtension;
            $destination = $uploadDir . $imageFileName;

            if (!move_uploaded_file($fileTmpPath, $destination)) {
                $error = "Failed to move uploaded image.";
            }
        }
    }

    // Sanitize and validate form data
    if (empty($error)) {
        $studentid = trim($_POST['studentid']);
        $firstname = trim($_POST['firstname']);
        $lastname = trim($_POST['lastname']);
        $dob = $_POST['dob'];
        $house = trim($_POST['house']);
        $town = trim($_POST['town']);
        $county = trim($_POST['county']);
        $country = trim($_POST['country']);
        $postcode = trim($_POST['postcode']);
        $password = $_POST['password'];

        if (empty($studentid) || empty($firstname) || empty($lastname) || empty($dob) || empty($postcode) || empty($password)) {
            $error = "Please fill in all required fields.";
        } elseif (!preg_match("/^[0-9]{8}$/", $studentid)) {
            $error = "Student ID must be 8 digits.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = mysqli_prepare($conn, "INSERT INTO student (studentid, firstname, lastname, dob, house, town, county, country, postcode, password, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, 'issssssssss', $studentid, $firstname, $lastname, $dob, $house, $town, $county, $country, $postcode, $hashedPassword, $imageFileName);

            if (mysqli_stmt_execute($stmt)) {
                $success = "Student added successfully.";
            } else {
                $error = "Error adding student: " . mysqli_error($conn);
            }

            mysqli_stmt_close($stmt);
        }
    }
}
?>

<div class="max-w-3xl mx-auto bg-white shadow-md rounded p-8 mt-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Add New Student</h2>

    <?php if ($error): ?>
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded border border-red-300"><?php echo $error; ?></div>
    <?php elseif ($success): ?>
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded border border-green-300"><?php echo $success; ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" action="" class="space-y-5">
        <div>
            <label class="block font-medium">Student ID*</label>
            <input type="text" name="studentid" required class="mt-1 block w-full border border-gray-300 rounded px-4 py-2">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-medium">First Name*</label>
                <input type="text" name="firstname" required class="mt-1 block w-full border border-gray-300 rounded px-4 py-2">
            </div>

            <div>
                <label class="block font-medium">Last Name*</label>
                <input type="text" name="lastname" required class="mt-1 block w-full border border-gray-300 rounded px-4 py-2">
            </div>
        </div>

        <div>
            <label class="block font-medium">Date of Birth*</label>
            <input type="date" name="dob" required class="mt-1 block w-full border border-gray-300 rounded px-4 py-2">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-medium">House</label>
                <input type="text" name="house" class="mt-1 block w-full border border-gray-300 rounded px-4 py-2">
            </div>

            <div>
                <label class="block font-medium">Town</label>
                <input type="text" name="town" class="mt-1 block w-full border border-gray-300 rounded px-4 py-2">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-medium">County</label>
                <input type="text" name="county" class="mt-1 block w-full border border-gray-300 rounded px-4 py-2">
            </div>

            <div>
                <label class="block font-medium">Country</label>
                <input type="text" name="country" class="mt-1 block w-full border border-gray-300 rounded px-4 py-2">
            </div>
        </div>

        <div>
            <label class="block font-medium">Postcode*</label>
            <input type="text" name="postcode" required class="mt-1 block w-full border border-gray-300 rounded px-4 py-2">
        </div>

        <div>
            <label class="block font-medium">Password*</label>
            <input type="password" name="password" required class="mt-1 block w-full border border-gray-300 rounded px-4 py-2">
        </div>

        <div>
            <label class="block font-medium">Upload Image</label>
            <input type="file" name="image" accept="image/*" class="mt-1 block w-full border border-gray-300 rounded px-4 py-2 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-blue-600 file:text-white hover:file:bg-blue-700">
        </div>

        <div class="text-right">
            <input type="submit" value="Add Student" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">
        </div>
    </form>
</div>

<?php
echo template("templates/partials/footer.php");
?>
