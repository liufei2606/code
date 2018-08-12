import 'regenerator-runtime/rumtime'
const routes = {
    '/foo': () =>
        import ('./views/foo'),
    '/bar.do': () =>
        import ('./views/bar.do')
}

class Router {

    async load(path) {
        if (path === '/') {
            path = '/foo'
        }

        const View = (await routes[path]()).default

        const view = new View()
        view.mount(document.body)
    }

}

export default new Router()