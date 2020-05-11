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
        </tr>
        <tr>
            <td class="balance"></td>
            <td class="income"></td>
            <td class="expense"></td>
        </tr>
    </table>
</template>

<script>
    export default {
        data() {
            return {
                records: ''
            }
        },
        mounted() {
            axios.get('/records/all')
                .then((response) => {
                    this.records = response.data;
                });
        }
    }
</script>
