<template>
    <side-bar>
        <template slot="links">
            <sidebar-link to="/lrs/home" :name="$t('xapi.common.statements')" icon="tim-icons icon-search"/>
            <sidebar-link to="/lrs/clients" :name="$t('common.clients')" icon="tim-icons icon-plug-2"/>
            <sidebar-link to="/lrs/settings" :name="$t('common.settings')" icon="tim-icons icon-settings"/>
        </template>
    </side-bar>
</template>

<script>
    export default {
    }
</script>
