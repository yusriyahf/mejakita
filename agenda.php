<?php
include 'koneksi.php';

$json = array();
$show = mysqli_query($koneksi, "SELECT * FROM todo ORDER BY id");


if (isset($_POST['addevent'])) {
    $title = $_POST['eventname'];
    $keterangan = $_POST['keterangan'];
    $start_event = $_POST['startdate'];
    $end_event = $_POST['enddate'];
    $query = "INSERT INTO todo SET title='$title',keterangan='$keterangan',start_event='$start_event',end_event='$end_event'";
    mysqli_query($koneksi, $query);
    header("location:home.php");
}

while ($row = mysqli_fetch_assoc($show)) {
    if ($row['title'] == 'TRYOUT') {
        $json[] = array(
            'backgroundColor' => 'rgb(255, 0, 0)',
            'borderColor' => 'rgb(255, 0, 0)',
            'title' => $row['title'],
            'keterangan' => $row['keterangan'],
            'start' => $row['start_event'],
            'end' => $row['end_event'],
        );
    } else {
        $json[] = array(
            'title' => $row['title'],
            'keterangan' => $row['keterangan'],
            'start' => $row['start_event'],
            'end' => $row['end_event'],
        );
    }
}
echo json_encode($json);
