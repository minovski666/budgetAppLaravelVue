<template>
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
            <td>
                <button class="btn btn-danger" @click="deleteRecord(record.id)">Delete</button>
            </td>
        </tr>
        <tr>
            <td class="balance">Balance: {{balance}}</td>
            <td class="income">Income: {{income}}</td>
            <td class="expense">Expense: {{expense}}</td>
        </tr>
    </table>
</template>

<script>
    export default {
        data() {
            return {
                records: '',
                income: '',
                expense: '',
                balance: ''
            }
        },
        mounted() {
            this.getInitSetup();
        },
        methods: {
            deleteRecord(id) {
                axios.get('records/delete/' + id)
                    .then((response) => {
                        this.getInitSetup();
                    })
            },
            getAllRecords() {
                axios.get('/records/all')
                    .then((response) => {
                        this.records = response.data;
                    });
            },
            getBalance() {
                axios.get('records/balance')
                    .then((response) => {
                        this.income = response.data.income;
                        this.expense = response.data.expense;
                        this.balance = response.data.balance;

                    });
            },
            getInitSetup(){
                this.getAllRecords();
                this.getBalance();
            }
        }
    }
</script>
