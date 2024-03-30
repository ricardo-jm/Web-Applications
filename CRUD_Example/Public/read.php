<?php
/**
 * Function to query information based on
 * a parameter: in this case, location.
 *
 */
if (isset($_POST['submit'])) {
    try {
        require "../common.php";
        require_once '../src/DBconnect.php';
        $sql = "SELECT *
FROM users
WHERE location = :location";
        $location = $_POST['location'];
        $statement = $connection->prepare($sql);
        $statement->bindParam(':location', $location, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
require "templates/header.php";
if (isset($_POST['submit'])) {
    if ($result && $statement->rowCount() > 0) {
        ?>
        <h2>Results</h2>
        <table>
            <thead>
            Page 28 of 32
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email Address</th>
                <th>Age</th>
                <th>Location</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($result as $row) { ?>
                <tr>
                    <td><?php echo escape($row["id"]); ?></td>
                    <td><?php echo escape($row["firstname"]); ?></td>
                    <td><?php echo escape($row["lastname"]); ?></td>
                    <td><?php echo escape($row["email"]); ?></td>
                    <td><?php echo escape($row["age"]); ?></td>
                    <td><?php echo escape($row["location"]); ?></td>
                    <td><?php echo ($row["date"]); ?> </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        > No results found for <?php echo escape($_POST['location']); ?>.
    <?php }
} ?>

    <div class="container">
    <div class="row">
        <?php foreach ($result as $cutePet) { ?>
            <div class="col-md-4 pet-list-item">
                <h2>
                    <?php echo $cutePet['firstname']; ?>
                </h2>
                <blockquote class="pet-details">
                    <span class="label label-info"><?php echo $cutePet['email']; ?></span>
                    <?php echo 'Age: '. $cutePet['age']; ?>
                </blockquote>
                <p>
                    <?php echo 'Location:'. $cutePet['location']; ?>
                </p>
            </div>
        <?php } ?>
    </div>

    <h2>Find user based on location</h2>
    <form method="post">
        <label for="location">Location</label>
        <input type="text" id="location" name="location">
        <input type="submit" name="submit" value="View Results">
    </form>
    <a href="index.php">Back to home</a>
<?php require "templates/footer.php"; ?>