<div class="container rounded bg-white mt-5 mb-5 border shadow">
    <div class="row">
        <div class="col-lg-12">
            <?php Flasher::flash(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" width="150px" src="<?= BASEURL; ?>img/<?= $data['user']['user_image']; ?>" alt="User Profile"><span class="font-weight-bold"><?= $data['user']['username']; ?></span><span class="text-black-50"><?= $data['user']['email']; ?></span><span> </span>
            </div>
        </div>
        <div class="col-md-5 border-right">
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
                        <button class="btn profile-button" type="submit">Ubah Data</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="text-right">Alamat Saya</h5>
                </div>
                <a href="<?= BASEURL; ?>user/address" class="btn bg-primary text-white">Tambah Alamat</a>
                <?php foreach ($data['address'] as $address) : ?>
                    <div class="card card-header text-sm my-3 font-monospace p-0">
                        <table class="table table-borderless table-sm">
                            <tr>
                                <td class="text-end">
                                    <p>Nama</p>
                                </td>
                                <td class="fw-bold"><?= $address['fullname']; ?></td>
                            </tr>
                            <tr>
                                <td class="text-end">
                                    <p>Telepon</p>
                                </td>
                                <td><?= $address['phone']; ?></td>
                            </tr>
                            <tr>
                                <td class="text-end">
                                    <p>Alamat</p>
                                </td>
                                <td class="fw-normal">
                                    <p class="text-reset"><?= $address['street_name']; ?></p>
                                    <p class="text-reset"><?= $address['city']; ?> - <?= $address['districts']; ?></p>
                                    <p class="text-reset"><?= $address['province']; ?></p>
                                    <p class="text-reset">ID <?= $address['postcode']; ?></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<div class="container rounded bg-white mt-5 mb-5 border shadow">
    <div class="row">
        <div class="col-lg-12">
            <h3>Pesanan Saya</h3>
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Home</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">...</div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
            </div>
        </div>
    </div>
</div>