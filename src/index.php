<?php
// 1. PHP 负责定义数据 (远程命令执行（RCE）和绕过关卡)
$challenges = array(
    // 基础信息获取与分析命令 (less-1 到 less-18)
    "less-1" => array(
        "title" => "cat 命令读取文件",
        "description" => "尝试利用 cat 命令读取指定文件内容",
        "url" => "/less-1/"
    ),
    "less-2" => array(
        "title" => "tac 命令倒序读取文件",
        "description" => "使用 tac 命令，从文件末尾开始倒序读取并显示内容",
        "url" => "/less-2/"
    ),
    "less-3" => array(
        "title" => "head 命令查看文件头",
        "description" => "利用 head 命令查看文件的前几行内容",
        "url" => "/less-3/"
    ),
    "less-4" => array(
        "title" => "tail 命令查看文件尾",
        "description" => "利用 tail 命令查看文件的后几行内容",
        "url" => "/less-4/"
    ),
    "less-5" => array(
        "title" => "more 命令分页查看",
        "description" => "使用 more 命令进行分页显示文件内容",
        "url" => "/less-5/"
    ),
    "less-6" => array(
        "title" => "less 命令高级分页查看",
        "description" => "使用 less 命令进行高级分页显示文件内容",
        "url" => "/less-6/"
    ),
    "less-7" => array(
        "title" => "nl 命令显示行号",
        "description" => "使用 nl 命令读取文件并加上行号显示",
        "url" => "/less-7/"
    ),
    "less-8" => array(
        "title" => "sort 命令排序输出",
        "description" => "使用 sort 命令对文件内容进行排序后输出",
        "url" => "/less-8/"
    ),
    "less-9" => array(
        "title" => "uniq 命令去重",
        "description" => "使用 uniq 命令去除文件中重复的连续行",
        "url" => "/less-9/"
    ),
    "less-10" => array(
        "title" => "od 命令八进制转储",
        "description" => "使用 od 命令以八进制或其他格式显示文件内容",
        "url" => "/less-10/"
    ),
    "less-11" => array(
        "title" => "xxd 命令十六进制转储",
        "description" => "使用 xxd 命令进行十六进制转储，通常用于查看二进制数据",
        "url" => "/less-11/"
    ),
    "less-12" => array(
        "title" => "hexdump 命令查看二进制",
        "description" => "使用 hexdump 命令以十六进制和其他格式转储文件",
        "url" => "/less-12/"
    ),
    "less-13" => array(
        "title" => "base32 编码/解码",
        "description" => "使用 base32 命令对文件内容进行编码或解码操作",
        "url" => "/less-13/"
    ),
    "less-14" => array(
        "title" => "base64 编码/解码",
        "description" => "使用 base64 命令对文件内容进行编码或解码操作",
        "url" => "/less-14/"
    ),
    "less-15" => array(
        "title" => "strings 命令查找可打印字符串",
        "description" => "使用 strings 命令从文件中提取出可打印的字符串",
        "url" => "/less-15/"
    ),
    "less-16" => array(
        "title" => "grep 命令文本搜索",
        "description" => "使用 grep 命令在文件中搜索特定的文本模式，更强大的文件读取工具 linux三剑客!",
        "url" => "/less-16/"
    ),
    "less-17" => array(
        "title" => "file 命令识别文件类型",
        "description" => "使用 file 命令识别给定文件的类型，file命令还可以读取文件内容？？",
        "url" => "/less-17/"
    ),
    "less-18" => array(
        "title" => "find 命令文件搜索",
        "description" => "使用 find 命令在文件系统中搜索文件或目录，<b>找到findme.txt的位置</b>",
        "url" => "/less-18/"
    ),

    "less-19" => array(
        "title" => "cp 命令复制文件",
        "description" => "尝试利用 cp 命令将文件复制到 Web 目录",
        "url" => "/less-19/"
    ),
    "less-20" => array(
        "title" => "mv 命令移动/更名文件",
        "description" => "利用 mv 命令移动或重命名文件，实现文件隐藏、覆盖或 Webshell 部署。",
        "url" => "/less-20/"
    ),

    "less-21" => array(
        "title" => "ping 命令 DNSLOG/ICMP 外带",
        "description" => "使用 ping 命令测试出网，利用 DNSLOG/ICMP 外带无回显命令执行结果",
        "url" => "/less-21/"
    ),
    "less-22" => array(
        "title" => "curl 发起http请求",
        "description" => "使用 curl 命令发送http请求，了解下weblog玩法、下载远程文件",
        "url" => "/less-22/"
    ),
    "less-23" => array(
        "title" => "echo 命令回显输出",
        "description" => "使用 echo 命令输出文本或变量内容，echo命令怎么重定向写入木马？",
        "url" => "/less-23/"
    ),
    "less-24" => array(
        "title" => "wget 命令网络下载",
        "description" => "使用 wget 命令下载文件，下载远程文件",
        "url" => "/less-24/"
    ),
    "less-25" => array(
        "title" => "nc 反弹shell",
        "description" => "使用 nc 命令进行反弹shell与监听，尝试反弹shell",
        "url" => "/less-25/"
    ),
    "less-26" => array(
        "title" => "ncat反弹Shell",
        "description" => "ncat反弹shell，注意waf，可暂跳过本关，先学习后续绕过姿势，再回来挑战",
        "url" => "/less-26/"
    ),

    "less-27" => array(
        "title" => "sed 篡改/写入 Webshell",
        "description" => "利用 sed 命令的特性，替换文件内容写入 Webshell",
        "url" => "/less-27/"
    ),

    "less-28" => array(
        "title" => "通配符 ? 代替单字符",
        "description" => "利用通配符 ? 来模糊匹配单个字符，【无懈可击】waf形同虚设",
        "url" => "/less-28/"
    ),
    "less-29" => array(
        "title" => "通配符 * 代替多字符",
        "description" => "利用通配符 * 来模糊匹配多个字符，【无懈可击】waf形同虚设",
        "url" => "/less-29/"
    ),
    "less-30" => array(
        "title" => "\$变量定义绕过 WAF",
        "description" => "利用 \$ 变量定义 绕过黑名单关键字，【无懈可击】waf形同虚设",
        "url" => "/less-30/"
    ),
    "less-31" => array(
        "title" => "多命令执行分隔 ;",
        "description" => "使用分号 ; 分隔符执行多个命令",
        "url" => "/less-31/"
    ),
    "less-32" => array(
        "title" => "多命令执行逻辑 &&",
        "description" => "使用逻辑与 && 分隔符，在第一个命令成功时执行第二个命令，& 具有特殊语义，注意url编码",
        "url" => "/less-32/"
    ),
    "less-33" => array(
        "title" => "多命令执行逻辑 ||",
        "description" => "使用逻辑或 || 分隔符，在第一个命令失败时执行第二个命令",
        "url" => "/less-33/"
    ),
    "less-34" => array(
        "title" => "反引号 `` 优先级",
        "description" => "反引号里的命令优先级高，会先执行，再执行外面的命令",
        "url" => "/less-34/"
    ),
    "less-35" => array(
        "title" => "绕过注释 #",
        "description" => "井号 # 会将后续内容注释掉，尝试绕过 # ",
        "url" => "/less-35/"
    ),
    "less-36" => array(
        "title" => "绕过空格 \t (Tab)",
        "description" => "尝试用 Tab 键（URL编码为 %09 ）代替空格",
        "url" => "/less-36/"
    ),

    // 进阶绕过技巧 (less-37 到 less-45)
    "less-37" => array(
        "title" => "绕过空格 \$IFS (环境变量)",
        "description" => "尝试用 环境变量 \$IFS(分隔符) 代替空格",
        "url" => "/less-37/"
    ),
    "less-38" => array(
        "title" => "绕过空格 \${IFS}",
        "description" => "利用 \${IFS} 环境变量代替空格进行命令执行",
        "url" => "/less-38/"
    ),
    "less-39" => array(
        "title" => "绕过空格 bash {,}",
        "description" => "利用 Bash 的大括号扩展 {,} 结构来代替空格",
        "url" => "/less-39/"
    ),
    "less-40" => array(
        "title" => "绕过黑名单关键字 ' (单引号)",
        "description" => "怎么使用单引号绕过黑名单？",
        "url" => "/less-40/"
    ),
    "less-41" => array(
        "title" => "绕过黑名单关键字 \" (双引号)",
        "description" => "怎么使用双引号绕过黑名单？",
        "url" => "/less-41/"
    ),
    "less-42" => array(
        "title" => "绕过黑名单关键字 ? (问号)",
        "description" => "使用问号绕过黑名单？",
        "url" => "/less-42/"
    ),
    "less-43" => array(
        "title" => "绕过黑名单关键字 * (星号)",
        "description" => "使用星号绕过黑名单？",
        "url" => "/less-43/"
    ),
    "less-44" => array(
        "title" => "绕过黑名单关键字 \ (反斜杠)",
        "description" => "使用反斜杠绕过黑名单",
        "url" => "/less-44/"
    ),
    "less-45" => array(
        "title" => "绕过黑名单关键字 . (点)",
        "description" => "真的没的玩了吗？你知道 . 可以做什么吗？<b>难度高</b>",
        "url" => "/less-45/"
    ),

    // 最终考察关卡 (原 less-45 已后延到 less-46)
    "less-46" => array(
        "title" => "最终考察 - 无回显 RCE",
        "description" => "命令执行结果不回显。",
        "url" => "/less-46/"
    ),
);

