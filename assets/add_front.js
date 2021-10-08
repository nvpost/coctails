let home_url = "http://localhost/coctails/"
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
            coctail_label: '',
            coctail_label_en:'',
            coctail_descr:'',
            ing_rows: [
            ],
            tools_rows: [],
            process_rows: [],
            ing_units: ['мг', 'г', 'шт'],
            img_src:"",
            existing_coctail: [],
            ingredient_hints: [],
            sort_ingredient_hints: [],
            tools_hints: [],
            name_hints: [],
        }
    },
    methods:{

        setTemplate(){
            for(var table in this.table_field){
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
            n = block=='process_rows'?1:3
            return line_is_ready==n
        },

        deleteRow(block, index){
            let line = index+1
            if(confirm('Удалить строку '+line+"?")){
                this[block].splice(index, 1);
            }

        },
        add_prewiev(event){
            let file = event.target.files[0]

            var output = document.getElementById('preview_img');
            output.src = URL.createObjectURL(file);
            console.log(output)
        },
        checkItem(field){

            let name = this[field]
            fetch(home_url+'components/add_parts/check_data.php',{
                method: "POST",
                body: JSON.stringify({'field':field, 'name':name})
            })
                .then(res=>res.json())
                .then(data => {
                    if(data.res.length!=0){
                        console.log('Уже есть')
                        console.log(data.res)
                        this.existing_coctail=data.res[0];
                    }
                })
        },
        ShowHint(event, field){
            let tag = event.target.value
            if(tag.length<3){
                return false;
            }
            console.log(field+"_hints")
            fetch(home_url+'components/add_parts/show_hint.php',{
                method: "POST",
                body: JSON.stringify({'field':field, 'tag':tag})
            })
                .then(res=>res.json())
                .then(data => {
                    console.log(data)
                    tools = Object.keys(data.res)
                    // this.ingredient_hints = Object.keys(data.res)
                    this[field+"_hints"] = Object.keys(data.res)
                })
        },
        sort_hint_array(tools, name){
            return tools.slice(0, 5);
        },
        setModelFromTag(event, tag){
            console.log(event.target, tag)
            let row_index = event.target.getAttribute('data-row')
            let model_root = event.target.getAttribute('data-model_root')
            let model_tail = event.target.getAttribute('data-model_tail')
            console.log(model_root, row_index, model_tail)
            this[model_root][row_index][model_tail] = tag //ing_row[0].ingredient

            console.log(this[model_root][row_index][model_tail])
            this[model_tail+"_hints"] = []
            //this[model].push[tag]


        }

    }
})

