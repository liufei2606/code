# my-app

* npm start 前端处于实时刷线模式
* docker:以当时 npm run build 生成的镜像文件打包，是个静态资源

## Project setup
```
pnpm install
```

### Compiles and hot-reloads for development

```
pnpm run serve
```

### Compiles and minifies for production
```
pnpm run build
```

### Lints and fixes files
```
pnpm run lint
```

## 运行

```sh
# 本地安装
npm install
# 构建production
npm run build
#本地运行
npm start

docker build -t bluebird89/vue_nginx .
# 运行docker
docker run -p 8081:8081 bluebird89/vue_nginx
```

### Customize configuration

See [Configuration Reference](https://cli.vuejs.org/config/).
