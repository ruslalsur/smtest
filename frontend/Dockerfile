FROM node:lts-alpine

WORKDIR /frontend
ENV PATH /frontend/node_modules/.bin:$PATH

COPY package*.json ./

RUN npm install
RUN npm install -g @vue/cli

CMD [ "npm", "run", "serve" ]