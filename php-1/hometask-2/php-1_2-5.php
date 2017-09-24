<?php
/*5. Посмотреть на встроенные функции PHP. Используя имеющийся HTML шаблон, вывести
текущий год в подвале при помощи встроенных функций PHP.*/

$h3 = "PHP 7.2.0 Release Candidate 2 Released";
$text = "The PHP development team announces the immediate availability of PHP 7.2.0 RC2. This release is the second Release Candidate for 7.2.0.";
$title = "PHP: Hypertext Preprocessor";
$year = date('Y'); // https://php.ru/manual/function.date.html
?>

<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.min.css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css' rel='stylesheet'
          type='text/css'>
</head>
<body>

<div class="top-bar">
    <div class="row">
        <div class="top-bar-left">
            <ul class="dropdown menu" data-dropdown-menu>
                <li class="menu-text">Yeti Store</li>
                <li class="has-submenu">
                    <a href="#">One</a>
                    <ul class="submenu menu vertical" data-submenu>
                        <li><a href="#">One</a></li>
                        <li><a href="#">Two</a></li>
                        <li><a href="#">Three</a></li>
                    </ul>
                </li>
                <li><a href="#">Two</a></li>
                <li><a href="#">Three</a></li>
            </ul>
        </div>
        <div class="top-bar-right">
            <ul class="menu">
                <li><input type="search" placeholder="Search"></li>
                <li>
                    <button type="button" class="button">Search</button>
                </li>
            </ul>
        </div>
    </div>
</div>

<br>

<div class="row columns">
    <nav aria-label="You are here:" role="navigation">
        <ul class="breadcrumbs">
            <li><a href="#">Home</a></li>
            <li><a href="#">Features</a></li>
            <li class="disabled">Gene Splicing</li>
            <li>
                <span class="show-for-sr">Current: </span> Cloning
            </li>
        </ul>
    </nav>
</div>
<div class="row">
    <div class="medium-6 columns">
        <img class="thumbnail" src="https://placehold.it/650x350">
        <div class="row small-up-4">
            <div class="column">
                <img class="thumbnail" src="https://placehold.it/250x200">
            </div>
            <div class="column">
                <img class="thumbnail" src="https://placehold.it/250x200">
            </div>
            <div class="column">
                <img class="thumbnail" src="https://placehold.it/250x200">
            </div>
            <div class="column">
                <img class="thumbnail" src="https://placehold.it/250x200">
            </div>
        </div>
    </div>
    <div class="medium-6 large-5 columns">
        <h3><?= $h3 ?></h3>
        <p><?= $text ?></p>
        <label>Size
            <select>
                <option value="husker">Small</option>
                <option value="starbuck">Medium</option>
                <option value="hotdog">Large</option>
                <option value="apollo">Yeti</option>
            </select>
        </label>
        <div class="row">
            <div class="small-3 columns">
                <label for="middle-label" class="middle">Quantity</label>
            </div>
            <div class="small-9 columns">
                <input type="text" id="middle-label" placeholder="One fish two fish">
            </div>
        </div>
        <a href="#" class="button large expanded">Buy Now</a>
        <div class="small secondary expanded button-group">
            <a class="button">Facebook</a>
            <a class="button">Twitter</a>
            <a class="button">Yo</a>
        </div>
    </div>
