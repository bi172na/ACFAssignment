<?php
$logo        = get_field('footer_logo', 'option');
$desc        = get_field('footer_description', 'option');
$menu        = get_field('footer_menu', 'option');
$address     = get_field('footer_address', 'option');
$phone       = get_field('footer_phone', 'option');
$email       = get_field('footer_email', 'option');
$copyright   = get_field('copyright_text', 'option');
?>

<footer class="site-footer">

    <div class="container footer-top">

        <!-- Column 1 -->
        <div class="footer-col footer-brand">

            <?php if ($logo) : ?>
                <img src="<?php echo esc_url($logo['url']); ?>" 
                     alt="<?php echo esc_attr($logo['alt']); ?>">
            <?php endif; ?>

            <?php if ($desc) : ?>
                <p><?php echo esc_html($desc); ?></p>
            <?php endif; ?>

        </div>

        <!-- Column 2 -->
        <div class="footer-col footer-links">

            <h4>Quick Links</h4>

            <?php if ($menu) : ?>
                <ul>
                    <?php foreach ($menu as $item) : ?>
                        <li>
                            <a href="<?php echo esc_url($item['menu_link']['url']); ?>">
                                <?php echo esc_html($item['menu_label']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

        </div>

        <!-- Column 3 -->
        <div class="footer-col footer-contact">

            <h4>Contact</h4>

            <ul>
                <?php if ($address) : ?>
                    <li><?php echo esc_html($address); ?></li>
                <?php endif; ?>

                <?php if ($phone) : ?>
                    <li>
                        <a href="tel:<?php echo esc_attr($phone); ?>">
                            <?php echo esc_html($phone); ?>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ($email) : ?>
                    <li>
                        <a href="mailto:<?php echo esc_attr($email); ?>">
                            <?php echo esc_html($email); ?>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>

        </div>

    </div>

    <div class="footer-bottom">
        <div class="container">
            <p>
                <?php echo esc_html($copyright ?: '© ' . date('Y') . ' All Rights Reserved'); ?>
            </p>
        </div>
    </div>

</footer>

<?php wp_footer(); ?>
</body>
</html>
