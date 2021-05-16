<div class="container border m-auto my-4 rounded shadow">
    <div class="row">
        <div class="col-12 p-4">
            <h3 class="mb-4">My Account</h3>
            <img class="img-thumbnail" src="<?= BASEURL; ?>img/<?= $data['user']['user_image']; ?>" alt="<?= $data['user']['user_image']; ?>"></img>
            <div class="form-group row my-3">
                <label for="nama_barang" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="<?= $data['user']['email']; ?>" autocomplete="off" disabled>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="nama_barang" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="<?= $data['user']['username']; ?>" autocomplete="off" disabled>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="nama_barang" class="col-sm-2 col-form-label">Fullname</label>
                <div class="col-sm-10">
                    <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="<?= $data['user']['fullname']; ?>" autocomplete="off" disabled>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="nama_barang" class="col-sm-2 col-form-label">Date of Birth</label>
                <div class="col-sm-10">
                    <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="<?= $data['user']['date_of_birth']; ?>" autocomplete="off" disabled>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="nama_barang" class="col-sm-2 col-form-label">Phone</label>
                <div class="col-sm-10">
                    <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="<?= $data['user']['phone']; ?>" autocomplete="off" disabled>
                </div>
            </div>
            <button class="btn rounded">Ubah Data</button>
        </div>
    </div>
</div>