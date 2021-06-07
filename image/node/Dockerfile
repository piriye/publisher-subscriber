FROM node:12.16-alpine

RUN apk update && apk upgrade && \
    apk add --no-cache bash git curl openssh make python \
    busybox-extras yarn

RUN yarn global add pm2 knex

RUN mkdir -p /home/pangaea-node-subscriber

ADD ./node-src /home/pangaea-node-subscriber

COPY . /home/pangaea-node-subscriber

WORKDIR /home/pangaea-node-subscriber

EXPOSE 4020

ADD ./node-src/docker-entrypoint.sh /usr/local/bin/

RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
