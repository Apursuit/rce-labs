FROM php:7.3-fpm-alpine

# 制作者信息
LABEL auther_template="CTF-Archives"

# 安装必要的软件包
RUN sed -i 's/dl-cdn.alpinelinux.org/mirrors.ustc.edu.cn/g' /etc/apk/repositories  &&\
    apk add --update --no-cache nginx bash \
    # ------ 添加的辅助工具 ------
    # 提供了 base32, base64 等核心工具
    coreutils \
    # 提供了 xxd 命令 (vim-full 或 vim-tools 的一部分)
    vim \
    # 提供了 nc、ncat 命令，支持-e、-c参数
    nmap-ncat \
    # 提供了 strings 命令
    binutils \
    # 提供了 file 命令 
    file \
    # 提供了 uuidgen 命令
    util-linux \
    && rm -rf /var/cache/apk/*

# 拷贝容器入口点脚本
COPY ./service/docker-entrypoint.sh /docker-entrypoint.sh
RUN chmod +x /docker-entrypoint.sh

# 复制nginx配置文件
COPY ./config/nginx.conf /etc/nginx/nginx.conf

# 复制web项目源码
COPY src /var/www/html

# 重新设置源码路径的用户所有权
RUN chown -R www-data:www-data /var/www/html

# 设置shell的工作目录
WORKDIR /var/www/html

EXPOSE 80

# 设置nginx日志保存目录
VOLUME ["/var/log/nginx"]

# 设置容器入口点
ENTRYPOINT [ "/docker-entrypoint.sh" ]