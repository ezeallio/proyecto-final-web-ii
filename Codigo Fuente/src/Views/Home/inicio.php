<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/lib/OwlCarousel2-2.2.1/animate.css"; ?>">
<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/lib/OwlCarousel2-2.2.1/owl.carousel.css"; ?>">
<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/lib/OwlCarousel2-2.2.1/owl.theme.default.css"; ?>">

<!-- Slider -->

    <div class="main_slider"  style="background-image:url('<?php echo getBaseAddress() . "Webroot/img/home/bannerAlt.jpg" ?>')">
        <div class="container fill_height">
            <div class="row align-items-center fill_height">
                <div class="col">
                    <div class="main_slider_content">
                        <h6>Encuentra todos los productos</h6>
                        <h1>Aqui en ShopLine</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Banner de productos -->

    <div class="banner mt-4">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div class="section_title new_arrivals_title">
                        <h2>Categorias mas populares</h2>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-4 border">
                    <div class="banner_item align-items-center" style="background-image:url('<?php echo getBaseAddress() . "Webroot/img/home/tecnologia.jpg" ?>')"">
                        <div class="banner_category">
                            <a href="#">Tecnologias</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 border">
                    <div class="banner_item align-items-center" style="background-image:url('<?php echo getBaseAddress() . "Webroot/img/home/calzado.jpg" ?>')">
                        <div class="banner_category">
                            <a href="#">Calzados</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 border">
                    <div class="banner_item align-items-center" style="background-image:url('<?php echo getBaseAddress() . "Webroot/img/home/indumentaria.png" ?>')">
                        <div class="banner_category">
                            <a href="#">Indumentarias</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mas vendiditos -->

    <div class="best_sellers">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div class="section_title new_arrivals_title">
                        <h2>Productos mas Vendidos</h2>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col">
                    <div class="owl-carousel owl-theme product_slider">
                        <!-- Producto 1 -->
                        <div class="owl-item product_slider_item">
                            <div class="product-item">
                                <div class="product discount">
                                    <div class="product_image">
                                        <img src="<?php echo getBaseAddress() . "Webroot/img/home/product_1.png" ?>" alt="">
                                    </div>
                                    <div class="product_info">
                                        <h6 class="product_name"><a href="#">Buzo Bordo con capucha</a></h6>
                                        <div class="product_price">$520.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Producto 2 -->

                        <div class="owl-item product_slider_item">
                            <div class="product-item women">
                                <div class="product">
                                    <div class="product_image">
                                        <img src="<?php echo getBaseAddress() . "Webroot/img/home/product_2.png" ?>" alt="">
                                    </div>
                                    <div class="product_info">
                                        <h6 class="product_name"><a href="#">Samsung S8 Plus</a></h6>
                                        <div class="product_price">$50000.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Producto 3 -->

                        <div class="owl-item product_slider_item">
                            <div class="product-item women">
                                <div class="product">
                                    <div class="product_image">
                                        <img src="<?php echo getBaseAddress() . "Webroot/img/home/product_3.png" ?>" alt="">
                                    </div>
                                    <div class="product_info">
                                        <h6 class="product_name"><a href="#">Nike Airmax 97</a></h6>
                                        <div class="product_price">$2500.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Producto 4 -->

                        <div class="owl-item product_slider_item">
                            <div class="product-item accessories">
                                <div class="product">
                                    <div class="product_image">
                                        <img src="<?php echo getBaseAddress() . "Webroot/img/home/product_4.png" ?>" alt="">
                                    </div>
                                    <div class="product_info">
                                        <h6 class="product_name"><a href="#">Moto G5 Plus</a></h6>
                                        <div class="product_price">$6000.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Producto 5 -->

                        <div class="owl-item product_slider_item">
                            <div class="product-item women men">
                                <div class="product">
                                    <div class="product_image">
                                        <img src="<?php echo getBaseAddress() . "Webroot/img/home/product_5.png" ?>"s alt="">
                                    </div>
                                    <div class="product_info">
                                        <h6 class="product_name"><a href="#">Puma Active 600</a></h6>
                                        <div class="product_price">$1000.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Caracteristicas -->

    <div class="benefit">
        <div class="container">
            <div class="row benefit_row">
                <div class="col-lg-3 benefit_col">
                    <div class="benefit_item d-flex flex-row align-items-center">
                        <div class="benefit_icon"><i class="fa fa-2x  fa-truck" aria-hidden="true"></i></div>
                        <div class="benefit_content">
                            <h6>Envio Gratis</h6>
                            <p>Puede ser alterado por el producto</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 benefit_col">
                    <div class="benefit_item d-flex flex-row align-items-center">
                        <div class="benefit_icon"><i class="far fa-2x fa-money-bill-alt"></i></div>
                        <div class="benefit_content">
                            <h6>Metodos de pago</h6>
                            <p>Efectivo, Credito y Debito</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 benefit_col">
                    <div class="benefit_item d-flex flex-row align-items-center">
                        <div class="benefit_icon"><i class="fa fa-2x fa-undo" aria-hidden="true"></i></div>
                        <div class="benefit_content">
                            <h6>Regreso en 45 dias</h6>
                            <p>Asegurarnos la calidad de tu producto</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 benefit_col">
                    <div class="benefit_item d-flex flex-row align-items-center">
                        <div class="benefit_icon"><i class="fas fa-2x fa-user-clock"></i></div>
                        <div class="benefit_content">
                            <h6>Atencion al Cliente</h6>
                            <p>8AM - 09PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Neovedades -->

    <div class="newsletter">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="newsletter_text d-flex flex-column justify-content-center align-items-lg-start align-items-md-center text-center">
                        <h4>Novedades</h4>
                        <p>Subcribete para obtener todad nuestras novedades</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form action="post">
                        <div class="newsletter_form d-flex flex-md-row flex-column flex-xs-column align-items-center justify-content-lg-end justify-content-center">
                            <input id="newsletter_email" type="email" placeholder="pupe893@gmail.com" required="required" data-error="Valid email is required.">
                            <button id="newsletter_submit" type="submit" class="newsletter_submit_btn trans_300" value="Submit">Subcribite</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script src="<?php echo getBaseAddress() . "Webroot/lib/easing/easing.js"; ?>"></script>
<script src="<?php echo getBaseAddress() . "Webroot/lib/Isotope/isotope.pkgd.min.js"; ?>"></script>
<script src="<?php echo getBaseAddress() . "Webroot/lib/OwlCarousel2-2.2.1/owl.carousel.js"; ?>"></script>
