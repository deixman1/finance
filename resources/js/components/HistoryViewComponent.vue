<template>
        <div>
            <span v-if="loading">Загрузка...</span>
            <div class="card" v-if="!loading">
                <div class="card-header bg-dark text-light">История</div>
                <div class="card-body p-0">
                    <table class="table table-sm table-hover">
                        <thead class="thead-dark">
                            <tr class="d-flex">
                                <th scope="col" class="col-1">#</th>
                                <th scope="col" class="text-center col-4">Название<br>события</th>
                                <th scope="col" class="text-center col-3">Итоговая<br>сумма</th>
                                <th scope="col" class="text-center col-4">Дата<br>добавления</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(event, index) in events" class="d-flex">
                            <th scope="row" class="col-1">{{ index+1 }}</th>
                            <td class="text-left col-4">{{ event.outcome_income.name }}</td>
                            <td class="text-center col-3">{{ event.outcome_income.sum }}</td>
                            <td class="text-center col-4">{{ convertUTCDateToLocalDate(event.outcome_income.created_at) }}</td>
                        </tr>
                        </tbody>
                    </table>
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
                    this.events = e.data.data;
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
