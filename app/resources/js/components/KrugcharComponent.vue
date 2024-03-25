<template>
<div class='container-fluid' style='border:1px solid red'>
<div class='row'>

<!----
<pie-chart :chart-data="data" :height="200" :options="{responsive: true, maintainAspectRation: true}">
</pie-chart>
----->
<div style="max-width:400px">
 <Pie v-if="data" :data="data" :options="options" />
</div>
</div>
  </div>

</template>

<script>

import axios from 'axios';
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js'
import { Pie } from 'vue-chartjs'
ChartJS.register(ArcElement, Tooltip, Legend)
//import $ from 'jquery';
//import pieChart from '../pieChart.js';
//alert($('meta[name="csrf-token"]').attr('content'));
    export default {
	
    data:function () {
    return {
      data:null,
	  options:{responsive: true, maintainAspectRation: false}
    }
  },
  components: {
	   Pie
	  //pieChart:pieChart
  },
      methods: {
         sendMessage: function(e) {
		 
		   axios.get('charviewkrug')
			.then(response => {
				this.data = response.data;
            })
         }
      },
	   mounted() {
			this.sendMessage();
		 }
	  
	  
    }
</script>
