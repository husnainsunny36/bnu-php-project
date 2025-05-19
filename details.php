<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

if (isset($_SESSION['id'])) {

    echo template("templates/partials/header.php");
    

    $studentId = $_SESSION['id'];
    $message = "";

    // Form submission
    if (isset($_POST['submit'])) {
        $sql = "UPDATE student SET 
                firstname = '" . mysqli_real_escape_string($conn, $_POST['txtfirstname']) . "',
                lastname = '" . mysqli_real_escape_string($conn, $_POST['txtlastname']) . "',
                house = '" . mysqli_real_escape_string($conn, $_POST['txthouse']) . "',
                town = '" . mysqli_real_escape_string($conn, $_POST['txttown']) . "',
                county = '" . mysqli_real_escape_string($conn, $_POST['txtcounty']) . "',
                country = '" . mysqli_real_escape_string($conn, $_POST['txtcountry']) . "',
                postcode = '" . mysqli_real_escape_string($conn, $_POST['txtpostcode']) . "'
                WHERE studentid = '$studentId'";

        $result = mysqli_query($conn, $sql);
        $message = "<div class='p-4 mb-4 bg-green-100 border border-green-300 text-green-800 rounded'>✅ Your details have been updated successfully.</div>";
    }

    // Retrieve student record
    $sql = "SELECT * FROM student WHERE studentid = '$studentId'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    ?>

    <div class="max-w-3xl mx-auto bg-white shadow-md rounded p-8 mt-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">My Details</h2>

        <?php echo $message; ?>

        <form method="POST" action="" class="space-y-5">
            <div>
                <label class="block font-medium">First Name</label>
                <input type="text" name="txtfirstname" value="<?php echo htmlspecialchars($row['firstname']); ?>" class="mt-1 block w-full border border-gray-300 rounded px-4 py-2" />
            </div>

            <div>
                <label class="block font-medium">Surname</label>
                <input type="text" name="txtlastname" value="<?php echo htmlspecialchars($row['lastname']); ?>" class="mt-1 block w-full border border-gray-300 rounded px-4 py-2" />
            </div>

            <div>
                <label class="block font-medium">Number and Street</label>
                <input type="text" name="txthouse" value="<?php echo htmlspecialchars($row['house']); ?>" class="mt-1 block w-full border border-gray-300 rounded px-4 py-2" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium">Town</label>
                    <input type="text" name="txttown" value="<?php echo htmlspecialchars($row['town']); ?>" class="mt-1 block w-full border border-gray-300 rounded px-4 py-2" />
                </div>

                <div>
                    <label class="block font-medium">County</label>
                    <input type="text" name="txtcounty" value="<?php echo htmlspecialchars($row['county']); ?>" class="mt-1 block w-full border border-gray-300 rounded px-4 py-2" />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium">Country</label>
                    <input type="text" name="txtcountry" value="<?php echo htmlspecialchars($row['country']); ?>" class="mt-1 block w-full border border-gray-300 rounded px-4 py-2" />
                </div>

                <div>
                    <label class="block font-medium">Postcode</label>
                    <input type="text" name="txtpostcode" value="<?php echo htmlspecialchars($row['postcode']); ?>" class="mt-1 block w-full border border-gray-300 rounded px-4 py-2" />
                </div>
            </div>

            <div class="text-right">
                <input type="submit" name="submit" value="Save" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow" />
            </div>
        </form>
    </div>

    <?php
    echo template("templates/partials/footer.php");

} else {
    header("Location: index.php");
    exit;
}
?>
