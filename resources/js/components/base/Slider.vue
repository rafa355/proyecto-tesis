<template>
    <div class="page_content_main_slider" id="home">
        <div class="swiper-container main_slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide" style="background: transparent">
                    <div class="container page_content_slider">
                        <div class="row text_center_row">
                            <div class="col-md-6 col-sm-5 before_column_insert col-md-push-6 col-sm-push-7">
                                <img src="images/slider/mobile.png" alt="Objetos de Aprendizaje" class="mobile_slider_img">
                            </div>
                            <div class="col-md-6 col-sm-7 before_column_insert_1 col-md-pull-6 col-sm-pull-5">
                                <div class="page_content_slider_1">
                                    <!-- <h1>Appland <span class="for_making_heading_lights">is</span> Perfect <span class="for_making_heading_lights">for</span> <span class="for_making_heading_lights">Business</span> Startups</h1>
                                    <p>Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> -->
                                    <div v-if="btn.length > 0" class="btn_div_inline">
                                        <router-link  class="btn_2 scroll"  v-for="(b, index) in btn" :key="index" :to="{name:b.to}">
                                            {{b.name}}
                                        </router-link>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        btn: {
            default: []
        }
    },

}
</script>