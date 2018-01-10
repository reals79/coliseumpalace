<template>
    <div>
        <h5>Общая информация</h5>
        <hr class="m-0">
        <div class="row mt-3">
            <div class="col-xl-12 col-lg-12 col-12">
                <div class="row">
                    <div class="col-sm-4 col-12" v-if="user.total_amount_debt > 0">
                        <div class="bg-white top-cards">
                            <div class="row px-3">
                                <div class="col-lg-12 d-flex pt-2">
                                    <div class="number-val text-danger animation-pulse">
                                        <i-count-up v-if="user.total_amount_debt"
                                          :start="0"
                                          :end="12312"
                                          :options="user.total_amount_debt"
                                        ></i-count-up>
                                    </div>
                                    <div class="ml-auto">
                                        <i class="fa fa-eur fa-2x text-primary" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-3">
                                <div class="col-lg-12">
                                    <div class="card-description">Просроченный платёж</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-12">
                        <div class="bg-white top-cards">
                            <div class="row px-3">
                                <div class="col-lg-12 d-flex pt-2">
                                    <div class="number-val text-primary">
                                        <i-count-up v-if="user.pay_at"
                                          :start="0"
                                          :end="user.pay_at"
                                          :options="options"
                                        ></i-count-up>
                                    </div>
                                    <div class="ml-auto">
                                        <i class="fa fa-eur fa-2x text-primary" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-3">
                                <div class="col-lg-12">
                                    <div class="card-description">Текущий платёж</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-12">
                        <div id="block-period_pay" class="bg-white top-cards">
                            <div class="row px-3">
                                <div class="col-lg-12 d-flex pt-2">
                                    <div class="number-val text-info">
                                        <i-count-up
                                          :start="0"
                                          :end="0"
                                          :options="options"
                                        ></i-count-up>
                                    </div>
                                    <div class="ml-auto">
                                        <i class="fa fa-eur fa-2x text-info" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-3">
                                <div class="col-lg-12">
                                    <div class="card-description">Сумма к оплате</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-4 col-12">
                        <div id="block-period_pay" class="bg-white top-cards">
                            <div class="row px-3">
                                <div class="col-lg-12 d-flex pt-2">
                                    <div class="number-val text-warning" :class="{'animation-pulse text-danger': pay_at.diff >= -5}">{{ pay_at.when_at }}</div>
                                    <div class="ml-auto">
                                        <i class="fa fa-calendar fa-2x text-warning" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-3">
                                <div class="col-lg-12">
                                    <div class="card-description">Срок оплаты</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-12"></div>
                    <div class="col-sm-4 col-12">
                        <div id="block-period_pay" class="bg-white top-cards">
                            <div class="row px-3">
                                <div class="col-lg-12 d-flex pt-2">
                                    <div class="card-description text-success">Курс валют
                                        <div class="small text-secondary">на 30.10.2017</div>
                                    </div>
                                    <div class="ml-auto">
                                        <i class="fa fa-bar-chart fa-2x text-success" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-3 data-rate">
                                <div class="col-3 text-center">
                                    <div>USD</div>
                                    <span class="flag-icon flag-icon-us flag-icon-squared my-2"></span>
                                    <div>17.27</div>
                                </div>
                                <div class="col-3 text-center">
                                    <div>EUR</div>
                                    <span class="flag-icon flag-icon-eu flag-icon-squared my-2"></span>
                                    <div>20.08</div>
                                </div>
                                <div class="col-3 text-center">
                                    <div>RUB</div>
                                    <span class="flag-icon flag-icon-ru flag-icon-squared my-2"></span>
                                    <div>0.29</div>
                                </div>
                                <div class="col-3 text-center">
                                    <div>RON</div>
                                    <span class="flag-icon flag-icon-ro flag-icon-squared my-2"></span>
                                    <div>4.36</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Events  from '../event.js';
    import ICountUp from 'vue-countup-v2';
    import moment from 'moment';

    export default {
        data() {
            return {
                options: {
                    useEasing: true,
                    useGrouping: true,
                    separator: ',',
                    decimal: '.',
                    prefix: '',
                    suffix: ''
                },
                user: {}
            }
        },
        computed: {
            pay_at() {
                var nm = moment().date(10).hour(23);
                var cr = moment();
                if (cr > nm)
                    nm.add(1, 'months');

                return {when_at: nm.format('DD.MM.YYYY'), diff: cr.diff(nm, 'days')};
            }
        },
        mounted() {
            if (this.$root.$data.user)
                this.user = this.$root.$data.user;
            Events.$on('data-user-loaded', function(user) {
                this.user = user;
            }.bind(this))
        },
        components: { ICountUp }
    }

</script>
