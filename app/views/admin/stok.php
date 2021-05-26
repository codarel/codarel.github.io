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
            <form action="<?= BASEURL; ?>admin/savestok" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="product_id" class="col-sm-2 col-form-label">SKU Produk</label>
                    <div class="col-sm-10">
                        <select id="product_id" class="form-control" name="product_id">
                            <?php foreach ($data['products'] as $product) : ?>
                                <option value="<?= $product['id']; ?>"><?= $product['sku']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="size" class="col-sm-2 col-form-label">Size</label>
                    <div class="col-sm-10">
                        <select id="size" class="form-control" name="size">
                            <option value="SM">SM</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option>
                            <option value="XXXL">XXXL</option>
                            <option value="One Size">One Size</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                    <div class="col-sm-10">
                        <input type="number" name="quantity" id="quantity" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Tambah Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>