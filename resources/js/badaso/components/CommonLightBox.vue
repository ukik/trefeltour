<template>
  <div>
    <!-- <button @click="showSingle">Show single picture.</button> -->
    <!-- <button @click="showMultiple">Show a group of pictures.</button> -->

    <!-- all props & events -->
    <vue-easy-lightbox
      escDisabled
      moveDisabled
      :visible="visible"
      :imgs="imgs"
      :index="index"
      @hide="handleHide"
    ></vue-easy-lightbox>
  </div>
</template>

<script>
// Method.3 Local registration
import VueEasyLightbox from "vue-easy-lightbox";

export default {
  components: {
    VueEasyLightbox,
  },
  data() {
    return {
      imgs: "", // Img Url , string or Array of string
      visible: false,
      index: 0, // default: 0
    };
  },
  props: {
    images: null,
  },
  methods: {
    // showSingle() {
    //   this.imgs = "http://via.placeholder.com/350x150";
    //   // or
    //   this.imgs = {
    //     title: "this is a placeholder",
    //     src: "http://via.placeholder.com/350x150",
    //   };
    //   this.show();
    // },
    showMultiple() {
      //   this.imgs = [
      //     "http://via.placeholder.com/350x150",
      //     "http://via.placeholder.com/350x150",
      //   ];
      //   // or
      //   this.imgs = [
      //     { title: "test img", src: "http://via.placeholder.com/350x150" },
      //     "http://via.placeholder.com/350x150",
      //   ];
      // allow mixing

      if (!this.images) return;

      this.imgs = this.images;

    //   this.index = 1; // index of imgList
      this.show();
    },
    show() {
      this.visible = true;
    },
    handleHide() {
      this.visible = false;
    },
  },
};
</script>
