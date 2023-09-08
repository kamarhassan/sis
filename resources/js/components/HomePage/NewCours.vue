<template>
  <div>
   <div>
      <OwlCaresoulitemVue/>

   </div>
  </div>
</template>
<script>
import OwlCaresoulitemVue from '../Block/OwlCaresoulitem.vue'

export default {
   name: "new-cours",
   data() {
     return { courss: [] };
   },
   components:{
      OwlCaresoulitemVue
   },
   mounted() {
     console.log("new cours mounted");
     this.getImageSlider();
   },
   methods: {
     getImageSlider() {
       axios
         .get("api/cours")
         .then((res) => {
           this.courss = res.data;
           console.log(this.courss);
         })
         .then((err) => console.log(err));
     },
    
   },
 };
 </script>
  