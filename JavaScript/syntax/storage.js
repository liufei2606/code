window.localStorage.setItem('foo', 'a');
window.localStorage.setItem('bar', 'b');
window.localStorage.setItem('baz', 'c');
window.sessionStorage.setItem('key', 'value');

window.localStorage.length // 3

window.sessionStorage.getItem('key')
window.localStorage.getItem('key')

sessionStorage.removeItem('key');
localStorage.removeItem('key');

window.sessionStorage.clear()
window.localStorage.clear()

window.sessionStorage.key(0) // "key"


function onStorageChange(e) {
	console.log(e.key);
}
window.addEventListener('storage', onStorageChange);
