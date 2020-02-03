<template>
    <div>
        <span v-if="loading">Загрузка...</span>
        <div class="card" v-if="!loading">
            <div class="card-header bg-dark text-light">Имя: {{ profile.user.name }}</div>
            <div class="card-body">
                Баланс на момент регистрации: {{ profile.user.balance }} рублей<br>
                Общий доход: {{ profile.income.sum.toFixed(2) }} рублей<br>
                Общий расход: {{ profile.outcome.sum.toFixed(2) }} рублей<br>
                Баланс итого: {{ calcBalance() }} рублей
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
            this.loading = false;
            this.$root.$on('user-view', () => {
                this.loading = true;
                this.update();
                this.loading = false;
            });
        },
        methods: {
            update: function() {
                axios.get('/user/get').then((e) => {
                    this.profile.user = e.data;
                    this.getOutcome();
                    this.getIncome();
                    //console.log(e.data);
                    //this.calcBalance();
                });
            },
            getOutcome: function () {
                axios.get('/outcome/get').then((e) => {
                    this.profile.outcome = e.data;
                    if (isNaN(this.profile.outcome.sum))
                        this.profile.outcome.sum = 0.00;
                    //console.log(e.data);
                });
            },
            getIncome: function () {
                axios.get('/income/get').then((e) => {
                    this.profile.income = e.data;
                    if (isNaN(this.profile.income.sum))
                        this.profile.income.sum = 0.00;
                    //console.log(e.data);
                });
            },
            calcBalance: function () {
                //console.log(parseFloat(this.profile.user.balance));
                //console.log(this.profile.income.sum);
                //console.log(parseFloat(this.profile.outcome.sum));
                let balance = parseFloat(this.profile.user.balance);
                let income = parseFloat(this.profile.income.sum);
                let outcome = parseFloat(this.profile.outcome.sum);
                if (isNaN(income))
                    income = 0.00;
                if (isNaN(outcome))
                    outcome = 0.00;
                let result = ((balance + income) - outcome);
                return result.toFixed(2);
            }
        }
    }
</script>
