


let app = new Vue({

    el: '#coctail_app',
    components: {
        multiselect: VueMultiselect.Multiselect
    },
    data:{
        mes:'hi',
        value_tag:value_tag,
        options_tag: arr_tag,

        value_ingredient:value_ingredient,
        options_ingredient: arr_ingredient,

        value_name:value_name,
        options_name: arr_name,
    },
    methods:{
        goToTag(key, val){
            console.log(key, val)
            let url = decodeURI(document.location.href)
            newRoute = url.indexOf('=')>-1? url+'&'+key+"="+val : url+key+"="+val

            //document.location.href=newRoute

        },
        removeTag(key, val) {
            console.log(key, val)
            this['value_'+key] = this['value_'+key].filter(i=>{
                return i!=val
            })
            console.log(this['value_'+key])

            removeTag(key,val)
        }


    }

})