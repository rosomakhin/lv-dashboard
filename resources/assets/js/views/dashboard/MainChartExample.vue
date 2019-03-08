<script>
    import {Line} from 'vue-chartjs';
    import moment from 'moment';

    const brandInfo = '#63c2de';

    function convertHex(hex, opacity) {
        hex = hex.replace('#', '');
        const r = parseInt(hex.substring(0, 2), 16);
        const g = parseInt(hex.substring(2, 4), 16);
        const b = parseInt(hex.substring(4, 6), 16);

        return 'rgba(' + r + ',' + g + ',' + b + ',' + opacity / 100 + ')';
    }

    export default Line.extend({
        props: ['height', 'data'],
        watch: {
            data() {
                const lines = new Map();

                // get map for data
                this.data.forEach((item) => {
                    const created = moment(item.created_at).format('YYYY-MM-DD');
                    const count = lines.has(created) ? lines.get(created) : 0;

                    lines.set(created, count + 1);
                });

                // general data
                const result = new Map([...lines.entries()].sort());
                const max = Math.max(...result.values());
                const labels = [...result.keys()];
                const data = [...result.values()];

                // render chart
                this.renderChart({
                    labels: labels,
                    datasets: [
                        {
                            label: 'Contacts',
                            backgroundColor: convertHex(brandInfo, 10),
                            borderColor: brandInfo,
                            pointHoverBackgroundColor: '#fff',
                            borderWidth: 2,
                            data: data
                        },
                    ]
                }, {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            gridLines: {
                                drawOnChartArea: false
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                maxTicksLimit: 5,
                                stepSize: 1,
                                max: max,
                            },
                            gridLines: {
                                display: true
                            }
                        }]
                    },
                    elements: {
                        point: {
                            radius: 0,
                            hitRadius: 10,
                            hoverRadius: 4,
                            hoverBorderWidth: 3
                        }
                    }
                })
            }
        },
        mounted() {

        }
    })
</script>
