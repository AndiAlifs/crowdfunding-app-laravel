<template>
    <v-card>
        <v-toolbar dark color="success">
            <v-btn icon dark @click.native="close">
                <v-icon>mdi-close</v-icon>
            </v-btn>
            <v-text-field
                hide-details
                append-icon="mdi-microphone"
                flat
                autofocus
                label="search"
                prepend-inner-icon="mdi-magnify"
                v-model="keyword"
                @input="doSearch"
            ></v-text-field>
        </v-toolbar>
        <v-card-text>
            <v-subheader v-if="keyword.length > 0">
                Result search "{{ keyword }}"
            </v-subheader>
            <v-alert
                :value="campaign.length == 0 && keyword.length > 0"
                color="warning"
                outlined
            >
                Sorry, but no result were found 
            </v-alert>

            <v-container class="ma-0 pa-0" grid-list-sm>
                <v-layout wrap>
                    <v-flex v-for="(campaign, index) in campaign"
                                    :key="'campaign-'+index"
                                    xs6>
                        <campaign-item v-bind:campaign="campaign" @click.native="close"/>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-card-text>
    </v-card>
</template>

<script>
export default {
    name: 'search',
    data() {
        return {
            keyword: '',
            campaign: []
        }
    },
    methods: {
        doSearch() {
            let keyword = this.keyword
            if (keyword.length > 0){
                let url = '/api/campaign/search/'+keyword;
                axios.get(url)
                    .then((response) => {
                        let { data } = response.data
                        console.log(data)
                        this.campaign = data.campaigns
                    })
                    .catch((error) => {
                        let { responses } = error
                        console.log(response)
                    })
            } else {
                this.campaign = []
            }
            console.log(this.campaign.length)
        },
        close() {
            this.$emit('closed', false)
        }
    }
}
</script>