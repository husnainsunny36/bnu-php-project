<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

echo template("templates/partials/header.php");

// If login failed, prepare message
if (isset($_GET['return']) && $_GET['return'] == "fail") {
    $data['message'] = '<div class="mb-4 p-3 bg-red-100 border border-red-300 text-red-700 rounded">
                            Login Failed. Please try again.
                        </div>';
}

// If user is logged in, show dashboard
if (isset($_SESSION['id'])) {
    echo template("templates/partials/nav.php");

    $data['content'] = "<div class='text-lg font-semibold text-gray-800 mb-4'>Welcome to your dashboard.</div>";

    echo template("templates/default.php", $data);

} else {
    // Not logged in: show login page
    echo template("templates/login.php", $data);
}

echo template("templates/partials/footer.php");
?>
