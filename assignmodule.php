<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Check logged in
if (isset($_SESSION['id'])) {

    echo template("templates/partials/header.php");
    

    echo '<div class="max-w-3xl mx-auto bg-white shadow-md rounded p-6 mt-8">';

    // If a module has been selected and submitted
    if (isset($_POST['selmodule'])) {
        $sql = "INSERT INTO studentmodules VALUES ('" . $_SESSION['id'] . "','" . $_POST['selmodule'] . "')";
        $result = mysqli_query($conn, $sql);

        echo "<div class='p-4 bg-green-100 text-green-800 border border-green-300 rounded mb-4'>";
        echo "✅ The module <strong>" . htmlspecialchars($_POST['selmodule']) . "</strong> has been assigned to you.";
        echo "</div>";
    }

    // Show module selection form
    $sql = "SELECT * FROM module";
    $result = mysqli_query($conn, $sql);

    ?>

    <h2 class="text-2xl font-bold text-gray-800 mb-4">Assign a Module</h2>

    <form method="POST" action="" class="space-y-4">
        <div>
            <label for="selmodule" class="block font-medium mb-1">Select a module to assign:</label>
            <select name="selmodule" id="selmodule" class="w-full border border-gray-300 rounded px-4 py-2">
                <?php while ($row = mysqli_fetch_array($result)): ?>
                    <option value="<?php echo htmlspecialchars($row['modulecode']); ?>">
                        <?php echo htmlspecialchars($row['name']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="text-right">
            <input type="submit" name="confirm" value="Assign Module" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">
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
