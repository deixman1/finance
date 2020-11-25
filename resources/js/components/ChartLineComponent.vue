<template>
    <div>
        <line-chart :chart-data="datacollection" :height="200" :options="{responsive: true, maintainAspectRation: true}"></line-chart>
    </div>
</template>

<script>
    import LineChart from '../LineChart.js'

    export default {
        components: {
            LineChart
        },
        data () {
            return {
                datacollection: null
            }
        },
        mounted () {
            this.fillData()
        },
        methods: {
            fillData () {
                this.datacollection = {
                    labels: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
                    datasets: [
                        {
                            label: 'Data One',
                            backgroundColor: '#f87979',
                            data: this.getRandomInt()
                        }, {
                            label: 'Data two',
                            backgroundColor: '#4af83f',
                            data: this.getRandomInt()
                        }
                    ]
                }
            },
            getRandomInt () {
                let array = [];
                for (let i = 0; i < 12; i++)
                    array.push(Math.floor(Math.random() * (50 - 5 + 1)) + 5);
                return array;
            }
        }
    }
</script>
