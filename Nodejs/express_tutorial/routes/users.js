const express = require('express');
const router = express.Router();
const fs = require('fs');

//  /del_user 页面响应
router.get('/del_user', function (req, res) {
	console.log("/del_user 响应 DELETE 请求");
	res.send('删除页面');
})

router.get('/', function (req, res) {

	console.log("/list_user GET 请求");
	fs.readFile(__dirname + "/../data/" + "users.json", 'utf8', function (err, data) {
		console.log(JSON.parse(data));
		res.render('users', { 'title': '用户列表页面', 'data': JSON.parse(data) });
	});
})

module.exports = router;
