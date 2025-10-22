#!/bin/sh

rm -f /docker-entrypoint.sh

mkdir -p /run/nginx 
touch /run/nginx/nginx.pid

user=$(ls /home)

if command -v uuidgen >/dev/null 2>&1; then
    # 生成一个标准的 UUID，并格式化为 flag{}
    RANDOM_UUID_FLAG="flag{$(uuidgen)}"
else
    RANDOM_UUID_FLAG="flag{$(head /dev/urandom | tr -dc 'a-f0-9' | head -c 32)}"
fi

if [ "$DASFLAG" ]; then
    INSERT_FLAG="$DASFLAG"
elif [ "$FLAG" ]; then
    INSERT_FLAG="$FLAG"
elif [ "$GZCTF_FLAG" ]; then
    INSERT_FLAG="$GZCTF_FLAG"
else
    INSERT_FLAG="$RANDOM_UUID_FLAG"
fi

export DASFLAG=no_FLAG
export FLAG=no_FLAG
export GZCTF_FLAG=no_FLAG
DASFLAG=no_FLAG
FLAG=no_FLAG
GZCTF_FLAG=no_FLAG

echo "$INSERT_FLAG" | tee /flag

echo "Find the hope in the unexpected. Find the courage in the challenge. Find your vision on the solitary road." | tee /tmp/findme.txt

chmod 744 /flag

php-fpm & nginx &

echo "Running with dynamic flag: $INSERT_FLAG"

tail -F /var/log/nginx/access.log /var/log/nginx/error.log