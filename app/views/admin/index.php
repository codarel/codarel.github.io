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
                            <?php if ($order['order_status'] == 3) : ?>
                                <button type="button" class="btn bg-success text-white disabled"><i class="fas fa-check"></i></button>
                            <?php elseif ($order['order_status'] == 2) : ?>
                                <form action="<?= BASEURL; ?>admin/updateorder/<?= $order['id']; ?>" method="post" class="d-inline">
                                    <input type="hidden" name="_method" value="UPDATE">
                                    <input type="hidden" name="orderstatus" value="3">
                                    <button class="btn bg-danger text-white" onclick="return confirm('apakah anda yakin?');"><i class="fas fa-minus"></i></button>
                                </form>
                            <?php else : ?>
                                <button type="button" class="btn bg-secondary text-white disabled"><i class="fas fa-minus"></i></button>
                            <?php endif; ?>
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
                        <td>
                            <?php if ($payment['confirm'] == 1) : ?>
                                <button type="button" class="btn bg-success text-white disabled"><i class="fas fa-check"></i></button>
                            <?php else : ?>
                                <form action="<?= BASEURL; ?>admin/confirm/<?= $payment['id']; ?>" method="post" class="d-inline">
                                    <input type="hidden" name="_method" value="UPDATE">
                                    <input type="hidden" name="confirm" value="1">
                                    <input type="hidden" name="orderid" value="<?= $payment['order_id']; ?>">
                                    <button class="btn bg-danger text-white" onclick="return confirm('apakah anda yakin?');"><i class="fas fa-minus"></i></button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>