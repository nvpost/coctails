let addApp = new Vue({
    el: "#add_app",
    data() {
        return {
            ing_rows_template:{
                ingredient: "",
                amount: "",
                unit: ""
            },
            ing_rows: [],
            ing_units: ['мг', 'г', 'шт']
        }
    },
    created(){
        this.ing_rows.push({
            ingredient: "",
            amount: "",
            unit: ""
        })
    },
    methods:{
        checkForAddRow(block, index){
            let row = this[block][index]

            line_is_ready = 0
            for(var i in row){
                if(row[i].length>0){
                    line_is_ready++
                }
            }

            if(line_is_ready==3){ //==3
                let template = this[block+'_template']
                console.log('block', block)
                console.log('template', template)
                addApp[block].push(template)
               //  this[block].push({
               //      ingredient: "",
               //      amount: "",
               //      unit: ""
               //  })
                // console.log(res)
            }
        },
    }
})