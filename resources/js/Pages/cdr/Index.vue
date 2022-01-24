<template>
	<layout>
		  <div class="container">
					
					<div class="row">
						<div class="col-md-12">
							<h2>Cargo Delivery Report</h2>
						</div>
					</div>

					<div class="row mb=3">
						<div class="col-md-12">
							<form href="/cdr/list" method="get" class="form-inline">
								<label class="m-1">From:</label>
								<input type="date" lang="en" format="YYYY-MM-DD" name="fromDate" class="m-1"></input>
								<label class="m-1">To:</label>
								<input type="date" lang="en" format="YYYY-MM-DD" name="toDate" class="m-1"></input>

								<input type="text" class="m-2 col-md-3" placeholder="Search by Source" name="search">

								<input type="text" class="m-2 col-md-3" placeholder="Search by Destination" name="dst">

								<input type="radio" name="prefer" value="0" class="m-1"  checked="checked">Like
								<input type="radio" name="prefer" value="1" class="m-1">Equal

								<center><button class="btn btn-primary m-2">Search</button>

								<a href="/cdr/list" class="m-2">Reset</a></center>

							</form>
						</div>
					</div>

			<div class="overflow-auto">
			    <b-table
			      id="my-table"
			      :bordered="true"
			      :items="cdr"
			      :fields="fields"
			      :data="cdr"
			      :per-page="perPage"
			      :current-page="currentPage"
			      small>

				<template v-slot:cell(result)="data">
					{{data.item.disposition.toLowerCase().split(' ').map(word => word.charAt(0).toUpperCase() + word.substring(1)).join(' ')}}
				</template>
				
				<template v-slot:cell(inout)="data">
					<span v-if="(data.item.src).length == 4">Out</span>
					<span v-else>In</span>
				</template>

				<template v-slot:cell(unit)="data">
					<span v-if="data.item.dst.substring(0,2)=='01'">{{parseFloat(data.item.billsec/10).toFixed(3).replace(/(\.0+|0+)$/, '')}}</span>
					<span v-else>{{parseFloat(data.item.billsec/180).toFixed(3).replace(/(\.0+|0+)$/, '')}}</span>
				</template>

				<template v-slot:cell(date)="data">
					{{data.item.calldate | formatDate}}
				</template>

				<template v-slot:cell(time)="data">
					{{data.item.calldate | formatTime}}
				</template>

			    </b-table>


			    <b-pagination
			      v-model="currentPage"
			      :total-rows="rows"
			      :per-page="perPage"
			      aria-controls="my-table">
			      </b-pagination>

			    <p class="mt-3">Current Page: {{ currentPage }}</p>
			  </div>
		  </div>
	  </layout>
	  </layout>
</template>

<script>
import Layout from './../../Shared/Layout'
import moment from 'moment'
import DatePicker from 'vue2-datepicker'

export default {

	props: ['cdr'],
	components: {
		DatePicker,
		Layout
	},
	data() {
    return {
      items: [],
      startDate:'',
      endDate:'',
      perPage: 20,
      currentPage: 1,
      sortBy: "name",
      sortDesc: false,
      pageOptions: [5, 10, 20, 50, {
        value: Number.MAX_SAFE_INTEGER,
        text: "show all"
      }],
      fields: [{
          key: "src",
          label: "Source"
        },
        {
        key: "dst",
          label: "Destination"
        },
        {
          key: "result",
          label: "Result"
        },
        {
          key: "inout",
          label: "In/Out"
        },
        {
          key: "duration",
          label: "Duration"
        },
        {
          key: "billsec",
          label: "Billsec"
        },
        {
          key: "unit",
          label: "Unit"
        },
        {
          key: "date",
          label: "Date"
        },
        {
          key: "time",
          label: "Time"
        }
      ]
    
    }
  },

	filters: {
	  formatDate: function(value) {
	    if (value)
    	return moment(String(value)).format('YYYY-DD-MM')
	  },
	  formatTime: function(value) {
	    if (value)
    	return moment(String(value)).format('HH:mm:ss')
	  }

	},
    methods: {
        onChangePage(pageOfItems) {
            console.log(pageOfItems)
            // update page of items
            this.pageOfItems = pageOfItems;
        },
            dateThAttrs(column) {
                return column.label === 'Date' ? {
                    title: 'This title is sponsored by "th-attrs" prop',
                    class: 'has-text-success'
                } : null
            },
            columnTdAttrs(row, column) {
                if (row.id === 'Total') {
                    if (column.label === 'ID') {
                        return {
                            colspan: 4,
                            class: 'has-text-weight-bold',
                            style: {
                                'text-align': 'left !important'
                            }
                        }
                    } else if (column.label === 'Gender') {
                        return {
                            class: 'has-text-weight-semibold'
                        }
                    } else {
                        return {
                            style: {display: 'none'}
                        }
                    }
                }
                return null
            },
  },

    computed: {
      rows() {
        return this.cdr.length
      },
    }
};

</script>
<style lang="scss">
.custom-table {
	border: 1px solid #9999;
	border-radius: 4px;
	color: #333;
	overflow: auto;

	b-table {
		border-collapse: collapse;
		width: 100.1%;
		color: #333;

		th {
			position: sticky;
			top: 0;
			background: #ccc;
			padding: 10px 5px;
			text-align: left;
			border-bottom: 1px solid #999;
		}

		td {
			padding: 10px 5px;
			text-align: left;
		}
	}
}

</style>