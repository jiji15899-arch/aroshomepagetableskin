<?php get_header(); ?>

<div class="container">
    <!-- 메인 카드 -->
    <div class="content-card">
        <h2 class="card-title"><?php echo esc_html(get_theme_mod('aros_main_card_title', '근로장려금 신청')); ?></h2>
        <p class="card-text"><?php echo wp_kses_post(get_theme_mod('aros_main_card_text', '대한민국 92%가 놓치고 있던 사실!<br/>근로장려금, 자금 받을 수 있습니다!<br/>바로 확인하고 혜택 놓치지 마세요!')); ?></p>
        <span class="card-icon"><?php echo esc_html(get_theme_mod('aros_main_card_icon', '🎁')); ?></span>
    </div>

    <?php
    // 섹션별로 버튼 출력
    $sections = array(
        'aros1' => '최대 460만원, 지금 바로 신청!',
        'aros2' => '근로장려금, 당신도 받을 수 있다!',
        'aros3' => '1인당 330만원, 지금 확인!',
        'aros4' => '정부 지원금, 놓치지 마세요!'
    );

    foreach ($sections as $section_id => $section_title) {
        $buttons = aros_get_buttons_by_section($section_id);
        
        if ($buttons->have_posts()) :
    ?>
        <h2 class="section-title" id="<?php echo esc_attr($section_id); ?>"><?php echo esc_html($section_title); ?></h2>
        <div class="support-grid">
            <?php
            while ($buttons->have_posts()) : $buttons->the_post();
                $subtitle = get_post_meta(get_the_ID(), '_aros_button_subtitle', true);
                $url = get_post_meta(get_the_ID(), '_aros_button_url', true);
                $icon = get_post_meta(get_the_ID(), '_aros_button_icon', true);
                $color = get_post_meta(get_the_ID(), '_aros_button_color', true);
            ?>
                <a class="support-card <?php echo esc_attr($color); ?>" href="<?php echo esc_url($url); ?>">
                    <div class="support-title"><?php the_title(); ?></div>
                    <?php if ($subtitle) : ?>
                        <div class="support-subtitle"><?php echo esc_html($subtitle); ?></div>
                    <?php endif; ?>
                    <?php if ($icon) : ?>
                        <div class="support-icon"><?php echo esc_html($icon); ?></div>
                    <?php endif; ?>
                </a>
            <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    <?php
        endif;
    }
    ?>

    <!-- 광고 영역 (필요시 애드센스 코드 삽입) -->
    <div class="ad-container">
        <!-- 여기에 광고 코드를 삽입하세요 -->
    </div>
</div>

<?php get_footer(); ?>
