FROM node:17.8-alpine
COPY --chown=node:node . .
WORKDIR /var/www
RUN chown -R node:node /var/www
USER node

