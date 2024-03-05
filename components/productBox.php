<div class="product-box">

    <!--
      - PRODUCT MINIMAL
    -->

    <div class="product-minimal">

        <?php
        require_once "utils/loader.php";
        loadFashionCat();
        ?>

    </div>


    <!--
      - PRODUCT FEATURED
    -->

    <?php
    require_once "components/featuredProduct.php";
    ?>

    <!--
      - PRODUCT GRID
    -->

    <?php
    require_once "components/newProducts.php";
    ?>

</div>
