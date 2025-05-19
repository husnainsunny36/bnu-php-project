<?php
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

echo template("templates/partials/header.php");


// Handle delete request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    if (!empty($_POST['selected_students'])) {
        $idsToDelete = array_map('intval', $_POST['selected_students']);
        $idList = implode(',', $idsToDelete);

        $sqlDelete = "DELETE FROM student WHERE studentid IN ($idList)";
        if (mysqli_query($conn, $sqlDelete)) {
            echo "<p class='text-green-600 mb-4'>Selected student(s) deleted successfully.</p>";
        } else {
            echo "<p class='text-red-600 mb-4'>Error deleting records: " . mysqli_error($conn) . "</p>";
        }
    } else {
        echo "<p class='text-red-600 mb-4'>No students selected for deletion.</p>";
    }
}

// Retrieve student info
$sql = "SELECT studentid, firstname, lastname, dob, house, town, county, country, postcode, image FROM student";
$result = mysqli_query($conn, $sql);
$studentinfo = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<h2 class="text-3xl font-bold mb-6 text-gray-800">Student Details</h2>

<form method="post" onsubmit="return confirm('Are you sure you want to delete the selected students?');">
    <div class="overflow-x-auto bg-white shadow-md rounded-lg border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
            <thead class="bg-gray-100 text-gray-700 uppercase tracking-wider">
                <tr>
                    <th class="px-4 py-3">Select</th>
                    <th class="px-4 py-3">Student ID</th>
                    <th class="px-4 py-3">First Name</th>
                    <th class="px-4 py-3">Last Name</th>
                    <th class="px-4 py-3">Date of Birth</th>
                    <th class="px-4 py-3">House</th>
                    <th class="px-4 py-3">Town</th>
                    <th class="px-4 py-3">County</th>
                    <th class="px-4 py-3">Country</th>
                    <th class="px-4 py-3">Postcode</th>
                    <th class="px-4 py-3">Image</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php foreach ($studentinfo as $student): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 text-center">
                            <input type="checkbox" name="selected_students[]" value="<?php echo htmlspecialchars($student['studentid']); ?>" class="form-checkbox h-4 w-4 text-blue-600">
                        </td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($student['studentid']); ?></td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($student['firstname']); ?></td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($student['lastname']); ?></td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($student['dob']); ?></td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($student['house']); ?></td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($student['town']); ?></td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($student['county']); ?></td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($student['country']); ?></td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($student['postcode']); ?></td>
                        <td class="px-4 py-2 text-center">
                            <?php if (!empty($student['image'])): ?>
                                <img src="uploads/<?php echo htmlspecialchars($student['image']); ?>" class="w-12 h-12 rounded-full object-cover mx-auto border">
                            <?php else: ?>
                                <span class="text-gray-400">No image</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex justify-end">
        <button type="submit" name="delete" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2 rounded shadow">
            Delete Selected
        </button>
    </div>
</form>

<?php echo template("templates/partials/footer.php"); ?>
