<template>
    <div class="modal fade" id="addNewEventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Новое событие</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times</span>
                    </button>
                </div>
                <div class="modal-body">
                    <button type="button" class="btn btn-primary" v-on:click="type = 1">Доход</button>
                    <button type="button" class="btn btn-primary" v-on:click="type = 2">Расход</button>
                    <form class="mt-2" action="">
                        <div class="form-group" v-if="type == 1">
                            <!--income-->
                            <div class="card">
                                <div class="card-header bg-dark text-light">Название: {{ income.name }}</div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="name-income" class="col-md-4 col-form-label text-md-right">Название дохода:</label>
                                        <div class="col-md-8">
                                            <input v-model="income.name" type="text" class="form-control" id="name-income">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right" for="selectTypeIncome">Тип дохода</label>
                                        <div class="col-md-8">
                                            <select class="form-control " id="selectTypeIncome">
                                                <option v-on:click="income.type = 1">Активный</option>
                                                <option v-on:click="income.type = 2">Пассивны</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="sum-income" class="col-md-4 col-form-label text-md-right">Сумма дохода:</label>
                                        <div class="col-md-8">
                                            <input v-model="income.sum" type="text" class="form-control" id="sum-income">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <!--outcome-->
                        <div class="form-group" v-if="type == 2">
                            <div class="form-group row">
                                <label for="name-outcome" class="col-md-4 col-form-label text-right">Название расхода:</label>
                                <div class="col-md-6">
                                    <input v-model="outcome.name" type="text" class="form-control" id="name-outcome">
                                </div>
                            </div>
                            <div class="form-group d-flex justify-content-md-start flex-wrap">
                                <div class="card m-3" v-for="(item, index) in outcome.items">
                                    <div class="card-header d-flex justify-content-between bg-dark text-light">
                                        <h5>Услуга/Товар: {{ index+1 }}</h5>
                                        <button type="button" class="btn btn-danger" v-on:click="removeOutcomeCard(index)">Удалить</button>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="name-item" class="col-md-5 col-form-label text-right">Название:</label>
                                            <div class="col-md-7">
                                                <input v-model="item.name" type="text" class="form-control" id="name-item">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="sum-item" class="col-md-5 col-form-label text-right">Сумма:</label>
                                            <div class="col-md-7">
                                                <input v-model="item.sum" type="text" class="form-control" id="sum-item">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group d-flex justify-content-center">
                                <button type="button" class="btn btn-primary" v-on:click="addOutcomeCard()">+ Добавить услугу/товар</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" v-on:click="storeEvent()" data-dismiss="modal">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                type: 1, //1 - income, 2 outcome
                income: {
                    name: "",
                    type: 1, //1 - active, 2 passive
                    sum: 0.00
                },
                outcome: {
                    name: "",
                    items: [{name: "", sum: 0}]
                }
            }
        },
        mounted() {
            console.log('Component event model mounted.');
        },
        methods: {
            addOutcomeCard: function() {
                this.outcome.items.push({name: "", sum: 0});
            },
            removeOutcomeCard: function(e) {
                if (this.outcome.items.length == 1)
                    return;
                this.outcome.items.splice(e,1);
            },
            storeEvent: function () {
                axios.post('/event/store', this.$data).then((e) => {
                    switch (this.type) {
                        case 1:
                            this.storeIncome(e.data);
                            break;
                        case 2:
                            this.storeOutcome(e.data);
                            break;
                    }
                }).catch((error) => {
                    console.log(error);
                });
            },
            storeOutcome: function (e) {
                axios.post('/outcome/store', [this.outcome, e]).then((e) => {
                    this.storeOutcomeItems(e.data);
                }).catch((error) => {
                    console.log(error);
                });
            },
            storeOutcomeItems: function (e) {
                axios.post('/item/store', [this.outcome.items, e]).then((e) => {
                    //console.log(e.data);
                    this.$root.$emit('history-view');
                }).catch((error) => {
                    console.log(error);
                });
            },
            storeIncome: function (e) {
                axios.post('/income/store', [this.income, e]).then((e) => {
                    //console.log(e.data);
                }).catch((error) => {
                    console.log(error);
                });
            }
        }
    }
</script>

