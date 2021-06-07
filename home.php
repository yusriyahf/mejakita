<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="fontawesome-free/css/all.min.css">

  <!-- My CSS -->
  <link rel="shortcut icon" href="Mejakita/img/favicon.png">
  <link rel="stylesheet" href="stylehome.css">
  <title>MejaKita</title>

  <!-- fullcalendar -->
  <link rel="stylesheet" href="dist/fullcalendar.min.css?v=?<?php echo time(); ?>">
  <script src="jquery.min.js?v=?<?php echo time(); ?>"></script>
  <script src="moment.js?v=?<?php echo time(); ?>"></script>
  <script src="dist/fullcalendar.min.js?v=?<?php echo time(); ?>"></script>

  <script>
    // Persiapan Jquery
    $(document).ready(function() {
      var calendar = $('#calendar').fullCalendar({
        editable: true,
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,agendaWeek,agendaDay'
        },
        events: 'agenda.php',
        selectable: true,
        selectHelper: true,
        select: function(start, end, allDay) {

          var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
          var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");


          // lempar data
          $.ajax({
            url: "agenda.php",
            type: "POST",
            data: {
              startdate: start,
              enddate: end
            },
            success: function() {
              // set value
              document.getElementById('startdate').value = start;
              document.getElementById('enddate').value = end

            }
          });
        }
      });
    });
  </script>

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="Mejakita/img/logo.png" alt="" height="25px" class="d-inline-block align-text-top">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">Mata Pelajaran</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Fitur Belajar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Jadwal Belajar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Tentang</a>
          </li>
        </ul>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
          <button class="btn btn-primary btn-left" type="button">Masuk</button>
          <button class="btn btn-primary btn-right" type="button">Daftar</button>
        </div>
      </div>
    </div>
  </nav>

  <div class="header">
    <div class="jumbotron"></div>
    <div class="container">
      <class class="d-flex">
        <input class="form-control mx-auto" type="search" placeholder="Cari.." aria-label="Search">
      </class>
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam deleniti, quidem modi officiis ipsam vel at repudiandae dolor animi libero.</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- Content -->
  <div class="card-content">
    <div class="container">
      <div class="filter">
        <div class="row">
          <div class="col-lg-12">
            <button class="btn btn-primary btn-card" type="button">Hari Ini</button>
            <button class="btn btn-primary btn-card" type="button">Besok</button>
            <button class="btn btn-primary btn-card" type="button">Minggu Depan</button>
            <button class="btn btn-primary btn-card" type="button">Bulan Depan</button>
            <button class="btn btn-primary btn-card" type="button">Tahun Depan</button>
            <button class="btn btn-primary btn-card" type="button">Selesai</button>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="ilustration" alt="">
          <img src="Mejakita/img/emptybox.png">
          <h5>OOPS JADWAL BELAJARMU MASIH KOSONG BURUAN DI ISI</h5>

          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6" onclick="openModal()">
            <button class="btn" type="button">
              <i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">

      <div class="modal-body">
        <span class="close" onclick="closeModal()">&times;</span>
        <h1>Tambah Kegiatan</h1>

        <form method="POST" action="agenda.php">
          <div style="font-weight: bold;">
            Nama
          </div>
          <input type="text" name="eventname" placeholder="Masukkan nama kegiatan">

          <div style="font-weight: bold;">
            Keterangan
          </div>
          <input type="text" name="keterangan" placeholder="Masukkan keterangan kegiatan">

          <input type="hidden" id="startdate" name="startdate">

          <input type="hidden" id="enddate" name="enddate">

          <div id="calendar"></div>

          <div class="bton">
            <button class="btn btn-primary btn-modal" name="addevent" type="submit">Submit</button>

          </div>
        </form>
      </div>

    </div>
  </div>

  <script>
    function openModal() {
      document.getElementById("myModal").style.display = "block";
    }

    function closeModal() {
      document.getElementById("myModal").style.display = "none";
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

</body>

</html>