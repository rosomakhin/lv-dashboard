<template>
    <div class="animated fadeIn">
        <b-card>
            <main-chart-example class="chart-wrapper" style="height:300px;margin-top:40px;"
                                height="300" :data="tableItems"></main-chart-example>
        </b-card>

        <div class="row">
            <div class="col-md-12">
                <b-card header="Contacts">
                    <b-table class="table-outline mb-0" hover responsive outline
                             :items="tableItems"
                             :fields="tableFields"
                             head-variant="default"
                    >
                        <template slot="name" scope="item">
                            <span>{{item.value}}</span>
                        </template>
                        <template slot="email" scope="item">
                            <span>{{item.value}}</span>
                        </template>
                        <template slot="tel" scope="item">
                            <span>{{item.value}}</span>
                        </template>
                        <template slot="created_at" scope="item">
                            <span>{{item.value}}</span>
                        </template>
                    </b-table>
                </b-card>
            </div><!--/.col-->
        </div><!--/.row-->
    </div>
</template>

<script>
    import MainChartExample from './dashboard/MainChartExample';
    import axios from 'axios';

    export default {
        name: 'dashboard',
        components: {
            MainChartExample,
        },
        created: function () {
            // get contacts from api
            axios.get('/api/contacts').then((response) => {
                this.tableItems = response.data;
            })
        },
        data: function () {
            return {
                tableItems: [],
                tableFields: {
                    name: {
                        label: 'Name',
                    },
                    email: {
                        label: 'E-mail',
                    },
                    tel: {
                        label: 'Tel',
                    },
                    created_at: {
                        label: 'Created'
                    },
                }
            }
        },
        methods: {
            variant(value) {
                let $variant;
                if (value <= 25) {
                    $variant = 'info'
                } else if (value > 25 && value <= 50) {
                    $variant = 'success'
                } else if (value > 50 && value <= 75) {
                    $variant = 'warning'
                } else if (value > 75 && value <= 100) {
                    $variant = 'danger'
                }
                return $variant
            }
        }
    }
</script>
