<?php get_header(); ?>
<main class="container mx-auto px-4 py-8">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php if (is_front_page()) : ?>
            <h1 class="text-3xl font-bold"><?php bloginfo('name'); ?></h1>
        <?php else : ?>
            <h1 class="text-3xl font-bold"><?php the_title(); ?></h1>
        <?php endif; ?>
        <div class="content"><?php the_content(); ?></div>
    <?php endwhile; endif; ?>
</main>
<?php get_footer(); ?>