<template>
    <div class="row">
        <div class="col">
            <statements-search></statements-search>
            <statements-result></statements-result>
            <back-to-top></back-to-top>
        </div>
    </div>
</template>

<script>
    import StatementsSearch from './statements/StatementsSearch';
    import StatementsResult from './statements/StatementsResult';

    export default {
    
        components: {
            StatementsSearch, StatementsResult
        }
    }
</script>
