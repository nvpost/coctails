function showTrigger(f){
    let el_class = '.block_'+f
    let el = document.querySelector(el_class)

    let button = el.querySelector('.tag_button')
    if(button.innerText !="Скрыть"){
        button.classList.add('tag_button_open')
        button.innerText="Скрыть"
        el.classList.add('open_tools')
    }else{

        button.innerText="Показать"
        el.classList.remove('open_tools')
        button.classList.remove('tag_button_open')
    }
}

function removeTag(key,val){
    let els = document.querySelectorAll('.active_tags .active_tags_item')
    if(els.length==1){
        document.location.href = home_url
    }else{
        val = val.replaceAll('_', ' ')
        let url = decodeURI(document.location.href)
        // console.log(key, val);

        if(url.indexOf("&"+key+"="+val)!=-1){
            forDelete = "&"+key+"="+val
            console.log('case 1')
        }
        if(url.indexOf(key+"="+val+"&")!=-1){
            forDelete = key+"="+val+"&"
            console.log('case 2')
        }

        if(url.indexOf(';'+val)!=-1){
            forDelete = ';'+val
            console.log('case 3')
        }
        if(url.indexOf(val+';')!=-1){
            forDelete = val+';'
            console.log('case 4')
        }
        console.log(url);
        console.log(forDelete);
        let newUrl = url.replace(forDelete, '')
        document.location.href = newUrl
    }

}

tag_search_triggers = document.querySelectorAll('.tag_search_trigger')
tag_search_triggers.forEach(i=>{
    i.addEventListener('click', openSelect.bind())
})

function openSelect(e){
    el = e.target
    field = el.getAttribute('data-field')
    let ms = document.querySelector(".multiselect[data-id='"+field+"']")
    if(el.getAttribute('data-active')=='true'){
        el.removeAttribute('data-active')
        el.classList.remove('fa-times')
        el.classList.add('fa-search')
        ms.style.opacity='0';
    }else{
        el.setAttribute('data-active', 'true')
        el.classList.remove('fa-search')
        el.classList.add('fa-times')
        ms.style.opacity='1';
    }

}
