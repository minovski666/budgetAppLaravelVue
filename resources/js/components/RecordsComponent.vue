<template>
    <div>
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
            <tr class="text-dark">
                <td class="balance">Balance: {{balance}}</td>
                <td class="income">Income: {{income}}</td>
                <td class="expense">Expense: {{expense}}</td>
            </tr>
            <tr v-show="incomeShow">
                <td><input type="number" v-model="cost" name="cost" class="form-control" placeholder="Cost"></td>
                <td><input type="text" v-model="name" name="name" placeholder="Name of the cost" class="form-control">
                </td>
                <td><select name="select" id="select" v-model="select" class="form-control">
                    <option value="">Select type</option>
                    <option value="1">Income</option>
                    <option value="2">Expense</option>
                </select></td>
                <td>
                    <button type="submit" @click="save()" class="btn btn-info btn-submit">Add</button>
                </td>
            </tr>
        </table>
        <button class="btn btn-info" @click="createRecord()">Create Record</button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                cost: '',
                name: '',
                select: '',
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                incomeShow: false,
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
            getInitSetup() {
                this.getAllRecords();
                this.getBalance();
            },
            createRecord() {
                this.incomeShow = !this.incomeShow;
                this.name = '';
                this.cost = '';
                this.select = '';
            },
            save() {
                axios.post('/records/store', {
                    _token: this._token,
                    name: this.name,
                    cost: this.cost,
                    select: this.select
                }).then((response) => {
                    this.getInitSetup();
                    this.incomeShow = false;
                });
            }
        }
    }
</script>
