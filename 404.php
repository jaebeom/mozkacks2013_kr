<?php get_header(); ?>

<header id="content-head">
  <h1 class="page-title">죄송합니다, 요청하신 내용을 찾을 수 없습니다.</h1>
</header>

<main id="content-main">
  <div class="fail post">
    <p>이 사이트는 여러 군데에서 찾을 수 있습니다. 그러나 여러분이 찾는 페이지나 파일을 찾을 수 없습니다. 추정 가능한 설명:</p>
    <ul>
      <li>여러분이 오래된 링크나 북마크를 따라오셨을 수 있습니다.</li>
      <li>만약 여러분이 손으로 주소를 입력했다면, 잘못 입력했을 수 있습니다.</li>
      <li>여러분이 알려지지 않은 에러를 발견했을 수 있습니다. 감사합니다!</li>
    </ul>

    <h2>그래서 지금 할일은?</h2>
    <ul>
      <li><a href="<?php bloginfo('url'); ?>">홈페이지</a>로 가기.</li>
      <li>사이트에서 <a href="#s">검색</a>하기.</li>
      <li><a href="<?php echo get_permalink(get_page_by_path('demos')->ID); ?>">데모페이지</a>를 확인해보기.</li>
    </ul>
  </div>
</main><!-- /#content-main -->

<?php get_footer(); ?>
