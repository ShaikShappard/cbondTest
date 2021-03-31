import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const state = {
    adaptive_width: 680,
    count: 0,
    active_tag_list: [],
    notauth: false,
    requestData: {},
    savedFilterName: '',
    labels: {},
    catfish: false,
    userLevel: 0,
};

const mutations = {

};

const actions = {

};

export default new Vuex.Store({
    state,
    mutations,
    actions
})
