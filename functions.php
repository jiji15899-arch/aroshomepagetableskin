<?php
/**
 * Aros Index Theme Functions
 * 
 * @package Aros_Index_Theme
 */

// 테마 설정
function aros_index_setup() {
    // 타이틀 태그 지원
    add_theme_support('title-tag');
    
    // 포스트 썸네일 지원
    add_theme_support('post-thumbnails');
    
    // HTML5 지원
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
}
add_action('after_setup_theme', 'aros_index_setup');

// 스크립트 및 스타일 로드
function aros_index_scripts() {
    // 구글 폰트
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@400;500;700&display=swap', array(), null);
    
    // 메인 스타일시트
    wp_enqueue_style('aros-index-style', get_stylesheet_uri(), array(), '1.0');
    
    // 스크립트
    wp_enqueue_script('aros-index-script', get_template_directory_uri() . '/script.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'aros_index_scripts');

// 커스터마이저 설정
function aros_index_customize_register($wp_customize) {
    
    // 로고 이미지 설정
    $wp_customize->add_setting('aros_logo', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'aros_logo', array(
        'label' => '로고 이미지',
        'section' => 'title_tagline',
        'settings' => 'aros_logo',
    )));
    
    // 로고 텍스트
    $wp_customize->add_setting('aros_logo_text', array(
        'default' => '오늘의 아파트',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('aros_logo_text', array(
        'label' => '로고 텍스트',
        'section' => 'title_tagline',
        'type' => 'text',
    ));
    
    // 탭 메뉴 섹션
    $wp_customize->add_section('aros_tabs', array(
        'title' => '탭 메뉴 설정',
        'priority' => 30,
    ));
    
    // 탭 1~4 설정
    for ($i = 1; $i <= 4; $i++) {
        // 탭 이름
        $wp_customize->add_setting("aros_tab{$i}_name", array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control("aros_tab{$i}_name", array(
            'label' => "탭 {$i} 이름",
            'section' => 'aros_tabs',
            'type' => 'text',
        ));
        
        // 탭 URL
        $wp_customize->add_setting("aros_tab{$i}_url", array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control("aros_tab{$i}_url", array(
            'label' => "탭 {$i} URL",
            'section' => 'aros_tabs',
            'type' => 'url',
        ));
        
        // 탭 활성화 (active 상태)
        $wp_customize->add_setting("aros_tab{$i}_active", array(
            'default' => ($i === 1) ? true : false,
            'sanitize_callback' => 'wp_validate_boolean',
        ));
        
        $wp_customize->add_control("aros_tab{$i}_active", array(
            'label' => "탭 {$i} 활성화 (Active)",
            'section' => 'aros_tabs',
            'type' => 'checkbox',
            'description' => '체크하면 이 탭이 기본 활성 상태로 표시됩니다',
        ));
    }
    
    // 카드 섹션
    $wp_customize->add_section('aros_cards', array(
        'title' => '카드 설정',
        'priority' => 31,
    ));
    
    // 메인 카드 제목
    $wp_customize->add_setting('aros_main_card_title', array(
        'default' => '근로장려금 신청',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('aros_main_card_title', array(
        'label' => '메인 카드 제목',
        'section' => 'aros_cards',
        'type' => 'text',
    ));
    
    // 메인 카드 내용
    $wp_customize->add_setting('aros_main_card_text', array(
        'default' => '대한민국 92%가 놓치고 있던 사실!<br/>근로장려금, 자금 받을 수 있습니다!<br/>바로 확인하고 혜택 놓치지 마세요!',
        'sanitize_callback' => 'wp_kses_post',
    ));
    
    $wp_customize->add_control('aros_main_card_text', array(
        'label' => '메인 카드 내용',
        'section' => 'aros_cards',
        'type' => 'textarea',
    ));
    
    // 메인 카드 아이콘
    $wp_customize->add_setting('aros_main_card_icon', array(
        'default' => '🎁',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('aros_main_card_icon', array(
        'label' => '메인 카드 아이콘 (이모지)',
        'section' => 'aros_cards',
        'type' => 'text',
    ));
    
    // 푸터 섹션
    $wp_customize->add_section('aros_footer', array(
        'title' => '푸터 설정',
        'priority' => 32,
    ));
    
    // 푸터 브랜드명
    $wp_customize->add_setting('aros_footer_brand', array(
        'default' => '굿인포',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('aros_footer_brand', array(
        'label' => '푸터 브랜드명',
        'section' => 'aros_footer',
        'type' => 'text',
    ));
    
    // 사업자 주소
    $wp_customize->add_setting('aros_footer_address', array(
        'default' => '대전광역시동구동부로10번길55',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('aros_footer_address', array(
        'label' => '사업자 주소',
        'section' => 'aros_footer',
        'type' => 'text',
    ));
    
    // 사업자 번호
    $wp_customize->add_setting('aros_footer_business_no', array(
        'default' => '784-15-02513',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('aros_footer_business_no', array(
        'label' => '사업자 번호',
        'section' => 'aros_footer',
        'type' => 'text',
    ));
}
add_action('customize_register', 'aros_index_customize_register');

// 버튼 추가를 위한 커스텀 포스트 타입
function aros_index_button_post_type() {
    register_post_type('aros_button', array(
        'labels' => array(
            'name' => '버튼',
            'singular_name' => '버튼',
            'add_new' => '버튼 추가',
            'add_new_item' => '새 버튼 추가',
            'edit_item' => '버튼 수정',
            'all_items' => '모든 버튼',
        ),
        'public' => false,
        'show_ui' => true,
        'supports' => array('title'),
        'menu_icon' => 'dashicons-admin-links',
        'menu_position' => 20,
    ));
    
    // 버튼 메타박스
    add_action('add_meta_boxes', 'aros_button_meta_boxes');
    add_action('save_post', 'aros_save_button_meta');
}
add_action('init', 'aros_index_button_post_type');

function aros_button_meta_boxes() {
    add_meta_box(
        'aros_button_details',
        '버튼 상세 설정',
        'aros_button_meta_callback',
        'aros_button',
        'normal',
        'high'
    );
}

function aros_button_meta_callback($post) {
    wp_nonce_field('aros_button_meta', 'aros_button_meta_nonce');
    
    $subtitle = get_post_meta($post->ID, '_aros_button_subtitle', true);
    $url = get_post_meta($post->ID, '_aros_button_url', true);
    $icon = get_post_meta($post->ID, '_aros_button_icon', true);
    $color = get_post_meta($post->ID, '_aros_button_color', true);
    $section = get_post_meta($post->ID, '_aros_button_section', true);
    $order = get_post_meta($post->ID, '_aros_button_order', true);
    
    ?>
    <table class="form-table">
        <tr>
            <th><label for="aros_button_subtitle">부제목</label></th>
            <td><input type="text" id="aros_button_subtitle" name="aros_button_subtitle" value="<?php echo esc_attr($subtitle); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="aros_button_url">링크 URL</label></th>
            <td><input type="url" id="aros_button_url" name="aros_button_url" value="<?php echo esc_url($url); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="aros_button_icon">아이콘 (이모지)</label></th>
            <td><input type="text" id="aros_button_icon" name="aros_button_icon" value="<?php echo esc_attr($icon); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="aros_button_color">색상 클래스</label></th>
            <td>
                <select id="aros_button_color" name="aros_button_color">
                    <option value="card-blue" <?php selected($color, 'card-blue'); ?>>파란색</option>
                    <option value="card-blue2" <?php selected($color, 'card-blue2'); ?>>파란색2</option>
                    <option value="card-teal" <?php selected($color, 'card-teal'); ?>>청록색</option>
                    <option value="card-purple" <?php selected($color, 'card-purple'); ?>>보라색</option>
                    <option value="card-green" <?php selected($color, 'card-green'); ?>>초록색</option>
                    <option value="card-orange" <?php selected($color, 'card-orange'); ?>>주황색</option>
                    <option value="card-amber" <?php selected($color, 'card-amber'); ?>>호박색</option>
                    <option value="card-forestgreen" <?php selected($color, 'card-forestgreen'); ?>>숲 초록색</option>
                    <option value="card-deeppurple" <?php selected($color, 'card-deeppurple'); ?>>진보라색</option>
                    <option value="card-lightpurple" <?php selected($color, 'card-lightpurple'); ?>>연보라색</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="aros_button_section">섹션 ID</label></th>
            <td>
                <input type="text" id="aros_button_section" name="aros_button_section" value="<?php echo esc_attr($section); ?>" class="regular-text">
                <p class="description">버튼이 속할 섹션 (예: aros1, aros2, aros3, aros4)</p>
            </td>
        </tr>
        <tr>
            <th><label for="aros_button_order">정렬 순서</label></th>
            <td><input type="number" id="aros_button_order" name="aros_button_order" value="<?php echo esc_attr($order); ?>" min="0"></td>
        </tr>
    </table>
    <?php
}

function aros_save_button_meta($post_id) {
    if (!isset($_POST['aros_button_meta_nonce']) || !wp_verify_nonce($_POST['aros_button_meta_nonce'], 'aros_button_meta')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    $fields = array('subtitle', 'url', 'icon', 'color', 'section', 'order');
    
    foreach ($fields as $field) {
        if (isset($_POST["aros_button_{$field}"])) {
            $value = $_POST["aros_button_{$field}"];
            if ($field === 'url') {
                $value = esc_url_raw($value);
            } else {
                $value = sanitize_text_field($value);
            }
            update_post_meta($post_id, "_aros_button_{$field}", $value);
        }
    }
}

// 버튼 가져오기 함수
function aros_get_buttons_by_section($section_id) {
    $args = array(
        'post_type' => 'aros_button',
        'posts_per_page' => -1,
        'meta_key' => '_aros_button_order',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key' => '_aros_button_section',
                'value' => $section_id,
                'compare' => '='
            )
        )
    );
    
    return new WP_Query($args);
}
?>
