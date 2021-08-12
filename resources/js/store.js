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
    authenticated:false,
};

const getters = {
    authCheck (state) {
        return state.authenticated
    },
};
const mutations = {
    SET_AUTHENTICATED (state, value) {
        state.authenticated = value
    },
};

const actions = {
    exit({commit}) {
        commit('SET_AUTHENTICATED', false)
    },
    logIn({commit}) {
        commit('SET_AUTHENTICATED', true)
    },
};

export default new Vuex.Store({
    state,
    getters,
    mutations,
    actions
})
