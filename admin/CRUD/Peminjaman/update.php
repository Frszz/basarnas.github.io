<?php
    require_once "../../../config/config.php";
    if(isset($_SESSION['Username'])) {
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Daftar Peminjaman Arsip | Arsip Nasional</title>

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
        
        <!-- Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

        <!-- CSS -->
        <link rel="stylesheet" href="../../CSS/peminjaman.css">

        <!-- Font -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    </head>
    <body>
        <!-- Start Sidebar -->
            <div class="menu-btn">
                <i class="fas fa-bars"></i>
            </div>
            <div class="side-bar">
                <header>
                    <div class="close-btn">

                    <i class="fas fa-times"></i>
                    </div>
                    <img src="../../../assets/img/anri.jpeg" alt="">
                        <h1>Arsip Nasional</h1>
                </header>
                <div class="menu">
                    <div class="item"><a href="../../Dashboard.php"><i class="bi bi-display"></i>Dashboard</a></div>
                    <div class="item"><a href="../../Arsip.php"><i class="bi bi-folder"></i>Data Arsip</a></div>
                    <div class="item"><a href="../../Peminjaman.php"><i class="bi bi-inboxes"></i></i>Daftar Pinjaman</a></div>
                    <div class="item">
                        <a class="sub-btn"><i class="bi bi-calendar3"></i></i>Publikasi<i class="fas fa-angle-right dropdown"></i></a>
                        <div class="sub-menu">
                            <a href="../../Akuntabilitas.php" class="sub-item"><i class="bi bi-keyboard"></i>Akuntabilitas</a>
                            <a href="../../Galeri.php" class="sub-item"><i class="bi bi-card-image"></i>Galeri</a>
                        </div>
                    </div>
                    <div class="item"><a href="../../Peraturan.php"><i class="bi bi-globe"></i></i>Peraturan</a></div>
                    <div class="item"><a href="../../../auth/logout.php"><i class="bi bi-power"></i></i>Logout</a></div>
                </div>
            </div>
        <!-- End Sidebar -->

        <!-- Start content -->
            <section class="main">
                <h1>Daftar Peminjaman</h1>
                <div class="content"> 
                    <?php
                        $id = @$_GET['id'];
                        $sql_pinjam = mysqli_query($con, "SELECT * FROM peminjaman WHERE ID = '$id'") or die (mysqli_error($con));
                        $data = mysqli_fetch_array($sql_pinjam);
                    ?>
                    <form action="proses.php" method="POST">
                        <div>
                            <label for="nama_peminjam">Nama Peminjam</label>
                            <input type="hidden" name="id" value="<?=$data['ID']?>">
                            <input type="text" id="nama_peminjam" name="nama_peminjam" value="<?=$data['nama_peminjam']?>" readonly>
                        </div>
                        <div>
                            <label for="email">E-mail</label>
                            <input type="email" id="email" name="email" value="<?=$data['email']?>" readonly>
                        </div>
                        <div>
                            <label for="no_hp">No. Hp</label>
                            <input type="text" id="no_hp" name="no_hp" value="<?=$data['no_hp']?>" readonly>
                        </div>
                        <div>
                            <label for="jenis_arsip">Jenis Arsip</label>
                            <input type="text" id="jenis_arsip" name="jenis_arsip" value="<?=$data['jenis_arsip']?>" readonly>
                        </div>
                        <div>
                            <label for="kode_arsip">Kode Arsip</label>
                            <input type="text" id="kode_arsip" name="kode_arsip" value="<?=$data['kode_arsip']?>" readonly>
                        </div>
                        <div>
                            <label for="jumlah">Jumlah</label>
                            <input type="number" id="jumlah" name="jumlah" value="<?=$data['jumlah']?>" readonly>
                        </div>
                        <div>
                            <label for="tgl_pinjam">Tanggal Pinjam</label>
                            <input type="date" id="tgl_pinjam" name="tgl_pinjam" value="<?=$data['tgl_pinjam']?>" readonly>
                        </div>
                        <div>
                            <label for="tgl_kembali">Tanggal Kembali</label>
                            <input type="date" id="tgl_kembali" name="tgl_kembali" value="<?=$data['tgl_kembali']?>" readonly>
                        </div>
                        <div>
                            <label for="status">Status</label>
                            <?php
                                echo "<select id=\"status\" name=\"status\">
                                    <option value=\"\" disabled selected style=\"display:none;\">Pilih</option>";
                                    $choose = mysqli_query($con, "SHOW COLUMNS FROM `peminjaman` WHERE `field` = 'status'");
                                    while($result = mysqli_fetch_row($choose)){
                                        foreach(explode("','",substr($result[1],6,-2)) as $option){
                                            echo "<option>".$option."</option>";
                                        }
                                    }
                                echo "</select>";
                            ?>
                        </div>
                        <div class="tmbl1">
                            <input type="submit" name="edit" value="Simpan">
                        </div>
                    </form>
                </div>
            </section>
        <!-- End Content -->

        <!-- Bootstrap -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

        <!-- Js -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>

        <!-- Reasponsive -->
        <script type="text/javascript">
            $(document).ready(function(){
                //jquery for toggle sub menus
                $('.sub-btn').click(function(){
                $(this).next('.sub-menu').slideToggle();
                $(this).find('.dropdown').toggleClass('rotate');
                });

                //jquery for expand and collapse the sidebar
                $('.menu-btn').click(function(){
                $('.side-bar').addClass('active');
                $('.menu-btn').css("visibility", "hidden");
                });

                $('.close-btn').click(function(){
                $('.side-bar').removeClass('active');
                $('.menu-btn').css("visibility", "visible");
                });
            });
        </script>
    </body>
</html>
<?php
    } else{
        echo "<script>window.location='../../../auth/login.php';</script>";
    }
?>