<template>
  <main-layout :class="[contentClass]">
      <v-container fluid grid-list-md>
        <v-layout row wrap>
            <v-breadcrumbs icons divider="forward">
                <v-breadcrumbs-item
                active-class="primary--text"
                :disabled="false"
                to="/"
                >
                    Home
                </v-breadcrumbs-item>
                <v-breadcrumbs-item
                active-class="primary--text"
                :disabled="false"
                to="/categories"
                >
                    Categories
                </v-breadcrumbs-item>
                <v-breadcrumbs-item
                :disabled="true"
                >
                    {{ slug | capitalize }}
                </v-breadcrumbs-item>
            </v-breadcrumbs>
        </v-layout>
        <v-divider inset></v-divider>
        <v-layout row wrap>
          <v-flex
            xs12 sm12 md3 lg3 xl3
            v-for="(product,index) in products"
            :key="product.slug" :index="index"
          >
            <v-card>
            <clazy-load :src="product.image">
                <transition name="fade" slot="image">
                    <v-card-media
                        :src="product.image"
                        height="200px"
                    >
                        <v-container fill-height fluid>
                            <v-layout fill-height>
                                <v-flex xs12 align-end flexbox>
                                <span class="headline" v-text="product.name"></span>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card-media>
                </transition>
                <transition name="fade" slot="placeholder">
                    <v-card-media
                    src="/img/Bars.svg"
                    height="200px"
                    width="200px"
                    >
                        <v-container fill-height fluid>
                            <v-layout fill-height>
                                <v-flex xs12 align-end flexbox>
                                    <span class="headline" v-text="product.name"></span>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card-media>
                </transition>
              </clazy-load>
              <v-card-actions class="accent">
                <span class="body-2">{{product.price | currency(currency)}}</span>
                <v-tooltip right lazy>
                <v-btn flat icon color="teal lighten-4" slot="activator" @click.native="showProduct(product.slug)">
                <v-icon>fa-info-circle</v-icon>
                </v-btn>
                <span>View | {{product.name}} Details</span>
                </v-tooltip>
                <v-spacer></v-spacer>
                <v-tooltip left lazy v-if="product.inCart">
                <v-btn flat icon color="error" slot="activator" @click.native="removeFromCart(product)" v-if="product.inCart">
                <v-icon>remove_shopping_cart</v-icon>
                </v-btn>
                <span>Remove | {{product.name}} in Cart</span>
                </v-tooltip>
                <v-tooltip left lazy v-if="product.inCart">
                <v-btn flat icon color="primary" slot="activator" @click.native="viewCart()" v-if="product.inCart">
                <v-badge left>
                <span slot="badge">{{ product.qty }}</span>
                <v-icon>shopping_cart</v-icon>
                </v-badge>
                </v-btn>
                <span>{{ product.name }} Qty: {{ product.qty }}</span>
                </v-tooltip>
                <v-tooltip left lazy>
                <v-btn flat icon color="info" slot="activator" @click.native="addToCart(product)">
                <v-icon>add_shopping_cart</v-icon>
                </v-btn>
                <span>Add To Cart | {{product.name}}</span>
                </v-tooltip>
                <!-- Add Other Action buttons Here -->
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
        <v-layout v-if="!noPagination" row wrap>
            <v-flex xs12>
                <div class="text-xs-center">
                    <v-pagination
                    :length="length"
                    v-model.number="page"
                    circle
                    >
                    </v-pagination>
                </div>
            </v-flex>
        </v-layout>
        <!-- If No Pagination Then Add 50px Height -->
        <v-layout v-else row wrap>
            <v-flex xs12>
                <v-card flat class="grey lighten-4" height="50px"></v-card>
            </v-flex>
        </v-layout>
      </v-container>
    </v-flex>
  </v-layout>
  </main-layout>
</template>
</template>

<script>
import MainLayout from '../layouts/Main.vue'
import Theme from '../mixins/theme'
import { createNamespacedHelpers } from 'vuex'
const { mapActions, mapGetters } = createNamespacedHelpers('cart')

