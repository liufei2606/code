# Python 教程

* [Python教程](https://www.liaoxuefeng.com/wiki/1016959663602400)
* [Dejango](https://developer.mozilla.org/zh-CN/docs/Learn/Server-side/Django)

## scarpy

* todo: 配置 mongo

```
scrapy crawl douban_spider
scrapy crawl douban_spider -o douban.csv
```

## behave

```
pip install allure-behave
behave -f allure_behave.formatter:AllureFormatter -o report ./features
allure serve report
```