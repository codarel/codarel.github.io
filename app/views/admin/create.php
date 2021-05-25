<div class="container p-5">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-12">
            <h2 class="my-3">Form Tambah Data Barang</h2>
            <form action="<?= BASEURL; ?>admin/save" method="post" enctype="multipart/form-data">
                <div class="form-group row mb-2">
                    <label for="sku" class="col-sm-2 col-form-label">SKU</label>
                    <div class="col-sm-10">
                        <input type="text" name="sku" id="sku" class="form-control">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="name" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="editor" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="editor" name="description" placeholder="Masukkan sesuatu ... "></textarea>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="regular" class="col-sm-2 col-form-label">Harga Normal</label>
                    <div class="col-sm-10">
                        <input type="number" name="regular" id="regular" class="form-control">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="discount" class="col-sm-2 col-form-label">Harga Diskon</label>
                    <div class="col-sm-10">
                        <input type="number" name="discount" id="discount" class="form-control">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="weight" class="col-sm-2 col-form-label">Berat (kg)</label>
                    <div class="col-sm-10">
                        <input type="number" name="weight" id="weight" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="category" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                        <select id="category" class="form-control" name="category">
                            <option value="M. Iqbal Ardimansyah, S.T., M.Kom.">M. Iqbal Ardimansyah, S.T., M.Kom.</option>
                            <option value="Asyifa Imanda Septiana, S.Pd., M.Eng.">Asyifa Imanda Septiana, S.Pd., M.Eng.</option>
                            <option value="Dian Anggraini, S.ST., M.T.">Dian Anggraini, S.ST., M.T.</option>
                            <option value="Indira Syawanodya, M.Kom.">Indira Syawanodya, M.Kom.</option>
                            <option value="Hendriyana, S.T., M.Kom.">Hendriyana, S.T., M.Kom.</option>
                            <option value="Raditya Muhammad, S.T., M.T.">Raditya Muhammad, S.T., M.T.</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label for="attachment_file" class="col-sm-2 col-form-label">Attachment File</label>
                    <div class="col-sm-10">
                        <div class="custom-file">
                            <input type="file" class="form-control" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" aria-label="Upload">
                            <div id="list_file"></div>
                            <label class="custom-file-label" for="attachment_file">Pilih file..</label>
                        </div>
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