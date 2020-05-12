<template>
    <div>
        <div class="col-xs-12 text-center">
            <label for="From">From Date</label>
            <input type="date" name="from" v-model="from" class="datepicker">
            <label for="To">To Date</label>
            <input type="date" name="to" v-model="to" class="datepicker" @change="getNewData()">
        </div>
        <hr>
        <div class="col-md-12">
            <input type="text" name="search" class="form-control" v-model="search" @keypress="searchQuery()" placeholder="Search a cost">
        </div>
        <table class="table">
            <tr>
                <td>Income</td>
                <td>Name</td>
                <td>Expenses</td>
            </tr>
            <tr v-for="record in records">
                <td v-if="record.select === 1">{{record.cost}}</td>
                <td v-else></td>
                <td>{{record.name}}</td>
                <td v-if="record.select === 2">{{record.cost}}</td>
                <td v-else></td>
            </tr>
            <tr class="text-dark">
                <td class="balance">Balance: {{balance}}</td>
                <td class="income">Income: {{income}}</td>
                <td class="expense">Expense: {{expense}}</td>
            </tr>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                from: '',
                to: '',
                records: '',
                income: '',
                expense: '',
                balance: '',
                search: ''
            }
        },
        mounted() {
            this.getInitSetup();
        },
        methods: {
            getAllRecords() {
                axios.get('/records/all')
                    .then((response) => {
                        this.records = response.data;
                    });
            },
            getBalance() {
                axios.get('/records/balance')
                    .then((response) => {
                        this.income = response.data.income;
                        this.expense = response.data.expense;
                        this.balance = response.data.balance;

                    });
            },
            getInitSetup() {
                this.getAllRecords();
                this.getBalance();
            },
            getNewData() {
                axios.get('/records/filters/' + this.from + '/' + this.to)
                    .then((response) => {
                        this.records = response.data;
                        axios.get('/records/filters/balance/' + this.from + '/' + this.to)
                            .then((response) => {
                                this.income = response.data.income;
                                this.expense = response.data.expense;
                                this.balance = response.data.balance;
                            })

                    });
            },
            searchQuery(){
                if (this.search.length >= 2){
                    axios.get('/records/search/' + this.search)
                    .then((response) => {
                        this.records = response.data;
                        axios.get('/records/search/balance/' + this.search)
                            .then((response) => {
                                this.income = response.data.income;
                                this.expense = response.data.expense;
                                this.balance = response.data.balance;
                            })
                    })
                }
            },
        }
    }
</script>
