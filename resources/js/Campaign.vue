<template>
    <div>
        <v-card v-if="campaign.id">
            <v-img
                :src="campaign.image"
                class="white--text"
                height="200px">
                
                <v-card-title
                    class="fill-height align-end"
                    v-text="campaign.title"> </v-card-title>
            </v-img>

            <v-card-text>
                <v-simple-table dense>
                    <tbody>
                        <tr>
                            <td class="pl-0"><v-icon>mdi-home-city</v-icon> Alamat</td>
                            <td>{{ campaign.address }}</td>
                        </tr>
                        <tr>
                            <td class="pl-0"><v-icon>mdi-hand-heart</v-icon> Terkumpul</td>
                            <td class="blue--text">Rp. {{ campaign.collected.toLocaleString('id-ID') }}</td>
                        </tr>
                        <tr>
                            <td class="pl-0"><v-icon>mdi-cash</v-icon> Dibutuhkan</td>
                            <td class="orange--text">Rp. {{ campaign.required.toLocaleString('id-ID') }}</td>
                        </tr>
                    </tbody>
                </v-simple-table>
                Description: <br>
                {{ campaign.description }}
            </v-card-text>
            <v-card-actions>
                <v-btn block color="primary" @click="donate" :disabled="campaign.collected >= campaign.required">
                    <v-icon left color="white">mdi-cash</v-icon>
                    Donate
                </v-btn>
            </v-card-actions>
        </v-card>
    </div> 
</template>

<script>
import Axios from "axios";
import { mapActions, mapGetters, mapMutations } from "vuex";
export default {
    data: () => ({
        campaign: {},
    }),
    created(){
        this.go()
    },
    methods: {
        go(){
            let { id } = this.$route.params
            let url = '/api/campaign/' + id
            axios.get(url)
                .then((response) => {
                    let { data } = response.data
                    console.log(data)
                    this.campaign = data.campaign
                })
                .catch((error) => {
                    let { responses } = error
                    console.log(response)
                })
        },
        ...mapMutations({
            tambahTransaksi: 'transaction/insert'
        }),
        ...mapActions({
            setAlert: 'alert/set'
        }),
        donate(){
            this.tambahTransaksi()
            this.setAlert({
                status: true,
                color : 'success',
                text: 'Donasi '+this.campaign.title+' ditambahkan'
            })
            console.log('masuk');
            let uri = '/api/payment/generate'
            axios.post(uri)
                .then((response) => {
                    // console.log(response.data.data.token)
                    snap.pay(response.data.data.token)
                })
                .catch((error) => {
                    let { responses } = error
                    console.log(response)
                })
        }
    }
}
</script>