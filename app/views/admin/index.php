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
                <table class="table table-striped table-hover table-responsive">
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
                        <?php $nouser = 1; ?>
                        <?php foreach ($data['users'] as $user) : ?>
                            <tr>
                                <th scope="row"><?= $nouser++; ?></th>
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
                <div class="row">
                    <div class="col-lg-12">
                        <a href="<?= BASEURL; ?>admin/create" class="btn bg-primary text-white mt-2">Tambah Data Produk</a>
                    </div>
                </div>
                <table class="table table-striped table-hover table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">SKU</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Product Image</th>
                            <th scope="col">Regular Price</th>
                            <th scope="col">Discount Price</th>
                            <th scope="col">Weight</th>
                            <th scope="col">Category</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $noproduct = 1; ?>
                        <?php foreach ($data['products'] as $product) : ?>
                            <tr>
                                <th scope="row"><?= $noproduct++; ?></th>
                                <td><?= $product['sku']; ?></td>
                                <td><?= $product['name']; ?></td>
                                <td><?= $product['description']; ?></td>
                                <td><?php
                                    $explode = explode(',', $product['product_image']);
                                    for ($i = 0; $i < count($explode); $i++) : ?>
                                        <?php if (str_word_count($explode[$i]) != 0) : ?>
                                            <img src="<?= BASEURL; ?>img/<?= $explode[$i]; ?>" alt="<?= $explode[$i]; ?>" width="100px">
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </td>
                                <td><?= $product['regular_price']; ?></td>
                                <td><?= $product['discount_price']; ?></td>
                                <td><?= $product['weight']; ?></td>
                                <td><?= $product['category']; ?></td>
                                <td>
                                    <button class="btn bg-warning text-white"><i class="fas fa-edit"></i></button>
                                    <form action="<?= BASEURL; ?>admin/delete/<?= $product['id']; ?>" method="post" class="d-inline">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn bg-danger col-lg-12 mb-2" onclick="return confirm('apakah anda yakin?');"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>