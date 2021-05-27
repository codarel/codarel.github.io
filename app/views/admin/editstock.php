<div class="container p-5">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-12">
            <h2 class="my-3">Form Tambah Data Stok Barang</h2>
            <div class="row">
                <div class="col-lg-12">
                    <?php Flasher::flash(); ?>
                </div>
            </div>
            <form action="<?= BASEURL; ?>admin/updatestock/<?= $data['stock']['id']; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="product_id" class="col-sm-2 col-form-label">SKU Produk</label>
                    <div class="col-sm-10">
                        <select id="product_id" class="form-control" name="product_id">
                            <?php foreach ($data['products'] as $product) : ?>
                                <option <?= ($data['stock']['product_id'] == $product['id']) ? 'selected' : ''; ?> value="<?= $product['id']; ?>"><?= $product['sku']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="size" class="col-sm-2 col-form-label">Size</label>
                    <div class="col-sm-10">
                        <select id="size" class="form-control" name="size">
                            <option <?= ($data['stock']['size'] == 'SM') ? 'selected' : ''; ?> value="SM">SM</option>
                            <option <?= ($data['stock']['size'] == 'S') ? 'selected' : ''; ?> value="S">S</option>
                            <option <?= ($data['stock']['size'] == 'M') ? 'selected' : ''; ?> value="M">M</option>
                            <option <?= ($data['stock']['size'] == 'L') ? 'selected' : ''; ?> value="L">L</option>
                            <option <?= ($data['stock']['size'] == 'XL') ? 'selected' : ''; ?> value="XL">XL</option>
                            <option <?= ($data['stock']['size'] == 'XXL') ? 'selected' : ''; ?> value="XXL">XXL</option>
                            <option <?= ($data['stock']['size'] == 'XXXL') ? 'selected' : ''; ?> value="XXXL">XXXL</option>
                            <option <?= ($data['stock']['size'] == 'One Size') ? 'selected' : ''; ?> value="One Size">One Size</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                    <div class="col-sm-10">
                        <input type="number" name="quantity" id="quantity" class="form-control" value="<?= $data['stock']['quantity']; ?>">
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