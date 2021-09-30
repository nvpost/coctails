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
            img_src:""
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
            console.log(file)

            var output = document.getElementById('preview_img');
            output.src = URL.createObjectURL(file);
            console.log(output)
            // let home_url = "http://localhost/coctails/"
            // fetch(home_url+'components/add_parts/add_img.php',{
            //     method: "POST"
            // }).then(res=>res.json())
            //     .then(data=>console.log(data))
        },
        checkItem(field){
            let home_url = "http://localhost/coctails/"
            let data = this[field]
            fetch(home_url+'components/add_parts/check_data.php',{
                method: "POST",
                body: JSON.stringify({'field':field, 'data':data})
            })
                .then(res=>res.json())
                .then(data => console.log(data))

            console.log("coctail_label ",coctail_label, model)
        }
    }
})

