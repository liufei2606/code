/*!
** by zhangxinxu(.com)
** ä¸ŽHTML5 videoè§†é¢‘çœŸå®žäº¤äº’çš„å¼¹å¹•æ•ˆæžœ
** http://www.zhangxinxu.com/wordpress/?p=6386
** MIT License
** ä¿ç•™ç‰ˆæƒç”³æ˜Ž
*/
var CanvasBarrage = function (canvas, video, options) {
    if (!canvas || !video) {
        return;
    }
    var defaults = {
        opacity: 100,
        fontSize: 24,
        speed: 2,
        range: [0, 1],
        color: 'white',
        data: []
    };

    options = options || {};

    var params = {};
    // å‚æ•°åˆå¹¶
    for (var key in defaults) {
        if (options[key]) {
            params[key] = options[key];
        } else {
            params[key] = defaults[key];
        }

        this[key] = params[key];
    }
    var top = this;
    var data = top.data;

    if (!data || !data.length) {
        return;
    }

    var context = canvas.getContext('2d');
    canvas.width = canvas.clientWidth;
    canvas.height = canvas.clientHeight;

    // å­˜å‚¨å®žä¾‹
    var store = {};

    // æš‚åœä¸Žå¦
    var isPause = true;
    // æ’­æ”¾æ—¶é•¿
    var time = video.currentTime;

    // å­—å·å¤§å°
    var fontSize = 28;

    // å®žä¾‹æ–¹æ³•
    var Barrage = function (obj) {
        // ä¸€äº›å˜é‡å‚æ•°
        this.value = obj.value;
        this.time = obj.time;
        // dataä¸­çš„å¯ä»¥è¦†ç›–å…¨å±€çš„è®¾ç½®
        this.init = function () {
            // 1. é€Ÿåº¦
            var speed = top.speed;
            if (obj.hasOwnProperty('speed')) {
                speed = obj.speed;
            }
            if (speed !== 0) {
                // éšç€å­—æ•°ä¸åŒï¼Œé€Ÿåº¦ä¼šæœ‰å¾®è°ƒ
                speed = speed + obj.value.length / 100;
            }
            // 2. å­—å·å¤§å°
            var fontSize = obj.fontSize || top.fontSize;

            // 3. æ–‡å­—é¢œè‰²
            var color = obj.color || top.color;
            // è½¬æ¢æˆrgbé¢œè‰²
            color = (function () {
                var div = document.createElement('div');
                div.style.backgroundColor = color;
                document.body.appendChild(div);
                var c = window.getComputedStyle(div).backgroundColor;
                document.body.removeChild(div);
                return c;
            })();

            // 4. rangeèŒƒå›´
            var range = obj.range || top.range;
            // 5. é€æ˜Žåº¦
            var opacity = obj.opacity || top.opacity;
            opacity = opacity / 100;

            // è®¡ç®—å‡ºå†…å®¹é•¿åº¦
            var span = document.createElement('span');
            span.style.position = 'absolute';
            span.style.whiteSpace = 'nowrap';
            span.style.font = 'bold ' + fontSize + 'px "microsoft yahei", sans-serif';
            span.innerText = obj.value;
            span.textcontext = obj.value;
            document.body.appendChild(span);
            // æ±‚å¾—æ–‡å­—å†…å®¹å®½åº¦
            this.width = span.clientWidth;
            // ç§»é™¤domå…ƒç´
            document.body.removeChild(span);

            // åˆå§‹æ°´å¹³ä½ç½®å’Œåž‚ç›´ä½ç½®
            this.x = canvas.width;
            if (speed == 0) {
                this.x = (this.x - this.width) / 2;
            }
            this.actualX = canvas.width;
            this.y = range[0] * canvas.height + (range[1] - range[0]) * canvas.height * Math.random();
            if (this.y < fontSize) {
                this.y = fontSize;
            } else if (this.y > canvas.height - fontSize) {
                this.y = canvas.height - fontSize;
            }

            this.moveX = speed;
            this.opacity = opacity;
            this.color = color;
            this.range = range;
            this.fontSize = fontSize;
        };

        this.draw = function () {
            // æ ¹æ®æ­¤æ—¶xä½ç½®ç»˜åˆ¶æ–‡æœ¬
            context.shadowColor = 'rgba(0,0,0,' + this.opacity + ')';
            context.shadowBlur = 2;
            context.font = this.fontSize + 'px "microsoft yahei", sans-serif';
            if (/rgb\(/.test(this.color)) {
                context.fillStyle = 'rgba(' + this.color.split('(')[1].split(')')[0] + ',' + this.opacity + ')';
            } else {
                context.fillStyle = this.color;
            }
            // å¡«è‰²
            context.fillText(this.value, this.x, this.y);
        };
    };

    data.forEach(function (obj, index) {
        store[index] = new Barrage(obj);
    });

    // ç»˜åˆ¶å¼¹å¹•æ–‡æœ¬
    var draw = function () {
        for (var index in store) {
            var barrage = store[index];

            if (barrage && !barrage.disabled && time >= barrage.time) {
                if (!barrage.inited) {
                    barrage.init();
                    barrage.inited = true;
                }
                barrage.x -= barrage.moveX;
                if (barrage.moveX == 0) {
                    // ä¸åŠ¨çš„å¼¹å¹•
                    barrage.actualX -= top.speed;
                } else {
                    barrage.actualX = barrage.x;
                }
                // ç§»å‡ºå±å¹•
                if (barrage.actualX < -1 * barrage.width) {
                    // ä¸‹é¢è¿™è¡Œç»™speedä¸º0çš„å¼¹å¹•
                    barrage.x = barrage.actualX;
                    // è¯¥å¼¹å¹•ä¸è¿åŠ¨
                    barrage.disabled = true;
                }
                // æ ¹æ®æ–°ä½ç½®ç»˜åˆ¶åœ†åœˆåœˆ
                barrage.draw();
            }
        }
    };

    // ç”»å¸ƒæ¸²æŸ“
    var render = function () {
        // æ›´æ–°å·²ç»æ’­æ”¾æ—¶é—´
        time = video.currentTime;
        // æ¸…é™¤ç”»å¸ƒ
        context.clearRect(0, 0, canvas.width, canvas.height);

        // ç»˜åˆ¶ç”»å¸ƒ
        draw();

        // ç»§ç»­æ¸²æŸ“
        if (isPause == false) {
            requestAnimationFrame(render);
        }
    };

    // è§†é¢‘å¤„ç†
    video.addEventListener('play', function () {
        isPause = false;
        render();
    });
    video.addEventListener('pause', function () {
        isPause = true;
    });
    video.addEventListener('seeked', function () {
        // è·³è½¬æ’­æ”¾éœ€è¦æ¸…å±
        top.reset();
    });


    // æ·»åŠ æ•°æ®çš„æ–¹æ³•
    this.add = function (obj) {
        store[Object.keys(store).length] = new Barrage(obj);
    };

    // é‡ç½®
    this.reset = function () {
        time = video.currentTime;
        // ç”»å¸ƒæ¸…é™¤
        context.clearRect(0, 0, canvas.width, canvas.height);

        for (var index in store) {
            var barrage = store[index];
            if (barrage) {
                // çŠ¶æ€å˜åŒ–
                barrage.disabled = false;
                // æ ¹æ®æ—¶é—´åˆ¤æ–­å“ªäº›å¯ä»¥èµ°èµ·
                if (time < barrage.time) {
                    // è§†é¢‘æ—¶é—´å°äºŽæ’­æ”¾æ—¶é—´
                    // barrage.disabled = true;
                    barrage.inited = null;
                } else {
                    // è§†é¢‘æ—¶é—´å¤§äºŽæ’­æ”¾æ—¶é—´
                    barrage.disabled = true;
                }
            }
        }
    };
};