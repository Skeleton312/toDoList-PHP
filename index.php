<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container mt-3">
        <?php if (isset($_SESSION['message'])) : ?> 
            <div class="alert alert-<?= $_SESSION['type']; ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <?php
                unset($_SESSION['message']);
                unset($_SESSION['type']);
            ?>     
        <?php endif; ?>
        <nav class="navbar navbar-light bg-dark p-3">
            <div class="navbar-brand text-white tw-300" href="#">My ToDoList</div>
            <div class="btn-group gap-3">
            <?php if(isset($_SESSION['user'])) : ?>
                <a href="deleteAll.php" type="submit" name="hapus" class="btn btn-light">Hapus Semua</a>
            <?php else: ?>
                <a type="submit" name="hapus" class="btn btn-light">Hapus Semua</a>
            <?php endif; ?>
                <a href="FormTambahList.php" type="button" class="btn btn-primary">Tambah +</a>            
            </div>
        </nav>
        <div class="card" style="min-height: 500px;">
            <div class="card-header d-flex gap-3">
                <a id="belum" style="cursor: pointer; font-weight: 700;" onclick='clickBelum()'>Dikerjakan</a>
                <a id="wisbar" style="cursor: pointer;" onclick='clickWisbar()'>Selesai</a>
            </div>
            <div class="container">
            <ul class="list-group mt-2">
                <?php if(isset($_SESSION['user']) && !empty($_SESSION['user'])) : ?>
                    <?php foreach ($_SESSION['user'] as $index => $user) : ?>
                        <?php if($user['check'] === 'false'): ?>
                            <?php
                            $deadline = new Datetime($user['tanggal']);
                            $today = new Datetime();
                            $selisih = $today -> diff($deadline);
                            $hasil = $selisih->days;
                            $akhir = $hasil+1;
                            ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center garap">
                                    <div class="d-flex gap-3">
                                        <?php 
                                        echo '<a href="editTugas.php?checked=' . $index . '" class="btn btn-outline-success px-1 py-0"><i class="fa fa-check fa-2xs" style="color: white" aria-hidden="true"></i> </a>'
                                        ?>
                                        <a style="text-transform: capitalize; font-weight: 500;"><?php echo $user['header']?></a>
                                        <?php if ($deadline->format('Y-m-d') === $today->format('Y-m-d')): ?>
                                            <span class="text-warning rounded p-0.7" style="font-weight:300"><?php echo "tenggat hari ini" ?>
                                        <?php elseif($deadline < $today): ?>
                                            <span class="text-danger rounded p-0.7" style="font-weight:300"><?php echo "kadaluarsa" ?> 
                                        <?php elseif($selisih->days >= 0 && $selisih->days < 7): ?>
                                            <span class="text-success rounded p-0.7" style="font-weight:300"><?php echo $akhir. " hari lagi" ?>
                                        <?php elseif($selisih->days >= 7): ?>
                                            <span class="text-info rounded p-0.7" style="font-weight:300"><?php echo $user['tanggal'] ?>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <?php
                                            echo '<a href="deleteTugas.php?delete=' . $index . '" type="button" class="btn btn-outline-danger">
                                            <img style="width: 18px;" src="https://img.icons8.com/?size=100&id=99933&format=png&color=000000" />
                                          </a>'; 
                                            echo '<a href="FormTambahList.php?edit=' . $index . '" type="button" class="btn btn-outline-warning">
                                            <img style="width: 18px;" src="https://img.icons8.com/?size=100&id=8192&format=png&color=000000" />
                                          </a>';                                    
                                        ?>                    
                                        <button type="button" class="btn btn-info"><span class="fa fa-star" style="color: white"><?php echo $user['level']?></span></button>
                                    </div>
                                </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                    <?php foreach ($_SESSION['user'] as $index => $user) : ?>
                        <?php if($user['check'] === 'true'): ?>
                                    <li class="list-group-item d-none justify-content-between align-items-center selesai">
                                        <div class="d-flex gap-3">
                                            <a class="btn btn-success px-1 py-0"><i class="fa fa-check fa-2xs" style="color: white" aria-hidden="true"></i></a>
                                            <a style="text-transform: capitalize;"><?php echo $user['header']?></a>
                                            <span class="text-success rounded p-0.7">Selesai</span>
                                        </div>
                                        <div>
                                            <?php
                                                echo '<a href="deleteTugas.php?delete=' . $index . '" type="button" class="btn btn-outline-danger">
                                                <img style="width: 18px;" src="https://img.icons8.com/?size=100&id=99933&format=png&color=000000" />
                                            </a>'; 
                                            ?>
                                            <button type="button" class="btn btn-info"><span class="fa fa-star" style="color: white"><?php echo $user['level']?></span></button>
                                        </div>
                                    </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
            </ul>
                <?php else: ?>
                    <p class="text-center"> Belum ada Kegiatan<p>
                <?php endif; ?>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
   function clickBelum(){
    const belum = document.getElementById('belum');
    const wisbar = document.getElementById('wisbar');
    const garapItems = document.querySelectorAll('.garap'); 
    const selesaiItems = document.querySelectorAll('.selesai'); 
    
    belum.style.fontWeight = 700;
    wisbar.style.fontWeight = 300;
    garapItems.forEach(item => {
        item.classList.add('d-flex');
        item.classList.remove('d-none');
    });
    selesaiItems.forEach(item => {
        item.classList.remove('d-flex');
        item.classList.add('d-none');
    });
    }

    function clickWisbar(){
        const belum = document.getElementById('belum');
        const wisbar = document.getElementById('wisbar');
        const garapItems = document.querySelectorAll('.garap');
        const selesaiItems = document.querySelectorAll('.selesai'); 
        
        belum.style.fontWeight = 300;
        wisbar.style.fontWeight = 700;
        
        selesaiItems.forEach(item => {
            item.classList.remove('d-none');
            item.classList.add('d-flex');
        });
        
        garapItems.forEach(item => {
        item.classList.add('d-none');
        item.classList.remove('d-flex');
        });
    }    
</script>
</body>
</html>