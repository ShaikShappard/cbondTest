<template>
    <span class="asterisks" @mouseover="show=true" @mouseleave="show=false">***<span class="innerElement" v-if="show">{{ asterisks }}</span></span>
</template>

<script>

    import {mapGetters} from 'vuex'

    export default {
        name: "AppAsterisks",
        props: {
            message: '',
        },
        data: function () {
            return {
                show: false,
                asterisks: 'Log in to access'
            }
        },
        created: function () {
            if(!this.authCheck) {
                if (typeof (labels.asterisks) != "undefined")
                    this.asterisks = labels.asterisks;
            }
            else{
                if (typeof (labels.asterisks_auth) != "undefined")
                    this.asterisks = labels.asterisks_auth;
            }
            if (this.message) {
                this.asterisks = typeof (labels[this.message]) !== 'undefined' ? labels[this.message] : this.message;
            }
        },
        computed: {
            ...mapGetters({
                authCheck: 'authCheck',
            }),
        },
        methods: {
        },
        destroyed: function () {}
    }
</script>
