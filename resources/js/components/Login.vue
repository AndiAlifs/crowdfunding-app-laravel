<template>
    <v-card>
        <v-toolbar dark color="success">
            <v-btn icon dark @click.native="close">
                <v-icon>mdi-close</v-icon>
            </v-btn>
            <v-toolbar-title>Login</v-toolbar-title>
        </v-toolbar>
        <v-divider></v-divider>
        <v-container>
            <v-form ref="form" v-model="valid" lazy-validation>
                <v-text-field
                    v-model="email"
                    :rules="emailRules"
                    label="E-mail"
                    required
                    append-icon="mdi-small"
                ></v-text-field>
                <v-text-field
                    v-model="password"
                    :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off;'"
                    :rules="passwordRules"
                    :type="showPassword? 'text' : 'password'"
                    label="Password"
                    hint="At least 6 Characters"
                    counter
                    @click:append="showPassword = !showPassword"
                ></v-text-field>

                <div class="text-cs-center">
                    <v-btn
                        color="success lighten-1"
                        :disabled = "!valid"
                        @click="submit"
                    >
                        Login
                        <v-icon right dark>mdi-lock-open</v-icon>
                    </v-btn>
                </div>
            </v-form>
        </v-container>
    </v-card>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
    name: 'login',
    data() {
        return {
            valid: true,
            email: 'example@example.com',
            emailRules: [
                v => !!v || 'email is required'
            ],
            showPassword: false,
            password: '',
            passwordRules: [
                v => !!v || 'password is required'
            ],
        }
    },
    computed: {
        ...mapGetters({
            user: 'auth/user'
        })
    },
    methods: {
        ...mapActions({
            setAlert : 'alert/set',
            setAuth: 'auth/set'
        }),
        submit() {
            if (this.$refs.form.validate()){
                let formData = {
                    'email' : this.email,
                    'password' : this.password,
                }
                let url = '/api/auth_2/login/'
                axios.post(url, formData)
                    .then((response) => {
                        let { data } = response.data
                        console.log(data)
                        this.setAuth(data)
                        if(data.id.length > 0) {
                            this.setAlert({
                                status: true,
                                color: 'success',
                                text: 'login success'
                            })
                            this.close()
                        } else {
                            this.setAlert({
                                status: true,
                                color: 'error',
                                text: 'login failed'
                            })
                        }
                    })
                
            }
        },
        close() {
            this.$emit('closed', false)
        }
    }
}
</script>