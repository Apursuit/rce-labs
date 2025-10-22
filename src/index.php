<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>rce-labs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>RCE-labs 命令执行</h1>

    <button id="theme-toggle" title="切换主题">
        🌙
    </button>

    <div id="challenge-list">
    </div>

    <div id="challenge-modal" class="modal">
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <span class="close-button">&times;</span>
                <h2 id="modal-title"></h2>
                <p id="modal-description"></p>
                <button id="go-to-challenge">前往题目</button>
            </div>
        </div>
    </div>

    <script>
        // 从 data.json 动态加载关卡数据
        let CHALLENGES_DATA = {};
        const themeToggleBtn = document.getElementById('theme-toggle');
        const body = document.body;

        /**
         * 主题切换逻辑
         */
        function applyTheme(isDark) {
            if (isDark) {
                body.classList.add('dark-theme');
                themeToggleBtn.innerHTML = '☀️'; // 深色模式显示太阳图标
                localStorage.setItem('theme', 'dark');
            } else {
                body.classList.remove('dark-theme');
                themeToggleBtn.innerHTML = '🌙'; // 浅色模式显示月亮图标
                localStorage.setItem('theme', 'light');
            }
        }

        function toggleTheme() {
            const isDark = body.classList.contains('dark-theme');
            applyTheme(!isDark);
        }

        // 首次加载时：从 localStorage 读取用户偏好，如果未设置则使用系统默认
        const savedTheme = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        if (savedTheme === 'dark') {
            applyTheme(true);
        } else if (savedTheme === 'light') {
            applyTheme(false);
        } else if (prefersDark) {
            // 如果用户没有明确设置，则跟随系统主题（默认为深色）
            applyTheme(true);
        } else {
            // 否则默认为浅色
            applyTheme(false);
        }

        // 监听按钮点击事件
        themeToggleBtn.addEventListener('click', toggleTheme);
        
        
        // ===================================================
        // 原有的关卡加载和模态框逻辑 (已根据新的数据结构适配)
        // ===================================================

        document.addEventListener('DOMContentLoaded', async () => {
            const challengeList = document.getElementById('challenge-list');
            const modal = document.getElementById('challenge-modal');
            const modalTitle = document.getElementById('modal-title');
            const modalDescription = document.getElementById('modal-description');
            const goToChallengeButton = document.getElementById('go-to-challenge');
            const closeModalButton = document.querySelector('.close-button');

            let currentChallengeUrl = '';

            // 通过 HTTP 获取 data.json（与 index.php 同目录）
            try {
                const res = await fetch('data.json', { cache: 'no-cache' });
                if (!res.ok) throw new Error('HTTP ' + res.status);
                CHALLENGES_DATA = await res.json();
            } catch (e) {
                console.error('加载关卡数据失败:', e);
                challengeList.innerHTML = '<p style="color: gray;">关卡数据加载失败，请稍后重试。</p>';
                return;
            }

            // 1. 动态生成关卡按钮
            if (Object.keys(CHALLENGES_DATA).length > 0) {
                // 将对象键转换为数字并排序，以确保关卡顺序正确
                const sortedKeys = Object.keys(CHALLENGES_DATA).sort((a, b) => {
                    const numA = parseInt(a.split('-')[1]);
                    const numB = parseInt(b.split('-')[1]);
                    return numA - numB;
                });

                sortedKeys.forEach(key => {
                    const challenge = CHALLENGES_DATA[key];
                    const button = document.createElement('button');
                    button.className = 'challenge-button';
                    // 关卡名: less-1，关卡标题: cat 命令读取文件
                    const levelNumber = key.split('-')[1]; // 提取数字部分
                    button.innerHTML = `<strong>Level ${levelNumber}</strong><br>${challenge.title}`;
                    
                    button.setAttribute('data-title', challenge.title);
                    button.setAttribute('data-description', challenge.description);
                    button.setAttribute('data-url', challenge.url);

                    button.addEventListener('click', showChallengeModal);
                    challengeList.appendChild(button);
                });

            } else {
                challengeList.innerHTML = '<p style="color: gray;">暂无挑战关卡。</p>';
            }


            // 2. 显示关卡详情弹出框
            function showChallengeModal(event) {
                const button = event.currentTarget; 
                
                const title = button.getAttribute('data-title');
                const description = button.getAttribute('data-description');
                const url = button.getAttribute('data-url');
                
                modalTitle.textContent = title;
                modalDescription.innerHTML = description;
                currentChallengeUrl = url; 

                modal.classList.add('active');
            }


            // 3. 关闭弹出框功能
            function closeModal() {
                modal.classList.remove('active');
                currentChallengeUrl = '';
            }

            closeModalButton.addEventListener('click', closeModal);

            // 监听点击背景关闭
            modal.addEventListener('click', (event) => {
                if (event.target.classList.contains('modal')) { 
                    closeModal();
                }
            });

            // 监听前往题目按钮点击
            goToChallengeButton.addEventListener('click', () => {
                if (currentChallengeUrl) {
                    // 关键修改：使用 window.open(url, '_blank') 在新标签页打开目标 URL
                    window.open(currentChallengeUrl, '_blank'); 
                    
                    closeModal();
                }
            });

            // 监听 ESC 键关闭
            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape' && modal.classList.contains('active')) {
                    closeModal();
                }
            });
        });
    </script>
</body>
</html>