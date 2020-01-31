<template>
    <div class="row" style="margin-top: 1rem">
        <div class="col-12">
            <span v-if="loading">Загрузка...</span>
            <div class="card" v-if="!loading">
                <div class="card-header bg-dark text-light">История</div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Название</th>
                                <th scope="col">Сумма</th>
                                <th scope="col">Дата</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(event, index) in events">
                            <th scope="row">{{ index+1 }}</th>
                            <td>{{ event.outcome_income.name }}</td>
                            <td>{{ event.outcome_income.sum }}</td>
                            <td>{{ event.outcome_income.created_at }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                events: {},
                loading: true
            }
        },
        mounted() {
            console.log('Component history mounted.');
            this.update();
            this.$root.$on('history-view', () => {
                // your code goes here
                this.update()
            });
        },
        methods: {
            update: function() {
                axios.get('/event/get').then((e) => {
                    this.events = e.data;
                    this.loading = false;
                    //console.log('update history');
                    //console.log(e.data);
                });
                /*axios.get('/user/get').then((e) => {
                    this.profile = e.data;
                    this.loading = false;
                });*/
            }
        }
    }
</script>
