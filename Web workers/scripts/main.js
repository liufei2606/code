var workerFor = new Worker('../workers/for.js');
// listen to message event of worker
workerFor.addEventListener('message', function(event) {
    var div = document.getElementById('result');
    div.innerHTML = 'message received => ' + event.data;
});
// listen to error event of worker
workerFor.addEventListener('error', function(event) {
    console.error('error received from workerFor => ', event);
});