// 2. 将 PHP 数组转换为 JSON 字符串，供前端 JS 使用
$json_data = json_encode($challenges, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_SLASHES);
if ($json_data === false) {
    die('Error encoding challenge data');
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>rce-labs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <style>
        /* CSS 部分... */
        /* =================================================== */
        /* 1. 定义 CSS 变量（主题颜色） */
        /* =================================================== */
        :root {
            /* 浅色主题 (默认) */
            --bg-color: #f4f7f6;
            --main-text-color: #333;
            --secondary-text-color: #7f8c8d;
            --card-bg-color: #ffffff;
            --shadow-color: rgba(0, 0, 0, 0.1);
            --hover-color: #4CAF50;
            --modal-bg-color: #fff;
            --header-border-color: #e0e0e0;
            --switch-button-color: #6c757d;
        }

        /* 深色主题 */
        body.dark-theme {
            --bg-color: #1e1e1e;
            --main-text-color: #ffffff;
            --secondary-text-color: #b0b0b0;
            --card-bg-color: #2c2c2c;
            --shadow-color: rgba(0, 0, 0, 0.5);
            --hover-color: #00bcd4; /* 蓝色或青色，在深色背景下效果更好 */
            --modal-bg-color: #383838;
            --header-border-color: #444;
            --switch-button-color: #ced4da;
        }

        /* =================================================== */
        /* 2. 应用通用样式和变量 */
        /* =================================================== */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-color);
            color: var(--main-text-color); /* 应用主题文字颜色 */
            margin: 0;
            padding: 20px;
            text-align: center;
            transition: background-color 0.3s, color 0.3s; /* 切换主题时有过渡效果 */
        }

        h1 {
            color: var(--main-text-color);
            margin-bottom: 30px;
        }

        /* 主题切换按钮样式 */
        #theme-toggle {
            position: absolute;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--switch-button-color);
            transition: color 0.3s;
            line-height: 1; /* 确保图标对齐 */
        }
        
        #theme-toggle:hover {
            color: var(--hover-color);
        }


        /* 关卡列表容器 */
        #challenge-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            max-width: 1000px;
            margin: 0 auto;
        }

        /* 关卡按钮样式 */
        .challenge-button {
            background-color: var(--card-bg-color);
            color: var(--main-text-color);
            border: none;
            padding: 15px 25px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 8px;
            box-shadow: 0 4px 6px var(--shadow-color);
            transition: all 0.3s ease;
            width: 180px;
            height: 80px;
        }

        .challenge-button:hover {
            background-color: var(--hover-color); 
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 6px 10px var(--shadow-color);
        }

        /* 弹出框（模态框）样式 (背景不变，但内容使用变量) */
        .modal {
            display: none;
            position: fixed;
            z-index: 100;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .modal.active {
            display: block;
            opacity: 1;
            visibility: visible;
        }

        .modal-content-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100%;
        }

        /* 弹出框内容 */
        .modal-content {
            background-color: var(--modal-bg-color); /* 使用主题变量 */
            color: var(--main-text-color); /* 使用主题变量 */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 16px var(--shadow-color);
            width: 80%;
            max-width: 500px;
            position: relative;
            transform: translateY(-50px);
            transition: transform 0.3s ease, background-color 0.3s;
        }

        .modal.active .modal-content {
            transform: translateY(0);
        }

        .modal-content h2 {
            color: var(--main-text-color);
            border-bottom: 2px solid var(--header-border-color); /* 使用主题变量 */
            padding-bottom: 10px;
            margin-top: 0;
        }

        .modal-content p {
            color: var(--secondary-text-color); /* 使用主题变量 */
            line-height: 1.6;
            margin-bottom: 25px;
        }

        /* 关闭按钮 */
        .close-button {
            color: var(--secondary-text-color);
            float: right;
            font-size: 28px;
            font-weight: bold;
            transition: color 0.2s;
            cursor: pointer;
        }

        .close-button:hover,
        .close-button:focus {
            color: var(--main-text-color);
            text-decoration: none;
            cursor: pointer;
        }

        /* 前往题目按钮 (保持不变，使用硬编码颜色以保持品牌色) */
        #go-to-challenge {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #go-to-challenge:hover {
            background-color: #0056b3;
        }
        
        /* 适配手机屏幕 */
        @media (max-width: 600px) {
            .challenge-button {
                width: 100%;
                height: auto;
            }
            .modal-content {
                width: 90%;
            }
        }

    </style>
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
        // JavaScript 直接接收 PHP 传递的 JSON 数据
        // 注意：此处是 PHP 脚本，在服务器端执行，将 JSON 数据嵌入 JS 变量
        const CHALLENGES_DATA = JSON.parse(<?php echo json_encode($json_data); ?>);
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

        document.addEventListener('DOMContentLoaded', () => {
            const challengeList = document.getElementById('challenge-list');
            const modal = document.getElementById('challenge-modal');
            const modalTitle = document.getElementById('modal-title');
            const modalDescription = document.getElementById('modal-description');
            const goToChallengeButton = document.getElementById('go-to-challenge');
            const closeModalButton = document.querySelector('.close-button');

            let currentChallengeUrl = '';

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