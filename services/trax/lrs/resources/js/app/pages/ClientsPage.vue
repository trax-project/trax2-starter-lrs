<template>
    <div class="row">
        <div class="col">
            <clients-crud></clients-crud>
        </div>
    </div>
</template>

<script>
    import ClientsCrud from './clients/ClientsCrud';

    export default {
        components: {
            ClientsCrud
        }
    }
</script>
