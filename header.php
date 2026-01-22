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
                    $current_url = home_url($_SERVER['REQUEST_URI']);
                    for ($i = 1; $i <= 4; $i++) {
                        $enabled = get_theme_mod("aros_tab{$i}_enabled", ($i <= 3));
                        $name = get_theme_mod("aros_tab{$i}_name");
                        $url = get_theme_mod("aros_tab{$i}_url");
                        
                        // 이름이 비어있거나 비활성화된 경우 스킵
                        if (!$enabled || empty($name)) {
                            continue;
                        }
                        
                        // 현재 URL과 비교하여 active 클래스 결정
                        $is_active = (strpos($current_url, $url) !== false) ? 'active' : '';
                        
                        // 첫 번째 탭에 기본 active 클래스 (다른 active가 없는 경우)
                        if ($i === 1 && empty($is_active)) {
                            $is_active = 'active';
                        }
                        ?>
                        <li class="tab-item">
                            <a class="tab-link <?php echo esc_attr($is_active); ?>" 
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
