<template>
    <div id="single">

        <div class="modal_share__wrapper" v-if="showModal">
            <div class="modal_share">
                <a v-on:click="closeModal" href="#" class="close_modal"></a>
                <h2>Super, deli ga še z prijatelji! </h2>
                <p>V Antonovi okusni nagradni igri si bo paket piknik dobrot prislužil tisti ali tista z največ všečki. Deli svojo mojstrovino s prijatelji in jih povabi na piknik. </p>

                <a v-on:click="share" href="#" class="btn btn-fb">Deli recept z prijatelji</a>
                <a v-on:click="closeModal" href="#" class="btn btn-grey">Zapri</a>
            </div>
        </div>

        <header class="single" :style="{ 'background-image': 'url(' + recept.acf.slika.sizes.large + ')' }">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <router-link to="/" class="hero__logo"><img src="/wp-content/themes/mesaranton/dist/img/logo.png" /></router-link>
                    </div>
                </div>
            </div>
        </header>

        <div class="single__content">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2 col-sm-12 single__back">
                        <router-link to="/" class="single__back-link"></router-link>
                        <h1 v-if="recept">{{ recept.title.rendered }}</h1>

                        <div class="single__social">
                            <iframe :src="getLikeIframeSrc" frameborder="0"></iframe>
                        </div>
                        <div class="single__author" v-if="recept">{{ recept.acf.avtor }}</div>
                        <hr>
                        <div class="single__fb-cta">
                            <span>Všečkaj recept in pomagaj do zmage!</span>

                            <div class="fb-like">
                                <iframe :src="getLikeIframeSrc" frameborder="0"></iframe>
                            </div>
                            <a href="#" class="btn">Všečkaj</a>
                        </div>
                        <hr>

                        <div class="recipe-full">
                            <p v-if="recept" v-html="recept.content.rendered">
                            </p>

                            <dl v-if="recept">
                                <dt v-if="recept.acf.priprava">PRIPRAVA</dt>
                                <dd v-if="recept.acf.priprava">
                                    <p v-html="recept.acf.priprava"></p>
                                </dd>

                                <dt v-if="recept.acf.sestavine">SESTAVINE</dt>
                                <dd v-if="recept.acf.sestavine">
                                    <p v-html="recept.acf.sestavine"></p>
                                </dd>
                            </dl>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="text-section text-section--bg3">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <h2>Deli svoj recept in osvoji paket mesnih dobrot!</h2>
                        <p>V Antonovi okusni nagradni igri sodeluješ čisto enostavno. Spodaj po korakih vpiši želene podatke - od naslova recepta pa vse do edinstvenega načina priprave, ki ga želiš deliti z drugimi. Ne pozabi na sestavine!</p>
                        <p>Nato podeli svoj recept na Facebook omrežju - zmagal bo namreč recept z največ všečki. Držimo pesti, da bo tvoj naslednji piknik še boljši - z Antonom!</p>

                        <div class="cta__wrapper col-sm-12 hidden-md-up">
                            <div class="cta__text">SODELUJ TUDI TI IN ZADENI PAKET PIKNIK DOBROT</div>
                        </div>

                        <router-link to="/dodaj" class="btn btn-primary mt-20">Sodeluj in oddaj svoj recept!</router-link>

                        <div class="cta__wrapper cta__wrapper--2-up col-sm-12 hidden-md-down">
                            <div class="cta__text cta__text--2-up">SODELUJ TUDI TI IN ZADENI PAKET PIKNIK DOBROT</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="recipes">
            <div class="container">
                <div class="row">
                    <div class="col-md-12"><h2>Recepti naših oboževalcev!</h2></div>
                    <recept v-for="r in recepti" :data="r" :key="r.id"></recept>

                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import Recept from '../components/recept.vue';
    import latest from '../mixins/latest';
    import fb from '../mixins/fb';

    export default {
        name: 'single',
        mixins: [latest, fb],
        props: ['base_url'],
        data () {
            return {
                likeCount: 0,
                showModal: false,
                recept: {
                    title: {
                        rendered: ''
                    },
                    content: {
                        rendered: ''
                    },
                    acf: {
                        priprava: '',
                        slika: {
                            sizes: {
                                large: '',
                                medium_large: ''
                            }
                        }
                    }
                },
                bgImage: null
            }
        },
        components: {
            recept: Recept
        },
        metaInfo() {
            return {
                title: this.recept ? this.recept.title.rendered : '',
                titleTemplate: '%s | Mesar Anton',
                meta: [
                    {property: 'og:url', content: this.base_url+this.$route.path},
                    {property: 'og:type', content: 'article'},
                    {property: 'og:title', content: (this.recept ? this.recept.title.rendered : '')},
                    {property: 'og:description', content: (this.recept.acf ? this.recept.acf.priprava : '')},
                    {property: 'og:image', content: ''},
                ]
            }
        },
        watch: {
            '$route' (to, from) {
                // react to route changes...
                if (to.path != from.path) {
                    if (to.path.indexOf('/recepti/') !== -1) {
                        let slug = to.path.replace('/recepti/','');
                        this.getRecept(slug);

                    }
                }
            },
            bgImage() {
                if (this.recept != null && typeof this.recept.acf != 'undefined' &&  this.recept.acf.length) {
                    return this.recept.acf.slika.sizes.large;
                }

                return '';
            },
        },

        mounted() {
            this.getRecept(this.$route.params.slug);
            if (typeof this.$route.query.thankyou !== 'undefined') {
                this.showModal = true;
            }
            window.scrollTo( 0, 0 );


        },
        computed: {
            getLikeUrl() {
                return this.base_url + 'recepti/'+ this.recept.slug
            },
            getLikeIframeSrc() {
                if (this.recept != null) {
                return 'https://www.facebook.com/v2.9/plugins/like.php?action=like&app_id=523407941381727&domain='+this.base_url.replace('http://')+'&origin='+this.base_url+'&relation=parent.parent&container_width=0&href='+this.base_url + 'recepti/'+ this.recept.slug+'&layout=button_count&locale=sl_SI&sdk=joey&send=true&share=false&show_faces=false&size=large';

                } else {
                    return '';
                }
            }
        },
        methods: {
            share(e) {

                let shareUrl = 'https://www.facebook.com/sharer/sharer.php?u=' +
                        encodeURIComponent(this.base_url+ this.$route.path).replace(/%20/g,'+')
                        + '&quote=' + encodeURIComponent(this.recept.content.rendered).replace(/%20/g,'+')
                        + '&title=' + encodeURIComponent(this.recept.title.rendered).replace(/%20/g,'+');

                if (typeof this.recept.acf.slika != 'undefined') {
                    shareUrl += '&picture=' + encodeURIComponent(this.recept.acf.slika.sizes.medium_large).replace(/%20/g,'+')
                }

                window.open(shareUrl, '_blank', 'width=520,height=350')
                e.preventDefault();

            },
            closeModal(e) {
                e.preventDefault();
                this.showModal = false;
            },
            getRecept(slug) {
                this.$http.get(this.base_url + 'wp-json/wp/v2/recepti', {
                    params: {
                        slug: slug
                    }
                }).then(response => {
                    if (response.status == 200) {
                    if (response.data.length) {
                        this.recept = response.data[0];
                        this.getLikeCount(this.getLikeUrl);
                        window.scrollTo( 0, 0 );


                        this.$http.get(this.base_url + 'wp-json/acf/v3/recepti/'+this.recept.id, {
                        }).then(response => {
                            if (response.status == 200)
                            {
                                if (typeof response.data.acf != 'undefined' &&  response.data.acf) {
                                    this.recept.acf = response.data.acf
                                } else {
                                    this.recept.acf = []
                                }

                                FB=null;
                                (function(d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0];
                                if (d.getElementById(id)) return;
                                js = d.createElement(s); js.id = id;
                                js.src = "//connect.facebook.net/sl_SI/sdk.js#xfbml=1&version=v2.9&appId=523407941381727";
                                fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));

                            }
                        }, response => { });
                        }
                    }
                }, response => { });
            }
        }
    }
</script>