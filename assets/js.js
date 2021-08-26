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
        }
        if(url.indexOf(key+"="+val+"&")!=-1){
            forDelete = key+"="+val+"&"
        }

        if(url.indexOf(';'+val)!=-1){
            forDelete = ';'+val
            console.log('case 3')
        }
        if(url.indexOf(val+';')!=-1){
            forDelete = val+';'
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

function auth_modal(){
    let modalWrapper = document.createElement('div')
    modalWrapper.classList.add('auth_modal')

    auth_urls.forEach(i=>{
        let authModalLink = document.createElement('div')
        authModalLink.classList.add('auth_modal_link')
        authModalLinkHtml = "<a href='"+i.link+"'>"
        authModalLinkHtml += "<i class='"+i.fa+"'></i>"
        authModalLinkHtml += "<span>"+i.label+"</span>"
        authModalLinkHtml += "</a>"

        authModalLink.innerHTML = authModalLinkHtml;
        modalWrapper.appendChild(authModalLink)
    })

    openModal(modalWrapper)

}

function openModal(mc){
    let hover = document.querySelector('.hover')
    hover.style.zIndex=1000
    hover.style.opacity=1
    hover.style.display="flex"
    let app = document.querySelector('#coctail_app')
    hover.appendChild(mc)
}

function closeModal(){
    document.querySelector('.auth_modal').remove();

    let hover = document.querySelector('.hover')
    hover.style.display="none"

}

