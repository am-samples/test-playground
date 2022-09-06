<template>
  <div class="example-wrapper uk-card uk-card-large uk-card-default">
    <h2>Markdown - dynamic update</h2>
    <div>
      <span>*text* - italic, **text** - bold</span>
      <textarea class="uk-textarea" v-model="text"></textarea>
      <viewer :markdown="text"></viewer>
    </div>
  </div>
</template>

<script>
export default {
  name: "Main",
  data: function () {
    return {
      text: ''
    }
  }
}
</script>

<style>
  .example-wrapper {
    margin: 1em auto;
    padding: 20px;
    min-height: 50vh;
    max-width: 800px;
    width: 95%;
    font: 18px/1.5 sans-serif;
  }
  .example-wrapper code {
    background: #F5F5F5;
    padding: 2px 6px;
  }
</style>