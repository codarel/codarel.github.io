<!-- Start Checkout -->
<section class="shop checkout section">
    <div class="container">
        <form action="<?= BASEURL; ?>user/addorder" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="checkout-form">
                        <h2>Pilih Alamat</h2>
                        <a href="<?= BASEURL; ?>user/address" class="btn bg-primary text-white my-2">Tambah Alamat</a>
                        <?php foreach ($data['address'] as $address) : ?>
                            <div class="card card-header text-sm my-3 font-monospace p-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="address" id="address<?= $address['id']; ?>" value="<?= $address['id']; ?>" required>
                                    <label class="form-check-label" for="address<?= $address['id']; ?>">
                                        Nama: <?= $address['fullname']; ?>,Telepon: <?= $address['phone']; ?>, Alamat: <?= $address['street_name']; ?> <?= $address['city']; ?> - <?= $address['districts']; ?> <?= $address['province']; ?> ID <?= $address['postcode']; ?>
                                    </label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="order-details">
                        <!-- Order Widget -->
                        <div class="single-widget">
                            <h2>CART TOTALS</h2>
                            <div class="content">
                                <ul>
                                    <li>Sub Total<span><?= array_sum($_POST['count']); ?></span></li>
                                    <li>(+) Shipping<span>12000</span></li>
                                    <li class="last">Total<span><?= array_sum($_POST['count']) + 12000; ?></span></li>
                                </ul>
                            </div>
                        </div>
                        <!--/ End Order Widget -->
                        <!-- Order Widget -->
                        <div class="single-widget">
                            <h2>Payments</h2>
                            <div class="content">
                                <div class="checkbox">
                                    <label class="checkbox-inline checked" for="1"><input name="updates" id="1" type="checkbox" disabled> Direct Bank Transfer</label>
                                    <p>Lakukan pembayaran Anda ke 0841494945 (BNI) atas nama Mochamad Nurul Huda. Gunakan Order Id sebagai referensi pembayaran. Pesananmu tidak akan dikirim sebelum menyelesaikan pembayaran</p>
                                </div>
                            </div>
                        </div>
                        <!--/ End Order Widget -->

                        <?php for ($i = 0; $i < $data['count']; $i++) : ?>
                            <input type="hidden" name="quantity[]" value="<?= $data['post']['quantity'][$i]; ?>">
                            <input type="hidden" name="size[]" value="<?= $data['post']['size'][$i]; ?>">
                            <input type="hidden" name="price[]" value="<?= $data['post']['price'][$i]; ?>">
                            <input type="hidden" name="product_id[]" value="<?= $data['post']['product_id'][$i]; ?>">
                            <input type="hidden" name="subtotal[]" value="<?= $data['post']['count'][$i]; ?>">
                        <?php endfor; ?>
                        <input type="hidden" name="shipping" value="12000">
                        <input type="hidden" name="amount" value="<?= array_sum($_POST['count']) + 12000; ?>">
                        <!-- Button Widget -->
                        <div class="single-widget get-button">
                            <div class="content">
                                <div class="button">
                                    <button type="submit" class="btn">proceed to checkout</button>
                                </div>
                            </div>
                        </div>
                        <!--/ End Button Widget -->
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!--/ End Checkout -->

<!-- Start Shop Services Area  -->
<section class="shop-services section home">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-rocket"></i>
                    <h4>Free shiping</h4>
                    <p>Orders over $100</p>
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-reload"></i>
                    <h4>Free Return</h4>
                    <p>Within 30 days returns</p>
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-lock"></i>
                    <h4>Sucure Payment</h4>
                    <p>100% secure payment</p>
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-tag"></i>
                    <h4>Best Peice</h4>
                    <p>Guaranteed price</p>
                </div>
                <!-- End Single Service -->
            </div>
        </div>
    </div>
</section>
<!-- End Shop Services -->

<!-- Start Shop Newsletter  -->
<section class="shop-newsletter section">
    <div class="container">
        <div class="inner-top">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-12">
                    <!-- Start Newsletter Inner -->
                    <div class="inner">
                        <h4>Newsletter</h4>
                        <p> Subscribe to our newsletter and get <span>10%</span> off your first purchase</p>
                        <form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
                            <input name="EMAIL" placeholder="Your email address" required="" type="email">
                            <button class="btn">Subscribe</button>
                        </form>
                    </div>
                    <!-- End Newsletter Inner -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Shop Newsletter -->