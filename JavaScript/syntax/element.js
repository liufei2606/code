var foo = document.getElementById('foo');

// 添加class
foo.className += 'bold';
foo.classList.add('bold');

// 删除class
foo.classList.remove('bold');
foo.className = foo.className.replace(/^bold$/, '');

// 视口高度
document.documentElement.clientHeight

// 网页总高度
document.body.clientHeight

