<template>
    <card class="clients-crud col-12" v-show="loaded">

        <base-table :data="ctrl.rows" :columns="columns" v-if="ctrl.rows.length">

            <template slot="columns">
                <th>{{ $t('common.name') }}</th>
                <th>{{ $t('common.username') }}</th>
                <th>{{  $t('common.password') }}</th>
                <th></th>
            </template>

            <template slot-scope="{row}">
                <td>
                    {{row.name}}
                </td>
                <td>
                    {{row.access.credentials.username}}
                </td>
                <td>
                    {{row.access.credentials.password}}
                </td>
                <td class="td-actions text-right">

                    <base-button icon link size="md" type="info" @click="showInfo(row)">
                        <i class="tim-icons icon-c-info"></i>
                    </base-button>

                    <base-button icon link size="md" type="warning" @click="ctrl.update(row.id)">
                        <i class="tim-icons icon-pencil"></i>
                    </base-button>

                    <base-button icon link size="md" type="danger" @click="ctrl.delete(row.id)">
                        <i class="tim-icons icon-simple-remove"></i>
                    </base-button>

                </td>
            </template>

        </base-table>

        <p class="text-center py-3" v-else>{{ $t('clients.no-client') }}</p>
                
        <div class="text-center pb-3">
            <base-button type="primary" @click="ctrl.create()">
                {{ $t('clients.new') }}
            </base-button>
        </div>

        <portal to="modals">

            <modal class="no-footer" :title="$t('common.client')" v-model="ctrl.modals.edit" :loading="ctrl.form.loading">
                <client-form v-model="ctrl.form.data" :errors="ctrl.form.errors"></client-form>
            </modal>

            <modal class="short" :title="clientTitle" size="lg" v-model="ctrl.modals.info">
                <client-info :info="info"></client-info>
            </modal>

            <modal-confirm v-model="ctrl.modals.confirmDelete">
                <p>{{ $t('clients.delete-confirm') }}</p>
            </modal-confirm>

        </portal>

    </card>
</template>

<script>
    import CrudController from '@trax/classes/CrudController'
    import ClientForm from './ClientForm'
    import ClientInfo from './ClientInfo'

    export default {

        components: {
            ClientForm, ClientInfo
        },

        data() {
            return {
                loaded: false,
                ctrl: new CrudController({
                    endpoint: '/trax/api/front/basic-clients',
                    mapData: this.mapData,
                    unmapData: this.unmapData,
                    modals: ['info']
                }),
                columns: ["name", "username", "password"],
                info: null
            }
        },

        created() {
            this.ctrl.init(this, 'ctrl').then(resp => {
                this.loaded = true
            })
        },

        computed: {

            clientTitle() {
                return this.info ? this.info.name : ''
            }
        },

        methods: {
            
            mapData(client) {
                return {
                    id: client ? client.id : null,
                    name: client ? client.name : null,
                    access: {
                        id: client ? client.access.id : null,
                        credentials: {
                            username: client ? client.access.credentials.username : null,
                            password: client ? client.access.credentials.password : null,
                        },
                    },
                    endpoint: this.clientEndpoint(client),
                }
            },

            unmapData(data) {
                return data
            },

            clientEndpoint(client) {
                return client 
                    ? this.$baseURL + '/trax/api/' + client.access.uuid + '/xapi/std'
                    : null
            },

            showInfo(data) {
                this.info = data
                this.ctrl.modals.open('info')
            }
        }
    }
</script>
