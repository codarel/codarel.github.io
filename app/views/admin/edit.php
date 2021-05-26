<div class="container p-5">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-12">
            <h2 class="my-3">Update Data Barang</h2>
            <div class="row">
                <div class="col-lg-12">
                    <?php Flasher::flash(); ?>
                </div>
            </div>
            <form action="<?= BASEURL; ?>admin/update/<?= $data['file']['id']; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group row mb-2">
                    <label for="sku" class="col-sm-2 col-form-label">SKU</label>
                    <div class="col-sm-10">
                        <input type="text" name="sku" id="sku" class="form-control" value="<?= $data['file']['sku']; ?>">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="name" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" id="name" class="form-control" value="<?= $data['file']['name']; ?>">
                    </div>
                </div>
                <div class=" form-group row mb-2">
                    <label for="editor" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="editor" name="description" placeholder="Masukkan sesuatu ... " required><?= $data['file']['description']; ?></textarea>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="regular" class="col-sm-2 col-form-label">Harga Normal</label>
                    <div class="col-sm-10">
                        <input type="number" name="regular" id="regular" class="form-control" value="<?= $data['file']['regular_price']; ?>">
                    </div>
                </div>
                <div class=" form-group row mb-2">
                    <label for="discount" class="col-sm-2 col-form-label">Harga Diskon</label>
                    <div class="col-sm-10">
                        <input type="number" name="discount" id="discount" class="form-control" value="<?= $data['file']['discount_price']; ?>">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="weight" class="col-sm-2 col-form-label">Berat (kg)</label>
                    <div class="col-sm-10">
                        <input type="number" step="0.01" name="weight" id="weight" class="form-control" value="<?= $data['file']['weight']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="category" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                        <select id="category" class="form-control" name="category">
                            <option <?= ($data['file']['category'] == 'Tshirt') ? 'selected' : ''; ?> value="Tshirt">Tshirt</option>
                            <option <?= ($data['file']['category'] == 'Shirt') ? 'selected' : ''; ?> value="Shirt">Shirt</option>
                            <option <?= ($data['file']['category'] == 'Jacket') ? 'selected' : ''; ?> value="Jacket">Jacket</option>
                            <option <?= ($data['file']['category'] == 'Pant') ? 'selected' : ''; ?> value="Pant">Pant</option>
                            <option <?= ($data['file']['category'] == 'Accessories') ? 'selected' : ''; ?> value="Accessories">Accessories</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label for="product_image" class="col-sm-2 col-form-label">Attachment File</label>
                    <div class="col-sm-10">
                        <div class="custom-file">
                            <input type="file" class="form-control" id="product_image" aria-describedby="inputGroupFileAddon03" aria-label="Upload" name="product_image[]" multiple>
                            <input type="hidden" name="old_image" value="<?= $data['file']['product_image']; ?>">
                            <div id="list_file"><?= $data['file']['product_image']; ?></div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Edit Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>