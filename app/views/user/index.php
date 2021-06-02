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

<div class="container rounded bg-white mt-5 mb-5 border shadow p-3">
    <div class="row">
        <div class="col-lg-12">
            <h3>Pesanan Saya</h3>
            <nav class="my-3">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-first-tab" data-bs-toggle="tab" data-bs-target="#nav-first" type="button" role="tab" aria-controls="nav-first" aria-selected="true">Belum Dibayar</button>
                    <button class="nav-link" id="nav-second-tab" data-bs-toggle="tab" data-bs-target="#nav-second" type="button" role="tab" aria-controls="nav-second" aria-selected="false">Sedang Diproses</button>
                    <button class="nav-link" id="nav-third-tab" data-bs-toggle="tab" data-bs-target="#nav-third" type="button" role="tab" aria-controls="nav-third" aria-selected="false">Selesai</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-first" role="tabpanel" aria-labelledby="nav-first-tab">
                    <?php foreach ($data['belum_bayar'] as $belum_bayar) : ?>
                        <div class="card my-3">
                            <div class="card-header">
                                <p class="">Order Id: <?= $belum_bayar['id']; ?></p>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Alamat</h5>
                                <?php foreach ($data['address'] as $address) : ?>
                                    <?php if ($address['id'] == $belum_bayar['address_id']) : ?>
                                        <p class="card-text">
                                            Nama: <?= $address['fullname']; ?>,Telepon: <?= $address['phone']; ?>, Alamat: <?= $address['street_name']; ?> <?= $address['city']; ?> - <?= $address['districts']; ?> <?= $address['province']; ?> ID <?= $address['postcode']; ?>
                                        </p>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                                <!-- Shopping Summery -->
                                <table class="table shopping-summery">
                                    <thead>
                                        <tr class="main-hading">
                                            <th>PRODUCT</th>
                                            <th>NAME</th>
                                            <th class="text-center">UNIT PRICE</th>
                                            <th class="text-center">SIZE</th>
                                            <th class="text-center">QUANTITY</th>
                                            <th class="text-center">TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data["detail"] as $detail) : ?>
                                            <?php if ($belum_bayar['id'] === $detail['id']) : ?>
                                                <tr>
                                                    <?php foreach ($data['product'] as $product) : ?>
                                                        <?php if ($detail['product_id'] === $product['id']) : ?>
                                                            <?php $explode = explode(',', $product['product_image']); ?>
                                                            <td class="image"><img src="<?= BASEURL; ?>img/<?= $explode[0]; ?>" alt="Product Image"></td>
                                                            <td class="product-des" data-title="Description">
                                                                <p class="product-name"><?= $product['name']; ?></p>
                                                                <p class="product-description"><?= $product['description']; ?></p>
                                                            </td>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                    <td class="price" data-title="Price"><span><?= $detail['subtotal'] / $detail['quantity']; ?></span></td>
                                                    <td class="size" data-title="Size"><span><?= $detail['size']; ?></span></td>
                                                    <td class="qty" data-title="Qty">
                                                        <span><?= $detail['quantity']; ?></span>
                                                    </td>
                                                    <td class="total-amount" data-title="Total"><span class="count"><?= $detail['subtotal']; ?></span></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <!--/ End Shopping Summery -->
                            </div>
                            <div class="card-footer text-muted d-flex flex-row bd-highlight justify-content-between">
                                <div class="bd-highlight">
                                    <p class="text-start">Ongkos Kirim: <?= $belum_bayar['shipping']; ?></p>
                                </div>
                                <div class="bd-highlight">
                                    <p class="text-end">Total Pesanan: <?= $belum_bayar['amount']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="tab-pane fade" id="nav-second" role="tabpanel" aria-labelledby="nav-second-tab">
                    <?php foreach ($data['proses'] as $proses) : ?>
                        <div class="card my-3">
                            <div class="card-header">
                                <p class="">Order Id: <?= $proses['id']; ?></p>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Alamat</h5>
                                <?php foreach ($data['address'] as $address) : ?>
                                    <?php if ($address['id'] == $proses['address_id']) : ?>
                                        <p class="card-text">
                                            Nama: <?= $address['fullname']; ?>,Telepon: <?= $address['phone']; ?>, Alamat: <?= $address['street_name']; ?> <?= $address['city']; ?> - <?= $address['districts']; ?> <?= $address['province']; ?> ID <?= $address['postcode']; ?>
                                        </p>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                                <!-- Shopping Summery -->
                                <table class="table shopping-summery">
                                    <thead>
                                        <tr class="main-hading">
                                            <th>PRODUCT</th>
                                            <th>NAME</th>
                                            <th class="text-center">UNIT PRICE</th>
                                            <th class="text-center">SIZE</th>
                                            <th class="text-center">QUANTITY</th>
                                            <th class="text-center">TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data["detail"] as $detail) : ?>
                                            <?php if ($proses['id'] === $detail['id']) : ?>
                                                <tr>
                                                    <?php foreach ($data['product'] as $product) : ?>
                                                        <?php if ($detail['product_id'] === $product['id']) : ?>
                                                            <?php $explode = explode(',', $product['product_image']); ?>
                                                            <td class="image"><img src="<?= BASEURL; ?>img/<?= $explode[0]; ?>" alt="Product Image"></td>
                                                            <td class="product-des" data-title="Description">
                                                                <p class="product-name"><?= $product['name']; ?></p>
                                                                <p class="product-description"><?= $product['description']; ?></p>
                                                            </td>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                    <td class="price" data-title="Price"><span><?= $detail['subtotal'] / $detail['quantity']; ?></span></td>
                                                    <td class="size" data-title="Size"><span><?= $detail['size']; ?></span></td>
                                                    <td class="qty" data-title="Qty">
                                                        <span><?= $detail['quantity']; ?></span>
                                                    </td>
                                                    <td class="total-amount" data-title="Total"><span class="count"><?= $detail['subtotal']; ?></span></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <!--/ End Shopping Summery -->
                            </div>
                            <div class="card-footer text-muted d-flex flex-row bd-highlight justify-content-between">
                                <div class="bd-highlight">
                                    <p class="text-start">Ongkos Kirim: <?= $proses['shipping']; ?></p>
                                </div>
                                <div class="bd-highlight">
                                    <p class="text-end">Total Pesanan: <?= $proses['amount']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="tab-pane fade" id="nav-third" role="tabpanel" aria-labelledby="nav-third-tab">
                    <?php foreach ($data['selesai'] as $selesai) : ?>
                        <div class="card my-3">
                            <div class="card-header">
                                <p class="">Order Id: <?= $selesai['id']; ?></p>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Alamat</h5>
                                <?php foreach ($data['address'] as $address) : ?>
                                    <?php if ($address['id'] == $selesai['address_id']) : ?>
                                        <p class="card-text">
                                            Nama: <?= $address['fullname']; ?>,Telepon: <?= $address['phone']; ?>, Alamat: <?= $address['street_name']; ?> <?= $address['city']; ?> - <?= $address['districts']; ?> <?= $address['province']; ?> ID <?= $address['postcode']; ?>
                                        </p>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                                <!-- Shopping Summery -->
                                <table class="table shopping-summery">
                                    <thead>
                                        <tr class="main-hading">
                                            <th>PRODUCT</th>
                                            <th>NAME</th>
                                            <th class="text-center">UNIT PRICE</th>
                                            <th class="text-center">SIZE</th>
                                            <th class="text-center">QUANTITY</th>
                                            <th class="text-center">TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data["detail"] as $detail) : ?>
                                            <?php if ($selesai['id'] === $detail['id']) : ?>
                                                <tr>
                                                    <?php foreach ($data['product'] as $product) : ?>
                                                        <?php if ($detail['product_id'] === $product['id']) : ?>
                                                            <?php $explode = explode(',', $product['product_image']); ?>
                                                            <td class="image"><img src="<?= BASEURL; ?>img/<?= $explode[0]; ?>" alt="Product Image"></td>
                                                            <td class="product-des" data-title="Description">
                                                                <p class="product-name"><?= $product['name']; ?></p>
                                                                <p class="product-desc"><?= $product['description']; ?></p>
                                                            </td>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                    <td class="price" data-title="Price"><span><?= $detail['subtotal'] / $detail['quantity']; ?></span></td>
                                                    <td class="size" data-title="Size"><span><?= $detail['size']; ?></span></td>
                                                    <td class="qty" data-title="Qty">
                                                        <span><?= $detail['quantity']; ?></span>
                                                    </td>
                                                    <td class="total-amount" data-title="Total"><span class="count"><?= $detail['subtotal']; ?></span></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <!--/ End Shopping Summery -->
                            </div>
                            <div class="card-footer text-muted d-flex flex-row bd-highlight justify-content-between">
                                <div class="bd-highlight">
                                    <p class="text-start">Ongkos Kirim: <?= $selesai['shipping']; ?></p>
                                </div>
                                <div class="bd-highlight">
                                    <p class="text-end">Total Pesanan: <?= $selesai['amount']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>