<div class="container my-4">
    <div class="row no-gutters">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <!-- Product Slider -->
            <div class="product-gallery">
                <div class="quickview-slider-active">
                    <?php
                    $explode = explode(',', $data['product']['product_image']);
                    for ($i = 0; $i < count($explode); $i++) : ?>
                        <?php if (str_word_count($explode[0]) != 0) : ?>
                            <div class="single-slider">
                                <img src="<?= BASEURL; ?>img/<?= $explode[$i]; ?>" alt="Product Image">
                            </div>
                        <?php endif; ?>
                    <?php endfor; ?>

                </div>
            </div>
            <!-- End Product slider -->
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="quickview-content">
                <h2><?= $data['product']['name']; ?></h2>
                <div class="quickview-ratting-review">
                    <div class="quickview-ratting-wrap">
                        <div class="quickview-ratting">
                            <i class="yellow fa fa-star"></i>
                            <i class="yellow fa fa-star"></i>
                            <i class="yellow fa fa-star"></i>
                            <i class="yellow fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <a href="#"> (1 customer review)</a>
                    </div>
                    <div class="quickview-stock">
                        <span><i class="fa fa-check-circle-o"></i> in stock</span>
                    </div>
                </div>
                <h3>
                    <?php if ($data['product']['discount_price'] == 0) : ?>
                        <?= $data['product']['regular_price']; ?>
                    <?php else : ?>
                        <?= $data['product']['discount_price']; ?>
                    <?php endif; ?>
                </h3>
                <?php
                $discount = $this->model("User_model")->getDiscount($data['product']['id']);
                if ($data['product']['discount_price'] != 0) : ?>
                    <span class="price-dec">
                        <?= $discount["percentage_discount('" . $data['product']['id'] . "')"]; ?>% OFF
                    </span>
                <?php endif; ?>
                <div class="quickview-peragraph">
                    <p><?= $data['product']['description']; ?></p>
                </div>
                <form action="<?= BASEURL; ?>user/addtocart/<?= $data['product']['id']; ?>" method="post" enctype="multipart/form-data">

                    <div class="size">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <h5 class="title">Size</h5>
                                <select name="size">
                                    <?php foreach ($data['stock'] as $stock) : ?>
                                        <option value="<?= $stock['size']; ?>"><?= $stock['size']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="quantity">
                        <!-- Input Order -->
                        <div class="input-group">
                            <div class="button minus">
                                <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                                    <i class="ti-minus"></i>
                                </button>
                            </div>
                            <input type="text" name="quant[1]" class="input-number" data-min="1" data-max="1000" value="1">
                            <div class="button plus">
                                <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
                                    <i class="ti-plus"></i>
                                </button>
                            </div>
                        </div>
                        <!--/ End Input Order -->
                    </div>
                    <div class="add-to-cart">
                        <button type="submit" class="btn">Add to cart</button>
                        <a href="#" class="btn min"><i class="ti-heart"></i></a>
                        <a href="#" class="btn min"><i class="fa fa-compress"></i></a>
                    </div>
                </form>
                <div class="default-social">
                    <h4 class="share-now">Share:</h4>
                    <ul>
                        <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a class="youtube" href="#"><i class="fa fa-pinterest-p"></i></a></li>
                        <li><a class="dribbble" href="#"><i class="fa fa-google-plus"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>