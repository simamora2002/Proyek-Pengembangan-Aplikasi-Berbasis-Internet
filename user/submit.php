<?php

if(isset($_POST['submit'])){
        $nisn = $_POST['nisn'];
        $nik = $_POST['nik'];
        $namalengkap = $_POST['namalengkap'];
        $kelamin = $_POST['jeniskelamin'];
        $userid = $_POST['id'];

        $tempatlahir = $_POST['tempatlahir'];
        $tgllahir = $_POST['tgllahir'];
        $alamat = $_POST['alamat'];
        $provinsi = $_POST['provinsi'];
        $kota = $_POST['kota'];
        $kecamatan = $_POST['kecamatan'];
        $kelurahan = $_POST['kelurahan'];

        $agama = $_POST['agama'];
        $telepon = $_POST['telepon'];

        $ayahnik = $_POST['ayahnik'];
        $ayahnama = $_POST['ayahnama'];
        $ayahpendidikan = $_POST['ayahpendidikan'];
        $ayahpekerjaan = $_POST['ayahpekerjaan'];
        $ayahpenghasilan = $_POST['ayahpenghasilan'];
        $ayahtelepon = $_POST['ayahtelepon'];

        $ibunik = $_POST['ibunik'];
        $ibunama = $_POST['ibunama'];
        $ibupendidikan = $_POST['ibupendidikan'];
        $ibupekerjaan = $_POST['ibupekerjaan'];
        $ibupenghasilan = $_POST['ibupenghasilan'];
        $ibutelepon = $_POST['ibutelepon'];

        $walinik = $_POST['walinik'];
        $walinama = $_POST['walinama'];
        $walipekerjaan = $_POST['walipekerjaan'];
        $walitelepon = $_POST['walitelepon'];

        $sekolahnpsn = $_POST['sekolahnpsn'];
        $sekolahnama = $_POST['sekolahnama'];
        $foto = 'foto_'.$nisn;
        $ijazahdepan = 'ijazahdpn_'.$nisn;
        $ijazahbelakang = 'ijazahblkg_'.$nisn;

        //perihal gambar
        $nama_file_foto = $_FILES['foto']['name'];
        $nama_file_idpn = $_FILES['scanijazahdepan']['name'];
        $nama_file_iblkg = $_FILES['scanijazahbelakang']['name'];
        $ext1 = pathinfo($nama_file_foto, PATHINFO_EXTENSION);
        $ext2 = pathinfo($nama_file_idpn, PATHINFO_EXTENSION);
        $ext3 = pathinfo($nama_file_iblkg, PATHINFO_EXTENSION);
        $ukuran_file_foto = $_FILES['foto']['size'];
        $ukuran_file_idpn = $_FILES['scanijazahdepan']['size'];
        $ukuran_file_iblkg = $_FILES['scanijazahbelakang']['size'];
        $ukurantotal = $ukuran_file_foto + $ukuran_file_idpn + $ukuran_file_iblkg;
        $tipe_file = $_FILES['foto']['type'];
        $tmp_file = $_FILES['foto']['tmp_name'];
        $tmp_file2 = $_FILES['scanijazahdepan']['tmp_name'];
        $tmp_file3 = $_FILES['scanijazahbelakang']['tmp_name'];
        $path_foto = "images/foto/".$foto.'.'.$ext1;
        $path_idpn = "images/ijazahdepan/".$ijazahdepan.'.'.$ext2;
        $path_iblkg = "images/ijazahbelakang/".$ijazahbelakang.'.'.$ext3;


        if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){
          if($ukurantotal <= 1600000){ 
            $upload = move_uploaded_file($tmp_file,$path_foto);
            $upload2 = move_uploaded_file($tmp_file2,$path_idpn);
            $upload3 = move_uploaded_file($tmp_file3,$path_iblkg);
            if($upload&&$upload2&&$upload3){ 
            
                $submitdata = mysqli_query($conn,"insert into userdata (userid, nisn, nik, namalengkap, jeniskelamin, tempatlahir, tanggallahir, alamat, provinsi, kabupaten, kecamatan, kelurahan, agama, telepon, ayahnik, ayahnama, ayahpendidikan, ayahpekerjaan, ayahpenghasilan, ayahtelepon, ibunik, ibunama, ibupendidikan, ibupekerjaan, ibupenghasilan, ibutelepon, walinik, walinama, walipekerjaan, walitelepon, sekolahnpsn, sekolahnama, foto, scanijazahdepan, scanijazahbelakang) 
                values('$userid','$nisn','$nik','$namalengkap','$kelamin','$tempatlahir','$tgllahir','$alamat','$provinsi','$kota','$kecamatan','$kelurahan','$agama','$telepon','$ayahnik','$ayahnama','$ayahpendidikan','$ayahpekerjaan','$ayahpenghasilan','$ayahtelepon','$ibunik','$ibunama','$ibupendidikan','$ibupekerjaan','$ibupenghasilan','$ibutelepon','$walinik','$walinama','$walipekerjaan','$walitelepon','$sekolahnpsn','$sekolahnama','$path_foto','$path_idpn','$path_iblkg')");
                
              if($submitdata){ 

                //berhasil bikin
                echo " <div class='alert alert-success'>
                        Berhasil submit data.
                    </div>
                    <meta http-equiv='refresh' content='2; url= daftar.php'/>  ";  

              }else{

                echo "<div class='alert alert-warning'>
                        Gagal submit data. Silakan coba lagi nanti.
                    </div>
                    <meta http-equiv='refresh' content='3; url= daftar.php'/> ";
                }
            }else{
              // Jika gambar gagal diupload, Lakukan :
              echo "Sorry, there's a problem while uploading the file.";
              echo "<br><meta http-equiv='refresh' content='5; URL=daftar.php'> You will be redirected to the form in 5 seconds";
            }
          }else{
            // Jika ukuran file lebih dari 1MB, lakukan :
            echo "Sorry, the file size is not allowed to more than 1,5mb";
            echo "<br><meta http-equiv='refresh' content='5; URL=daftar.php'> You will be redirected to the form in 5 seconds";
          }
        }else{
          // Jika tipe file yang diupload bukan JPG / JPEG / PNG, lakukan :
          echo "Sorry, the image format should be JPG/PNG.";
          echo "<br><meta http-equiv='refresh' content='5; URL=daftar.php'> You will be redirected to the form in 5 seconds";
        }

    };




    //kalau update
    if(isset($_POST['update'])){
      $id = $_POST['id'];
      $alamat = $_POST['alamat'];
      $telepon = $_POST['telepon'];
      $ayahpendidikan = $_POST['ayahpendidikan'];
        $ayahpekerjaan = $_POST['ayahpekerjaan'];
        $ayahpenghasilan = $_POST['ayahpenghasilan'];
        $ayahtelepon = $_POST['ayahtelepon'];
      $ibupendidikan = $_POST['ibupendidikan'];
        $ibupekerjaan = $_POST['ibupekerjaan'];
        $ibupenghasilan = $_POST['ibupenghasilan'];
        $ibutelepon = $_POST['ibutelepon'];

      $walinik = $_POST['walinik'];
        $walinama = $_POST['walinama'];
        $walipekerjaan = $_POST['walipekerjaan'];
        $walitelepon = $_POST['walitelepon'];

    $update = mysqli_query($conn,"update userdata
    set alamat='$alamat', telepon='$telepon', ayahpendidikan='$ayahpendidikan', ayahpenghasilan='$ayahpenghasilan', ayahpekerjaan='$ayahpekerjaan',
    ayahtelepon='$ayahtelepon', ibupendidikan='$ibupendidikan', ibupekerjaan='$ibupekerjaan', ibupenghasilan='$ibupenghasilan', ibutelepon='$ibutelepon',
    walinik='$walinik', walinama='$walinama', walipekerjaan='$walipekerjaan', walitelepon='$walitelepon' where userid='$id'");

    if($update){ 

      //berhasil bikin
      echo " <div class='alert alert-success'>
              Berhasil submit data.
          </div>
          <meta http-equiv='refresh' content='1; url= mydata.php'/>  ";  

    }else{

      echo "<div class='alert alert-warning'>
              Gagal submit data. Silakan coba lagi nanti.
          </div>
          <meta http-equiv='refresh' content='3; url= mydata.php'/> ";
      }

    };



    
//get timezone jkt
date_default_timezone_set("Asia/Bangkok");
$today = date("Y-m-d"); //now

    //kalau konfirmasi
    if(isset($_POST['ok'])){
      $id = $_POST['id'];
      $updateaja = mysqli_query($conn,"update userdata set status='Verified', tglkonfirmasi='$today' where userid='$id'");

      if($updateaja){
        //berhasil bikin
          echo " <div class='alert alert-success'>
          Berhasil submit data.
      </div>
      <meta http-equiv='refresh' content='1; url= mydata.php'/>  ";  
      } else {
        echo "<div class='alert alert-warning'>
              Gagal submit data. Silakan coba lagi nanti.
          </div>
          <meta http-equiv='refresh' content='3; url= mydata.php'/> ";
      }
    };

?>