jQuery(document).ready(function($) {
    // 탭 활성화 처리
    const tabs = document.querySelectorAll('.tab-link');
    const hash = window.location.hash;
    let activeTabFound = false;

    tabs.forEach(tab => {
        if (hash) {
            if (tab.getAttribute('href').includes(hash)) {
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                activeTabFound = true;
            }
        }
    });

    if (!activeTabFound) {
        const defaultActiveTab = document.querySelector('.tab-link.active');
        if (defaultActiveTab) {
            defaultActiveTab.classList.add('active');
        }
    }

    // 스크롤 오프셋 함수
    function scrollToElementWithOffset(elementId) {
        const targetElement = document.getElementById(elementId);
        if (targetElement) {
            const offset = window.innerHeight * 0.15;
            const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset;
            const scrollPosition = targetPosition - offset;

            window.scrollTo({
                top: scrollPosition,
                behavior: 'smooth'
            });
        }
    }

    // 페이지 로드시 해시가 있으면 스크롤
    if (hash) {
        const targetId = hash.substring(1);
        setTimeout(() => {
            scrollToElementWithOffset(targetId);
        }, 300);
    }

    // 탭 클릭시 스크롤
    tabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            const hashIndex = href.indexOf('#');
            
            if (hashIndex !== -1) {
                const targetId = href.substring(hashIndex + 1);
                const targetElement = document.getElementById(targetId);
                
                // 같은 페이지 내의 요소인 경우에만 기본 동작 방지
                if (targetElement) {
                    e.preventDefault();
                    
                    // 모든 탭의 active 클래스 제거
                    tabs.forEach(t => t.classList.remove('active'));
                    
                    // 클릭한 탭에 active 클래스 추가
                    this.classList.add('active');
                    
                    // 스크롤
                    scrollToElementWithOffset(targetId);
                    
                    // URL 업데이트
                    history.pushState(null, null, href);
                }
            }
        });
    });
});
