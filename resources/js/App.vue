<template>
  <!-- App.vue -->
  <v-app>
    <alert/>

    <keep-alive>
        <v-dialog
        v-model="dialog"
        fullscreen
        persistent
        hide-overlay
        transition="scale-transition"
    >
        <component :is="currentComponent" @closed="setDialogStatus"></component>>
    </v-dialog>
    </keep-alive>
    <!-- sidebar -->
    <v-navigation-drawer app v-model="drawer">
        <v-list>
                <v-list-item v-if="!guest">
                    <v-list-item-avatar>
                        <v-img src="https://randomuser.me/api/portraits/men/78.jpg"></v-img>
                    </v-list-item-avatar>
                    <v-list-item-content>
                        <v-list-item-title>{{ user.name }}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <div class="pa-2" v-if="guest">
                    <v-btn block color="primary" class="mb-1" @click="setDialogComponent('login')">
                        <v-icon left>mdi-lock</v-icon>
                        Login
                    </v-btn>
                    <v-btn block color="success">
                        <v-icon left>mdi-account</v-icon>
                        Register
                    </v-btn>
                </div>

                <v-divider></v-divider>

                <v-list-item
                    v-for="(item,index) in menus"
                    :key="'menu-'+index"
                    :to="item.route"
                >

                    <v-list-item-icon>
                        <v-icon left>{{ item.icon }}</v-icon>
                    </v-list-item-icon>

                    <v-list-item-content>             
                        <v-list-item-title>{{ item.title }}</v-list-item-title>
                    </v-list-item-content>

                </v-list-item>
        </v-list>

        <template v-slot:append v-if="!guest">
            <div class="pa-2">
                <v-btn block color="red" dark @click="logout">
                    <v-icon left>mdi-lock</v-icon>
                    Logout
                </v-btn>
            </div>
        </template>
    
    </v-navigation-drawer>

    <!-- header -->
    <v-app-bar app color="success" dark v-if="isHome">
        <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
        <v-toolbar-title>SanberCode App</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn icon>
            <v-badge color="orange" overlap v-if="transaction > 0">
                <template v-slot:badge>
                    <span>{{ transaction }}</span>
                </template>
                <v-icon>mdi-cash-multiple</v-icon>
            </v-badge>
            <v-icon v-else>mdi-cash-multiple</v-icon>
        </v-btn>

        <v-text-field 
            slot="extension"
            hide-details
            append-icon="mdi-microphone"
            flat
            label="search"
            prepend-inner-icon="mdi-magnify"
            solo-inverted
            @click="setDialogComponent('search')"
        ></v-text-field>

    </v-app-bar>

    <v-app-bar app color="success" dark v-else>
        <v-btn icon @click.stop="$router.go(-1)">
            <v-icon>mdi-arrow-left-circle</v-icon>
        </v-btn>
        <v-spacer></v-spacer>
        <v-btn icon>
            <v-badge color="orange" overlap v-if="transaction > 0">
                <template v-slot:badge>
                    <span>{{ transaction }}</span>
                </template>
                <v-icon>mdi-cash-multiple</v-icon>
            </v-badge>
            <v-icon v-else>mdi-cash-multiple</v-icon>
        </v-btn>
    </v-app-bar>

    <!-- Content -->
    <v-main>
      <!-- Provides the application the proper gutter -->
      <v-container fluid>
        <!-- If using vue-router -->
        <v-slide-y-transition>
            <router-view></router-view>
        </v-slide-y-transition>
      </v-container>
    </v-main>

    <!-- footer -->
    <v-card>
        <v-footer app>
            <v-card-text absolute class="text-center">
                &copy; {{ new Date().getFullYear() }} - <strong>SongGi Tech Studio</strong>
            </v-card-text>
        </v-footer>
    </v-card>
  </v-app>
</template>

<script>
    import { mapActions, mapGetters } from "vuex";
    import Search from './components/Search.vue';
    export default {
    components: { Search },
        name: 'App',
        data: () => ({
            drawer: false,
            menus: [
                {title: 'Home', icon:'mdi-home', route: '/'},
                {title: 'Donations', icon:'mdi-cash-usd-outline', route: '/donations'},
                {title: 'Campaigns', icon:'mdi-hand-heart', route: '/campaigns'}
            ],
            // guest: false,
            // dialog: false,
        }),
        computed: {
            isHome() {
                return (this.$route.path === '/' || this.$route.path === '/home' )
            },
            ...mapGetters({
                transaction : 'transaction/transaction',
                guest: 'auth/guest',
                user: 'auth/user',
                token: 'auth/token',
                dialogStatus: 'dialog/status',
                currentComponent: 'dialog/component'
            }),
            dialog: {
                get() {
                    return this.dialogStatus
                },
                set() {
                    return this.setDialogStatus(value)
                }
            }
        },
        methods: {
            ...mapActions({
                setDialogStatus: 'dialog/setStatus',
                setDialogComponent: 'dialog/setComponent',
                setAuth: 'auth/set',
                setAlert : 'alert/set',

            }),
            logout() {
                let config = {
                    headers: {
                        'Authorization': 'Bearer ' + this.token
                    },
                }
                axios.post('api/auth/logout', {}, config)
                .then((response) => {
                    this.setAuth({
                        'user': {},
                        'token': {}
                    })
                    this.setAlert({
                                    status: true,
                                    color: 'success',
                                    text: 'logout success'
                                })
                })
                .catch((error) => {
                    let {data} = error.response
                    this.setAlert({
                                    status: true,
                                    color: 'error',
                                    text: 'data.message'
                                })
                })
                
            }
        },
        
    };
</script>
