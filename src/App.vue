<template>
  <div id="app">

      <header :class="{ 'header': true, 'header--inverted': invert_header }" :style="{ backgroundColor: header_bg_color }">
          <div class="container">
              <div class="row">
                  <div class="col-md-6 col-sm-12">
                      <router-link to="/" class="header__logo"></router-link>
                  </div>

                  <div class="col-md-6 col-sm-12">
                    <ul class="header__meni">
                        <li>
                            <router-link to="/">Domov</router-link>
                        </li>
                        <li>
                            <router-link to="/projekti">Projekti</router-link>
                        </li>
                        <li>
                            <router-link to="/kontakt">Kontakt</router-link>
                        </li>
                        <li class="phone">
                            <a href="tel:+386 31 724 182">+386 31 724 182</a>
                        </li>
                    </ul>
                  </div>
              </div>
          </div>
      </header>

      <transition name="fade" mode="out-in">
          <router-view :base_url="base_url"></router-view>
      </transition>
    <foot></foot>
  </div>
</template>

<script>

import Foot from './components/foot.vue';

export default {
    name: 'app',
    components: {
        foot: Foot
    },
    data () {
        return {
            base_url: document.getElementsByTagName('base')[0].href,
            invert_header: false,
            header_bg_color: '#fff'
        }
    },
    created() {
        this.$on('invertHeader', function(val) {
            this.invert_header = val
            if (!val) {
                this.header_bg_color = '#fff'
            }
        });

        this.$on('headerBgColor', function(val) {
            this.header_bg_color = val
        });
    }
}
</script>