</div>
<div class="column row">
    <hr>
    <ul class="tabs" data-tabs id="example-tabs">
        <li class="tabs-title is-active"><a href="#panel1" aria-selected="true">Reviews</a></li>
        <li class="tabs-title"><a href="#panel2">Similar Products</a></li>
    </ul>
    <div class="tabs-content" data-tabs-content="example-tabs">
        <div class="tabs-panel is-active" id="panel1">
            <h4>Reviews</h4>
            <div class="media-object stack-for-small">
                <div class="media-object-section">
                    <img class="thumbnail" src="https://placehold.it/200x200">
                </div>
                <div class="media-object-section">
                    <h5>Mike Stevenson</h5>
                    <p>I'm going to improvise. Listen, there's something you should know about me... about inception. An
                        idea is like a virus, resilient, highly contagious. The smallest seed of an idea can grow. It
                        can grow to define or destroy you.</p>
                </div>
            </div>
            <div class="media-object stack-for-small">
                <div class="media-object-section">
                    <img class="thumbnail" src="https://placehold.it/200x200">
                </div>
                <div class="media-object-section">
                    <h5>Mike Stevenson</h5>
                    <p>I'm going to improvise. Listen, there's something you should know about me... about inception. An
                        idea is like a virus, resilient, highly contagious. The smallest seed of an idea can grow. It
                        can grow to define or destroy you</p>
                </div>
            </div>
            <div class="media-object stack-for-small">
                <div class="media-object-section">
                    <img class="thumbnail" src="https://placehold.it/200x200">
                </div>
                <div class="media-object-section">
                    <h5>Mike Stevenson</h5>
                    <p>I'm going to improvise. Listen, there's something you should know about me... about inception. An
                        idea is like a virus, resilient, highly contagious. The smallest seed of an idea can grow. It
                        can grow to define or destroy you</p>
                </div>
            </div>
            <label>
                My Review
                <textarea placeholder="None"></textarea>
            </label>
            <button class="button">Submit Review</button>
        </div>
        <div class="tabs-panel" id="panel2">
            <div class="row medium-up-3 large-up-5">
                <div class="column">
                    <img class="thumbnail" src="https://placehold.it/350x200">
                    <h5>Other Product
                        <small>$22</small>
                    </h5>
                    <p>In condimentum facilisis porta. Sed nec diam eu diam mattis viverra. Nulla fringilla, orci ac
                        euismod semper, magna diam.</p>
                    <a href="#" class="button hollow tiny expanded">Buy Now</a>
                </div>
                <div class="column">
                    <img class="thumbnail" src="https://placehold.it/350x200">
                    <h5>Other Product
                        <small>$22</small>
                    </h5>
                    <p>In condimentum facilisis porta. Sed nec diam eu diam mattis viverra. Nulla fringilla, orci ac
                        euismod semper, magna diam.</p>
                    <a href="#" class="button hollow tiny expanded">Buy Now</a>
                </div>
                <div class="column">
                    <img class="thumbnail" src="https://placehold.it/350x200">
                    <h5>Other Product
                        <small>$22</small>
                    </h5>
                    <p>In condimentum facilisis porta. Sed nec diam eu diam mattis viverra. Nulla fringilla, orci ac
                        euismod semper, magna diam.</p>
                    <a href="#" class="button hollow tiny expanded">Buy Now</a>
                </div>
                <div class="column">
                    <img class="thumbnail" src="https://placehold.it/350x200">
                    <h5>Other Product
                        <small>$22</small>
                    </h5>
                    <p>In condimentum facilisis porta. Sed nec diam eu diam mattis viverra. Nulla fringilla, orci ac
                        euismod semper, magna diam.</p>
                    <a href="#" class="button hollow tiny expanded">Buy Now</a>
                </div>
                <div class="column">
                    <img class="thumbnail" src="https://placehold.it/350x200">
                    <h5>Other Product
                        <small>$22</small>
                    </h5>
                    <p>In condimentum facilisis porta. Sed nec diam eu diam mattis viverra. Nulla fringilla, orci ac
                        euismod semper, magna diam.</p>
                    <a href="#" class="button hollow tiny expanded">Buy Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row column">
    <hr>
    <ul class="menu">
        <li>Yeti Store</li>
        <li><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
        <li class="float-right" style="margin-top:-32px;">Copyright &copy; <?= $year ?></li>
    </ul>
</div>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.js"></script>
<script>
    $(document).foundation();
</script>
</body>
</html>