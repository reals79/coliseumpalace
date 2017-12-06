<template>
    <div>
        <div id="register-step-1" v-if="step === 1">
            <form @submit="check_idno" role="form">
                <div class="form-group">
                    <input type="text" class="form-control" :class="{ 'is-invalid': error && response.idno }" id="idno" name="idno" v-model.number="idno" title="IDNO номер" placeholder="IDNO номер" required autofocus>
                    <div class="invalid-feedback" v-if="error && response.idno">{{ response.idno }}</div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" :class="{ 'is-invalid': error && response.verify_code }" id="verify_code" name="verify_code" v-model="verify_code" title="Проверочный код" placeholder="Проверочный код" required>
                    <div class="invalid-feedback" v-if="error && response.verify_code">{{ response.verify_code }}</div>
                    <small class="form-text">
                        <strong>Проверочный код формируется следующим образом (пр. GO093032):</strong>
                        <ul>
                            <li>GO – первые буквы фамилии и имени (пр. Gitu Oxana – необходимо ввести заглавными буквами GO)</li>
                            <li>093032 – последние 6 цифр идентификационного номера (пр. 2001002093032 – 093032)</li>
                        </ul>
                    </small>
                </div>
                <button type="submit" class="btn btn-primary float-right">Далее &gt;</button>
            </form>
        </div>
        <div id="register-step-1" v-if="step === 2">
            <form @submit="register" role="form">
                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" v-model="password" title="Пароль" placeholder="Пароль" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" :class="{ 'is-invalid': error }" id="password_confirmation" name="password_confirmation" v-model="password_confirmation" title="Подтверждение пароля" placeholder="Подтверждение пароля" required>
                    <div class="invalid-feedback" v-if="error">Пароль не совпадает с подтверждением.</div>
                </div>
                <button type="submit" class="btn btn-primary float-right">Сохранить</button>
            </form>
        </div>
        <div id="register-step-1" v-if="step === 3">
            <h4 class="text-primary">Регистрация успешно выполнена!</h4>
            <p class="lead">Теперь Вы можете авторизоваться в <a href="/">My Coliseum</a> используя Ваш IDNO и установленный пароль.</p>
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
