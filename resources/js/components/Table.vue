<template>

    <div class="row">
        <div class="col-12 col-sm-3 col-md-2 col-lg-2">
            <select class="custom-select" v-model="per_page_selected" @change="update({per_page:parseInt($event.target.value)})">
                <option v-for="item in per_pages" :value="item" :key="item">
                    {{ item }}
                </option>
            </select>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th v-for="column in columns" :key="column.label">
                        {{ column.label }}
                    </th>
                </tr>
            </thead>
            <tbody v-if="list?.data">
                <tr v-for="row of list.data" :key="row.id">
                    <td v-for="column in columns" :key="column.label">
                        <div v-if="column.field === 'observation'">
                            <button type="button" class="btn btn-outline-dark" @click="info({text: row[column.field]})">
                                <font-awesome-icon icon="info" />
                            </button>
                        </div>
                        <div v-else>
                            {{ row[column.field] }}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
        
    <pagination
        :params="pagination"
        @update="update"
    />
</template>

<script>

import Pagination from './Pagination.vue'

export const props = {
    columns: {
        type: Array,
        required: true,
        /**
         * 
            {
                label: 'Nº',
                field: 'n',
                width: '1%',
            },
            {
                label: 'Cliente',
                field: 'date',
            },
            {
                label: 'Acciones',
                field: 'acciones',
                width: '1%',
                html: true,
            },
        */
    },
    list: {
        type: Object,
        default: {},
    },
    per_page: {
        type: Number,
        default: 10,
    },
};

export default {
    emits: ['update'],
    props,
    components:{
        Pagination,
    },
    data() {
        return {
            pagination: {},
            per_pages: [5,10,25,50,100,250,500,1000],
            per_page_selected: 5,
        }
    },
    methods: {
        info({text}){
            this.$swal({
                html: text,
            });
        },
        update(values){
            console.log('update')
            this.$emit('update',values)
        },
    },  
    watch: {
        ['list']({links}){
            this.pagination = {links}
        },
    },
    created() {
        this.per_page_selected = this.per_page
    },
}
</script>