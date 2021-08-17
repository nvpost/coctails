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
        forDelete = "&"+key+"="+val
        if(url.indexOf(forDelete)==-1){
            forDelete = key+"="+val+"&"
        }
        // console.log(url);
        // console.log(forDelete);
        let newUrl = url.replace(forDelete, '')
        document.location.href = newUrl
    }

}