<!DOCTYPE html>
<html class="html">

<head>
    <meta charset="UTF-8">
    <title><?php echo $title ?></title>
    <meta name="description" content="$description">

    <link rel="stylesheet" href="stylesheet.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdn.statically.io/gh/mdlavin/bootstrap-carousel-standalone/292657fcb31f3c21cc7147816ab66e2191466f67/css/bootstrap.css"
        crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-1.9.1.min.js" crossorigin="anonymous"></script>
    <script
        src="https://cdn.statically.io/gh/mdlavin/bootstrap-carousel-standalone/292657fcb31f3c21cc7147816ab66e2191466f67/js/bootstrap.js"
        crossorigin="anonymous"></script>
</head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-9GCJ94VJMX"></script>
<script>
window.dataLayer = window.dataLayer || [];

function gtag() {
    dataLayer.push(arguments);
}
gtag('js', new Date());

gtag('config', 'G-9GCJ94VJMX');
</script>


<body>
    <header>
        <a class="manage-link" href="index.php"><img id="logo" src="images/logo.png" alt="Busy Bee Snacks Logo"></a>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <div class="dropdown">
                    <li>Shop All</li>
                    <div class="dropdown-content">
                        <a class="manage-link" href="products.php">All Products</a>
                        <div class="line"></div>
                        <a href="category.php">All Categories</a>
                    </div>
                </div>
                <li><a href="specials.php">Specials</a></li>
                <li><a href="story.php">Our Story</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
        </nav>
        <div id="mini-nav">
            <ul>
                <form class="mini-nav-search" action="process-search.php" method="post">
                    <div class="dropdown">
                        <li><img src="images/icons/yellow-search-icon.png" alt=""></li>
                        <div class="dropdown-content">
                            <input required autocomplete="off" type="text" name="search" placeholder="search">
                            <button type="submit" class="search-btn">
                                Go
                            </button>
                        </div>
                    </div>
                </form>
                </li>
                <li><a href="account.php"><img src="images/icons/green-account-icon.png"></a></li>
                <li><a href="fav.php"><img src="images/icons/yellow-fave-icon.png"></a></li>
                <li><a href="cart.php"><img src="images/icons/green-cart-icon.png">
                        <?php if (isset($_SESSION['cart'])) : ?>
                        <div id="count">
                            <?php echo count($_SESSION['cart']) ?>
                        </div>
                        <?php endif; ?>
                    </a>
                </li>

            </ul>
        </div>
    </header>