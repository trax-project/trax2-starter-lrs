import ToggleState from '@trax/classes/ToggleState'

export default {

    install(Vue) {
        let app = new Vue({
            data: {
                topbarState: new ToggleState()
            }
        });
        Vue.prototype.$topbar = app.topbarState;
    }
}
