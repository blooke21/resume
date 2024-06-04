<?php
function redirect()
{
?>
<script>
window.location = "admin-view.php";
</script>
<?php
}

if (isset($_POST['form'])) {
    switch ($_POST['form']) {
        case "product":
            setcookie("table", "product");
            setcookie("inner", "inner join category on product.category_id = category.category_id");
            setcookie("inner-target", "category_id");
            setcookie("inner-replacer", "category_name");
            setcookie("edit", true);
            redirect();
            break;
        case "customer":
            setcookie("table", "customer");
            setcookie("inner", "");
            setcookie("edit", true);
            redirect();
            break;
        case "review":
            setcookie("table", "review");
            setcookie("inner", "inner join product on review.product_id = review.product_id");
            setcookie("inner-target", "product_id");
            setcookie("inner-replacer", "name");
            setcookie("edit", true);
            redirect();
            break;
        case "special":
            setcookie("table", "special");
            setcookie("inner", "inner join product on special.product_id = special.product_id");
            setcookie("inner-target", "product_id");
            setcookie("inner-replacer", "name");
            setcookie("edit", true);
            redirect();
            break;
        case "payment":
            setcookie("table", "payment_method");
            setcookie("inner", "");
            setcookie("edit", "AA");
            redirect();
            break;
    }
}
?>
<article class="admin-header">
    <h1>Admin Area</h1>
    <div class="admin-box" onClick="document.forms['admin-product'].submit();">
        <form name="admin-product" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="hidden" name="form" value="product" />
            <p>View/Edit Products</p>
        </form>
    </div>
    <div class="admin-box" onClick="document.forms['admin-customer'].submit();">
        <form name="admin-customer" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="hidden" name="form" value="customer" />
            <p>View/Edit Customers</p>
        </form>
    </div>
    <div class="admin-box" onClick="document.forms['admin-review'].submit();">
        <form name="admin-review" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="hidden" name="form" value="review" />
            <input type="hidden" name="type" value="review">
            <p>View/Edit Reviews</p>
        </form>
    </div>
    <div class="admin-box" onClick="document.forms['admin-special'].submit();">
        <form name="admin-special" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="hidden" name="form" value="special" />
            <input type="hidden" name="type" value="special">
            <p>View/Edit Specials</p>
        </form>
    </div>
    <div class="admin-box last" onClick="document.forms['admin-payment'].submit();">
        <form name="admin-payment" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="hidden" name="form" value="payment" />
            <input type="hidden" name="type" value="payment">
            <p>View Payment Method</p>
        </form>
    </div>

</article>