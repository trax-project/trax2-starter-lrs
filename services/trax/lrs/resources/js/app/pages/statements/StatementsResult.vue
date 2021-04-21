<template>
    <div>
        <p class="loading text-center pt-5" v-if="loader.firstLoading">
            <i class="fas fa-spinner fa-spin" style="font-size:2rem"></i>
        </p>

        <div v-else>
            <div v-if="loader.rows.length">

                <base-table type="hover" :data="loader.rows" :columns="columns">

                    <template slot="columns">
                        <th width="50px"></th>
                        <th width="100px">{{ $t('xapi.common.stored') }}</th>
                        <th>{{ $t('xapi.common.actor') }}</th>
                        <th>{{ $t('xapi.common.verb') }}</th>
                        <th>{{ $t('xapi.common.object') }}</th>
                        <th class="text-center">. . .</th>
                    </template>

                    <template slot-scope="{row}">

                        <td @mouseover="hovered=row.index" 
                            @mouseleave="hovered=null" 
                            @click="openStatement(row)" 
                            class="td-actions"
                        >
                            <div class="index text-warning">
                                {{row.index}}
                            </div>
                        </td>

                        <td @mouseover="hovered=row.index" 
                            @mouseleave="hovered=null" 
                            @click="openStatement(row)"
                        >
                            {{row.stored.date}}
                            <br><small class="spaced">{{ row.stored.time }}</small>
                        </td>

                        <td @mouseover="hovered=row.index" 
                            @mouseleave="hovered=null" 
                            @click="openStatement(row)"
                        >
                            <i :class="'tim-icons text-info-light mr-1 '+row.actor.icon"></i>
                            {{row.actor.name}}
                            <div v-if="row.actor.more"><small>{{ row.actor.more }}</small></div>
                            <div v-if="row.actor.more2"><small>{{ row.actor.more2 }}</small></div>
                        </td>

                        <td @mouseover="hovered=row.index" @mouseleave="hovered=null" @click="openStatement(row)">
                            {{row.verb.keyword}}
                            <div><small>{{ row.verb.domain }}</small></div>
                        </td>

                        <td @mouseover="hovered=row.index" 
                            @mouseleave="hovered=null"
                            @click="openStatement(row)"
                        >
                            <i :class="'tim-icons text-info-light mr-1 '+row.object.icon"></i>
                            {{row.object.name}}
                            <div v-if="row.object.more"><small>{{ row.object.more }}</small></div>
                            <div v-if="row.object.more2"><small>{{ row.object.more2 }}</small></div>
                        </td>

                        <td class="text-center" 
                            @mouseover="hovered=row.index"
                            @mouseleave="hovered=null"
                            @click="openStatement(row)"
                        >
                            <i v-if="row.hasResult" class="tim-icons text-info-light icon-check-single ml-1"></i>
                            <i v-if="row.hasContextActivities" class="tim-icons text-info-light icon-app ml-1"></i>
                            <i v-if="row.hasInstructor" class="tim-icons text-info-light icon-single-02 ml-1"></i>
                            <i v-if="row.hasTeam" class="tim-icons text-info-light icon-multiple-19 ml-1"></i>
                        </td>

                    </template>

                </base-table>

                <div slot="footer" class="text-center mt-3" v-if="loader.hasMore()">
                    <base-button round type="primary" :loading="loader.nextLoading" @click="loader.nextLoad()">
                        {{ $t('common.load-more') }}
                    </base-button>
                </div>

            </div>
            
            <div v-else>
                <p class="text-center pt-3">{{ $t('xapi.common.search.no-result') }}</p>
            </div>

        </div>

        <portal to="modals">

            <modal class="fullscreen" :title="'#'+index" title-color="warning" v-model="modals.statementViewer">
                <statement-viewer :statement="statement"></statement-viewer>
            </modal>

        </portal>
    </div>
</template>

<script>
    import StatementViewer from './StatementViewer'
    import ModalsController from '@trax/classes/ModalsController'
    import moment from 'moment'

    export default {

        components: {
            StatementViewer
        },

        data() {
            return {
                loader: this.$xapi.loaders.statements,
                filters: this.$xapi.filters.statements,
                modals: new ModalsController('statementViewer'),
                columns: ["stored", "actor", "verb", "object", "other"],
                hovered: null,
                statement: null,
                index: null,
                moment: moment
            }
        },

        created() {
            this.loader.setMapData(this.mapData)
            this.loader.firstLoad()
        },

        methods: {

            mapData(item, index) {
                return {
                    index: index + 1,
                    statement: item.data,
                    stored: this.stored(item.data.stored),
                    actor: this.actor(item.data.actor),
                    verb: this.verb(item.data.verb),
                    object: this.object(item.data.object),
                    hasResult: item.data.result ? true : false,
                    hasContextActivities: item.data.context && item.data.context.contextActivities ? true : false,
                    hasInstructor: item.data.context && item.data.context.instructor ? true : false,
                    hasTeam: item.data.context && item.data.context.team ? true : false,
                }
            },

            stored(stored) {
                let moment = this.moment(stored)
                return {
                    date: moment.format('YYYY-MM-DD'),
                    time: moment.format('HH:mm:ss'),
                }
            },

            actor(actor) {
                let icon = actor.objectType == 'Group' ? 'icon-multiple-19' : 'icon-single-02'
                let name = actor.name ? actor.name : '-------'
                let more = null
                let more2 = null
                if (actor.mbox) {
                    more = String(actor.mbox).substr(7)
                } else if (actor.account) {
                    more = actor.account.name
                    more2 = actor.account.homePage
                }
                return {icon, name, more, more2}
            },

            verb(verb) {
                let segments = String(verb.id).split('/')
                let keyword = segments.pop()
                segments.pop()
                segments.shift()
                segments.shift()
                let domain = segments.join('/')
                return {keyword, domain}
            },

            object(object) {
                if (object.objectType == 'Agent' || object.objectType == 'Group') {
                    return this.actor(object)
                }
                let icon = 'icon-app'
                let name = '-------'
                let more = ''
                let more2 = ''
                if (object.objectType == 'SubStatement') {
                    more = 'Type: SubStatement'
                    icon = 'icon-move-right'
                } else if (object.objectType == 'StatementRef') {
                    more = 'Type: StatementRef'
                    icon = 'icon-move-right'
                } else {
                    let idSegments = String(object.id).split('/')
                    let lastSegment = idSegments.pop()
                    more = 'Id: .../' + lastSegment
                    if (object.definition) {
                        if (object.definition.name) {
                            let keys = Object.keys(object.definition.name)
                            name = object.definition.name[keys.shift()]
                        }
                        if (object.definition.type) {
                            let type = String(object.definition.type).split('/').pop()
                            more2 = 'Type: ' + type
                        }
                    }
                }
                return {icon, name, more, more2}
            },

            openStatement(row) {
                this.statement = row.statement
                this.index = row.index
                this.modals.open('statementViewer')
            }
        }
    }
</script>

<style scoped>

    td:hover {
        cursor: pointer;
    }
    td .index {
        width: 30px;
        height: 30px;
        text-align: center;
        padding-top: 5px;
    }

</style>