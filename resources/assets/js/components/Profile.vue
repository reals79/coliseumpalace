<template>
    <div>
        <h5>{{ $t('account.menu.profile') }}</h5>
        <hr class="m-0">
        <div class="container mt-2">
            <div class="alert alert-success fade show" role="alert" v-if="alert">
                {{ $t('account.data_saved') }}
            </div>
            <form @submit="profile_save">
                <div class="row">
                    <label for="idno" class="col-sm-2 col-form-label">{{ $t('account.idno_number') }}:</label>
                    <div class="col-sm-10">
                      <input type="text" readonly class="form-control-plaintext" id="idno" v-model="user.idno">
                    </div>
                </div>
                <div class="row">
                    <label for="contract" class="col-sm-2 col-form-label">{{ $t('account.contract_number') }}:</label>
                    <div class="col-sm-10">
                      <input type="text" readonly class="form-control-plaintext" id="contract" v-model="user.contract">
                    </div>
                </div>
                <div class="row">
                    <label for="first_name" class="col-sm-2 col-form-label">{{ $t('account.first_name') }}:</label>
                    <div class="col-sm-10">
                      <input type="text" readonly class="form-control-plaintext" id="first_name" v-model="user.first_name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="last_name" class="col-sm-2 col-form-label">{{ $t('account.last_name') }}:</label>
                    <div class="col-sm-10">
                      <input type="text" readonly class="form-control-plaintext" id="last_name" v-model="user.last_name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">{{ $t('account.email') }}:</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="email" v-model="user.email">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label">{{ $t('account.phone') }}:</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="phone" v-model="user.phone">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-7">
                        <button type="submit" class="btn btn-primary float-right">{{ $t('account.buttons.save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    const USER = {
        id: null,
        idno: null,
        contract: null,
        first_name: null,
        last_name: null,
        email: null,
        phone: null,
    }

    export default {
        data() {
            return {
                user: USER,
                alert: false
            }
        },
        methods: {
            profile_save(e) {
                e.preventDefault()
                this.alert = false
                axios.post(
                    '/api/user/save',
                    this.user
                ).then(response => {
                    this.alert = true
                }, response => {
                    
                })
            }
        },
        mounted() {
            axios.get(
                '/api/user'
            ).then(response => {
                this.user = response.data;
            }, response => {
                
            })
        }
    }
</script>
