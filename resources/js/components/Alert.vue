<template>
    <div>
        <v-snackbar
            v-model="alert"
            color="success"
            multi-line
            outlined
        >
            {{ text }}

            <template v-slot:action="{ attrs }">
                <v-btn
                    color="red"
                    text
                    v-bind="attrs"
                    @click="close"
                >
                    Close
                </v-btn>
            </template>
        </v-snackbar>
    </div> 
</template>

<script>
    import { mapGetters, mapActions } from "vuex";
    export default {
        name: 'alert',
        computed: {
            ...mapGetters({
                status: 'alert/status',
                color: 'alert/color',
                text: 'alert/text',
            }),
            alert: {
                get() {
                    return this.status
                },
                set() {
                    this.setAlert({
                        status: false
                    })
                }
            },
        },
        methods: {
            ...mapActions({
                setAlert : 'alert/set'
            }),
            close(){
                this.setAlert({
                    status: false
                })
            }
        }
}
</script>