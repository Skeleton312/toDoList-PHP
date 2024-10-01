<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Kegiatan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .checked {
        color: orange;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3>Tambah Kegiatan</h3>
            </div>
            <div class="card-body">
                <?php
                    $edit_mode = false;
                    $edit_id = -1;
                    if (isset($_GET['edit'])) {
                        $edit_id = $_GET['edit'];
                        $edit_mode = true;
                        $user = $_SESSION['user'][$edit_id];                        
                    }
                ?>
                <form method="post" action="tambahList.php">
                    <input type="hidden" name="edit_id" value="<?= $edit_mode ? $edit_id : -1; ?>">
                    <div class="form-group mb-3">
                        <label for="header" class="form-label">Judul Kegiatan</label>
                        <input type="text" class="form-control" id="header" name="header" placeholder="Masukkan judul kegiatan" value="<?= $edit_mode ? $user['header'] : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="comments" class="form-label">Deskripsi Kegiatan</label>
                        <textarea id="comments" class="form-control" name="komen" rows="4" placeholder="Masukkan deskripsi kegiatan">
                            <?php echo $edit_mode ? $user['komen'] : ''; ?>
                        </textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="tanggal" class="form-label">Deadline</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $edit_mode ? $user['tanggal'] : '' ?>" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="level" class="form-label">Level Prioritas</label>
                            <div>
                                <span id="star 0" class="fa fa-star" onclick='checkedStar(1)'></span>
                                <span id="star 1" class="fa fa-star" onclick='checkedStar(2)'></span>
                                <span id="star 2" class="fa fa-star" onclick='checkedStar(3)'></span>
                                <span id="star 3" class="fa fa-star" onclick='checkedStar(4)'></span>
                                <span id="star 4" class="fa fa-star" onclick='checkedStar(5)'></span>
                                <input id='level' name='level' value="<?= $edit_mode ? $user['level'] : '' ?>" type='hidden'/>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <a class="btn btn-danger" href='index.php'>Batal</a>
                        <input type="submit" class="btn btn-success" value="Tambah Kegiatan">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function checkedStar(nomor){
            for (let i = nomor; i < 5; i++) {
                let star = document.getElementById('star ' + i);
                star.classList.remove('checked');
            }
            for (let i = 0; i < nomor; i++){
                let star = document.getElementById('star '+i);
                star.classList.add('checked');
            }
            const level = document.getElementById('level');
            level.value = nomor;
        }
        const edit = document.getElementById('level');
        const val = parseInt(edit.value); 
        for (let i = 0; i < val; i++) {
            let star = document.getElementById('star ' + i); 
            if (star) {
                star.classList.add('checked'); 
            }
        }
    </script>
</body>
</html>
