FROM node:14-alpine

RUN echo http://dl-2.alpinelinux.org/alpine/edge/community/ >> /etc/apk/repositories
RUN apk --no-cache add shadow python

# Use app user
ARG USER_UID=1000
RUN usermod -u $USER_UID node

WORKDIR /var/www

USER node
