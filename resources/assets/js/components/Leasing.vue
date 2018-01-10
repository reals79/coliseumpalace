<template>
    <div>
        <h5>Лизинговые платежи</h5>
        <hr class="m-0">
        <div class="container mt-2">
            <table class="table table-sm table-striped table-bordered">
                <thead>
                    <tr class="text-center">
                        <th width="80" rowspan="2">Период</th>
                        <th width="100" rowspan="2">Дата оплаты</th>
                        <th width="120" rowspan="2">Квартальная выплата по лизингу</th>
                        <th width="120" colspan="2">включая:</th>
                        <th rowspan="2">Пеня</th>
                        <th rowspan="2">Остаточная сумма</th>
                        <th rowspan="2">Оплачено</th>
                    </tr>
                    <tr class="text-center">
                        <th width="120">Сумма</th>
                        <th width="120">Процентная ставка</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(record, index) in user.records" :key="record.id">
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
                        <td colspan="2" class="text-right">Всего:</td>
                        <td class="text-right">{{ (user.total_amount_leasing > 0) ? user.total_amount_leasing.toFixed(2) : '' }}</td>
                        <td class="text-right">{{ (user.total_amount_leasing_period > 0) ? user.total_amount_leasing_period.toFixed(2) : '' }}</td>
                        <td class="text-right">{{ (user.total_amount_stavka > 0) ? user.total_amount_stavka.toFixed(2) : '' }}</td>
                        <td class="text-right">{{ (user.total_amount_fine > 0) ? user.total_amount_fine.toFixed(2) : '' }}</td>
                        <td colspan="2" class="text-right">{{ (user.total_amount_pay > 0) ? user.total_amount_pay.toFixed(2) : '' }}</td>
                    </tr>
                    <tr class="font-weight-bold">
                        <td colspan="2" class="text-right">Неоплаченная сумма:</td>
                        <td colspan="6" class="text-right">{{ (user.total_amount_sold > 0) ? user.total_amount_sold.toFixed(2) : '' }}</td>
                    </tr>
                    <tr class="font-weight-bold text-danger" v-if="user.total_amount_debt > 0">
                        <td colspan="2" class="text-right">Текущая задолженность:</td>
                        <td colspan="6" class="text-right"><h4>{{ (user.total_amount_debt > 0) ? user.total_amount_debt.toFixed(2) : '' }}</h4></td>
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
                user: {}
            }
        },
        mounted() {
            if (this.$root.$data.user)
                this.user = this.$root.$data.user;
            Events.$on('data-user-loaded', function(user) {
                this.user = user;
            }.bind(this))
        }
    }
</script>
