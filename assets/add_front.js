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
            imgFile:"",
            existing_coctail: [],
            ingredient_hints: [],
            sort_ingredient_hints: [],
            tools_hints: [],
            name_hints: [],
            tag_list:[],
            selected_tags:[],
            fk:{}
        }
    },
    mounted(){
        this.getTags();
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
            validateState = line_is_ready==n
            return validateState
        },

        deleteRow(block, index){
            let line = index+1
            if(confirm('Удалить строку '+line+"?")){
                this[block].splice(index, 1);
            }

        },
        add_preview(event){
            let file = event.target.files[0]


            // провераяем тип файла
            if (!['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml'].includes(file.type)) {
                alert('Разрешены только изображения.');
                event.target.value=""
                return;
            }

            // проверим размер файла (<2 Мб)
            if (file.size > 2 * 1024 * 1024) {
                alert('Файл должен быть менее 2 МБ.');
                event.target.value=""
                return;
            }


            this.imgFile = event.target.files[0]
            var output = document.getElementById('preview_img');
            output.src = URL.createObjectURL(file);

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
            let like_flag=tag.length<3
            // if(tag.length<3){
            //     return false
            // }
            fetch(home_url+'components/add_parts/show_hint.php',{
                method: "POST",
                body: JSON.stringify({'field':field, 'tag':tag, 'like_flag': like_flag})
            })
                .then(res=>res.json())
                .then(data => {
                    tools = Object.keys(data.res)
                    // this.ingredient_hints = Object.keys(data.res)
                    this[field+"_hints"] = Object.keys(data.res)
                })
        },
        sort_hint_array(tools, name){
            return tools.slice(0, 5);
        },
        getTags(){
            this.tag_list = localStorage.getItem('coctailTags').split(',')

            if(this.tag_list==null){
                fetch(home_url+'components/add_parts/get_tags.php',{
                    method: "POST",
                })
                    .then(res=>res.json())
                    .then(data => {
                        tg = Object.keys(data.res)
                        this.tag_list = tg
                        localStorage.setItem('coctailTags', tg)

                    })
            }

        },
        addTag(e){
            tag = e.target.innerText
            let status = e.target.classList.contains('selected_tag')
            if(status){
                this.selected_tags = this.selected_tags.filter(i=>{
                    return i!=tag
                })
            }else{
                this.selected_tags.push(tag)
            }

            // console.log(this.selected_tags)
        },


        setModelFromTag(event, tag){
            let row_index = event.target.getAttribute('data-row')
            let model_root = event.target.getAttribute('data-model_root')
            let model_tail = event.target.getAttribute('data-model_tail')
            this[model_root][row_index][model_tail] = tag //ing_row[0].ingredient

            this[model_tail+"_hints"] = []
        },

        checkFormData(){
            let validScore = 0
            this.coctail_label.length>1 ? validScore++ : false
            this.ing_rows.length>2 ? validScore++ : false
            this.tools_rows.length>1 ? validScore++ : false
            this.process_rows.length>1 ? validScore++ : false
            this.selected_tags.length>0 ? validScore++ : false

            //TODO проверка на картинку

            let canSend= validScore==5
            return !canSend;

        },



        saveData(){
            if(this.coctail_label_en==0){
                if(confirm('Точно отправить без осмысленного английско названия')){
                    this.coctail_label_en=this.tranlate_coctail_name(this.coctail_label)
                }else{
                    return false
                }
            }
            if(this.coctail_descr==0){
                if(confirm('Точно отправить без Описания')){
                    this.coctail_descr=" ";
                }else{
                    return false
                }
            }


            let formContent = {
                'coctail_label':this.coctail_label,
                'coctail_label_en':this.coctail_label_en,
                'coctail_descr':this.coctail_descr,
                'ing_rows': JSON.stringify({'ings':this.ing_rows}),
                'tools_rows': JSON.stringify({'tools': this.tools_rows}),
                'process_rows': JSON.stringify({'process': this.process_rows}),
                'tag_list': JSON.stringify({'tags': this.selected_tags}),
                'img': this.imgFile,
                'img_name': this.coctail_label_en
            }
            this.fk = formContent

            this.sendData(formContent)
        },

        sendData(formContent){

            var fd = new FormData();

            Object.keys(formContent).forEach(i=>{
                fd.append(i, formContent[i])
            })
            //
            // console.log(this.imgFile)
            // console.log(fd)


            fetch(home_url+'components/add_parts/add_data.php', {
                method: 'POST',
                body: fd,
            })
                .then(res=>res.json())
                .then(data=>{
                    console.log(data)
                })
                .catch(error => console.error(error));

        },


        tranlate_coctail_name(name){
            let timestamp = Date.now()
            return 'tmp_coctail_name' + timestamp
        }






}
})

