<template>
    <div>
        <h5>Уведомления</h5>
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
                '/api/alerts'
            ).then(response => {
                this.records = response.data;
            }, response => {
                
            })
        }
    }
</script>
