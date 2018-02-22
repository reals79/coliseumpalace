<template>
    <div>
        <h5>{{ $t('account.menu.settings') }}</h5>
        <hr class="m-0">
        <div class="container mt-2">
            <div class="alert alert-success fade show" role="alert" v-if="alert">
                {{ $t('account.data_saved') }}
            </div>
            <form @submit="settings_save">
                <div class="row">
                    <div class="col-sm-12 form-check">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" id="notify_email" name="notify_email" v-model="settings.notify_is_email" class="custom-control-input">
                            <label class="custom-control-label" for="notify_email">{{ $t('account.notify_email') }}</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 form-check">
                        <label class="custom-control custom-checkbox mt-2">
                            <input type="checkbox" id="notify_sms" name="notify_sms" v-model="settings.notify_is_sms" class="custom-control-input">
                            <label class="custom-control-label" for="notify_sms">{{ $t('account.notify_sms') }}</label>
                        </label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary float-right">{{ $t('account.buttons.save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    const SETTINGS = {
        notify_is_email: false,
        notify_is_sms: false,
    }

    export default {
        data() {
            return {
                settings: SETTINGS,
                alert: false
            }
        },
        methods: {
            settings_save(e) {
                e.preventDefault()
                this.alert = false
                axios.post(
                    '/api/settings/save',
                    this.settings
                ).then(response => {
                    this.alert = true
                }, response => {
                    
                })
            }
        },
        mounted() {
            axios.get(
                '/api/settings'
            ).then(response => {
                this.settings.notify_is_email = response.data.notify_is_email;
                this.settings.notify_is_sms = response.data.notify_is_sms;
            }, response => {
                
            })
        }
    }
</script>
