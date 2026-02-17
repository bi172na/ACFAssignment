<section class="property-section">
    <div class="container">

        <div class="section-header">
            <h2 class="section-title">Current Listings</h2>

            <div class="property-tabs" role="tablist">

    <?php
    $terms = get_terms([
        'taxonomy'   => 'property_type',
        'hide_empty' => true,
		'orderby'    => 'slug',
		'order'      => 'ASC',
    ]);
	// Sort manually
usort($terms, function($a, $b) {
    if ($a->slug === 'residential') return -1;
    if ($b->slug === 'residential') return 1;
    return 0;
});
    foreach ($terms as $term) :

        $is_active = ($term->slug === 'residential');
    ?>

        <button
            class="tab-btn <?php echo $is_active ? 'active' : ''; ?>"
            role="tab"
            aria-selected="<?php echo $is_active ? 'true' : 'false'; ?>"
            aria-controls="property-panel"
            data-term="<?php echo esc_attr($term->slug); ?>"
        >
            <?php echo esc_html($term->name); ?>
        </button>

    <?php endforeach; ?>

</div>

        </div>

   <div id="property-panel"
     class="property-grid"
     role="tabpanel"
     aria-live="polite">
</div>

        <div class="load-more-wrapper">
            <button id="load-more" data-page="1">Load More</button>
        </div>

    </div>
</section>


