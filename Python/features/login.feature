Feature: UI测试

   Scenario Outline: 登录后台系统
      Given 打开后台登录页面并且通过后台验证
      When 输入<username>和<password>并点击登录
      Then 正确跳转进入系统后台

      Examples: userinfo
         |username       |password|
         |admin          |111111|