<template>
<v-container fluid class="pa-0 ma-0" :class="[contentClass]">
    <v-layout row wrap>
    <v-flex xs12 sm12 md3 lg3 xl3>
        <v-subheader class="headline primary--text">Featured Products</v-subheader>
        <v-list dense :class="[contentClass]">
        <v-link title="Grape juice with Garcinia Cambogia" :href="'/products/grape-juice-with-garcinia-cambodia'"></v-link>
        <v-link title="Organic Pure Barley Powered Drink" :href="'/products/organic-pure-barley-powered-drink'"></v-link>
        <v-link title="Coffee Mix with Glutathione" :href="'/products/coffee-mix-with-gluthathione'"></v-link>
        <v-link title="Choco Barley Powered Drink" :href="'/products/choco-barley-powdered-drink'"></v-link>
        </v-list>
    </v-flex>
    <v-flex xs12 sm12 md3 lg3 xl3>
        <v-subheader class="headline primary--text">Featured Food Carts</v-subheader>
        <v-list dense :class="[contentClass]">
        <v-link title="Mang Siomai" :href="'/products/mang-siomai'"></v-link>
        <v-link title="Hongkong Fried Noodles" :href="'/products/hongkong-fried-noodles'"></v-link>
        <v-link title="Dumpling King" :href="'/products/dumpling-king'"></v-link>
        <v-link title="Chinky Pao" :href="'/products/chinky-pao'"></v-link>
        </v-list>
    </v-flex>
    <v-flex xs12 sm12 md3 lg3 xl3>
        <v-subheader class="headline primary--text">Compliance</v-subheader>
        <v-list dense :class="[contentClass]">
        <v-link title="Cookie Policy" :href="'/cookie-policy'"></v-link>
        <v-link title="Privacy Policy" :href="'/privacy-policy'"></v-link>
        <v-link title="Refund Policy" :href="'/refund-policy'"></v-link>
        <v-link title="Anti-Spam Policy" :href="'/anti-spam-policy'"></v-link>
        </v-list>
    </v-flex>
    <v-flex xs12 sm12 md3 lg3 xl3>
        <v-subheader class="headline primary--text">Contact Details</v-subheader>
        <v-list dense :class="[contentClass]">
        <v-link title="Landline" :href="'/facebook'"></v-link>
        <v-link title="Mobile 1" :href="'/twitter'"></v-link>
        <v-link title="Mobile 2" :href="'/instagram'"></v-link>
        <v-link title="Mobile 3" :href="'/linkedin'"></v-link>
        <v-link title="Viber" :href="'/youtube'"></v-link>
        </v-list>
    </v-flex>
    </v-layout>
</v-container>

</template>

<script>
import VLink from '../components/VLink.vue'
export default {
    data: () => ({
        contentClass: {'accent': true}
        // Get Referral Cookie Info For Contact Details
    }),
    components: {
        VLink
    }
}
</script>

<style>

</style>
