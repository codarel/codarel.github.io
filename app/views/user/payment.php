<div class="container p-4">
    <div class="row">
        <div class="col-12">
            <h2 class="my-3">Form Konfirmasi Pembayaran</h2>
            <div class="row">
                <div class="col-lg-12">
                    <?php Flasher::flash(); ?>
                </div>
            </div>
            <form action="<?= BASEURL; ?>user/savepayment" method="post" enctype="multipart/form-data">
                <div class="form-group row mb-2">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="orderid" class="col-sm-2 col-form-label">Order Id</label>
                    <div class="col-sm-10">
                        <select id="orderid" class="form-control" name="orderid">
                            <?php foreach ($data['orders'] as $order) : ?>
                                <option value="<?= $order['id']; ?>"><?= $order['id']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="sender" class="col-sm-2 col-form-label">Nama Pengirim</label>
                    <div class="col-sm-10">
                        <input type="text" name="sender" id="sender" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="amount" class="col-sm-2 col-form-label">Jumlah Transfer</label>
                    <div class="col-sm-10">
                        <input type="number" name="amount" id="amount" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="payment_image" class="col-sm-2 col-form-label">Upload bukti pembayaran</label>
                    <div class="col-sm-10">
                        <div class="custom-file">
                            <input type="file" class="form-control" id="payment_image" aria-describedby="inputGroupFileAddon03" aria-label="Upload" name="payment_image">
                            <div id="list_file"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Konfirmasi Pembayaran</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>