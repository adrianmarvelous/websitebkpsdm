<?php
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Daftar Hadir</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
  .card-title {
    font-size: 2rem;
    font-weight: bold;
    color: #007bff; /* Change to your desired color */
  }
  .card-subtitle {
    font-size: 1.5rem;
    font-weight: normal;
    color: #6c757d; /* Change to your desired color */
  }
  .btn-primary {
    background-color: #007bff;
    border: none;
  }
  .btn-primary:hover {
    background-color: #0056b3;
  }
  .form-group label {
    font-size: 1.2rem;
    font-weight: bold;
  }
  body {
    background-color: #f8f9fa; /* Light grey background */
  }
  .card {
    box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Add shadow for better aesthetics */
  }
</style>
</head>
<body>

  <datalist id="master_data">
    <?php
    $query_master = $db->prepare("SELECT * FROM daftar_master_pengarahan_walikota");
    $query_master->execute();
    while ($data_query_master = $query_master->fetch(PDO::FETCH_ASSOC)) {
      $nip = $data_query_master['nip'];
      $nama = $data_query_master['nama'];
      ?>
      <option value="<?= $nip ?>"><?= $nama ?></option>
      <?php
    }
    ?>
  </datalist>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card mt-5">
          <div class="card-body">
            <table>
              <tr>
                <td align="left"><img src="logo_pemkot.png" style="max-width: 100px; height: auto;"></td>
              </tr>
            </table>
            <h2 class="card-title text-center">
              DAFTAR HADIR
            </h2>
            <h5 class="card-subtitle text-center">
              (PENGARAHAN WALIKOTA)
            </h5>
            <form method="post" action="proses_insert_absen.php">
              <div class="form-group">
                <br>
                <label for="nip">NIP</label>
                <input list="master_data" name="nip" id="nip" class="form-control" required="" autocomplete="off">
              </div>
              <button type="submit" class="btn btn-primary btn-block">Absen</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
