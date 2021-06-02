<!-- Start Product Area -->
<div class="product-area section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>All Item</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product-info">
                    <div class="tab-content" id="myTabContent">
                        <!-- Start Single Tab -->
                        <div class="tab-pane fade show active" role="tabpanel">
                            <div class="tab-single">
                                <div class="row">
                                    <?php foreach ($data['products'] as $product) : ?>
                                        <?php $discount = $this->model("User_model")->getDiscount($product['id']); ?>
                                        <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                                            <div class="single-product">
                                                <div class="product-img">
                                                    <a href="<?= BASEURL; ?>shop/product/<?= $product['sku']; ?>">
                                                        <?php
                                                        $explode = explode(',', $product['product_image']);
                                                        ?>
                                                        <?php if (str_word_count($explode[0]) != 0) : ?>
                                                            <img class="default-img" src="<?= BASEURL; ?>img/<?= $explode[0]; ?>" alt="product_image">
                                                        <?php endif; ?>
                                                        <img class="hover-img default-img" src="<?= (isset($explode[1])) ? BASEURL . 'img/' . $explode[1] : BASEURL . 'img/' . '550x750.png' ?>" alt="#">
                                                        <?php if ($product['discount_price'] != 0) : ?>
                                                            <span class="price-dec">
                                                                <?= $discount["percentage_discount('" . $product['id'] . "')"]; ?>% OFF
                                                            </span>
                                                        <?php endif; ?>
                                                    </a>
                                                    <div class="button-head">
                                                        <div class="product-action-2">
                                                            <a title="Add to cart" href="<?= BASEURL; ?>shop/product/<?= $product['sku']; ?>">View Product</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h3><a href="<?= BASEURL; ?>shop/product/<?= $product['sku']; ?>"><?= $product['name']; ?></a></h3>
                                                    <div class="product-price">
                                                        <span>
                                                            <?php if ($product['discount_price'] == 0) : ?>
                                                                <?= $product['regular_price']; ?>
                                                            <?php else : ?>
                                                                <?= $product['discount_price']; ?>
                                                            <?php endif; ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <!--/ End Single Tab -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Product Area -->