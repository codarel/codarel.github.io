<!-- Start Checkout -->
<section class="shop checkout section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="checkout-form">
                    <h2 class="mb-3">Tambah Data Alamat</h2>
                    <!-- Form -->
                    <form class="form" method="post" action="<?= BASEURL; ?>user/addAddress">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="fullname">Nama Lengkap<span>*</span></label>
                                    <input type="text" name="fullname" id="fullname" placeholder="" required="required">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="phone">Nomor Telepon<span>*</span></label>
                                    <input type="text" name="phone" id="phone" placeholder="" required="required">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="province">Provinsi<span>*</span></label>
                                    <input type="text" name="province" id="province" placeholder="" required="required">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="city">Kota/Kabupaten<span>*</span></label>
                                    <input type="text" name="city" id="city" placeholder="" required="required">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="districts">Kecamatan<span>*</span></label>
                                    <input type="text" name="districts" id="districts" placeholder="" required="required">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="postcode">Kode Pos<span>*</span></label>
                                    <input type="text" name="postcode" id="postcode" placeholder="" required="required">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="street_name">Nama Jalan<span>*</span></label>
                                    <input type="text" name="street_name" id="street_name" placeholder="Nama Jalan, Gedung, No.Rumah" required="required">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group create-account">
                                    <button type="submit" class="btn">Tambah Alamat</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--/ End Form -->
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Checkout -->