<template>
    <div v-if="title">
        <a :href="titleLink" target="_blank">
            <span class="title">{{ title }}</span>
            <span class="subtitle text-primary">{{ subtitle }}</span>
        </a>
    </div>
</template>

<script>
    export default {

        props: {
            title: {
                type: String,
                default: "TRAX LRS"
            },
            subtitle: {
                type: String,
                default: "2.1"
            },
            titleLink: {
                type: String,
                default: "http://traxlrs.com"
            }
        }
    }
</script>

<style scoped>
    .title {
        font-size: 1.5rem;
        font-weight: 400;
        color: rgba(255, 255, 255, 0.9);
    }
    .subtitle {
        font-size: 1.0rem;
        font-weight: 400;
    }
</style>
