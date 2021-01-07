<template>
    <div>
        <v-container class="ma-0 pa-0" grid-list-m>
            <div class="text-right">
                <v-btn small text to="/campaigns" class="blue--text">
                    All campaign <v-icon>mdi-chevron-right</v-icon>
                </v-btn>
            </div>
            <v-layout wrap>
                <v-flex v-for="(campaign, index) in campaigns"
                                :key="'campaign-'+index"
                                xs6>
                    <campaign-item v-bind:campaign="campaign" />
                </v-flex>
            </v-layout>
        </v-container>
        <v-container class="ma-0 pa-0" grid-list-m>
            <div class="text-right">
                <v-btn small text to="/blogs" class="blue--text">
                    All blog <v-icon>mdi-chevron-right</v-icon>
                </v-btn>
            </div>
            <v-layout wrap>
                <v-carousel hide-delimiters height="250" m-2>
                    <v-carousel-item v-for="(blog, i) in blogs"
                                :key="'blog-'+i"
                                xs6
                                class="mx-2">
                        <v-img :src="blog.image" class="fill-height">
                            <v-container fill-height fluid pa-0 ma-0>
                                <v-layout fill-height align-end>
                                    <v-flex xs12 p-2 class="text-center" style="background-color: rgba(255, 255, 255, 0.5)">
                                        <span class="subtitle-1 black--text text-capitalize" v-text="blog.title"> </span>
                                    </v-flex>
                                </v-layout>
                            </v-container>
                        </v-img>
                    </v-carousel-item>
                </v-carousel>
            </v-layout>
        </v-container>
    </div> 
</template>

<script>
export default {
    data: () => ({
        campaigns: [],
        blogs: []
    }),
    created(){
        axios.get('api/campaign/random/2')
                .then((response) => {
                    let { data } = response.data
                    console.log(data)
                    this.campaigns = data.campaigns
                })
                .catch((error) => {
                    let { response } = error
                    console.log(response)
                }),
        axios.get('api/blog/random/2')
                .then((response) => {
                    let { data } = response.data
                    console.log(data)
                    this.blogs = data.blogs
                })
                .catch((error) => {
                    let { response } = error
                    console.log(response)
                })
    }
}
</script>