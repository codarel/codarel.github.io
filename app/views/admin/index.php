<h1>Selamat Datang</h1>
<div class="container p-5">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-12">
            <h2 class="my-3">Form Tambah Data Barang</h2>
            <form action="<?= BASEURL; ?>admin/save" method="post" enctype="multipart/form-data">
                <div class="form-group row mb-2">
                    <label for="notulen" class="col-sm-2 col-form-label">Notulen</label>
                    <div class="col-sm-10">
                        <input type="text" name="notulen" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                        <input type="date" name="tanggal" class="form-control">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="jam_mulai" class="col-sm-2 col-form-label">Jam Mulai</label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control" id="jam_mulai" name="jam_mulai">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="jam_selesai" class="col-sm-2 col-form-label">Jam Selesai</label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control" id="jam_selesai" name="jam_selesai">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="tempat" class="col-sm-2 col-form-label">Tempat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="tempat" name="tempat">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="agenda_rapat" class="col-sm-2 col-form-label">Agenda Rapat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="agenda_rapat" name="agenda_rapat">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="peserta_rapat" class="col-sm-2 col-form-label">Peserta Rapat</label>
                    <div class="col-sm-10">
                        <select id="peserta" class="form-control" name="peserta[]" multiple="multiple">
                            <option value="#" selected>Pilih nama</option>
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
                    <label for="hasil_rapat" class="col-sm-2 col-form-label">Hasil Diskusi dan Keputusan Rapat</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="editor" name="hasil_rapat" placeholder="Masukkan sesuatu ... "></textarea>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="attachment_file" class="col-sm-2 col-form-label">Attachment File</label>
                    <div class="col-sm-10">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="attachment_file" name="attachment_file[]" multiple>
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