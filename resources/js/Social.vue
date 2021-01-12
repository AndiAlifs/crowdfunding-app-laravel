<template>
    <div>
        Halaman social vue
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
    data() {
        return {
            code: '',
            data: ''
        }
    },
    computed: {
        ...mapGetters({
            'user': 'auth/user'
        })
    },
    methods: {
        ...mapActions({
                setDialogStatus: 'dialog/setStatus',
                setAuth: 'auth/set',
                setAlert : 'alert/set',
        }),
        go(provider, code){
            let url = '/api/auth/social/' + provider + '/callback?code=' + code +'/'
            console.log(url)
            axios.get(url)
                .then((response) => {
                    let { data } = response.data
                    this.setAuth(data)
                    if(this.user.id.length > 0) {
                        this.setAlert({
                            status: true,
                            color: 'success',
                            text: 'login success'
                        })
                        // this.setDialogStatus(false)
                        this.$router.push({ name:'home' })
                    } else {
                        this.setAlert({
                            status: true,
                            color: 'error',
                            text: 'login failed'
                        })
                    }
                })
                .catch((error) => {
                    let {data} = error.response
                    console.error(data)
                    this.setAlert({
                                    status: true,
                                    color: 'error',
                                    text: 'data.message'
                                })
                })
        }
    },
    mounted(){
        this.code = this.$route.query.code
        this.provider = this.$route.path.split('/')[3]

        this.go(this.provider, this.code)
    }
}
</script>