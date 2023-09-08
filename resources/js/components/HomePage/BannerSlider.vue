<template>
  <div class="banner">
    <div class="card-content">
      <div class="card-body">
        <div
          id="carousel-example-caption"
          class="carousel slide"
          data-ride="carousel"
        >
          <ol class="carousel-indicators">
            <li
              v-for="(slider, index) in sliders"
              :key="index"
              data-target="#carousel-example-caption"
              :data-slide-to="index"
              :class="[{ active: index === 0 }]"
            ></li>
          </ol>

          <div class="carousel-inner" role="listbox">
            <div
              v-for="(slider, index) in sliders"
              :key="index"
              :class="['carousel-item', { active: index === 0 }]"
            >
              <img :src="slider.image" width="100%"/>
              <div class="carousel-caption">
                <a
                  v-if="slider.link != null"
                  :href="slider.link" 
                  target="_blank"
                  ><h3 class="btn btn-outline-success">
                    {{ slider.link_label }}
                  </h3></a
                >
                <p v-if="slider.description != null">
                  {{ slider.description }}
                </p>
              </div>
            </div>
          </div>

          <a
            class="carousel-control-prev"
            href="#carousel-example-caption"
            role="button"
            data-slide="prev"
          >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a
            class="carousel-control-next"
            href="#carousel-example-caption"
            role="button"
            data-slide="next"
          >
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>
 
 <script>
export default {
  name: "banner-slider",
  data() {
    return { sliders: [] };
  },
  mounted() {
    console.log("banner mounted");
    this.getImageSlider();
  },
  methods: {
    getImageSlider() {
      axios
        .get("api/slider")
        .then((res) => {
          this.sliders = res.data.slider;
          console.log(this.sliders);
        })
        .then((err) => console.log(err));
    },
   
  },
};
</script>
 