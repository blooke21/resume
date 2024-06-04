<h1>Filter By</h1>
<!-- ------------------------------------------------- -->
<div class="<?php if ($filter == "default") { ?>
                    active
                <?php } else { ?>
                        non-active
                <?php } ?>
                " onClick="document.forms['filter-default'].submit();">
    <form name="filter-default" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h1>View All</h1>
        <input type="hidden" name="form" value="filter-default" />
    </form>
</div>
<!-- ------------------------------------------------- -->
<div class="<?php if ($filter == "bar") { ?>
                    active
                <?php } else { ?>
                        non-active
                <?php } ?>
                " onClick="document.forms['filter-bar'].submit();">
    <form name="filter-bar" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h1>Granola Barzzz</h1>
        <input type="hidden" name="form" value="filter-bar" />
    </form>
</div>
<!-- ------------------------------------------------- -->
<div class="<?php if ($filter == "honey") { ?>
                    active
                <?php } else { ?>
                        non-active
                <?php } ?>
                " onClick="document.forms['filter-honey'].submit();">
    <form name="filter-honey" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h1>Honey Products</h1>
        <input type="hidden" name="form" value="filter-honey" />
    </form>
</div>
<!-- ------------------------------------------------- -->
<div class="<?php if ($filter == "nut") { ?>
                    active
                <?php } else { ?>
                        non-active
                <?php } ?>
                " onClick="document.forms['filter-nut'].submit();">
    <form name="filter-nut" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h1>Packaged Nutzzz</h1>
        <input type="hidden" name="form" value="filter-nut" />
    </form>
</div>
<!-- ------------------------------------------------- -->
<div class="<?php if ($filter == "yogurt") { ?>
                    active
                <?php } else { ?>
                        non-active
                <?php } ?>
                " onClick="document.forms['filter-yogurt'].submit();">
    <form name="filter-yogurt" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h1>Yogurtzzz</h1>
        <input type="hidden" name="form" value="filter-yogurt" />
    </form>
</div>
<!-- ------------------------------------------------- -->
<div class="<?php if ($filter == "popsicle") { ?>
                    active
                <?php } else { ?>
                        non-active
                <?php } ?>
                " onClick="document.forms['filter-popsicle'].submit();">
    <form name="filter-popsicle" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h1>Popsiclezzz</h1>
        <input type="hidden" name="form" value="filter-popsicle" />
    </form>
</div>