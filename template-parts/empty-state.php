<main class="main max-width">
    <header class="main-header relative">
        <button class="button-container button-56" onclick="history.back()">
            <div class="button-face green-button">
                <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/back.svg" alt="">
                <div class="button-glow"></div>
                <div class="button-hover"></div>
            </div>
        </button>
    </header>

    <article class="single single-blog about-page">
        <h1 class="main-title"><?php echo $args['title'] ?? "" ?></h1>
        <div class="blog-content">
            <p>
                راه‌کارهای زیر را امتحان کنید:
            </p>
            <ul>
                <li>از کادر جست‌وجوی بالای صفحه برای پیداکردن محتوای موردنظر استفاده کنید.</li>
                <li>به صفحۀ اصلی برگردید.</li>
            </ul>
            <a class="button-container button-48" href="<?php echo get_home_url(); ?>">
                <div class="button-face yellow-button text-button">
                    <div class="button-text">برو به صفحۀ اصلی</div>
                    <div class="button-glow"></div>
                    <div class="button-hover"></div>
                </div>
            </a>
        </div>
    </article>
</main>