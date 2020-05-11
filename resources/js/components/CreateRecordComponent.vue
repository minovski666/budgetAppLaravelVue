<template>
    <div class="form-group">
        <label>Name</label>
        <input type="text" v-model="name" name="name" class="form-control">
        <label>Insert cost</label>
        <input type="number" v-model="cost" name="cost" class="form-control">
        <label>Select one</label>
        <select name="select" id="select" v-model="select" class="form-control">
            <option value="1">Income</option>
            <option value="2">Expense</option>
        </select>
        <button type="submit" @click="save()" class="btn btn-info btn-submit">Submit</button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: '',
                cost: '',
                select: '',
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
        methods: {
            save() {
                axios.post('/records/store', {
                    _token: this._token,
                    name: this.name,
                    cost: this.cost,
                    select: this.select
                }).then((response) => {
                    window.location.href = '/records'
                });
            }
        }
    }
</script>

