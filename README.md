# RCE-labs

构建一个靶场式学习平台（RCE-labs），通过实战化的CTF挑战关卡，系统性地帮助网络安全初学者理解掌握远程代码执行（RCE）漏洞利用中所需的基础Linux命令和绕过技巧。

![](/assets/1.png)

![](/assets/2.png)

![](/assets/3.png)

![](/assets/4.png)


Ciallo～(∠・ω< )⌒★~~柚子厨蒸鹅心~~

## 我可以学习到什么？


### 命令

linux 终端的常用命令

- ls
- cat
- tac
- head
- tail
- more
- less
- nl
- sort
- uniq
- od
- xxd
- hexdump
- base32
- base64
- strings
- grep
- file
- find
- cp
- mv
- ping
- curl
- wget
- nc
- ncat
- sed

### 特性

linux 终端的特性具有简单高效等优点，在RCE的场景下，往往可以利用这些特性来达到绕过过滤、逃逸的目的

- ?
- \*
- ;
- &&
- ||
- \#
- space
- tab
- \t
- \n
- $
- ${IFS}
- $IFS
- {cmd,param}
- ''
- ""
- \

### 无回显rce

- 重定向写入webshell
- 反弹shell
- 外带（http请求带出命令执行结果）
- 时间盲注
- 临时文件执行

## 关卡设计

常用命令

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
| 10 | od | 内容查看 |
| 11 | xxd | 内容查看 |
| 12 | hexdump | 内容查看 |
| 13 | base32 | 编码解码 |
| 14 | base64 | 编码解码 |
| 15 | strings | 字符串提取 |
| 16 | grep | 字符串匹配 |
| 17 | file | 文件类型判断 |
| 18 | find | 文件查找 |
| 19 | cp | 文件复制文件 |
| 20 | mv | 文件移动/重命名 |
| 21 | ping | 外带数据 |
| 22 | curl | 网络请求 |
| 23 | echo | 重定向写文件 |
| 24 | wget | 文件下载 |
| 25 | nc反弹shell | 端口监听 |
| 26 | ncat反弹shell | 端口监听 |
| 27 | sed 篡改/写入 Webshell | 高级文件操作 |
| 28 | 通配符? | 绕过技巧 |
| 29 | 通配符* | 绕过技巧 |
| 30 | $定义变量绕过 | 变量拆分与拼接 |
| 31 | 多命令执行分隔; | 绕过技巧 |
| 32 | 多命令执行&& | 绕过技巧 |
| 33 | 多命令执行|| | 绕过技巧 |
| 34 | 反引号优先级 | 绕过技巧 |
| 35 | 绕过注释# | 绕过技巧 |
| 36 | 绕过空格\t | 绕过技巧 |
| 37 | 绕过空格$IFS | 绕过技巧 |
| 38 | 绕过空格${IFS} | 绕过技巧 |
| 39 | 绕过空格bash{,} | 绕过技巧 |
| 40 | 绕过黑名单关键字 ' | 绕过技巧 |
| 41 | 绕过黑名单关键字 " | 绕过技巧 |
| 42 | 绕过黑名单关键字 ? | 绕过技巧 |
| 43 | 绕过黑名单关键字 * | 绕过技巧 |
| 44 | 绕过黑名单关键字 \ | 绕过技巧 |
| 45 | 绕过黑名单关键字 . | 绕过技巧 |
| 46 | 无回显RCE | 进阶实战 |

## 部署


### docker compose（推荐）

```bash
git clone https://github.com/Apursuit/rce-labs.git
cd rce-labs/docker
docker-compose up -d
```

访问8080


### docker


```bash
docker pull the0n3/rce-labs:latest
docker run -d -p 8080:80 the0n3/rce-labs
```

访问8080


## 最后

🎉恭喜您完成了本靶场挑战！推荐阅读的一些资源

- [提问的智慧](https://the0n3.top/pages/3d073e/)
- [入门综述](https://xp0int-team.feishu.cn/wiki/wikcnnWbXXGELt1xHkyBhvdQKrh)
- [《上海交通大学生存手册》](http://www.houxiaodi.com/assets/misc/manual.pdf)
