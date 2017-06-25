<template>
<div id="landing">
  <div class="top-bg">
    <div class="container">
    <div class="hero row">
      <div class="col-sm-12">
        <h1>Z vašo idejo do projekta, ki bo obračal glave</h1>
        <p>Naša ekipa z eksperti na področju razvoja s spletnimi tehnologijami ima samo en cilj - razviti projekt, kot ste si ga zamislili vi.</p>

        <router-link to="/kontakt" class="btn btn-primary">ŽELIM BREZPLAČNO PONUDBO</router-link>
      </div>
    </div>
    <div class="services row">
      <div class="col-md-4">
        <div class="services__box services--grey">
          <h2>Spletne strani in spletne trgovine</h2>
          <p>Naj vaš posel ne počiva niti, ko počivate vi. Izdelujemo moderne spletne strani ter privlačne trgovine, ki bodo prodajale kar same. Z vami smo od ideje do produkta.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="services__box services--black">
          <h2>Razvoj spletnih aplikacij</h2>
          <p>Zagotavljamo vam produkt z naprednimi funkcijami in uporabniku prijaznim vmesnikom, ki bo pospešil delovanje vašega podjetja.
        </p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="services__box services--green">
          <h2>Razvoj mobilnih aplikacij</h2>
          <p>Izdelujemo hibridne mobilne aplikacije s pomočjo naprednih spletnih tehnologij. Končano aplikacijo objavimo na tržnici App Store in Google Play.</p>
          <!--<p>Celostna grafična podoba naredi na kupce takojšen vtis. Zakaj ne bi ciljali na najboljše in jih privabili že na prvi pogled?</p>-->
        </div>
      </div>
    </div>
  </div>
  </div>
  <div class=" middle-bg">
    <div class="container">
      <div class="cta row">
        <div class="cta__lang col-sm-12">
          <h3>Jeziki katere govorimo</h3>
          <p>Če vam oznake PHP, MySQL, SASS/CSS3, JavaScript, Ajax in HTML5 ne povedo ničesar, jih prepustite nam. Mi govorimo njihov jezik.</p>

          <router-link to="/kontakt" class="btn btn-primary">ŽELIM BREZPLAČNO PONUDBO</router-link>
        </div>
      </div>
    </div>
  </div>

  <div class="projects">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h3>Zadnji Projekti</h3>
        </div>
      </div>

      <projects :number="3" :projects="projects" :rendered="projects.length"></projects>
    </div>
  </div>

  <div class="partners">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <h3>Zaupali so nam</h3>
        </div>
        <div class="col-md-3 col-sm-6 partners__partner" v-for="img in partners" :style="{ backgroundImage: 'url(' + img + ')' }"></div>
      </div>
    </div>
  </div>

  <div class="cta__bottom">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h3>Rastemo skupaj z vami!</h3>
          <p>S pomočjo natančne analize vedenja uporabnikov pripravimo produkt, ki bo izboljšal <b>konverzijo in pospešil prodajo</b>. Nudimo svetovanje na podlagi naprednih matrik in projekt pripeljemo od ideje do cilja.</p>

          <router-link to="/kontakt" class="btn btn-white">POŠLJITE POVRPRAŠEVANJE</router-link>

        </div>
      </div>
    </div>
  </div>

  <testimonials :base_url="base_url" :items="testimonials" :rendered="testimonials.length"></testimonials>

</div>

</template>


<script type="text/babel">

  import Projects from '../components/projects.vue';
  import Testimonials from '../components/testimonials.vue';

export default {
  name: 'landing',
  components: {
    projects: Projects,
    testimonials: Testimonials
  },
  props: ['base_url'],
  data () {
    return {
      testimonials: [],
      projects: [
      ],
      partners: ['/wp-content/uploads/2017/t1.png','/wp-content/uploads/2017/t2.png','/wp-content/uploads/2017/t3.png','/wp-content/uploads/2017/t4.png'],
    }
  },
  created() {
    this.$router.app.$children[0].$emit('invertHeader', false)

      this.$http.get(this.base_url + 'wp-json/wp/v2/reference', {}).then(response => {
        if (response.status == 200) {
          this.testimonials = response.data
        }
      });

      this.getProjects();

  },
  metaInfo() {
    return {
      title: 'Spletni bit',
    }
  },
  methods: {
    getProjects() {
      this.$http.get(this.base_url + 'wp-json/wp/v2/projekti').then(response => {
        if (response.status == 200) {
          this.projects = response.data.slice(0, 3);
        }
      });
    }
  }

}
</script>