FROM node:12
RUN mkdir -p /app/{public,Modules/Admin}

# yarn (web)
COPY ./src/package.json ./src/webpack.mix.js ./src/yarn.lock /app/
COPY ./src/resources/assets/ /app/resources/assets/
WORKDIR /app
RUN yarn install && yarn production

# yarn (admin)
# COPY ./src/Modules/Admin/package.json ./src/Modules/Admin/webpack.mix.js ./src/Modules/Admin/yarn.lock /app/Modules/Admin/
# COPY ./src/Modules/Admin/resources/assets/ /app/Modules/Admin/resources/assets/
# WORKDIR /app/Modules/Admin
# RUN yarn install && yarn production
