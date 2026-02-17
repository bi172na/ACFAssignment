<?php
$bg       = get_field('hero_background');
$logo     = get_field('hero_logo');
$tagline  = get_field('hero_tagline');
$heading  = get_field('hero_heading');
?>

<section class="hero-section"
    style="background-image: url('<?php echo esc_url($bg['url'] ?? ''); ?>');">

   
    <div class="hero-content container">

        <?php if ($tagline) : ?>
            <p class="hero-tagline">
                <?php echo esc_html($tagline); ?>
            </p>
        <?php endif; ?>

        <?php if ($heading) : ?>
            <h1 class="hero-title">
                <?php echo nl2br(esc_html($heading)); ?>
            </h1>
        <?php endif; ?>

    </div>


</section>
