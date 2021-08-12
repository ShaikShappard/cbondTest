import Vue from 'vue';
import axios from 'axios';
import AppTableNew from './components/AppTableNew.vue';
import store from './store.js';
import * as _ from 'lodash';

var resizeTable = new Vue;
Vue.prototype.$resizeTable = resizeTable;

import {mapGetters, mapActions} from 'vuex'

new Vue({
    el: '#app',
    store,
    components: {
        'app-table-new': AppTableNew,
    },
    data: {
        labels: {
            id: '#',
            name: 'Наименование',
            param1: 'Параметр 1',
            param2: 'Параметр 2',
            param3: 'Параметр 3',
            action: 'Действие'
        },
        tableFields: ['name', 'param1', 'param2', 'param3', 'action'],
        tableData: [],
        error: {
            display: false,
            message: ''
        },
        newItem: {
            id: 0,
            name: '',
            param1: '',
            param2: '',
            param3: '',
        },
        sum: {},
        needNumberValidation: [
            'param1', 'param2', 'param3'
        ],
        fieldsToHide: [
            'param2', 'param3'
        ]
    },
    mounted() {
        this.getTableData();
    },
    computed: {
        ...mapGetters({
            authCheck: 'authCheck',
        }),
    },
    methods: {
        ...mapActions({
            exit: 'exit',
            logIn: 'logIn',
        }),
        setAuth(auth){
            if(auth)
                this.logIn();
            else
                this.exit();
        },
        appendRow: function () {
            this.newItem.id = 1;
            if (this.tableData.length) {
                this.newItem.id = _.maxBy(this.tableData, 'id').id + 1;
            }

            if (!this.authCheck) {
                this.setError('Пожалуйста авторизуйтесь');
                return false;
            }

            for (var num = 0; num < this.needNumberValidation.length; num++) {
                if (!this.validNumericField(this.newItem[this.needNumberValidation[num]])) {
                    this.setError('поля "Параметр 1", "Параметр 2", "Параметр 3" должны быть только числовыми');
                    return false;
                }
            }
            this.tableData.push(this.newItem);
            this.setTableData();
        },

        setError(message) {
            this.error.display = true;
            this.error.message = message;

            setTimeout(() => {
                this.error.display = false;
                this.error.message = "";
            }, 5000)
        },
        validNumericField(number) {
            var re = /[^\d]/g;
            return !re.test(number);
        },
        removeRow: function (id) {
            _.remove(this.tableData, {id: id});
            this.setTableData();
            this.calculateTable();
        },
        setTableData: function () {
            axios.post('/set', {data: this.tableData})
                .then((response) => {
                    this.getTableData();
                    this.calculateTable();
                });
        },
        getTableData: function () {
            axios.get('/get')
                .then((response) => {
                    this.tableData = response.data;
                    this.calculateTable();
                });
        },
        fieldCustomize(field, row) {
            if (!this.authCheck && this.fieldsToHide.indexOf(field) != -1)
                return 'asterisks';

            return row[field];
        },
        calculateTable() {
            if(!this.tableData.length)
                return false;

            this.sum = {};
            for (var i in  this.needNumberValidation) {

                for (var num in this.tableData) {
                    var numberField = this.needNumberValidation[i];
                    this.sum[numberField] = (typeof this.sum[this.needNumberValidation[i]] != 'undefined' ?
                        +this.sum[this.needNumberValidation[i]] :
                        +0) + +this.tableData[num][numberField];
                }

            }
        }
    },
});

