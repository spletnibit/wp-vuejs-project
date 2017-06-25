<template>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-xs-12">
                    <img class="footer__logo img-fluid" src="/wp-content/themes/spletnibit/dist/img/logo_white.png" alt="Spletnibit" />

                    <p class="footer__copy">Copyright &copy; SPLETNI BIT, svetovanje in storitve,<br /> Matic Prevolšek, s.p.</p>
                </div>
                <div class="col-sm-8 col-xs-12">
                    <div class="float-md-right">
                        <div class="footer__meni">
                            <b>navigacija</b>

                            <ul>
                                <li><router-link to="/">Domov</router-link></li>
                                <li><router-link to="/projekti">Projekti</router-link></li>
                                <li><router-link to="/kontakt">Kontakt</router-link></li>
                            </ul>
                        </div>

                        <div class="footer__meni hide">
                            <b>socialna omrežja</b>

                            <ul class="footer__social">
                                <li><a class="footer__social--ln" href="#">LinkedIn</a></li>
                                <li><a class="footer__social--fb" href="#">Facebook</a></li>
                            </ul>
                        </div>

                        <div class="footer__meni">
                            <b>kontakt</b>

                            <ul class="footer__contact">
                                <li><a class="footer__contact--phone" href="tel:+38631724182">+386 31 724 182</a></li>
                                <li><a class="footer__contact--mail" href="mailto:info@spletnibit.si">info@spletnibit.si</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </footer>
</template>

<script>

    export default {
        name: 'foot',
        data () {
            return {

            }
        }
    }
</script>