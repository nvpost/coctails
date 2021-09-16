let addApp = new Vue({
    el: "#add_app",
    data() {
        return {
            table_field:{
                ing:{
                    label: 'Ингреденты',
                    template:{
                        ingredient: "",
                        amount: "",
                        unit: ""
                    },
                    front:[
                        {placeholder: 'Ингредиент', type: 'text', model:'ingredient'},
                        {placeholder: 'Сколько', type: 'text', model:'amount'},
                        {type: 'select', options:['мг', 'г', 'шт'], model:'unit'},
                    ],
                    root_model: 'ing_rows',
                    data:[]
                },
                tools:{
                    label: 'Штуки',
                    template:{
                        name: "",
                        amount: "",
                        unit: ""
                    },
                    front:[
                        {placeholder: 'Штука', type: 'text', model:'name'},
                        {placeholder: 'Сколько', type: 'text', model:'amount'},
                        {type: 'select', model:'unit'},
                    ],
                    root_model: 'tools_rows',
                    data:[]
                },
                process:{
                    label: 'Как делать',
                    template:{
                        line: "",
                    },
                    front:[
                        {placeholder: 'процесс', type: 'text', model:'process'},
                    ],
                    root_model: 'process_rows',
                    data:[]
                }
            },
            ing_rows_template:{
                ingredient: "",
                amount: "",
                unit: ""
            },
            ing_rows: [
            ],
            tools_rows: [],
            process_rows: [],
            ing_units: ['мг', 'г', 'шт'],

        }
    },
    methods:{

        do_vModel(event, rootModel, index, lineModel){
            let vModel = addApp[rootModel][index][lineModel]
            console.log('vModel', vModel)
            console.log(event.target.value, rootModel, index, lineModel)
            addApp[rootModel][index][lineModel] = event.target.value
        },
        setTemplate(){
            for(var table in this.table_field){
                console.log(table)
                let table_copy = Object.assign({}, this.table_field[table].template)
                    addApp[table+'_rows'].push(table_copy)
            }
        },
        checkForAddRow(block, index){
            let addRow = this.validateRow(block, index, false)
            if(addRow){
                let template = Object.assign({}, this[block+'_template'])
                addApp[block].push(template)
            }
        },
        validateRow(block, index, validate=true){
            let row = this[block][index]
            let line_is_ready = 0
            if(index+1==this[block].length||validate){
                for(var i in row){
                    if(row[i].length>0){
                        line_is_ready++
                    }
                }
            }
            return line_is_ready==3
        },

        deleteRow(block, index){
            let line = index+1
            if(confirm('Удалить строку '+line+"?")){
                this[block].splice(index, 1);
            }

        }
    }
})

var inputTemplate = `
                    <input type="text"
                           :placeholder="placeholder"
                    >
`

Vue.component('input-temp', {
    props:{
        placeholder: ''},
    template: inputTemplate
})

