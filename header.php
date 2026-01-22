<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="main-wrapper">
    <!-- 헤더 섹션 -->
    <div class="section" id="header">
        <div class="container">
            <header class="header">
                <div class="container">
                    <div class="logo">
                        <?php 
                        $logo = get_theme_mod('aros_logo');
                        if ($logo) : ?>
                            <img alt="로고 이미지" src="<?php echo esc_url($logo); ?>">
                        <?php endif; ?>
                    </div>
                    <h1 class="logo-text"><?php echo esc_html(get_theme_mod('aros_logo_text', '오늘의 아파트')); ?></h1>
                </div>
            </header>
        </div>
    </div>

    <!-- 탭 메뉴 -->
    <div class="tab-wrapper">
        <div class="container">
            <nav class="tab-container">
                <ul class="tabs">
                    <?php
                    for ($i = 1; $i <= 4; $i++) {
                        $name = get_theme_mod("aros_tab{$i}_name");
                        $url = get_theme_mod("aros_tab{$i}_url");
                        $is_active_setting = get_theme_mod("aros_tab{$i}_active", ($i === 1));
                        
                        // 이름이 입력되어 있으면 무조건 표시
                        if (empty($name)) {
                            continue;
                        }
                        
                        // 활성화 설정 확인
                        $active_class = $is_active_setting ? 'active' : '';
                        ?>
                        <li class="tab-item">
                            <a class="tab-link <?php echo esc_attr($active_class); ?>" 
                               data-tab="aros<?php echo $i; ?>" 
                               href="<?php echo esc_url($url); ?>#aros<?php echo $i; ?>">
                                <?php echo esc_html($name); ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </div>
