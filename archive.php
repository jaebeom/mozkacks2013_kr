<?php get_header();

// Fetch these IDs now because we'll be using them a lot.
$demo_id = get_cat_ID('예제');
$featureddemo_id = get_cat_ID('주요 예제');
$featured_id = get_cat_ID('주요 문서');

$search_count = 0;
$search = new WP_Query("s=$s & showposts=-1");
if($search->have_posts()) : while($search->have_posts()) : $search->the_post();
$search_count++;
endwhile; endif;
?>

<header id="content-head">
  <ul class="nav-crumbs">
    <li><a href="<?php bloginfo('url'); ?>" title="Go to the home page">첫화면</a></li>
    <li><a href="<?php echo get_permalink(get_page_by_path('articles')->ID); ?>">기술문서</a></li>
  </ul>

  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
  <h1 class="page-title">
  <?php if (is_category($demo_id)) : ?>예제
  <?php elseif (is_category()) : ?><?php single_cat_title(); ?> 기술문서
  <?php elseif (is_tag()) : ?>&#8220;<?php single_tag_title(); ?>&#8221로 태깅된 기술문서;
  <?php elseif (is_day()) : ?><?php the_time('F jS, Y'); ?> 기술문서
  <?php elseif (is_month()) : ?><?php the_time('F Y'); ?> 기술문서
  <?php elseif (is_year()) : ?><?php the_time('Y'); ?> 기술문서
  <?php elseif (is_author()) : ?><?php echo get_userdata(intval($author))->display_name; ?>가 작성한 기술문서
  <?php elseif (is_search()) : ?>&ldquo;<?php the_search_query(); ?>&rdquo;로 검색된 결과 &#10025;
  <?php elseif (isset($_GET['paged']) && !empty($_GET['paged'])) : ?>기술문서
  <?php else : ?>기술문서
  <?php endif; ?>
  </h1>

  <div id="content-bar" class="options">
    <h3>정렬방식:</h3>
    <ul class="opt-sort">
      <li<?php tmh_has_query_var('tmh_sort_by', 'date', ' class="selected"', TRUE) ?>><a class="sort-date" href="<?php echo tmh_by_as_url('date'); ?>" title="Sort articles by date, most recent first">날짜순</a><?php tmh_has_query_var('tmh_sort_by', 'date', ' <em>(this is the current option)</em>', TRUE) ?></li>
<?php if (function_exists('tmh_page_hits_ok') AND tmh_page_hits_ok()) : ?>
      <li<?php tmh_has_query_var('tmh_sort_by', 'views', ' class="selected"') ?>><a class="sort-views" href="<?php echo tmh_by_as_url('views'); ?>" title="Sort articles by number of views, most popular first">조회순</a><?php tmh_has_query_var('tmh_sort_by', 'views', ' <em>(this is the current option)</em>') ?></li>
<?php endif; ?>
      <li<?php tmh_has_query_var('tmh_sort_by', 'comments', ' class="selected"') ?>><a class="sort-comments" href="<?php echo tmh_by_as_url('comments'); ?>" title="Sort articles by number of comments, most commented first">댓글순</a><?php tmh_has_query_var('tmh_sort_by', 'comments', ' <em>(this is the current option)</em>') ?></li>
    </ul>
    <h3>View:</h3>
    <ul class="opt-view">
      <li<?php tmh_has_query_var('tmh_view_as', 'title', ' class="selected"', TRUE) ?>><a class="view-title" href="<?php echo tmh_by_as_url(TRUE, 'title'); ?>" title="Show only article titles">제목</a><?php tmh_has_query_var('tmh_view_as', 'title', ' <em>(this is the current view)</em>') ?></li>
      <li<?php tmh_has_query_var('tmh_view_as', 'brief', ' class="selected"') ?>><a class="view-brief" href="<?php echo tmh_by_as_url(TRUE, 'brief'); ?>" title="Show article excerpts">요약</a><?php tmh_has_query_var('tmh_view_as', 'brief', ' <em>(this is the current view)</em>') ?></li>
      <li<?php tmh_has_query_var('tmh_view_as', 'complete', ' class="selected"') ?>><a class="view-complete" href="<?php echo tmh_by_as_url(TRUE, 'complete'); ?>" title="Show full articles">전체</a><?php tmh_has_query_var('tmh_view_as', 'complete', ' <em>(this is the current view)</em>') ?></li>
    </ul>
  </div>

</header><!-- /#content-head -->

<main id="content-main">
<?php if (have_posts()) :
  fc_custom_loop($query_string.'&template=article-%view%'); ?>

  <?php if (fc_show_posts_nav()) : ?>
    <?php if (function_exists('fc_pagination') ) : fc_pagination(); else: ?>
      <ul class="nav-paging">
        <?php if ( $paged < $wp_query->max_num_pages ) : ?><li class="prev"><?php next_posts_link('Previous'); ?></li><?php endif; ?>
        <?php if ( $paged > 1 ) : ?><li class="next"><?php previous_posts_link('Next'); ?></li><?php endif; ?>
      </ul>
    <?php endif; ?>
  <?php endif; ?>

<?php else : ?>
  <p class="fail">죄송합니다, 기술문서가 존재하지 않습니다.</p>
<?php endif; ?>
</main><!-- /#content-main -->

<aside id="content-sub">
  <ul id="widgets">
  <?php if (is_author()) : ?>
    <li class="widget author">
      <h3>저자</h3>
      <div class="vcard">
        <h4 class="fn">
        <?php if (get_userdata(intval($author))->user_url) : ?>
          <a class="url" href="<?php echo get_userdata(intval($author))->user_url; ?>" rel="external me"><?php echo get_userdata(intval($author))->display_name; ?>
        <?php else : ?>
          <a class="url" href="<?php echo get_author_posts_url($author->ID); ?>"><?php echo get_userdata(intval($author))->display_name; ?>
        <?php endif; ?>
        <?php if (function_exists('get_avatar')) { echo ('<span class="photo">'.get_avatar( get_userdata(intval($author))->user_email, 48 ).'</span>'); } ?>
        </a></h4>
      <?php if (get_userdata(intval($author))->description) : ?>
        <p><?php echo get_userdata(intval($author))->description; ?></p>
      <?php endif; ?>
      </div>
    </li><?php // end author module ?>
  <?php endif; ?>

    <li class="widget categories">
      <h3 class="widgettitle">분류별</h3>
      <ul class="cat-list" role="navigation">
       <?php wp_list_categories('show_count=1&hierarchical=0&depth=1&title_li='); ?>
      </ul>
    </li>
  </ul>
</aside><!-- /#content-sub -->

<?php get_footer(); ?>
