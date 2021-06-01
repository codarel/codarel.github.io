<div class="container p-5">
    <h1>Selamat Datang</h1>
</div>
<div class="container border m-auto mb-4 p-3 rounded shadow">
    <!-- Page Heading -->
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

<div class="container border m-auto my-5 p-3 rounded shadow">
    <!-- Page Heading -->
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
                            <a class="btn bg-warning text-white" href="<?= BASEURL; ?>admin/edit/<?= $product['id']; ?>"><i class="fas fa-edit"></i></a>
                            <form action="<?= BASEURL; ?>admin/delete/<?= $product['id']; ?>" method="post" class="d-inline">
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn bg-danger" onclick="return confirm('apakah anda yakin?');"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="container border m-auto my-5 p-3 rounded shadow">
    <!-- Page Heading -->
    <div class="col-12">
        <h2>Tabel Stok Produk</h2>
        <div class="row">
            <div class="col-lg-12">
                <a href="<?= BASEURL; ?>admin/stock" class="btn bg-primary text-white mt-2">Tambah Data Stok Produk</a>
            </div>
        </div>
        <table class="table table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">SKU</th>
                    <th scope="col">Size</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $noproduct = 1; ?>
                <?php foreach ($data['stocks'] as $stock) : ?>
                    <tr>
                        <th scope="row"><?= $noproduct++; ?></th>
                        <td><?= $stock['sku']; ?></td>
                        <td><?= $stock['size']; ?></td>
                        <td><?= $stock['quantity']; ?></td>
                        <td>
                            <a class="btn bg-warning text-white" href="<?= BASEURL; ?>admin/editstock/<?= $stock['stock_id']; ?>"><i class="fas fa-edit"></i></a>
                            <form action="<?= BASEURL; ?>admin/deletestock/<?= $stock['stock_id']; ?>" method="post" class="d-inline">
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn bg-danger" onclick="return confirm('apakah anda yakin?');"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="container border m-auto my-5 p-3 rounded shadow">
    <!-- Page Heading -->
    <div class="col-12">
        <h2>Tabel Order</h2>
        <table class="table table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">User Id</th>
                    <th scope="col">Order Status</th>
                    <th scope="col">Shipping</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Address Id</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['orders'] as $order) : ?>
                    <tr>
                        <th scope="row"><?= $order['id']; ?></th>
                        <td><?= $order['user_id']; ?></td>
                        <td>
                            <?php if ($order['order_status'] == 1) {
                                echo "Belum Bayar";
                            } elseif ($order['order_status'] == 2) {
                                echo "Sedang Diproses";
                            } elseif ($order['order_status'] == 3) {
                                echo "Selesai";
                            };
                            ?>
                        </td>
                        <td><?= $order['shipping']; ?></td>
                        <td><?= $order['amount']; ?></td>
                        <td><?= $order['address_id']; ?></td>
                        <td>
                            <a class="btn bg-warning text-white" href="<?= BASEURL; ?>admin"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="container border m-auto my-5 p-3 rounded shadow">
    <!-- Page Heading -->
    <div class="col-12">
        <h2>Tabel Order Items</h2>
        <table class="table table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Order Id</th>
                    <th scope="col">Product Id</th>
                    <th scope="col">Size</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $noitem = 1; ?>
                <?php foreach ($data['items'] as $item) : ?>
                    <tr>
                        <th scope="row"><?= $noitem++; ?></th>
                        <td><?= $item['order_id']; ?></td>
                        <td><?= $item['product_id']; ?></td>
                        <td><?= $item['size']; ?></td>
                        <td><?= $item['quantity']; ?></td>
                        <td><?= $item['subtotal']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="container border m-auto my-5 p-3 rounded shadow">
    <!-- Page Heading -->
    <div class="col-12">
        <h2>Tabel Payment</h2>
        <table class="table table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Email</th>
                    <th scope="col">Order Id</th>
                    <th scope="col">Sender Name</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Payment Image</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Confirm</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $nopay = 1; ?>
                <?php foreach ($data['payment'] as $payment) : ?>
                    <tr>
                        <th scope="row"><?= $nopay++; ?></th>
                        <td><?= $payment['email']; ?></td>
                        <td><?= $payment['order_id']; ?></td>
                        <td><?= $payment['sender_name']; ?></td>
                        <td><?= $payment['amount']; ?></td>
                        <td><a href="<?= BASEURL; ?>img/<?= $payment['payment_image']; ?>"><?= $payment['payment_image']; ?></a></td>
                        <td><?= $payment['created_at']; ?></td>
                        <td><?= $payment['confirm']; ?></td>
                        <td>
                            <a class="btn bg-warning text-white" href="<?= BASEURL; ?>admin"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>