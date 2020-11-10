const express = require('express');
const router = express.Router();

/* GET home page. */
router.get('/', function (req, res, next) {
	console.log("主页 GET 请求");
	res.render('index', { title: 'Express' });
});

router.post('/', function (req, res) {
	console.log("主页 POST 请求");
	res.render('Hello POST');
})

// 对页面 abcd, abxcd, ab123cd, 等响应 GET 请求
router.get('/ab*cd', function (req, res) {
	console.log("/ab*cd GET 请求");
	res.render('index', { 'title': '正则匹配' });
})

module.exports = router;
