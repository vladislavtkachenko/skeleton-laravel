import './bootstrap'
import Vue from 'vue'

import 'fonts'
import 'base'
import Blocks from 'blocks'
import Pages from 'pages'

const app = new Vue({
  el: '#app',
  mounted () {
    console.log('INIT APPLICATION')
    Blocks.init()
    Pages.init()
  }
})
