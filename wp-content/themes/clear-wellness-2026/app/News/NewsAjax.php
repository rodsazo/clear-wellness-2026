<?php

namespace App\News;
class NewsAjax
{
    public function __construct ()
    {
        add_action('wp_ajax_news_load_more',        [ $this, 'newsLoadMore' ]);
        add_action('wp_ajax_nopriv_news_load_more', [ $this, 'newsLoadMore' ]);
    }

    public function newsLoadMore() : void
    {
        check_ajax_referer( 'news_load_more', 'nonce' );

        $page    = max( 1, intval( $_POST['page'] ?? 1 ) );
        $exclude = intval( $_POST['exclude'] ?? 0 );

        $query = new \WP_Query([
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => 12,
            'paged'          => $page,
            'post__not_in'   => $exclude ? [ $exclude ] : [],
            'orderby'        => 'date',
            'order'          => 'DESC',
        ]);

        ob_start();
        while ( $query->have_posts() ) : $query->the_post();
            get_template_part('parts/blocks/news/list-item', '', ['cats' => $cats, 'date' => $date] );
        endwhile;
        wp_reset_postdata();
        $html = ob_get_clean();

        wp_send_json_success([
            'html'     => $html,
            'has_more' => $page < $query->max_num_pages,
        ]);
    }

}
