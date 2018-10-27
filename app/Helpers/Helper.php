<?php

namespace App\Helpers;

use App\Category;
use App\Comment;
use App\Post;
use App\User;

class Helper
{
    /**
     * Return user selected infos
     */
    public static function get_userinfo( $user_id )
    {
        if( empty( $user_id ) )
            return;

        $user_infos = User::where('id', $user_id)->first();

        if( $user_infos )
            return $user_infos;

        return false;
    }

    /**
     * Return user selected infos
     */
    public static function get_users()
    {
        if( empty( $user_id ) )
            return;

        $users = User::get();

        if( $users )
            return $users;

        return false;
    }


    /**
     * Return post_slug
     */
    public static function get_post_slug( $post_id )
    {
        if( empty( $post_id ) )
            return;

        $post = Post::where('post_type', 'post')
            ->where('id', $post_id)->first();

        if( $post )
            return $post->post_slug;

        return false;
    }

    /**
     * Get lists of posts
     */
    public static function get_posts()
    {
        $posts = Post::where('post_type', 'post')->get();

        return $posts;
    }

    /**
     * This return single page record
     * @param  INT $page_id Post ID supplied by user
     * @return Object Object of posts records
     */
    public static function get_post( $post_id )
    {
        if( empty( $post_id ) )
            return;

        $post = Post::where('id', $post_id)->first();

        return $post;
    }

    /**
     * Get lists of pages
     */
    public static function get_pages()
    {
        $pages = Post::where('post_type', 'page')->get();

        return $pages;
    }

    /**
     * This return single page record
     * @param  INT $page_id Page ID supplied by user
     * @return Object Object of pages records
     */
    public static function get_page( $page_id )
    {
        if( empty( $page_id ) )
            return;

        $page = Post::where('id', $page_id)->first();

        return $page;
    }

    /**
     * Return all category if any otherwise false
     */
    public static function get_categories() {

        $categories = Category::get();

        if( $categories )
            return $categories;

        return false;
    }

    /**
     * Return category data
     */
    public static function get_category( $category_id ) {

        if( empty( $category_id ) )
            return;

        $category = Category::where('id', $category_id)->first();

        return $category;
    }

    /**
     * Get lists of comments
     */
    public static function get_comments( $post_id, $args = array() )
    {
        if( empty( $post_id ) )
            return;

        $args = array_merge( $args, array(
            'comment_approved'  => 1,
            'order'             => 'desc',
            'orderby'           => 'created_at'
        ) );

        $comments = Comment::where('post_id', $post_id)
            ->where('comment_approved', $args['comment_approved'])
            ->orderBy($args['orderby'], $args['order'])
            ->get();

        if( $comments )
            return self::get_comments_markup( $comments );

        return false;
    }

    /**
     * Display comment markup
     */
    public static function get_comments_markup( $comments )
    {
        ob_start();

        if( $comments->count() ) {
            ?>
            <ul>
                <?php foreach( $comments as $comment ) { ?>
                    <li>
                        <a rel="nofollow" target="_blank" href="<?php echo urlencode( $comment->comment_author_url ); ?>"><?php echo $comment->comment_author; ?></a>

                        <div class="comment-body">
                            <?php echo $comment->comment_content; ?>
                        </div>
                    </li>
                <?php } ?>
            </ul>
            <?php
        } else {
            echo "Be the first to comment.";
        }

        return ob_get_clean();
    }

}
