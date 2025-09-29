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
- ping
- curl
- wget
- nc
- ncat

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

| 关卡 | 关卡描述 | 
| ---- | ---- |
| 1 | cat |
| 2 | tac |
| 3 | head |
| 4 | tail |
| 5 | more |
| 6 | less |
| 7 | nl |
| 8 | sort |
| 9 | uniq |
| 10 | od |
| 11 | xxd |
| 12 | hexdump |
| 13 | base32 |
| 14 | base64 |
| 15 | strings |
| 16 | grep |
| 17 | file |
| 18 | find |
| 19 | ping |
| 20 | curl |
| 21 | echo |
| 22 | wget |
| 23 | nc反弹shell |
| 24 | ncat反弹shell |
| 25 | 通配符? | 
| 26 | 通配符* |
| 27 | 多命令执行分隔; |
| 28 | 多命令执行&& |
| 29 | 多命令执行|| |
| 30 | 反引号优先级 |
| 31 | 绕过注释# |
| 32 | 绕过空格\t |
| 33 | 绕过空格$IFS |
| 34 | 绕过空格${IFS} |
| 35 | 绕过空格bash{,} |
| 36 | 绕过黑名单关键字 ' |
| 37 | 绕过黑名单关键字 " |
| 38 | 绕过黑名单关键字 ? |
| 39 | 绕过黑名单关键字 * |
| 40 | 绕过黑名单关键字 \ |
| 41 | 绕过黑名单关键字 . |
| 42 | 无回显RCE  |

## 部署

### docker


```bash
docker pull the0n3/rce-labs:latest
docker run -d -p 8080:80 the0n3/rce-labs
```

访问8080

### docker compose

```bash
git clone https://github.com/Apursuit/rce-labs.git
cd rce-labs/docker
docker-compose up -d
```

访问8080

## 最后

🎉恭喜您完成了本靶场挑战！推荐阅读的一些资源

- [提问的智慧](https://the0n3.top/pages/3d073e/)
- [入门综述](https://xp0int-team.feishu.cn/wiki/wikcnnWbXXGELt1xHkyBhvdQKrh)
- [《上海交通大学生存手册》](http://www.houxiaodi.com/assets/misc/manual.pdf)
