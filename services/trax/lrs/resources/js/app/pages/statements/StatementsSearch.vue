<template>
    <card class="spaced typo">
        
        <h2 class="text-white">
            {{ $t('common.filters') }}

            <a href="#"
                class="nav-link float-right p-0" 
                data-toggle="modal"
                data-target="#helpModal"
            >
                <i class="tim-icons icon-support"></i>
            </a>
        </h2>

        <form @submit.prevent @keydown="filters.errors.clear($event.target.name)">

            <div class="form-row mt-2">

                <label class="col-md-1 col-form-label text-md-right text-left pb-0">
                    {{ $t('xapi.common.actor') }}
                </label>

                <base-input class="col-md-5"
                    :placeholder="$t('xapi.statements.search.actor-placeholder')"
                    v-model="filters.actor"
                    name="actor"
                    :error="filters.errors.get('actor')">
                </base-input>

                <label class="col-md-1 col-form-label text-md-right text-left pb-0">
                    {{ $t('xapi.common.verb') }}
                </label>

                <base-input class="col-md-5"
                    :placeholder="$t('xapi.statements.search.verb-placeholder')"
                    v-model="filters.verb"
                    name="verb"
                    :error="filters.errors.get('verb')">
                </base-input>
            </div>

            <div class="form-row">

                <label class="col-md-1 col-form-label text-md-right text-left pb-0">
                    {{ $t('xapi.common.object') }}
                </label>

                <base-input class="col-md-5"
                    :placeholder="$t('xapi.statements.search.object-placeholder')"
                    v-model="filters.object"
                    name="object"
                    :error="filters.errors.get('object')">
                </base-input>

                <label class="col-md-1 col-form-label text-md-right text-left pb-0">
                    {{ $t('xapi.common.context') }}
                </label>

                <base-input class="col-md-5"
                    :placeholder="$t('xapi.statements.search.context-placeholder')"
                    v-model="filters.context"
                    name="context"
                    :error="filters.errors.get('context')">
                </base-input>
            </div>

            <div class="form-row">

                <label class="col-md-1 col-form-label text-md-right text-left pb-0">
                    {{ $t('xapi.statements.search.from') }}
                </label>

                <base-input class="col-md-5"
                    :placeholder="$t('xapi.statements.search.from-placeholder')"
                    v-model="filters.from"
                    name="from"
                    :error="filters.errors.get('from')">
                </base-input>

                <label class="col-md-1 col-form-label text-md-right text-left pb-0">
                    {{ $t('xapi.statements.search.to') }}
                </label>

                <base-input class="col-md-5"
                    :placeholder="$t('xapi.statements.search.to-placeholder')"
                    v-model="filters.to"
                    name="to"
                    :error="filters.errors.get('to')">
                </base-input>
            </div>

            <div class="form-row">
                <base-checkbox class="col-md-5 offset-md-1 mt-0" v-model="filters.chronological">
                    {{ $t('xapi.statements.search.chronological') }}
                </base-checkbox>
            </div>

            <div class="text-center pt-1">
                <base-button type="primary" native-type="submit" @click="apply">
                    {{ $t('common.apply') }}
                </base-button>

                <base-button type="primary" native-type="submit" link @click="reset">
                    {{ $t('common.reset') }}
                </base-button>
            </div>

        </form>

        <modal id="helpModal" :title="$t('common.filters')" size="lg">
            <help-filters></help-filters>
        </modal>
    </card>
</template>

<script>
    import HelpFilters from '@lrs/js/app/contents/help/HelpFilters';

    export default {

        components: {
            HelpFilters
        },

        data() {
            return {
                loader: this.$xapi.loaders.statements,
                filters: this.$xapi.filters.statements,
            }
        },

        created() {
            this.$xapi.filters.statements.attach(this)
        },

        methods: {

            apply() {
                this.loader.firstLoad()
            },

            reset() {
                this.filters.reset()
                this.loader.firstLoad()
            }
        }
    }
</script>
