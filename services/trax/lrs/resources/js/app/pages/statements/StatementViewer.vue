<template>
    <pre id="statement-viewer" v-highlightjs="statementString">
        <code class="json"></code>
    </pre>
</template>

<script>
    export default {

        props: ['statement'],

        computed: {
            statementString() {
                return JSON.stringify(this.statement, null, 4);
            }
        }
    }
</script>

<style scoped>

    pre {
        margin-top: -30px;
    }
    pre, code, pre code {
        font-size: 0.85rem;
    }
    #statement-viewer >>> .hljs {
        background-color: transparent;
    }
    #statement-viewer >>> .hljs-attr {
        color: white;
    }
    #statement-viewer >>> .hljs-string {
        color: #62b1ff;
    }
    #statement-viewer >>> .hljs-number {
        color: #e14eca;
    }
    #statement-viewer >>> .hljs-literal {
        color: #ff8d72;
    }

</style>