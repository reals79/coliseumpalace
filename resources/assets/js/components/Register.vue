<template>
    <div>
        <div id="register-step-1" v-if="step === 1">
            <form @submit="check_idno" role="form">
                <div class="form-group">
                    <input type="text" class="form-control" :class="{ 'is-invalid': error && response.idno }" id="idno" name="idno" v-model="idno" :placeholder="$t('account.idno_number')" required autofocus>
                    <div class="invalid-feedback" v-if="error && response.idno">{{ response.idno }}</div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" :class="{ 'is-invalid': error && response.verify_code }" id="verify_code" name="verify_code" v-model="verify_code" :placeholder="$t('account.code_verify')" required>
                    <div class="invalid-feedback" v-if="error && response.verify_code">{{ response.verify_code }}</div>
                    <small class="form-text">
                        <strong>{{ $t('account.text_1') }}</strong>
                        <ul>
                            <li>{{ $t('account.text_2') }}</li>
                            <li>{{ $t('account.text_3') }}</li>
                        </ul>
                    </small>
                </div>
                <button type="submit" class="btn btn-primary float-right">{{ $t('app.buttons.more') }}</button>
            </form>
        </div>
        <div id="register-step-1" v-if="step === 2">
            <form @submit="register" role="form">
                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" v-model="password" :title="$t('account.password')" :placeholder="$t('account.password')" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" :class="{ 'is-invalid': error }" id="password_confirmation" name="password_confirmation" v-model="password_confirmation" :title="$t('account.password_confirm')" :placeholder="$t('account.password_confirm')" required>
                    <div class="invalid-feedback" v-if="error">{{ $t('account.password_dont_match') }}</div>
                </div>
                <button type="submit" class="btn btn-primary float-right">{{ $t('account.buttons.save') }}</button>
            </form>
        </div>
        <div id="register-step-1" v-if="step === 3">
            <h4 class="text-primary">{{ $t('account.registration_success') }}</h4>
            <p class="lead" v-html="$t('account.text_4', {link: 'http://my.coliseumpalace.md'})"></p>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                step: 1,
                idno: null,
                password: null,
                password_confirmation: null,
                verify_code: null,
                error: false,
                response: null
            }
        },
        methods: {
            check_idno(e) {
                e.preventDefault()

                this.error = false

                axios.post(
                    '/api/check-idno',
                    {
                        idno: this.idno,
                        verify_code: this.verify_code
                    }
                ).then(response => {
                    this.response = response.data;
                    if (this.response.error)
                        this.error = this.response.error;
                    else {
                        this.step++;
                    }
                }, response => {
                    
                })

            },
            register(e) {
                e.preventDefault()

                this.error = false

                if (this.password != this.password_confirmation) {
                    this.error = true
                    return
                }

                if (this.response.user_id) {
                    axios.post(
                        '/api/register/' + this.response.user_id,
                        {
                            password: this.password
                        }
                    ).then(response => {
                        this.response = response.data;
                        if (this.response.error)
                            this.error = this.response.error;
                        else {
                            this.step++;
                        }
                    }, response => {
                        
                    })
                }
            }
        }
    }
</script>
