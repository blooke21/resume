<h1>Sort By</h1>
<!-- ------------------------------------------------- -->
<div class="<?php if ($sort == "default") { ?>
                    active
                <?php } else { ?>
                        non-active
                <?php } ?>
                " onClick="document.forms['sort-default'].submit();">
    <form name="sort-default" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h1>Default Order</h1>
        <input type="hidden" name="form" value="sort-default" />
    </form>
</div>
<!-- ------------------------------------------------- -->
<div class="<?php if ($sort == "priceLowToHigh") { ?>
                    active
                <?php } else { ?>
                    non-active
                <?php } ?>" onClick="document.forms['sort-priceLowToHigh'].submit();">
    <form name="sort-priceLowToHigh" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h1>Price: Low -> High</h1>
        <input type="hidden" name="form" value="sort-priceLowToHigh" />
    </form>
</div>
<!-- ------------------------------------------------- -->
<div class="<?php if ($sort == "priceHighToLow") { ?>
                    active
                <?php } else { ?>
                    non-active
                <?php } ?>" onClick="document.forms['sort-priceHighToLow'].submit();">
    <form name="sort-priceHighToLow" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h1>Price: High -> Low</h1>
        <input type="hidden" name="form" value="sort-priceHighToLow" />
    </form>
</div>
<!-- ------------------------------------------------- -->
<div class="<?php if ($sort == "sizeLowToHigh") { ?>
                    active
                <?php } else { ?>
                    non-active
                <?php } ?>" onClick="document.forms['sort-sizeLowToHigh'].submit();">
    <form name="sort-sizeLowToHigh" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h1>Size: Low -> High</h1>
        <input type="hidden" name="form" value="sort-sizeLowToHigh" />
    </form>
</div>
<!-- ------------------------------------------------- -->
<div class="<?php if ($sort == "sizeHighToLow") { ?>
                    active
                <?php } else { ?>
                    non-active
                <?php } ?>" onClick="document.forms['sort-sizeHighToLow'].submit();">
    <form name="sort-sizeHighToLow" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h1>Size: High -> Low</h1>
        <input type="hidden" name="form" value="sort-sizeHighToLow" />
    </form>
</div>