export default {
    props: ['slug', 'query'],
    mixins: [Theme],
    components: {
        MainLayout
    },
    data: () => ({
        contentClass: { 'grey': true, 'lighten-4': true, 'accent--text': true },
        currency: '₱',
        products: [],
        links: {
            first: null,
            last: null,
            prev: null,
            next: null
        },
        meta: {
            current_page: 1,
            from: 0,
            last_page: 0,
            path: null,
            per_page: 0,
            to: 0,
            total: 0
        },
        page: 1
    }),
    computed: {
        ...mapGetters({
            getItems: 'getItems'
        }),
        length () {
            let self = this
            return Math.round(self.meta.total / (self.meta.per_page))
        },
        noPagination () {
            let self = this
            return self.meta.total === self.meta.per_page
        }
    },
    created () {
        /* important if redirecting back to populate our product list */
        this.getProducts()
    },
    mounted () {
        let self = this
        self.page = parseInt(self.query.page)
    },
    methods: {
        ...mapActions({
            addItem: 'addItem',
            removeItem: 'removeItem'
        }),
        /* Adapter for product and cart Items */
        setInCart () {
            let self = this
            let items = Object.values(self.getItems)
            if (items.length > 0) {
                let inCart = items.filter(function (item) {
                    return self.products.some(function (product) {
                        return product.id === item.id
                    })
                })
                inCart.forEach(function (payload) {
                    let product = _.find(self.products, { id: payload.id })
                    let index = _.findIndex(self.products, { id: payload.id })
                    product.inCart = true
                    product.qty = payload.qty
                    self.$set(self.products, index, product)
                })
            }
        },
        showProduct (slug) {
            let self = this
            self.$router.push({ name: 'product.show', params: { slug: slug } })
        },
        viewCart () {
            let self = this
            self.$router.push({ name: 'cart' })
        },
        addToCart (product) {
            let self = this
            product.inCart = true
            product.qty = product.qty || 1
            self.addItem(product.sku)
        },
        removeFromCart (product) {
            let self = this
            product.qty = 0
            product.inCart = false
            self.removeItem(product.id)
        },
        async getProducts () {
            let self = this
            let slug = {slug: self.$route.params.slug}
            await axios.get(`${route('api.category.show', slug)}/?page=${self.page}`).then((response) => {
                self.products = response.data.data
                self.links = response.data.links
                self.meta = response.data.meta
                self.setInCart()
            }).catch(({errors, message}) => {
                console.log(errors)
                self.$popup({ message: message, backgroundColor: '#e57373', delay: 5, color: '#fffffa' })
            })
        },
        async loadProducts () {
            let slug = {slug: self.slug}
            await axios.get(`${route('api.category.show', slug)}/?page=${self.page}`).then((response) => {
                self.products = response.data.data
                self.links = response.data.links
                self.meta = response.data.meta
                self.setInCart()
                vm.$popup({ message: `${self.$route.params.slug} Page: ${self.page}`, backgroundColor: '#4db6ac', delay: 5, color: '#fffffa' })
            }).catch(({errors, message}) => {
                console.log(errors)
                self.$popup({ message: message, backgroundColor: '#e57373', delay: 5, color: '#fffffa' })
            })
        }

    },
    watch: {
        getItems () {
            let self = this
            /* if items in cart change we should Set what is in the cart */
            self.setInCart()
        },
        products: {
            handler: function () {
                console.log('Products Array Updated')
            },
            deep: true
        },
        page (newValue) {
            let self = this
            self.page = newValue
            self.$router.push({ name: 'category.show', query: { page: newValue }, params: { slug: self.$route.params.slug } })
            vm.$popup({ message: `${self.$route.params.slug} Page: ${self.page}`, backgroundColor: '#4db6ac', delay: 5, color: '#fffffa' })
        },
        '$route': 'loadProducts'
    }
}
</script>
