
export default {

    install(Vue) {

        // FROM BLACK DASHBOARD.

        // Plugins.        
        Vue.use(require('@tim/black/src/components/NotificationPlugin').default);

        // Directives.
        Vue.directive('click-outside', require('@tim/black/src/directives/click-ouside.js').default);

        // Components.
        Vue.component('base-alert', require('@tim/black/src/components/BaseAlert.vue').default);
        Vue.component('base-button', require('@tim/black/src/components/BaseButton.vue').default);
        Vue.component('card', require('@tim/black/src/components/Cards/Card.vue').default);
        Vue.component('base-dropdown', require('@tim/black/src/components/BaseDropdown.vue').default);
        Vue.component('base-checkbox', require('@tim/black/src/components/BaseCheckbox.vue').default);
        Vue.component('base-radio', require('@tim/black/src/components/BaseRadio.vue').default);
        Vue.component('base-table', require('@tim/black/src/components/BaseTable.vue').default);

                
        // LOCAL COMPONENTS.

        // Base components.
        Vue.component('base-input', require('./app/components/Inputs/BaseInput.vue').default);
        Vue.component('modal', require('./app/components/Modal.vue').default);
        Vue.component('modal-confirm', require('./app/components/ModalConfirm.vue').default);
        Vue.component('back-to-top', require('./app/components/BackToTop.vue').default);

        // Content components.
        Vue.component('brand', require('./app/contents/Brand.vue').default);
        Vue.component('brand-footer', require('./app/contents/BrandFooter.vue').default);

    }
}
