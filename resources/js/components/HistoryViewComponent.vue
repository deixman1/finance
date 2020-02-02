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
                                <th scope="col">Название события</th>
                                <th scope="col">Итоговая сумма события</th>
                                <th scope="col">Дата добовления</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(event, index) in events">
                            <th scope="row">{{ index+1 }}</th>
                            <td>{{ event.outcome_income.name }}</td>
                            <td>{{ event.outcome_income.sum }}</td>
                            <td>{{ convertUTCDateToLocalDate(event.outcome_income.created_at) }}</td>
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
            this.loading = false;
            this.$root.$on('history-view', () => {
                this.loading = true;
                this.update();
                this.loading = false;
            });
        },
        methods: {
            update: function() {
                axios.get('/event/get').then((e) => {
                    this.events = e.data;
                    //console.log('update history');
                    //console.log(e.data);
                });
            },
            convertUTCDateToLocalDate: function(date) {
                date = new Date(date);
                let newDate = new Date(date.getTime()+date.getTimezoneOffset()*60*1000);
                let offset = date.getTimezoneOffset() / 60;
                let hours = date.getHours();
                newDate.setHours(hours - offset);
                let currDate = ("0" + newDate.getDate()).slice(-2);
                let currMunth = ("0" + (newDate.getMonth()+1)).slice(-2);
                let currYear = newDate.getFullYear();
                let currHours = ("0" + newDate.getHours()).slice(-2);
                let currMinutes = ("0" + newDate.getMinutes()).slice(-2);
                return currDate + "." + currMunth + "." + currYear + " " + currHours + ":" + currMinutes;
            }
        }
    }
</script>
