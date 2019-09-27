function setCookie(key, value, attributes) {
    if (typeof document === 'undefined') {
        return
    }
    attributes = Object.assign({}, {
        path: '/'
    }, attributes)

    let { domain, path, expires, secure } = attributes

    if (typeof expires === 'number') {
        expires = new Date(Date.now() + expires * 1000)
    }
    if (expires instanceof Date) {
        expires = expires.toUTCString()
    } else {
        expires = ''
    }

    key = encodeURIComponent(key)
    value = encodeURIComponent(value)

    let cookieStr = `${key}=${value}`

    if (domain) {
        cookieStr += `; domain=${domain}`
    }

    if (path) {
        cookieStr += `; path=${path}`
    }

    if (expires) {
        cookieStr += `; expires=${expires}`
    }

    if (secure) {
        cookieStr += `; secure`
    }

    return (document.cookie = cookieStr)
}

function getCookie(name) {
    if (typeof document === 'undefined') {
        return
    }
    let cookies = []
    let jar = {}
    document.cookie && (cookies = document.cookie.split('; '))

    for (let i = 0, max = cookies.length; i < max; i++) {
        let [key, value] = cookies[i].split('=')
        key = decodeURIComponent(key)
        value = decodeURIComponent(value)
        jar[key] = value
        if (key === name) {
            break
        }
    }

    return name ? jar[name] : jar
}
