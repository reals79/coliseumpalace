<template>
    <div>
        <h5>{{ $t('account.menu.general_info') }}</h5>
        <hr class="m-0">
        <div class="row mt-3">
            <div class="col-xl-12 col-lg-12 col-12">
                <div class="row" v-if="user.total_amount_sold > 0">
                    <div class="col-sm-6 col-md-3 col-12">
                        <div class="bg-white top-cards">
                            <div class="row px-3">
                                <div class="col-lg-12 d-flex pt-2">
                                    <div class="number-val" :class="{'animation-pulse text-danger': user.total_amount_debt > 0}">
                                        <i-count-up
                                          :start="0"
                                          :end="user.total_amount_debt"
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
                                    <div class="card-description">{{ $t('account.payment_back') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-12">
                        <div class="bg-white top-cards">
                            <div class="row px-3">
                                <div class="col-lg-12 d-flex pt-2">
                                    <div class="number-val text-primary">
                                        <i-count-up
                                          :start="0"
                                          :end="amount_current"
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
                                    <div class="card-description">{{ $t('account.payment_current') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-12">
                        <div id="block-period_pay" class="bg-white top-cards">
                            <div class="row px-3">
                                <div class="col-lg-12 d-flex pt-2">
                                    <div class="number-val text-primary">
                                        <i-count-up v-if="amount_paid"
                                          :start="0"
                                          :end="amount_paid"
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
                                    <div class="card-description">{{ $t('account.amount_paid') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-12">
                        <div id="block-period_pay" class="bg-white top-cards">
                            <div class="row px-3">
                                <div class="col-lg-12 d-flex pt-2">
                                    <div class="number-val text-primary" :class="{'animation-pulse text-danger': pay_at.diff >= -5}">{{ pay_at.when_at }}</div>
                                    <div class="ml-auto">
                                        <i class="fa fa-calendar fa-2x text-primary" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-3">
                                <div class="col-lg-12">
                                    <div class="card-description">{{ $t('account.due_date') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2" v-if="this.rates.data.length">
                    <div class="col">
                        <div id="block-period_pay" class="bg-white top-cards">
                            <div class="row px-3">
                                <div class="col-lg-12 d-flex pt-2">
                                    <div class="card-description text-primary">{{ $t('account.rates') }}
                                        <div class="small text-secondary mt-1">{{ $t('account.rates_on', {rates: rates.date_at}) }}</div>
                                    </div>
                                    <div class="ml-auto">
                                        <i class="fa fa-bar-chart fa-2x text-primary" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-3 data-rate">
                                <div v-for="(rate, index) in rates.data" :key="rate.id" class="col-sm text-center">
                                    <div>{{ rate.char_code }}</div>
                                    <span :class="'flag-icon flag-icon-squared my-2 flag-icon-'+rate.char_code_short"></span>
                                    <div>{{ (rate.value).toFixed(2) }}</div>
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
                user: {},
                rates: {
                    date_at: moment().format('DD.MM.YYYY'),
                    data: []
                },
            }
        },
        computed: {
            pay_at() {
                var nm = moment().date(10).hour(23);
                var cr = moment();
                if (cr > nm)
                    nm.add(1, 'months');

                return {when_at: nm.format('DD.MM.YYYY'), diff: cr.diff(nm, 'days')};
            },
            amount_current() {
                var pay_cur = 0;
                _.forEach(this.user.records, function(record) {
                    if (record.amount_pay == 0) {
                        pay_cur = record.amount_leasing;
                        return false;
                    }
                });
                return pay_cur;
            },
            amount_paid() {
                let paid = (this.user.total_amount_debt + this.amount_current);
                return paid;
            }
        },
        mounted() {
            if (this.$root.$data.user)
                this.user = this.$root.$data.user;
            Events.$on('data-user-loaded', function(user) {
                this.user = user;
            }.bind(this));

            axios.get(
                '/api/rates'
            ).then(response => {
                this.rates.data = response.data;
                if (this.rates.data.length)
                    this.rates.date_at = moment(this.rates.data[0].created_at).format('DD.MM.YYYY');
            }, response => {
                
            })

        },
        components: { ICountUp }
    }

</script>
