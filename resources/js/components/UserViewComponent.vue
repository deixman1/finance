<template>
    <div>
        <span v-if="loading">Загрузка...</span>
        <div class="card" v-if="!loading">
            <div class="card-header bg-dark text-light">Имя: {{ profile.name }}</div>
            <div class="card-body">
                Баланс: {{ profile.user.balance }} рублей<br>
                Общий доход: {{ profile.income.sum }} рублей<br>
                Общий расход: {{ profile.outcome.sum }} рублей<br>
                Баланск итого: {{ calcBalance() }} рублей
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                profile: {
                    user: {},
                    outcome: {},
                    income: {}
                },
                loading: true
            }
        },
        mounted() {
            console.log('Component user profile mounted.');
            this.update();
        },
        methods: {
            update: async function() {
                await axios.get('/user/get').then((e) => {
                    this.profile.user = e.data;
                    this.getOutcome();
                    this.getIncome();
                    //console.log(e.data);
                    //this.calcBalance();
                    this.loading = false;
                });
            },
            getOutcome: async function () {
                await axios.get('/outcome/get').then((e) => {
                    this.profile.outcome = e.data;
                    //console.log(e.data);
                });
            },
            getIncome: async function () {
                await axios.get('/income/get').then((e) => {
                    this.profile.income = e.data;
                    //console.log(e.data);
                });
            },
            calcBalance: function () {
                return parseFloat(this.profile.user.balance) + parseFloat(this.profile.income.sum) - parseFloat(this.profile.outcome.sum);
            }
        }
    }
</script>
