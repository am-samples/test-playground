<template>
  <div class="example-wrapper">
    <article class="uk-article" v-html="renderedHTML"></article>
  </div>
</template>

<script>
export default {
  name: "Viewer",
  props: ['markdown'],
  asyncComputed: {
     async renderedHTML() {
       let markdown = this.markdown;
       let html = await this.$http.post('/markdown', {markdown: markdown});
       return html.data;
     }
  }
}
</script>