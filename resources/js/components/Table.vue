<template>
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
};

export default {
    props,
    components:{
        Pagination,
    },
    data() {
        return {
            pagination: {},
        }
    },
    methods: {
        info({text}){
            this.$swal({
                html: text,
            });
        },
    },  
    watch: {
        ['list']({current_page, first_page_url, from, last_page, last_page_url, links, next_page_url, path, per_page, prev_page_url, to, total}){
            this.pagination = {current_page, first_page_url, from, last_page, last_page_url, links, next_page_url, path, per_page, prev_page_url, to, total}
        }
    },
}
</script>

<style scoped>
    .show-read-more .more-text{
        display: none;
    }
</style>