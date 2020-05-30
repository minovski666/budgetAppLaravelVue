<template>
    <div>
        <table class="table">
            <tr>
                <td>Income</td>
                <td>Name</td>
                <td>Expenses</td>
            </tr>
            <tr v-for="record in records" class="edit-link" @mouseover="show = record" @mouseleave="show = null">
                <td v-if="record.select === 1"><input name="cost" @change="newCost($event)" type="number" v-show="show === record"
                                                      :value="record.cost"><span v-show="show !== record">{{record.cost}}</span>
                </td>
                <td v-else></td>
                <td><input type="text" name="name" @change="newName($event)" v-show="show === record" :value="record.name"><span
                        v-show="show !== record">{{record.name}}</span></td>
                <td v-if="record.select === 2"><input type="number" name="cost"  @change="newCost($event)" v-show="show === record"
                                                      :value="record.cost"><span v-show="show !== record">{{record.cost}}</span>
                </td>
                <td v-else></td>
                <td>
                    <button class="btn btn-info" v-show="show === record" @click="editRecord(record.id, record.select, record.name, record.cost)">
                        Edit
                    </button>
                </td>
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
                balance: '',
                show: null,
                getNewName: '',
                getNewCost: ''
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
                        flash('You have deleted a record');
                    }, (error) => {
                        flash('Something went wrong!!!');
                    });
            },
            newName(event){
                this.getNewName = event.target.value;
            },
            newCost(event){
                this.getNewCost = event.target.value;
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
                    flash('You have created new record');
                }, (error) => {
                    flash('Something went wrong!!!');
                });
            },
            editRecord(id, select, name, cost) {
                axios.post('/records/edit/' + id, {
                    _token: this._token,
                    name: this.getNewName ? this.getNewName : name,
                    cost: this.getNewCost ? this.getNewCost : cost,
                    select: select
                }).then((response) => {
                    this.getInitSetup();
                    flash('You have updated a record');
                }, (error) => {
                    flash('Something went wrong!!!');
                });
            }
        }
    }
</script>

<style>
    .edit-link:hover {
        background: lightblue;
    }
</style>
