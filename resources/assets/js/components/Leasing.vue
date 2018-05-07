<template>
    <div>
        <h5>{{ $t('account.menu.leasing_payments') }}</h5>
        <hr class="m-0">
        <div class="container mt-2">
            <table class="table table-sm table-striped table-bordered">
                <thead>
                    <tr class="text-center">
                        <th width="80" rowspan="2">{{ $t('apartment.period') }}</th>
                        <th width="100" rowspan="2">{{ $t('apartment.payment_date') }}</th>
                        <th width="120" rowspan="2">{{ $t('apartment.payment_quart') }}</th>
                        <th width="120" colspan="2">{{ $t('apartment.including') }}:</th>
                        <th rowspan="2">{{ $t('apartment.fee') }}</th>
                        <th rowspan="2">{{ $t('apartment.amount_rest') }}</th>
                        <th rowspan="2">{{ $t('apartment.paid') }}</th>
                    </tr>
                    <tr class="text-center">
                        <th width="120">{{ $t('apartment.sum') }}</th>
                        <th width="120">{{ $t('apartment.percent_rate') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(record, index) in contract.records" :key="record.id">
                        <td class="text-center">{{ record.number_period }}</td>
                        <td class="text-center">{{ record.pay_at | formatDate }}</td>
                        <td class="text-right">{{ (record.amount_leasing > 0) ? record.amount_leasing.toFixed(2) : '' }}</td>
                        <td class="text-right">{{ (record.amount_leasing_period > 0) ? record.amount_leasing_period.toFixed(2) : '' }}</td>
                        <td class="text-right">{{ (record.amount_stavka > 0) ? record.amount_stavka.toFixed(2) : '' }}</td>
                        <td class="text-right">{{ (record.amount_fine > 0) ? record.amount_fine.toFixed(2) : '' }}</td>
                        <td class="text-right">{{ (record.amount_sold > 0) ? record.amount_sold.toFixed(2) : '' }}</td>
                        <td class="text-right">{{ (record.amount_pay > 0) ? record.amount_pay.toFixed(2) : '' }}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="font-weight-bold">
                        <td colspan="2" class="text-right">{{ $t('apartment.total') }}:</td>
                        <td class="text-right">{{ (contract.total_amount_leasing > 0) ? contract.total_amount_leasing.toFixed(2) : '' }}</td>
                        <td class="text-right">{{ (contract.total_amount_leasing_period > 0) ? contract.total_amount_leasing_period.toFixed(2) : '' }}</td>
                        <td class="text-right">{{ (contract.total_amount_stavka > 0) ? contract.total_amount_stavka.toFixed(2) : '' }}</td>
                        <td class="text-right">{{ (contract.total_amount_fine > 0) ? contract.total_amount_fine.toFixed(2) : '' }}</td>
                        <td colspan="2" class="text-right">{{ (contract.total_amount_pay > 0) ? contract.total_amount_pay.toFixed(2) : '' }}</td>
                    </tr>
                    <tr class="font-weight-bold">
                        <td colspan="2" class="text-right">{{ $t('account.unpaid_amount') }}:</td>
                        <td colspan="6" class="text-right">{{ (contract.total_amount_sold > 0) ? contract.total_amount_sold.toFixed(2) : '' }}</td>
                    </tr>
                    <tr class="font-weight-bold text-danger" v-if="contract.total_amount_debt > 0">
                        <td colspan="2" class="text-right">{{ $t('account.current_debt') }}:</td>
                        <td colspan="6" class="text-right"><h4>{{ (contract.total_amount_debt > 0) ? contract.total_amount_debt.toFixed(2) : '' }}</h4></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</template>

<script>
    import Events  from '../event.js';

    export default {
        data() {
            return {
                user: {},
                contract: {}
            }
        },
        mounted() {
            if (this.$root.$data.user) {
                this.user = this.$root.$data.user;
            }
            if (this.$root.$data.contract) {
                this.contract = this.$root.$data.contract;
            }
            Events.$on('data-user-loaded', function(user, contract) {
                this.user = user;
                this.contract = contract;
            }.bind(this))
        }
    }
</script>
