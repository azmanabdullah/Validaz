<?php
  require_once "clasess/Validasi.php";
  $validasi = new Validasi;

  
 
  

  if(isset($_POST['btn']))
  {
    // var_dump(is_numeric($_POST['angka']));
    // die();
    // $validasi->setPesan('wajib|true','harus diisi');
    // var_dump($_FILES['dokumen']);
    // die();
    $validasi->init(array(
      'username' => array(
          'wajib' => true,
      ),
      'dokumen' => array(
        'fileFormat' => 'docx|pdf',
        'fileSize' => 100000,
        'wajib' => true
      ),
      'email' => array(
        'wajib' => true,
        'format' => 'email',
        
      ),
      'hp' => array(
        'min' => 8,
        'angka' => true,
      )
      ));


      
      if($validasi->hasErrors())
      {
        $errors = $validasi->getErrors();
      }else{
        echo "gak ada error";
      }

      
  }




?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Hello, world!</title>
   
  </head>
  <body>

    <div class="container">
      <div class="row mt-5">
      <div class="col-md-4 offset-md-4">
        <h1 class="text-center">Daftar</h1>
        <hr>
        <!-- <?php //if(isset($errors)): ?>
      <div class="alert alert-warning" role="alert">
          
        <?php //foreach($errors as $error): ?>
          <li> //<?php //echo $error ?> </li>
        <?php //endforeach; ?>
        
      </div> -->
      <?php //endif; ?>
        <form action="" method="post" enctype="multipart/form-data">
           <div class="form-group">
            <label for="">Username</label>
            <input type="text" class="form-control" name="username" value="<?php echo Validasi::inputValue('username') ?>">
            <?php if($validasi->openCheck('username')): ?>
            <div class="alert alert-warning" role="alert">
              <?php echo $validasi->open('username'); ?>
            </div>
            <?php endif; ?>
           </div>
           <div class="form-group">
            <label for="">Email</label>
            <input type="text" class="form-control" name="email">
            <?php if($validasi->openCheck('email')): ?>
            <div class="alert alert-warning" role="alert">
              <?php echo $validasi->open('email'); ?>
            </div>
            <?php endif; ?>
           </div>
           <div class="form-group">
            <label for="">Nomor telpon</label>
            <input type="text" class="form-control" name="hp">
            <?php if($validasi->openCheck('hp')): ?>
            <div class="alert alert-warning" role="alert">
              <?php echo $validasi->open('hp'); ?>
            </div>
            <?php endif; ?>
           </div>
           <div class="form-group">
            <label for="">Dokumen</label>
            <input type="file"  name="dokumen">
            <?php if($validasi->openCheck('dokumen')): ?>
            <div class="alert alert-warning" role="alert">
              <?php echo $validasi->open('dokumen'); ?>
            </div>
            <?php endif; ?>
           </div>
           <div class="form-group">
            <button class="btn btn-primary" type="submit" name="btn">Daftar</button> 
           </div>

        </form>
        </div>
      </div>
    </div> 





    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>