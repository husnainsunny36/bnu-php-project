<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Check if the user is logged in
if (isset($_SESSION['id'])) {

    echo template("templates/partials/header.php");
   

    // Fetch student modules
    $sql = "SELECT * FROM studentmodules sm, module m 
            WHERE m.modulecode = sm.modulecode 
            AND sm.studentid = '" . $_SESSION['id'] . "'";

    $result = mysqli_query($conn, $sql);
    ?>

    <div class="max-w-5xl mx-auto bg-white shadow-md rounded p-6 mt-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">My Modules</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 divide-y divide-gray-100">
                <thead class="bg-gray-100 text-gray-700 text-sm uppercase tracking-wider">
                    <tr>
                        <th class="px-4 py-3 text-left border">Code</th>
                        <th class="px-4 py-3 text-left border">Module Name</th>
                        <th class="px-4 py-3 text-left border">Level</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-800 divide-y divide-gray-100">
                    <?php while ($row = mysqli_fetch_array($result)) : ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border"><?php echo htmlspecialchars($row['modulecode']); ?></td>
                            <td class="px-4 py-2 border"><?php echo htmlspecialchars($row['name']); ?></td>
                            <td class="px-4 py-2 border"><?php echo htmlspecialchars($row['level']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
    echo template("templates/partials/footer.php");

} else {
    header("Location: index.php");
    exit;
}
?>
