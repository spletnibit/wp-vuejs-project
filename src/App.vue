<template>
  <div id="app" :class="cssClass">

      <header class="header" :style="{ backgroundColor: header_bg_color }">
          <div class="container">
              <div class="row">
                  <div class="col-md-4 col-sm-12">
                      <router-link to="/" class="header__logo">
                          <object data="/wp-content/themes/spletnibit/dist/img/logo.svg" type="image/svg+xml" class="img-fluid header__logo_img">
                              <img src="/wp-content/themes/spletnibit/dist/img/logo.png"  class="img-fluid header__logo_img" />
                          </object>

                          <object data="/wp-content/themes/spletnibit/dist/img/logo_black.svg" type="image/svg+xml" class="img-fluid header__logo_black_img">
                              <img src="/wp-content/themes/spletnibit/dist/img/logo_black.png"  class="img-fluid header__logo_black_img" />
                          </object>

                          <object data="/wp-content/themes/spletnibit/dist/img/logo_white_head.svg" type="image/svg+xml" class="img-fluid header__logo_white_head_img">
                              <img src="/wp-content/themes/spletnibit/dist/img/logo_white_head.png"  class="img-fluid header__logo_white_head_img" />
                          </object>
                      </router-link>
                  </div>

                  <div class="col-md-8 col-sm-12">
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

      <transition name="scaleDown" mode="out-in" appear>
          <router-view :key="$route.fullPath" :base_url="base_url"></router-view>
      </transition>
    <foot></foot>
  </div>
</template>

<script type="text/babel">

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
            header_bg_color: '#fff',
            cssClass: {
                'header--inverted': false
            }
        }
    },
    watch: {
        '$route' (to, from) {
            this.removeRouteCss();
            this.cssClass['route-'+to.name] = true;
        }
    },
    created() {
        this.$on('invertHeader', function(val) {
            this.cssClass['header--inverted'] = val
//            if (!val) {
//                this.header_bg_color = '#fff'
//            }
        });

        this.$on('routeProject', function() {
            this.cssClass['route-project'] = true;
        });

        this.$on('headerBgColor', function(val) {
            this.header_bg_color = val
        });
    },
    methods: {
        removeRouteCss() {
            for( var selector in this.cssClass) {
                if (selector.indexOf('route-') !== -1) {
                    delete this.cssClass[selector];
                }
            }
        }
    }
}
</script>