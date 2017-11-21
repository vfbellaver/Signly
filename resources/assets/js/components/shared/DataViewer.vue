<template>
    <box>
        <box-title>
            <form class="form-inline pull-right" @submit.prevent="fetchIndexData">
                <label for="search_column">Search:</label>
                <select class="form-control input-sm" v-model="query.search_column" id="search_column">
                    <option v-for="(column, index) in columns" :value="column.name" :key="index"
                            v-if="column.searchable !== undefined ? column.searchable : true">{{column.label}}
                    </option>
                </select>
                <select class="form-control input-sm" v-model="query.search_operator">
                    <option v-for="(value, key) in operators" :key="key" :value="key">{{value}}</option>
                </select>
                <input type="text" class="form-control input-sm"
                       placeholder="Search"
                       v-model="query.search_input">
                <button type="submit" class="btn btn-default btn-sm">
                    <icon icon="search"></icon>
                    Filter
                </button>
            </form>
        </box-title>
        <box-content>
            <div class="table-responsive">
                <div v-if="loading">Loading...</div>
                <table class="table table-striped table-hover" v-else>
                    <thead>
                    <tr>
                        <th class="index">#</th>
                        <th v-for="(column, index) in columns" @click="toggleOrder(column)"
                            :style="{width: column.width !== undefined ? column.width + 'px' : 'auto'}" 
                            :key="index"
                        >
                            <span>{{column.label}}</span>
                            <span class="dv-table-column" v-if="column.name === query.column">
                            <span v-if="query.direction === 'desc'">&darr;</span>
                            <span v-else>&uarr;</span>
                        </span>
                        </th>
                        <th class="action" :style="{width: action_width + 'px'}"
                            v-if="btnShare || btnEdit || btnDestroy"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(row, index) in model.data" :key="'row_' + index">
                        <td>{{ (index + 1) + ((query.page - 1) * query.per_page)}}</td>
                        <td v-for="(column, index) in columns" :key="index">
                            <span v-if="typeof(row[column.name]) === 'object' && row[column.name] !== null">
                                <img v-image-preview class="hand" :src="row[column.name]['data']"
                                     :width="row[column.name]['width']"
                                     :height="row[column.name]['height']"
                                     v-if="row[column.name]['type'] === 'image'"/>
                                <span v-if="row[column.name]['type'] === 'boolean'">
                                    {{(row[column.name]['data'] === null) ? '-' : (row[column.name]['data'] ? 'Yes' : 'No')}}
                                </span>
                            </span>
                            <span v-else v-html="row[column.name]"></span>
                        </td>
                        <td style="white-space:nowrap;">
                            <button class="btn btn-xs btn-default" @click="$emit('optional', row)"
                                    v-if="btnOptional.enabled">
                                <icon :icon="btnOptional.icon"></icon>
                            </button>
                            <button class="btn btn-xs btn-default" @click="$emit('share', row)"
                                    v-if="btnShare">
                                <icon icon="share"></icon>
                            </button>
                            <button class="btn btn-xs btn-primary" @click="$emit('edit', row)" v-if="btnEdit">
                                <icon icon="edit"></icon>
                            </button>
                            <button class="btn btn-xs btn-danger" @click="$emit('destroy', row)"
                                    v-if="btnDestroy">
                                <icon icon="trash"></icon>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </box-content>
        <box-footer>
            <row>
                <column size="12">
                    <div class="displaying">Displaying {{model.from}} - {{model.to}} of {{model.total}} rows</div>
                    <div class="pull-right">
                        <form class="form-inline " @submit.prevent="fetchIndexData">
                            <label for="per_page">Rows per page</label>
                            <select v-model="query.per_page" id="per_page" class="form-control input-sm"
                                    @change="rowsPerPageChanged">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <div class="input-group">
                                <div class="input-group-btn">
                                    <button class="btn btn-default btn-sm" @click="prev()"
                                            :disabled="! model.prev_page_url">
                                        <icon icon="arrow-left"></icon>
                                    </button>
                                </div>
                                <select v-model="query.page" class="form-control input-sm square"
                                        @change="fetchIndexData">
                                    <option v-for="i in model.last_page" :key="i" :value="i">{{ i }}</option>
                                </select>
                                <div class="input-group-btn">
                                    <button class="btn btn-default btn-sm" @click="next()"
                                            :disabled="! model.next_page_url">
                                        <icon icon="arrow-right"></icon>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </column>
            </row>
        </box-footer>
    </box>
</template>

<script>
    import Vue from 'vue';
    import axios from 'axios';

    export default {
        props: {
            source: {required: true},
            title: {required: true},
            defaultColumn: {required: false},
            btnEdit: {require: false, default: false},
            btnDestroy: {require: false, default: false},
            btnShare: {require: false, default: false},
            btnOptional: {require: false, default: { enabled: false }}
        },
        data() {
            return {
                model: {},
                columns: {},
                query: {
                    page: 1,
                    column: this.defaultColumn || 'id',
                    direction: 'desc',
                    per_page: 15,
                    search_column: this.defaultColumn || 'id',
                    search_operator: 'equal',
                    search_input: ''
                },
                operators: {
                    equal: '=',
                    not_equal: '<>',
                    less_than: '<',
                    greater_than: '>',
                    less_than_or_equal_to: '<=',
                    greater_than_or_equal_to: '>=',
                    in: 'in',
                    like: 'contains'
                },
                action_width: 72,
                loading: false,
            }
        },
        created() {
            this.fetchIndexData();
        },
        methods: {
            next() {
                if (this.model.next_page_url) {
                    this.query.page++;
                    this.fetchIndexData();
                }
            },
            prev() {
                if (this.model.prev_page_url) {
                    this.query.page--;
                    this.fetchIndexData();
                }
            },
            toggleOrder(column) {
                if (column.name === this.query.column) {
                    this.query.direction = this.query.direction === 'desc' ? 'asc' : 'desc';
                } else {
                    this.query.column = column;
                    this.query.direction = 'asc';
                }

                this.fetchIndexData()
            },
            fetchIndexData() {
                let vm = this;
                vm.loading = true;
                axios.get(`${this.source}?column=${this.query.column}&direction=${this.query.direction}&page=${this.query.page}&per_page=${this.query.per_page}&search_column=${this.query.search_column}&search_operator=${this.query.search_operator}&search_input=${this.query.search_input}`)
                    .then(function (response) {
                        console.log('DataViewer', response);
                        Vue.set(vm.$data, 'model', response.data.model);
                        Vue.set(vm.$data, 'columns', response.data.columns);
                        vm.action_width = response.data.action_width ? response.data.action_width : 72;
                        vm.loading = false;
                    })
                    .catch(function (response) {
                        console.log(response);
                        vm.loading = false;
                    })
            },
            rowsPerPageChanged() {
                this.query.page = 1;
                this.fetchIndexData();
            }
        }
    }
</script>

<style lang="scss" scoped>
    .ibox-title {
        min-height: 60px;
        button {
            margin-bottom: 0;
        }
    }

    th {
        &.index {
            width: 1%;
            white-space: nowrap;
            text-align: center;
        }
        &:not(.index) {
            cursor: pointer;
        }
    }

    .ibox-footer {
        .input-group {
            margin-bottom: -6px;
            margin-left: 10px;
        }
    }

    .square {
        -webkit-appearance: none;
        border-radius: 0;
        text-align-last: center;
        text-align: center;
        -ms-text-align-last: center;
        -moz-text-align-last: center;
        font-size: 13px;
        padding: 0;
        width: 50px !important;
    }

    .displaying {
        font-weight: bold;
        float: left;
        margin-top: 6px;
    }
</style>