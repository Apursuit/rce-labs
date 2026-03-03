FROM php:7.3-fpm-alpine

# 制作者信息
LABEL auther_template="CTF-Archives"

# 安装必要的软件包
RUN echo "http://mirrors.aliyun.com/alpine/v3.15/main" > /etc/apk/repositories && \
    echo "http://mirrors.aliyun.com/alpine/v3.15/community" >> /etc/apk/repositories && \
    echo "http://mirrors.tuna.tsinghua.edu.cn/alpine/v3.15/main" >> /etc/apk/repositories && \
    echo "http://mirrors.tuna.tsinghua.edu.cn/alpine/v3.15/community" >> /etc/apk/repositories && \
    echo "http://mirrors.ustc.edu.cn/alpine/v3.15/main" >> /etc/apk/repositories && \
    echo "http://mirrors.ustc.edu.cn/alpine/v3.15/community" >> /etc/apk/repositories && \
    echo "http://dl-cdn.alpinelinux.org/alpine/v3.15/main" >> /etc/apk/repositories && \
    echo "http://dl-cdn.alpinelinux.org/alpine/v3.15/community" >> /etc/apk/repositories && \
    apk update && \
    apk add --no-cache nginx bash \
    coreutils \
    vim \
    nmap-ncat \
    binutils \
    file \
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