<template>
    <div>
        <h5>{{ $t('account.menu.public_service') }}</h5>
        <hr class="m-0">
        <div class="container mt-2">
            

        </div>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                records: null
            }
        },
        methods: {
        },
        mounted() {
            axios.get(
                '/api/services'
            ).then(response => {
                this.records = response.data;
            }, response => {
                
            })
        }
    }
</script>
