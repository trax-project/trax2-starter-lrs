<template>
    <side-bar>
        <template slot="links">
            <sidebar-link to="/lrs/home" :name="$t('xapi.common.statements')" icon="tim-icons icon-search"/>
            <sidebar-link to="/lrs/clients" :name="$t('common.clients')" icon="tim-icons icon-plug-2"
                v-if="$auth.hasPermission('client.manage')"
            />
            <sidebar-link to="/lrs/settings" :name="$t('common.settings')" icon="tim-icons icon-settings"
                v-if="$auth.hasPermission('xapi-extra.manage')"
            />
        </template>
    </side-bar>
</template>

<script>
    export default {
    }
</script>
