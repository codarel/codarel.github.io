<div class="container p-5">
    <h1>Selamat Datang</h1>
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
</div>