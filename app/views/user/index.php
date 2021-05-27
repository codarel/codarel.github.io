<div class="container rounded bg-white mt-5 mb-5 border shadow">
    <div class="row">
        <div class="col-lg-12">
            <?php Flasher::flash(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" width="150px" src="<?= BASEURL; ?>img/<?= $data['user']['user_image']; ?>" alt="User Profile"><span class="font-weight-bold"><?= $data['user']['username']; ?></span><span class="text-black-50"><?= $data['user']['email']; ?></span><span> </span>
            </div>
        </div>
        <div class="col-md-8 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">My Account</h4>
                </div>
                <form action="<?= BASEURL; ?>user/update/<?= $data['user']['id']; ?>" method="post" enctype="multipart/form-data">
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="labels" for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="email" class="form-control" value="<?= $data['user']['email']; ?>" autocomplete="off">
                        </div>
                        <div class="col-md-12">
                            <label class="labels" for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username" class="form-control" value="<?= $data['user']['username']; ?>" autocomplete="off">
                        </div>
                        <div class="col-md-12">
                            <label class="labels" for="fullname">Nama Lengkap</label>
                            <input type="text" class="form-control" name="fullname" id="fullname" class="form-control" value="<?= $data['user']['fullname']; ?>" autocomplete="off">
                        </div>
                        <div class="col-md-12">
                            <label class="labels" for="birth">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="birth" id="birth" class="form-control" value="<?= $data['user']['date_of_birth']; ?>">
                        </div>
                        <div class="col-md-12">
                            <label class="labels" for="phone">No Telepon</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="<?= $data['user']['phone']; ?>" autocomplete="off">
                        </div>
                        <div class="col-md-12">
                            <label class="labels" for="user_image">Foto Profil</label>
                            <input type="file" name="user_image" id="user_image" class="form-control">
                            <div class="list-file"><?= $data['user']['user_image']; ?></div>
                        </div>
                        <input type="hidden" name="old_image" id="old_image" value="<?= $data['user']['user_image']; ?>">
                    </div>
                    <div class="mt-5 text-center">
                        <button class="btn btn-primary profile-button" type="submit">Ubah Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>