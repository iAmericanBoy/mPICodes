<?php

//moves the pointer to the beginning to the line 
function lineStart($file) {
    $position = ftell($file);
    //if at beginning of file don't try to go farther
    if ($position == false) {
        return $position;
    } else {
        while (fgetc($file) != "\n") {
            fseek($file, --$position);
            if ($position == 0) break;
        }
    }

    return $position;
}

//open file
$file = fopen('Codes.csv', "r+");

//go to the end of file to get the last row
fseek($file, -1, SEEK_END);

lineStart($file);

//get the row
$row = fgetcsv($file);
if (!empty($row)) {
    $code = $row[0];
    $link = $row[2];
} else {
    $code = "Out of codes please contact admin";
    $link = ""; 
}

if (!empty($file)) {
    ftruncate($file, lineStart($file));
}

fclose($file);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/main.css">
        <title>MPI lite download link</title>
      </head>

<body>
<h1>MPI lite</h1>
<p>Copy this unique one time use code to redeem the MPIlite app on the AppStore:</p>

<h3><?php echo $code ?></h3>

<p>Or <a href=<?php echo $link ?> target="_blank"> click this link</a> on your iPhone</p>


<p><a href="mailto:changeMe@meijer.com?subject=MPI lite download link&body=Click this link on your iPhone: <?php echo $link ?>">Send email to yourself with this information</a></p>

<p> <strong>Meijer Team Members:</strong> Meijer employees must only use the mPI Lite app during work hours and adhere to all policies</p>
<p><strong>Meijer Vendors:</strong> Vendors will use their login credentials for <a href= "https://vendornet.meijer.com/" target="_blank"> VendorNet</a> to access mPI Lite. Please see your account broker for details on how to obtain VendorNet login credentials. Vendors will be limited to access product information only for the products they service</p>

</body>
</html>
