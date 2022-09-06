import Vue from "vue";
import Axios from "axios";
import AsyncComputed from "vue-async-computed";

Vue.use(AsyncComputed);
Vue.prototype.$http = Axios;