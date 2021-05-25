<div class="div">
    <div class="container">
        <h1>Selamat Datang</h1>
        <!-- Page Heading -->
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-12">
                        <?php Flasher::flash(); ?>
                    </div>
                </div>
                <h2>Tabel Users</h2>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Role</th>
                            <th scope="col">Email</th>
                            <th scope="col">Username</th>
                            <th scope="col">User Profile</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($data['users'] as $user) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= ($user['role_id'] == 1) ? "admin" : "member"; ?></td>
                                <td><?= $user['email']; ?></td>
                                <td><?= $user['username']; ?></td>
                                <td><img src="<?= BASEURL; ?>img/<?= $user['user_image']; ?>" alt="<?= $user['user_image']; ?>" width="100px"></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-12">
                        <?php Flasher::flash(); ?>
                    </div>
                </div>
                <h2>Tabel Produk</h2>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Role</th>
                            <th scope="col">Email</th>
                            <th scope="col">Username</th>
                            <th scope="col">User Profile</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($data['users'] as $user) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= ($user['role_id'] == 1) ? "admin" : "member"; ?></td>
                                <td><?= $user['email']; ?></td>
                                <td><?= $user['username']; ?></td>
                                <td><img src="<?= BASEURL; ?>img/<?= $user['user_image']; ?>" alt="<?= $user['user_image']; ?>" width="100px"></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>