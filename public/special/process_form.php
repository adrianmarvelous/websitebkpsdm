<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve signature data from the form
    echo $signatureData = $_POST['signatureData'];

    // Decode the base64-encoded signature data
    $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
    $signatureData = str_replace(' ', '+', $signatureData);
    $signatureImage = base64_decode($signatureData);

    // Save the signature as a PNG file
    $filename = 'path/to/save/signature.png';
    file_put_contents($filename, $signatureImage);

    // // Insert the file path into the database
    // $dbHost = 'your_database_host';
    // $dbName = 'your_database_name';
    // $dbUser = 'your_database_user';
    // $dbPass = 'your_database_password';

    // try {
    //     $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    //     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //     $stmt = $pdo->prepare("INSERT INTO signatures (filepath) VALUES (?)");
    //     $stmt->bindParam(1, $filename);
    //     $stmt->execute();

    //     echo "Signature saved and inserted into the database successfully!";
    // } catch (PDOException $e) {
    //     echo "Error: " . $e->getMessage();
    // }
}
?>
