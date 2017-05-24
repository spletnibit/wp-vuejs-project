<template>
<div id="project">
    <div class="inner__header" :style="{ backgroundColor: item.acf.color }">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>{{ item.title.rendered }}</h1>
                    <p>{{ item.acf.short_desc }}</p>
                </div>
            </div>
        </div>
    </div>

    <div id="project__content" class="container">
        <div class="row">
            <div class="col-sm-12">
                <img class="img-fluid" :src="item.acf.projekt_devices" />

                <div class="single-project__section">
                    <h3>Opis Projekta</h3>
                    <p v-html="item.content.rendered"></p>
                </div>

                <div class="single-project__section single-project__features">
                    <div class="single-project__feature" v-for="feature in item.acf.features">
                        <div class="single-project__feature--bg" :style="{ backgroundColor: item.acf.color }">

                        </div>
                        {{ featuresDict[feature] }}
                    </div>
                </div>


                <testimonials></testimonials>
            </div>
        </div>
    </div>
</div>

</template>

<script type="text/babel">

    import Testimonials from '../components/testimonials.vue';

    export default {
        name: 'project',
        props: ['base_url'],
        components: {
            testimonials: Testimonials
        },
        data() {
            return {
                item: {
                    acf: {
                        color: null,
                        features: [],
                        short_desc: null
                    },
                    title: {
                        rendered: null
                    },
                    content: {
                        rendered: null
                    }
                },
                featuresDict: {
                    rwd: 'Odziven design',
                    ux: 'Uporabniška izkušnja',
                    wp: 'Wordpress',
                    dev: 'Razvoj'
                },
                rendered: false

            }
        },
        created() {
            this.$router.app.$children[0].$emit('invertHeader', true)


            this.$http.get(this.base_url + 'wp-json/wp/v2/projekti', {
                params: {
                    slug: this.$route.params.slug
                }
            }).then(response => {
                if (response.status == 200 && response.data.length) {
                    this.item = response.data[0];
                    window.scrollTo( 0, 0 );

//                    this.$router.app.$children[0].$emit('invertHeader', this.item.acf.invert_header)
                    this.$router.app.$children[0].$emit('headerBgColor', this.item.acf.color)
                }
            });
        }
    }
</script>